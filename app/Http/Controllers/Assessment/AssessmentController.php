<?php

namespace App\Http\Controllers\Assessment;

use PDF;
use Exception;
use Carbon\Carbon;
use App\Models\Program;
use App\Models\Student;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use App\Classes\StudentClass;
use App\Classes\ScheduleClass;
use App\Models\CashierBalance;
use App\Models\CashierFeeType;
use App\Models\CashierCollection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use App\Models\CashierCollectionDetail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ViewController;
use App\Models\CashierCollectionDetails;

class AssessmentController extends Controller
{
    public function index()
    {
        return view('assessment.index')->render();
    } 

    public function showSearch(){

        return response()->json([
            'view' => view('assessment.search')->render()
        ]);

    }

    public function search(Request $request)
    {
        try {
            $students = collect([]);

            $student = new Student;

            $data = $student->select('fname', 'lname', 'mname', 'stud_id', 'is_cabs')->where('stud_id', 'LIKE', "%{$request->search}%")->get();

            foreach($data as $item){
                $enrolment = Enrolment::where('stud_id', 'LIKE', "%{$request->search}%")->current()->first();

                $student->cabs = $item->is_cabs;
                $student->name = $item->fullname;
                $student->id = $item->id_key;
                $student->program = $enrolment->program->program_code;

                $students->push($student);
            }

            return response([
                'data' => $students->toJson(),
                'status' => 200
            ]);

        } catch(Exception $exp) {

            return response([
                'message' => $exp->getMessage(),
                'status' => 400
            ]);

        }
    }

    public function assess(Request $request)
    {
        try {
            $enrolment = Enrolment::with('student')->where('stud_id', decrypt($request->id))->current()->first();
            $schedules = DB::select('call STUDENT_SCHEDULES('.$enrolment->stud_id.', 2, 20)');
            $fees = $this->getFees($enrolment);

            $fee_types = CashierFeeType::whereIn('fee_type_id', $fees->pluck('fee_type_id'))->get();

            return response()->json([
                'status' => 200,
                'view' => view('assessment.student', compact('enrolment', 'schedules', 'fees', 'fee_types'))->render()
            ]);
        } catch(Exception $exp) {

            return response([
                'message' => $exp->getMessage(),
            ], 400);
        }
        
    }

    public function store(Request $request)
    {
        $enrolment = Enrolment::where('stud_id', decrypt($request->id))->current()->first();
        $has_assessment = CashierBalance::where([['account_id', decrypt($request->id)], ['sem_id', 2], ['ay_id', 20]])->first();

        if(!$has_assessment){
            
            $assessment = self::saveAssessment($enrolment);

            if($assessment->status() == 200){
                return response([
                    'message' => "Student assessed successfully!",
                    'status' => 200
                ]);
            } else {
                return response([
                    'message' => "An error occured!",
                    'status' => 400
                ]);
            }
        } 

        return response([
            'message' => "Student already assessed!",
            'status' => 400
        ]);
    }

    public function streamAssessment($stud_id)
    {
        $enrolment = Enrolment::where('stud_id', decrypt($stud_id))->current()->first();
        $model = new CashierBalance();
        $student_fee_breakdown = $model->hydrate(
            DB::select('call GET_STUDENT_ASSESSMENT('.$enrolment->stud_id.')')
        );
        $schedules = DB::select('call STUDENT_SCHEDULES('.$enrolment->stud_id.', 2, 20)');

        $fee_types = CashierFeeType::whereIn('fee_type_id', $student_fee_breakdown->pluck('fee_type_id'))->get();

        $filename = 'Assessment Form - '.$enrolment->student->lname;
        $customPaper = array(0,0,612,936);
        $pdf = PDF::loadView('assessment.template', compact('schedules', 'enrolment', 'student_fee_breakdown', 'fee_types'));
        $pdf->set_paper($customPaper);
        return $pdf->stream($filename.'.pdf');
    }

    public function automatedAssessment(Request $request)
    {
        set_time_limit(0);

        $enrolments = Enrolment::current()->where('program_id', $request->program_id)->whereNot('isassessed', 1)->get();

        foreach($enrolments as $enrolment){
            self::saveAssessment($enrolment);
        }

        $status = Enrolment::current()->where('program_id', $request->program_id)->select('isassessed')->get();

        return response([
            'message' => "Success",
            'status' => 200,
            'assessed' => $status->where('isassessed', 1)->count(),
            'not_assessed' => $status->where('isassessed', 0)->count(),
        ]);
    }

    public function get_status()
    {
        $enrolments = Enrolment::current()->where([['sem_id', 2], ['ay_id', 20]])->get();
        $isassessed = $enrolments->where('isassessed', 1)->count();
        $not_assessed = $enrolments->where('isassessed', 0)->count();

        return response([
            'isassessed' => $isassessed,
            'not_assessed' => $not_assessed
        ]);
    }

    public function reassess(Request $request)
    {
        try{
            DB::beginTransaction(); 

            $collection = CashierCollection::where([['account_id', decrypt($request->account_id)], ['sem_id', 2], ['ay_id', 20]])->first();
            $balance = CashierBalance::where([['account_id', decrypt($request->account_id)], ['sem_id', 2], ['ay_id', 20]])->get();
            $collection_detail = CashierCollectionDetail::where('account_id', decrypt($request->account_id))->get();

            if($balance->isNotEmpty()){
                $balance->each->delete();
            }

            if($collection_detail->isNotEmpty()){
                $collection_detail->where('col_id', $collection->col_id)->each->delete();
            }

            if($collection){
                $collection->delete();
            }
            
            Enrolment::current()->where('stud_id', decrypt($request->account_id))->update([
                'isassessed' => 0
            ]);

            $enrolment = Enrolment::current()->where('stud_id', decrypt($request->account_id))->whereNot('isassessed', 1)->first();

            self::saveAssessment($enrolment);

            DB::commit(); 

            return response([
                'message' => "Assessment updated successfully!",
            ], 200);

        } catch(Exception $exp) {
            DB::rollBack(); 

            return response([
                'message' => $exp->getMessage(),
            ], 400);
        }
    }

    public function saveAssessment($enrolment)
    {
        try{
            DB::beginTransaction(); 

            $schedules = $this->getStudentSchedules($enrolment);

            $enrolment->units = $schedules->sum('units');
            $enrolment->lec_count = $schedules->sum('lec_units');
            $enrolment->lab_count = $schedules->sum('lab_units');
            $enrolment->rle_count = $schedules->where('class_type', 3)->count();
            
            $fees = $this->getFees($enrolment);
            
            if($enrolment->student->has_unifast)
            {
                $collection = CashierCollection::create([
                    'account_id' => $enrolment->stud_id, 
                    'account_type' => $fees->first()->account_type, 
                    'sem_id' => $enrolment->sem_id, 
                    'ay_id' => $enrolment->ay_id, 
                    'collection_date' => Carbon::now(), 
                    'amount' => $fees->where('unifast', 1)->sum('cost'), 
                    'scholarship_id' => 1, 
                    'or_no' => 'uinifast', 
                    'remarks' => 'unifast', 
                    'is_active' =>  1,
                ]);
            }

            foreach($fees as $fee){
                $saved_balance = CashierBalance::create([
                    'account_id' => $enrolment->stud_id,
                    'account_type' => $fee->account_type,
                    'fee_id' => $fee->fee_id,
                    'fee_type_id' => $fee->fee_type_id,
                    'sem_id' => $enrolment->sem_id,
                    'ay_id' => $enrolment->ay_id,
                    'cost' => $fee->cost,
                    'status' => 1
                ]);

                if($fee->unifast)
                {
                    $collection_detail = new CashierCollectionDetail;
                    $collection_detail->account_id = $enrolment->stud_id;
                    $collection_detail->fee_id = $fee->fee_id;
                    $collection_detail->fee_type_id = $fee->fee_type_id;
                    $collection_detail->bal_id = $saved_balance->bal_id;
                    $collection_detail->col_id = $collection->col_id;
                    $collection_detail->amount = $fee->cost;
                    $collection_detail->is_active = 1;
                    $collection_detail->save();
                }
                
            }

            $enrolment = Enrolment::where('enrolment_id', $enrolment->enrolment_id)->update([
                'isassessed' => 1
            ]);

            DB::commit(); 

            return response([
                'message' => "Assessment saved successfully!",
            ], 200);

        } catch(Exception $exp) {
            DB::rollBack(); 

            return response([
                'message' => $exp->getMessage(),
            ], 400);
        }
    }

    public function generate(Request $request)
    {
        try {
            // $enrolments = Enrolment::current()->where('program_id', $request->program_id)->get()->makeHidden(['units', 'lec_count', 'lab_count', 'rle_count', 'course_count']);
            $enrolments = Enrolment::current()->whereIn('stud_id', [2202440, 2202419, 2201492, 2202390, 2202446, 1903573, 1903688, 2000315])->get()->makeHidden(['units', 'lec_count', 'lab_count', 'rle_count', 'course_count']);
            $program = Program::select('program_code')->where('program_id', $request->program_id)->first(); 
            $storage_path = storage_path("app/".$program->program_code);

            set_time_limit(0);

            foreach($enrolments as $enrolment){
                $model = new CashierBalance();
                $student_fee_breakdown = $model->hydrate(
                    DB::select('call GET_STUDENT_ASSESSMENT('.$enrolment->stud_id.')')
                );
                $fee_types = CashierFeeType::whereIn('fee_type_id', $student_fee_breakdown->pluck('fee_type_id'))->get();
                $schedules = DB::select('call STUDENT_SCHEDULES('.$enrolment->stud_id.', 2, 20)');

                $filename = 'Assessment Form - '.$enrolment->student->lname;
                $customPaper = array(0,0,612,936);
                $pdf = PDF::loadView('assessment.template', compact('schedules', 'enrolment', 'student_fee_breakdown', 'fee_types'));
                $pdf->set_paper($customPaper);
                $filename = $enrolment->student->lname.'_'.$enrolment->student->fname.'_-_04_PnC_2023_'.$enrolment->sem_id.'_1.pdf';
                $content = $pdf->download()->getOriginalContent();
                Storage::put($program->program_code.'/'.$filename,$content) ;
            }

            return response()->json([
                'status' => 200
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }
    
}
