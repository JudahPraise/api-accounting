<?php

namespace App\Http\Controllers\Api;

use PDF;
use App\Models\Program;
use App\Models\Student;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use App\Models\CashierBalance;
use App\Models\CashierFeeType;
use App\Models\PaymentRequest;
use App\Models\StudentBalance;
use Illuminate\Support\Carbon;
use App\Models\CashierCollection;
use App\Models\NonUnifastGrantee;
use App\Models\StudentAssessment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CashierCollectionDetail;

class AssessmentController extends Controller
{
    protected function check_assessment($enrolment_id)
    {   
        // get enrolment id 
        $enrolment = Enrolment::where('enrolment_id', $enrolment_id)->first();
        
        // get student
        $student = Student::select('stud_id', 'is_cabs', 'fname', 'lname', 'mname')->where('stud_id', $enrolment->stud_id)->first();

        $non_unifast_grantees = NonUnifastGrantee::where('stud_id', $student->stud_id)->get();
        // get enrolment count check if student is on first year first semester
        $enrolment_count = Enrolment::select('stud_id')->where('stud_id', $student->stud_id)->get()->count();
        // get student's current enlisted schedules 
        $schedules = StudentAssessment::procstudentschedules($student->stud_id, $enrolment->sem_id, $enrolment->ay_id);
        // Check student type
        $college = Program::where('program_id', $enrolment->program_id)->first();
        
        $student_type = $college->college_id == 7 ? 2 :1;
        
        // get second take courses
        $retake_courses = StudentAssessment::procretakecourses($student->stud_id, $enrolment->sem_id, $enrolment->ay_id);
        // get regular courses
        $regular_courses = $schedules->whereNotIn('course_id', $retake_courses->pluck('course_id'));
        // get nstp courses
        $nstp_courses = $schedules->filter(function ($schedule) {
            return strpos($schedule['code'], 'NSTP') !== false;
        });
        // get RLE
        $rle_courses = $schedules->filter(function ($schedule) {
            return strpos($schedule['code'], 'RLENCM') !== false;
        });
        // get skills lab
        $skills_lab = $schedules->filter(function ($schedule) {
            return strpos($schedule['room'], 'SKILLS') !== false;
        });

        // get regular units
        $regular_units = $schedules->whereNotIn('course_id', $retake_courses->pluck('course_id'));
        // get second take units
        $retake_units =  $schedules->whereIn('course_id', $retake_courses->pluck('course_id'))->whereNotIn('course_id', $nstp_courses->pluck('course_id'));
        // get regular nstp units
        $regular_nstp_units = $nstp_courses->whereNotIn('course_id', $retake_courses->pluck('course_id'))->sum('units');
        // get retake nstp units
        $retake_nstp_units = $nstp_courses->whereIn('course_id', $retake_courses->pluck('course_id'))->sum('units');

        if($non_unifast_grantees->isEmpty() && $student_type == 1){
            if($schedules->count() == $schedules->where('type', 1)->count()){
                $is_unifast = 0; //If number of petition is equal to number of subject non unifast
            } else {
                $is_unifast = 1;
            }
        } else {
            $is_unifast = 0; // non unifast or !college
        }

        $student_assessment_config = [
            'name' => $student->fullname,
            'stud_id' => $student->stud_id,
            'enrolment_id' => $enrolment->enrolment_id,
            'student_type' => $student_type, 
            'is_cabs' => $student->is_cabs,
            'is_unifast' => $is_unifast,
            'past_enrolment_count' => $enrolment_count,
            'program' => $enrolment->program_id,
            'major' => $enrolment->major,
            'sem_id' => $enrolment->sem_id,
            'ay_id' => $enrolment->ay_id,
            'courses' => $schedules->pluck('code'),
            'rle_courses' => $rle_courses->pluck('code'),
            'skills_lab' => $skills_lab->count(),

            'regular_nstp_units' => $regular_nstp_units,
            'regular_units' => $regular_units->sum('units'),
            'regular_com_lab_units' => $regular_units->where('has_lab_room', 0)->where('lab_units','<>',0)->sum('lab_units'),
            'regular_lab_room' => $regular_units->where('has_lab_room', 1)->count() - $skills_lab->count(),

            'retake_nstp_units' => $retake_nstp_units,
            'retake_units' => $retake_units->sum('units'),
            'retake_com_lab_units' => $retake_units->where('has_lab_room', 0)->where('lab_units','<>',0)->sum('lab_units'),
            'retake_lab_room' => $retake_units->where('has_lab_room', 1)->count() - $skills_lab->count(),   

            'petition_class_count' => $schedules->where('type', 1)->count(),
            'petition_class_courses' => $schedules->where('type', 1)->map(function ($item) {
                return [
                    'sched_id' => $item['sched_id'],
                    'course_id' => $item['course_id'],
                    'code' => $item['code'],
                    'units' => $item['units'],
                    'petition_cost' => $item['petition_cost'],
                    'class_size' => $item['class_size'],

                ];
            }),
            'petition_class_lab_units' => $schedules->where('type', 1)->sum('lab_units'),
            
            'total_units' => $schedules->sum('units'),
            'lec_units' => $schedules->sum('lec_units'),
            'clab_units' => $schedules->where('has_lab_room', 0)->where('lab_units','<>',0)->sum('lab_units'),
            'lab_units' =>  $schedules->where('has_lab_room', 1)->sum('lab_units'),
        ];

        return $student_assessment_config ;
    }

    public function assess_student(Request $request)
    {   
        try {
            DB::beginTransaction();

            $student_config = self::check_assessment($request->enrolment_id);
            $assessment = self::make_assessment($request->enrolment_id, $student_config);

            DB::commit();
            
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'student' => $student_config,
                'reassessment' => 0
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function reassess_student(Request $request)
    {   
        try {
            DB::beginTransaction();

            $student_config = self::check_assessment($request->enrolment_id);
            
            // Remove balances
            $balances = CashierBalance::where([['account_id', $student_config['stud_id']],['sem_id', $student_config['sem_id']],['ay_id', $student_config['ay_id']]]);
            $bal_ids = $balances->pluck('bal_id');
            $oop_ids = PaymentRequest::whereIn('bal_id', $bal_ids)->pluck('bal_id');

            $collection_details = CashierCollectionDetail::whereIn('bal_id', $bal_ids);
            $col_ids = $collection_details->pluck('col_id')->unique();
            $collections = CashierCollection::whereIn('col_id', $col_ids)->get();

            $remove_balances = $balances->whereNotIn('bal_id', $oop_ids)->delete();

            $assessment = self::make_assessment($request->enrolment_id, $student_config);
            
            $collection_details->whereNotIn('bal_id', $oop_ids)->delete();

            foreach($collections as $collection){
                
                $oop_amount = CashierCollectionDetail::whereIn('bal_id', $oop_ids)->where('col_id', $collection->col_id)->sum('amount');

                if($collection->or_no != "unifast"){

                    $amount = $collection->amount - $oop_amount;
                    
                    $procstudenttotalbalancepersem = StudentBalance::procstudenttotalbalancepersem($student_config['stud_id']);
                    self::distribute($procstudenttotalbalancepersem, $amount, $student_config['stud_id'], $collection->col_id, false);
                } else {

                    $collection->delete();

                }
            }

            

            DB::commit();
            
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'student' => $student_config,
                'reassessment' => 1
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }
    
    public function generate_reg_form($enrolment_id)
    {
        $student_config = self::check_assessment($enrolment_id);
        
        $enrolment = Enrolment::with('student')->where('enrolment_id', $enrolment_id)->first();
        // get assessment
        $student_fee_breakdown = StudentAssessment::procstudentassessment($student_config['stud_id'], $student_config['sem_id'], $student_config['ay_id']);
        // get student schedules
        $schedules = StudentAssessment::procstudentschedules($student_config['stud_id'], $student_config['sem_id'], $student_config['ay_id']);

        
        // get fee types
        $fee_types = CashierFeeType::whereIn('fee_type_id', $student_fee_breakdown->pluck('fee_type_id'))->get();

        $htmlContent = view('assessment.template', compact('schedules', 'enrolment', 'student_fee_breakdown', 'fee_types', 'student_config'))->render();
        
        return response($htmlContent, 200)
        ->header('Content-Type', 'text/html');
    }

    public function view_reg_form($enrolment_id)
    {
        $student_config = self::check_assessment($enrolment_id);
        
        $enrolment = Enrolment::with('student')->where('enrolment_id', $enrolment_id)->first();
        // get assessment
        $student_fee_breakdown = StudentAssessment::procstudentassessment($student_config['stud_id'], $student_config['sem_id'], $student_config['ay_id']);
        // get student schedules
        $schedules = StudentAssessment::procstudentschedules($student_config['stud_id'], $student_config['sem_id'], $student_config['ay_id']);

        // get fee types
        $fee_types = CashierFeeType::whereIn('fee_type_id', $student_fee_breakdown->pluck('fee_type_id'))->get();

        $htmlContent = view('assessment.template', compact('schedules', 'enrolment', 'student_fee_breakdown', 'fee_types', 'student_config'))->render();
        
        $filename = 'Assessment Form - '.$enrolment->student->fullname;
        $customPaper = array(0,0,612,936);
        $pdf = PDF::loadHTML($htmlContent);
        $pdf->set_paper($customPaper);
        return $pdf->stream($filename.'.pdf');
    }

    public function student_config(Request $request)
    {
        return  $student_config = self::check_assessment($request->enrolment_id);
    }

    public function student_assessment_template(Request $request)
    {
        $student_config = self::check_assessment($request->enrolment_id);

        $has_petition = $student_config['petition_class_count'] > 0 ? 1 : 0;

        $template = StudentAssessment::procassessmenttemplate($student_config['is_cabs'], $student_config['past_enrolment_count'], $student_config['is_unifast'], $student_config['program']);

        return $template;
    }

    public function make_assessment($enrolment_id, $student_config)
    {
        try {
            DB::beginTransaction();
            
            $has_petition = $student_config['petition_class_count'] > 0 ? 1 : 0;
            // get assessment template
            $template = StudentAssessment::procassessmenttemplate($student_config['is_cabs'], $student_config['past_enrolment_count'], $student_config['is_unifast'], $student_config['program']);

            // Insert Miscellaneous Fee
            foreach($template->whereNotIn('fee_type_id', [1, 17, 8, 3]) as $item){
                $insert_balance = CashierBalance::create([
                    'account_id' => $student_config['stud_id'],
                    'account_type' => 1,
                    'fee_id' => $item->fee_id,
                    'fee_type_id' => $item->fee_type_id,
                    'sem_id' => $student_config['sem_id'],
                    'ay_id' => $student_config['ay_id'],
                    'cost' => $item->cost,
                    'status' => 1
                ]);
            }

            // Insert RLE Fee
            if($student_config['program'] == 14){

                foreach($template->where('fee_type_id', 17)->whereIn('name', $student_config['rle_courses']) as $item){
                    $insert_balance = CashierBalance::create([
                        'account_id' => $student_config['stud_id'],
                        'account_type' => 1,
                        'fee_id' => $item->fee_id,
                        'fee_type_id' => $item->fee_type_id,
                        'sem_id' => $student_config['sem_id'],
                        'ay_id' => $student_config['ay_id'],
                        'cost' => $item->cost,
                        'status' => 1
                    ]);
                }

                $affiliation_fee = $template->where('fee_id', 96)->first();

                $insert_affiliation_fee = CashierBalance::create([
                    'account_id' => $student_config['stud_id'],
                    'account_type' => 1,
                    'fee_id' => $affiliation_fee->fee_id,
                    'fee_type_id' => $affiliation_fee->fee_type_id,
                    'sem_id' => $student_config['sem_id'],
                    'ay_id' => $student_config['ay_id'],
                    'cost' => $affiliation_fee->cost,
                    'status' => 1
                ]);
            }

            // Insert Computer Fee
            foreach ($template->where('fee_type_id', 3) as $item) {
                // Computer Laboratory Fee - Regular
                if($student_config['regular_com_lab_units'] > 0){
                    if($item->fee_id == 24 || $item->fee_id == 630){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['regular_com_lab_units'],
                            'status' => 1
                        ]);
                    }
                }

                // Computer Laboratory Fee - Retake
                if($student_config['retake_com_lab_units'] > 0){
                    if($item->fee_id == 93 || $item->fee_id == 631){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['retake_com_lab_units'],
                            'status' => 1
                        ]);
                    }
                }

                // ICT Services
                if($item->fee_id == 25 || $item->fee_id == 632){
                    $insert_balance = CashierBalance::create([
                        'account_id' => $student_config['stud_id'],
                        'account_type' => 1,
                        'fee_id' => $item->fee_id,
                        'fee_type_id' => $item->fee_type_id,
                        'sem_id' => $student_config['sem_id'],
                        'ay_id' => $student_config['ay_id'],
                        'cost' => $item->cost,
                        'status' => 1
                    ]);
                }

                // Petition Class Laboratory Fee
                if($student_config['petition_class_lab_units'] > 0){
                    if($item->fee_id == 93){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['petition_class_lab_units'],
                            'status' => 1
                        ]);
                    }
                }
            }

            //Regular Units

            //Insert Tuition Fee
            foreach ($template->where('fee_type_id', 1) as $item) {
                if($student_config['regular_units'] > 0){
                    // Regular Tuition
                    if($item->fee_id == 19 || $item->fee_id == 79 || $item->fee_id == 629){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['regular_units'],
                            'status' => 1
                        ]);
                    }
                }

                if($student_config['retake_units'] > 0){
                    // Retake Tuition
                    if($item->fee_id == 56 || $item->fee_id == 81){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['retake_units'],
                            'status' => 1
                        ]);
                    }
                }

                if($student_config['regular_nstp_units'] > 0){
                    // Regular NSTP
                    if($item->fee_id == 94 || $item->fee_id == 95){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['regular_nstp_units'],
                            'status' => 1
                        ]);
                    }
                }
                
                if($student_config['retake_nstp_units'] > 0){
                    // Retake NSTP
                    if($item->fee_id == 78 || $item->fee_id == 80){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['retake_nstp_units'],
                            'status' => 1
                        ]);
                    }
                }
            }
            
            // Laboratory Fee
            foreach ($template->where('fee_type_id', 8) as $item) {
                // Regular laboratory fee
                if($student_config['regular_lab_room'] > 0){
                    if($item->fee_id == 36){
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['regular_lab_room'],
                            'status' => 1
                        ]);
                    }
                }
                // Retake laboratory fee
                if($student_config['retake_lab_room'] > 0){
                    if($item->fee_id == 89){    
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['retake_lab_room'],
                            'status' => 1
                        ]);
                    }
                }
                // Skills Lab
                if($student_config['skills_lab'] > 0){
                    if($item->fee_id == 82){    
                        $insert_balance = CashierBalance::create([
                            'account_id' => $student_config['stud_id'],
                            'account_type' => 1,
                            'fee_id' => $item->fee_id,
                            'fee_type_id' => $item->fee_type_id,
                            'sem_id' => $student_config['sem_id'],
                            'ay_id' => $student_config['ay_id'],
                            'cost' => $item->cost * $student_config['skills_lab'],
                            'status' => 1
                        ]);
                    }
                }
            }

            // Insert Petition Fee
            if($has_petition){
                foreach ($student_config['petition_class_courses'] as $class) {

                    $petition_class = $template->where('tuition_type', 1)->first();

                    foreach ($template->where('tuition_type', 1) as $item) {
                        if($class['class_size'] >= 15){
                            $insert_balance = CashierBalance::create([
                                'account_id' => $student_config['stud_id'],
                                'account_type' => 1,
                                'fee_id' => $petition_class->fee_id,
                                'fee_type_id' => $petition_class->fee_type_id,
                                'sem_id' => $student_config['sem_id'],
                                'ay_id' => $student_config['ay_id'],
                                'cost' => $class['petition_cost'] * $class['units'],
                                'status' => 1
                            ]);
                        } else {
                            $insert_balance = CashierBalance::create([
                                'account_id' => $student_config['stud_id'],
                                'account_type' => 1,
                                'fee_id' => $petition_class->fee_id,
                                'fee_type_id' => $petition_class->fee_type_id,
                                'sem_id' => $student_config['sem_id'],
                                'ay_id' => $student_config['ay_id'],
                                'cost' => $class['petition_cost'] / $class['class_size'],
                                'status' => 1
                            ]);
                        }
                    }
                }
            }


            $to_collect = StudentAssessment::procassessmentbalances($student_config['stud_id'], $student_config['sem_id'], $student_config['ay_id']);
            // Collection Process ...
            if($student_config['is_unifast'] == 1){
                $collection = CashierCollection::create([
                    'account_id' => $student_config['stud_id'], 
                    'account_type' => 1, 
                    'sem_id' => $student_config['sem_id'], 
                    'ay_id' => $student_config['ay_id'], 
                    'collection_date' => Carbon::now(), 
                    'amount' => $to_collect->where('is_unifast', 1)->sum('cost'), 
                    'scholarship_id' => 1, 
                    'or_no' => 'unifast', 
                    'remarks' => 'unifast', 
                    'is_active' =>  1,
                ]);

                foreach ($to_collect->where('is_unifast', 1) as $item) {
                    $collection_detail = new CashierCollectionDetail;
                    $collection_detail->account_id = $student_config['stud_id'];
                    $collection_detail->fee_id = $item->fee_id;
                    $collection_detail->fee_type_id = $item->fee_type_id;
                    $collection_detail->bal_id = $item->bal_id;
                    $collection_detail->col_id = $collection->col_id;
                    $collection_detail->amount = $item->cost;
                    $collection_detail->is_active = 1;
                    $collection_detail->save();
                }
            }
            
            $enrolment = Enrolment::where('enrolment_id', $student_config['enrolment_id'])->update([
                'isassessed' => 1
            ]);

            DB::commit();
            
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'student' => $student_config
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function distribute($procstudenttotalbalancepersem, $payment_amount, $stud_id, $col_id, $is_oop)
    {
        $counter = 0;

        if($is_oop){
            foreach ($procstudenttotalbalancepersem as $balance) {

                $counter++;

                if($payment_amount >= $balance->balance){
                    $balance_amount = $balance->balance;
                    $payment_amount-= $balance->balance;
                }else{
                    $balance_amount = $payment_amount;
                    $payment_amount = 0;
                }

                if($balance_amount <= 0){
                    break;
                }

                $cashier_collection_details = new CashierCollectionDetail();
                $cashier_collection_details->account_id = $stud_id;
                $cashier_collection_details->fee_id = $balance->fee_id;
                $cashier_collection_details->fee_type_id = $balance->fee_type_id;
                $cashier_collection_details->bal_id = $balance->bal_id;
                $cashier_collection_details->col_id = $col_id;
                $cashier_collection_details->amount = $balance_amount;
                $cashier_collection_details->is_active = 1;
                
                if($cashier_collection_details->save()){
                    if($balance->account_type == 2){

                        $update_balance = CashierBalance::where('bal_id', $balance->bal_id)->first();
                        $update_balance->account_type = 1;
                        $update_balance->update();

                        $update_request = PaymentRequest::where([
                            ['account_id', '=', $balance->account_id],
                            ['bal_id', '=', $balance->bal_id]
                        ])->update([
                            'status' => 2
                        ]);

                    }
                }
            }
        } else {
            $procStudentBalance = CashierBalance::procStudentBalance($stud_id)->where('account_type', 1);

            foreach($procstudenttotalbalancepersem as $persem_item){

                if($payment_amount >= $persem_item->balance){
                    $temp_payment_amount =  $persem_item->balance;
                    $payment_amount-= $persem_item->balance;
                } else {
                    $temp_payment_amount =  $payment_amount;
                    $payment_amount = 0;
                }

                if($temp_payment_amount > 0){
                    foreach ($procStudentBalance->where('sem_id', $persem_item->sem_id)->where('ay_id', $persem_item->ay_id) as $balance) {
                        
                        $counter++;

                        if($temp_payment_amount >= $balance->balance){
                            $balance_amount = $balance->balance;
                            $temp_payment_amount-= $balance->balance;
                        }else{
                            $balance_amount = $temp_payment_amount;
                            $temp_payment_amount = 0;
                        }

                        if($balance_amount <= 0){
                            break;
                        }

                        $cashier_collection_details = new CashierCollectionDetail();
                        $cashier_collection_details->account_id = $stud_id;
                        $cashier_collection_details->fee_id = $balance->fee_id;
                        $cashier_collection_details->fee_type_id = $balance->fee_type_id;
                        $cashier_collection_details->bal_id = $balance->bal_id;
                        $cashier_collection_details->col_id = $col_id;
                        $cashier_collection_details->amount = $balance_amount;
                        $cashier_collection_details->is_active = 1;
                        
                        $cashier_collection_details->save();
                    }
                }
            }
        }

        return $payment_amount;
    }
}
