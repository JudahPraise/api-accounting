<?php

namespace App\Models;

use App\Classes\StudentClass;
use App\Classes\ScheduleClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrolment extends Model
{
    use HasFactory;
 
    public $timestamps = false;

    protected $primaryKey = 'enrolment_id';

    protected $table = "enrolment_details";

    protected $appends = ['lab_units',
    'clab_units',
    'units_for_tuition',
    'nstp_units', 'course_count'];

    protected $fillable = [
        'stud_id', 'program_id', 'major_id', 'year_id', 'section_id', 'sem_id', 'ay_id', 'curr_id', 'isassessed'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'stud_id', 'stud_id')->withDefault();
    }

    public function collections()
    {
        return $this->hasMany(CashierCollectionDetail::class, 'account_id', 'stud_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id')->withDefault();
    }

    public function major()
    {
        return $this->hasOne(Major::class, 'major_id', 'major_id');
    }

    public function academic_year()
    {
        return $this->hasOne(AcademicYear::class, 'ay_id', 'ay_id');
    }

    public function getAcademicYearNameAttribute()
    {
        return $this->academic_year->ay_name;
    }

    public function getSemesterAttribute()
    {
        switch ($this->sem_id) {
            case '1':
                return 'First';
                break;
            case '2':
                return 'Second';
            case '3':
                return 'Summer';
            default:
                # code...
                break;
        }
    }

    public function getYearStandingAttribute()
    {
        switch ($this->year_id) {
            case '1':
                return '1st';
                break;
            case '2':
                return '2nd';
            case '3':
                return '3rd';
            case '4':
                return '4th';
            case '5':
                return '5th';
            default:
                # code...
                break;
        }
    }

    public function scopeCurrent($query)
    {
        return $query->where([['sem_id', 2], ['ay_id', 20]]);
    }

    public function getEnrolmentStandingAttribute()
    {
        $standing = $this->year_id.$this->sem_id;

        return $standing;
    }

    public function getEnroledUnitsAttribute()
    {
        $student_class = new StudentClass;
        return $student_class->getStudentSchedule($this)->where('sem_id', 2)->where('ay_id', 20)->sum('units');
    }

    public function getLecUnitsAttribute()
    {
        $student_class = new StudentClass;
        return $student_class->getStudentSchedule($this)->where('sem_id', 2)->where('ay_id', 20)->sum('lec_units');
    }

    public function getLabUnitsAttribute()
    {
        return ScheduleClass::get_lab_course($this)->count();
    }

    public function getClabUnitsAttribute()
    {
       return ScheduleClass::get_com_lab_course($this)->sum('lab_units');
    }

    public function getNstpUnitsAttribute()
    {
        return ScheduleClass::get_nstp_course($this)->sum('units');
    }

    public function getUnitsForTuitionAttribute()
    {   
        $retake_course_units = ScheduleClass::get_retake_course($this)->sum('units');

        if($this->enroled_units > $this->nstp_units){
            $units = $this->enroled_units - $this->nstp_units;
        } else {
            $units = $this->nstp_units - $this->enroled_units;
        }
        
        if($retake_course_units != 0){
            if($units > $retake_course_units){
                $total_units = $units - $retake_course_units;
            } else {    
                $total_units = $retake_course_units - $units;
            }

            return $total_units;
        }

        return $units;
    }
}
