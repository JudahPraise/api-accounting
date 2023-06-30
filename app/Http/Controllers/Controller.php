<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\Enrolment;
use App\Models\CashierFee;
use App\Models\CashierLog;
use App\Models\StudentGrade;
use App\Models\ScheduleBlock;
use App\Models\CashierFeeType;
use App\Models\ScheduleDayTime;
use App\Models\StudentSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\StudentFee;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $coverages = ['Per Unit', 'Per Student', 'Per Sbject', 'Per Hour'];

    protected $year_leves = ['All year levels', 'First year only'];

    protected $courses_with_lab = [17, 16, 6, 7, 14, 31, 4];

    protected $new_student_fees = [7, 12, 13];

    public function formatStudentSchedule($sched_id){

        $scdr =  ScheduleDayTime::where('sched_id', $sched_id)
        ->orderby('daytime_id', 'ASC')
        ->get();

        $c = 0;
        $dd = 0; $dt = 0; $dr = 0;
        foreach($scdr as $scd){
            $c++;
            if($c==1){
                $d = $scd->day->day_code;
                $dd = $d;
                $t = $scd->time_start->time_start . "-" . $scd->time_end->time_end;
                $dt = $t;
                if($scd->room_id == 0){
                    $r = "NA";
                }
                else{
                        $r = $scd->room->room_name;
                }
                $dr = $r;
            }
            else{
                if(( $t != $scd->time_start->time_start . "-" . $scd->time_end->time_end or $r != $scd->room->room_name)){
                    $d = $scd->day->day_code;
                    $dd = $dd."/".$d;
                    $t = $scd->time_start->time_start . "-" . $scd->time_end->time_end;
                    $dt = $dt."/".$t;
                    $r = $scd->room->room_name;
                    if($scd->room->room_name == ""){
                        $r = "NA";
                    }
                    else{
                        $r = $scd->room->room_name;
                    }
                    $dr = $dr."/".$r;
                }
                else{   
                    $d = $scd->day->day_code;
                    $dd = $dd.$d;  

                    if($t != $scd->time_start->time_start . "-" . $scd->time_end->time_end){
                        $t = $scd->time_start->time_start . "-" . $scd->time_end->time_end;
                        $dt = $dt.$t;
                    }
                    if($r != $scd->room->room_name){
                        $r = $scd->room->room_name;
                        $dr = $dr.$r;
                    }
                }
            }
        }

        $block = "";
        $bks = ScheduleBlock::where('sched_id', $sched_id)
        ->orderby('block_id', 'ASC')->get();

        if(!empty($bks)){
            foreach($bks as $bk){
                if(empty($block)){
                    $block = $bk->program->program_code."-".$bk->get_block->block_name;
                }
                else
                {
                    $block = $block.", ".$bk->program->program_code."-".$bk->get_block->block_name;
                }
            }
        }
        else
        {
            $block = "";
        }

        $class_status = 0;

        $sched = Schedule::where('sched_id', $sched_id)->first()->class_size;
        $no_enroled = StudentSchedule::where('sched_id', $sched_id)->count();

        if($sched == $no_enroled){
            $class_status = 1;
        }

        $disp = collect([
            'day' => $dd,
            'time' => $dt,
            'room' => $dr,
            'block' => $block,
            'size' => $sched,
            'enrolled' =>  $no_enroled,
            'isFull' => $class_status
        ]);

        return $disp;
    }

    public function getStudentSchedules($enrolment){

        $student = Student::where('stud_id', $enrolment->stud_id)->first();
        $sched_ids = $student->schedules->pluck('sched_id');
        $schedules = Schedule::whereIn('sched_id', $sched_ids)->where([['sem_id','=',$enrolment->sem_id],['ay_id','=',$enrolment->ay_id]])->get();

        foreach($schedules as $schedule)
        {
            $format = self::formatStudentSchedule($schedule->sched_id);
            $schedule->description = $schedule->course->description;
            $schedule->code = $schedule->course->code;
            $schedule->units = $schedule->course->units;
            $schedule->lec_units = $schedule->course->lec_units;
            $schedule->lab_units = $schedule->course->lab_units;
            $schedule->class_type = $schedule->course->class_type;
            $schedule->has_lab_room = $schedule->course->has_lab_room;
            $schedule->day = $format['day'];
            $schedule->time = $format['time'];
            $schedule->room = $format['room'];
            $schedule->block = $format['block'];
        }
        
        return $schedules;
    }

    public function getFees($enrolment)
    {
        $retake_courses = self::get_retake_course($enrolment);
        $nstp = self::get_nstp_course($enrolment);
        $rle = self::get_rle($enrolment);
        $lab_courses = self::get_lab_course($enrolment);
        $com_lab_courses = self::get_com_lab_course($enrolment);
        
        $fees =  self::fee_identifier($enrolment);
        $student_fees = collect([]);

        $retake_com_lab_course_units = $retake_courses->where('has_lab_room', 0)->where('lab_units','!=',0)->sum('lab_units');
        $retake_nstp_course_units = $retake_courses->where('type', 4)->sum('units');

        // dd($com_lab_courses);

        foreach($fees as $fee){
            $student_fee = new StudentFee;

            $student_fee->fee_id = $fee->fee_id;
            $student_fee->fee_type_id = $fee->fee_type_id;
            $student_fee->name = $fee->description_text;
            $student_fee->is_cabs = $fee->cabs;
            $student_fee->unifast = $enrolment->student->has_unifast ? $fee->is_unifast : 0;
            $student_fee->account_type = $fee->account_type;
            
            if($fee->coverage == 1){
                if($fee->is_unifast == 1){ 
                    if($fee->fee_type_id == 1 && $fee->is_nstp == 1){
                        // NSTP Regular
                        if($nstp->isNotEmpty()){
                            $student_fee->cost = $fee->cost * $nstp->sum('units') / 2;
                        }
                    } else {
                        // Tuition Regular
                        $student_fee->cost = $fee->cost * $enrolment->units_for_tuition;
                    }
                } else {
                    if($fee->fee_type_id == 1 && $fee->is_nstp == 1){
                        // NSTP second take
                        if($retake_courses->where('type', 4)->isNotEmpty()){
                            $student_fee->cost = $fee->cost * $retake_nstp_course_units / 2;
                        }
                    } else {
                        // Tuition second take
                        $student_fee->cost = $fee->cost * $retake_courses->where('type','!=', 4)->sum('units');
                    }
                }
            } 
            else if($fee->coverage == 3) {
            
                if($fee->fee_type_id == 17){
                    
                    if($rle->isNotEmpty()){
                        
                        $student_fee->cost = $fee->cost * $rle->where('name', $fee->name)->count();

                    }

                } else if($fee->fee_type_id == 8) {

                    if($fee->is_unifast == 1){

                        if($lab_courses->isNotEmpty()){

                            $student_fee->cost = $fee->cost * $lab_courses->count();
                        }

                    } else { 

                        if($retake_courses->where('has_lab_room','=',1)->isNotEmpty()){

                            $student_fee->cost = $fee->cost * $retake_courses->where('has_lab_room', 1)->count();
                        }
                    }

                } else {

                    if($rle->isNotEmpty()){

                        $student_fee->cost = $fee->cost * $rle->count();

                    }

                }
        
            }else if($fee->coverage == 5){
        
                if($fee->fee_id == 24){
                    if($com_lab_courses->isNotEmpty()){

                        // if($retake_com_lab_course_units > $com_lab_courses->sum('units')){
                            
                        //     $com_lab_units = $retake_com_lab_course_units - $com_lab_courses->sum('units');

                        // } else {

                        //     $com_lab_units = $com_lab_courses->sum('units') - $retake_com_lab_course_units;    

                        // }

                        // dd($com_lab_courses->sum('units'));

                        $student_fee->cost =  $fee->cost * $com_lab_courses->sum('units');
                    }
                }else if($fee->fee_id == 93){
                    if($retake_courses->where('has_lab_room', 0)->where('lab_units','!=',0)->isNotEmpty()){
                        $student_fee->cost = $fee->cost * $retake_courses->where('has_lab_room', 0)->where('lab_units','!=',0)->sum('lab_units');
                    }
                }
        
            } else {
        
                $student_fee->cost = $fee->cost;
        
            }

            $student_fees->push($student_fee);
        }

        return $student_fees->where('cost','!=',0);
    }
    

    public function addToLog($action, $feature, $target)
    {
        $cashier_log = CashierLog::create([
            'user_id' => Auth::user()->p_id, 
            'ip_address' => request()->ip(), 
            'browser' => request()->userAgent(),
            'action' => $action, 
            'description' => self::logDescription($action, $feature, $target)
        ]);
    }

    public function logDescription($action, $feature, $target)
    {
        switch ($feature) {
            case 'fees':
                
                if($action == 'create')
                    return Auth::user()->lname.' created fee_id '.$target;
                else if($action == 'update')
                    return Auth::user()->lname.' updated fee_id '.$target;
                else if($action == 'delete')
                    return Auth::user()->lname.' deleted fee_id '.$target;

                break;
            case 'assessment':

                if($action == 'create')
                    return Auth::user()->lname.' created assessment '.$target;
                else if($action == 'update')
                    return Auth::user()->lname.' updated fee_id '.$target;
                else if($action == 'delete')
                    return Auth::user()->lname.' deleted fee_id '.$target;

                break;
            default:
                # code...
                break;
        }
    }

    public function get_com_lab_course($enrolment)
    {
        $student_schedules = self::getStudentSchedules($enrolment);
        $retake_courses = self::get_retake_course($enrolment);

        $com_lab = collect([]);

        foreach($student_schedules as $schedule){
            if(!$schedule->course->has_lab_room){
                if($schedule->course->class_type == 2 || $schedule->course->class_type == 4){
                    if(!$retake_courses->contains('course_id', $schedule->course->course_id)){
                        $com_lab->push([
                            'course_id' => $schedule->course->course_id,
                            'code' => $schedule->course->code,
                            'units' => $schedule->course->lab_units,
                            'has_lab_room' => $schedule->course->has_lab_room
                        ]);
                    }
                }
            }
        }

        return $com_lab;
    }

    public function get_lab_course($enrolment)
    {
        $student_schedules = self::getStudentSchedules($enrolment);
        $retake_courses = self::get_retake_course($enrolment);

        $lab_room = collect([]);

        foreach($student_schedules as $schedule){
            if($schedule->course->has_lab_room){
                if(!$retake_courses->contains('course_id', $schedule->course->course_id)){
                    $lab_room->push([
                        'course_id' => $schedule->course->course_id,
                        'code' => $schedule->course->code,
                        'units' => $schedule->course->lab_units,
                        'has_lab_room' => $schedule->course->has_lab_room
                    ]);
                }
            }
        }

        return $lab_room;
    }

    public function get_rle($enrolment)
    {
        $student_schedules = self::getStudentSchedules($enrolment);
        $rle_subjects = collect([]);

        foreach($student_schedules as $sched){
            if($sched->course->class_type == 3){
                $rle_subjects->push([
                    'course_id' => $sched->course->course_id,
                    'name' => $sched->course->code,
                    'units' => $sched->course->units
                ]);
            }
        }

        return $rle_subjects;
    }

    public function get_retake_course($enrolment){
        
        $failed_courses = StudentGrade::where([['stud_id', $enrolment->stud_id],  ['remarks','!=','PASSED']])->get();
        $course_ids = array();

        foreach($failed_courses as $f){
            if($f->remarks != '--'){
                array_push($course_ids, $f->course_id);
            }
        }
        
        $courses = Course::whereIn('course_id', $course_ids)->get();
        $student_schedules = self::getStudentSchedules($enrolment);
        $retake_courses = collect([]);


        foreach($courses as $course){
            foreach($student_schedules as $schedule){
                if($schedule->description == $course->description){
                    $retake_courses->push([
                        'course_id' => $schedule->course_id,
                        'sched_id' => $schedule->sched_id,
                        'name' => $schedule->code,
                        'units' => $schedule->course->units,
                        'lec_units' => $schedule->lec_units,
                        'lab_units' => $schedule->lab_units,
                        'has_lab_room' => $schedule->has_lab_room,
                        'type' => $schedule->course->type,
                    ]);
                }
            }
        }

        return $retake_courses;
    }

    public function get_nstp_course($enrolment)
    {
        $student_schedules = self::getStudentSchedules($enrolment);
        $retake_courses = self::get_retake_course($enrolment);

        $nstp = collect([]);

        foreach($student_schedules as $schedule){
            if($schedule->course->type == 4){
                if(!$retake_courses->contains('course_id', $schedule->course->course_id)){
                    $nstp->push([
                        'course_id' => $schedule->course->course_id,
                        'code' => $schedule->course->code,
                        'units' => $schedule->course->units,
                        'type' => $schedule->course->type
                    ]); 
                }
            }
        }

        return $nstp;
    }

    public function is_transferee($stud_id){
        
        $enrolment = Enrolment::where([['stud_id', $stud_id], ['sem_id','<',2], ['ay_id','<=',20]])->first();

        if($enrolment)
            return false;
        else 
            return true;

    }

    public function first_year_first_sem($stud_id)
    {
        $enrolment = Enrolment::where('stud_id', $stud_id)->current()->first();

         if($enrolment->year_id == 1 && $enrolment->sem_id < 2)
            return true;
        else 
            return false;
    }

    public function fee_identifier($enrolment)
    {  
        if(self::is_transferee($enrolment->stud_id) || self::first_year_first_sem($enrolment->stud_id)){

           if($enrolment->program_id == 14){

                $fees = CashierFee::where([['type','=',1], ['fee_id','!=',96]])->cabuyenyo($enrolment->student->cabs_status)->get(); 

                return $fees;

           } else {
                $fees = CashierFee::where([['type','=',1],['fee_type_id','!=',17]])->cabuyenyo($enrolment->student->cabs_status)->get(); 

                return $fees;
           }

        } else {

            if($enrolment->program_id == 14){

                if($enrolment->year_id < 2){
                    $fees = CashierFee::where([['type','=',1], ['year_level','!=',2], ['fee_id','!=',96]])->cabuyenyo($enrolment->student->cabs_status)->get(); 
                }else {
                    $fees = CashierFee::where([['type','=',1], ['year_level','!=',2]])->cabuyenyo($enrolment->student->cabs_status)->get(); 
                }

                return $fees;

           } else {

                $fees = CashierFee::where([['type','=',1], ['year_level','!=',2], ['fee_type_id','!=',17]])->cabuyenyo($enrolment->student->cabs_status)->get(); 

                return $fees;
           }

        }
    }

    public function generateDayTime($day, $time, $room)
    {
        $days = explode('/', $day);
        $times = explode('/', $time);
        $rooms = explode('/', $room);

        $prev_time = '';
        $prev_room = '';

        $day_output = '';
        $time_output = '';
        $room_output = '';
        foreach($days as $index => $day){	

            if ($index == 0){
                $day_output .= $days[$index];
                $time_output .= $times[$index];
                $room_output .= $rooms[$index];
            }else if($times[$index] == $prev_time && $rooms[$index] == $prev_room){
                $day_output .= $days[$index];
            }else{
                $day_output .= '/' . $days[$index];
                $time_output .= '/' . $times[$index];
                $room_output .= '/' . $rooms[$index];
            }
                
            $prev_time = $times[$index];
            $prev_room = $rooms[$index];
        }

        return [
            'day' => $day_output,
            'time' => $time_output,
            'room' => $room_output
        ];
    }
}
