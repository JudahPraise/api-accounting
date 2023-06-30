<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAssessment extends Model
{
    use HasFactory;

    public static function procstudentschedules($stud_id, $sem_id, $ay_id)
    {
        $student_schedules = static::hydrate(
            DB::select('call procstudentschedules(?, ?, ?)', [$stud_id, $sem_id, $ay_id])
        );

        return $student_schedules;
    }

    public static function procstudentassessment($stud_id, $sem_id, $ay_id)
    {
        $student_assessment = static::hydrate(
            DB::select('call procstudentassessment(?, ?, ?)', [$stud_id, $sem_id, $ay_id])
        );

        return $student_assessment;
    }

    public static function procassessmenttemplate($cabs, $year_level, $is_unifast, $program_id)
    {
        $assessment_template = static::hydrate(
            DB::select('call procassessmenttemplate(?, ?, ?, ?)', [$cabs, $year_level, $is_unifast, $program_id])
        );

        return $assessment_template;
    }

    public static function procretakecourses($stud_id, $sem_id, $ay_id)
    {
        $student_retake_courses = static::hydrate(
            DB::select('call procretakecourses(?, ?, ?)', [$stud_id, $sem_id, $ay_id])
        );

        return $student_retake_courses;
    }

    public static function procassessmentbalances($stud_id, $sem_id, $ay_id)
    {
        $assessment_balances = static::hydrate(
            DB::select('call procassessmentbalances(?, ?, ?)', [$stud_id, $sem_id, $ay_id])
        );

        return $assessment_balances;
    }
}
