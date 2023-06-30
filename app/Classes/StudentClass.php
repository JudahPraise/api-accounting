<?php

namespace App\Classes;

use App\Models\CashierFeeType;
use App\Models\CashierCollectionDetail;

class StudentClass {
    
    public function getStudentSchedule($enrolment) {
        $schedules = collect([]);

        foreach($enrolment->student->schedules as $schedule){
            if($schedule->schedule){
                $schedules->push([
                    'stud_id' => $schedule->stud_id,
                    'sched_id' => $schedule->sched_id,
                    'stud_id' => $schedule->stud_id,
                    'course_id' => $schedule->schedule->course->course_id,
                    'code' => $schedule->schedule->course->code,
                    'sem_id' => $schedule->schedule->sem_id,
                    'ay_id' => $schedule->schedule->ay_id,
                    'units' => $schedule->schedule->course->units,
                    'lec_units' => isset($schedule->schedule->course->lec_units) ? $schedule->schedule->course->lec_units : 0,
                    'lab_units' => isset($schedule->schedule->course->lab_units) ? $schedule->schedule->course->lab_units : 0,
                    'class_type' => isset($schedule->schedule->course->class_type) ? $schedule->schedule->course->class_type : 0,
                    'type' => isset($schedule->schedule->course->type) ? $schedule->schedule->course->type : 0,
                    'has_lab_room' => isset($schedule->schedule->course->has_lab_room) ? $schedule->schedule->course->has_lab_room : 0,
                ]);
            }
        }

        return $schedules;
    }

}