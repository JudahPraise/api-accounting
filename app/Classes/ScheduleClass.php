<?php

namespace App\Classes;

use App\Models\Course;
use App\Models\Student;
use App\Models\Schedule;
use App\Models\StudentGrade;
use App\Models\ScheduleBlock;
use App\Models\ScheduleDayTime;
use App\Models\StudentSchedule;

class ScheduleClass {

    public static function formatStudentSchedule($sched_id){

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
    
    public static function getStudentSchedules($enrolment){

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
            if($schedule->course->has_lab_room){ 
                $schedule->room = $schedule->room = $format['room'].'/LAB';
            }else if($schedule->course->has_lab_room != 1 && $schedule->course->class_type == 2){
                $schedule->room = $schedule->room = $format['room'].'/CL';
            }else if($schedule->course->has_lab_room != 1 && $schedule->course->class_type == 4){
                $schedule->room = $schedule->room = $format['room'].'/CL';
            } else { 
                $schedule->room = $format['room'];
            }
            $schedule->block = $format['block'];
        }
        
        return $schedules;
    }

    public static function get_retake_course($enrolment){
        
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


    public static function get_com_lab_course($enrolment)
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
                            'units' => $schedule->course->units,
                            'lab_units' => $schedule->course->lab_units,
                            'has_lab_room' => $schedule->course->has_lab_room
                        ]);
                    }
                }
            }
        }

        return $com_lab;
    }

    public static function get_lab_course($enrolment)
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

    public static function get_rle($enrolment)
    {
        $student_schedules = self::getStudentSchedules($enrolment);
        $retake_courses = self::get_retake_course($enrolment);
        $rle_subjects = collect([]);

        foreach($student_schedules as $sched){
            if($sched->course->class_type == 3){
                if(!$retake_courses->contains('course_id', $schedule->course->course_id)){
                    $rle_subjects->push([
                        'course_id' => $sched->course->course_id,
                        'name' => $sched->course->code,
                        'units' => $sched->course->units
                    ]);
                }
            }
        }

        return $rle_subjects;
    }

    public static function get_nstp_course($enrolment)
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

    public static function formatDayTime($day, $time, $room){
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



