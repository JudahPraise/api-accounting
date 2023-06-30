<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Support\Str;
use App\Models\StudentGrade;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'stud_id';

    public $incrementing = false;

    protected $appends = ['id_key', 'fullname'];

    // protected $hidden = 'stud_id';

    public function getIdKeyAttribute()
    {
        return encrypt($this->stud_id);
    }

    public function getFullnameAttribute()
    {
        $length = Str::length($this->mname);

        if($length > 1)
        {
            $fullname = $this->lname.', '.$this->fname.' '.$this->mname[0].'.';
        
            return $fullname;
        }

        return $this->lname.', '.$this->fname;
    }

    public function collection()
    {
        return $this->hasOne(CashierCollection::class, 'account_id', 'stud_id');
    }

    public function unifast_collection()
    {
        return $this->hasOne(CashierCollection::class, 'account_id', 'stud_id')->where('scholarship_id', 1);
    }

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class, 'stud_id', 'stud_id');
    }

    public function schedules()
    {
        return $this->hasMany(StudentSchedule::class, 'stud_id', 'stud_id');
    }

    public function assessment()
    {
        return $this->hasMany(StudentAssessment::class, 'stud_id', 'stud_id');
    }

    public function nonunifast()
    {
        return $this->belongsTo(NonUnifastGrantee::class, 'stud_id', 'stud_id');
    }
    
    public function grades()
    {   
        return $this->hasMany(StudentGrade::class, 'stud_id');
    }

    public function getCabsStatusAttribute(){
        if($this->is_cabs != 1){
            return 0;
        } else {
            return 1;
        }
    }

    public function getHasUnifastAttribute()
    {
        if($this->nonunifast){
            return false;
        } else {
            return true;
        }

    }

    public function getStudGenderAttribute()
    {
        return $this->gender == 0 ? "Female" : "Male";
    }

    public function getClassificationAttribute()
    {
        return $this->is_cabs == 1 ? 'Cabuyeño' : 'Non-cabuyeño';
    }

    public function getIsTransfereeAttribute()
    {
        $transferee = $this->enrolments()->where([['stud_id', $this->stud_id], ['sem_id','<',2], ['ay_id','<',20]])->first();

        if($transferee)
            return true;
        else
            return false;
    }

    
    public function getNstpUnitsAttribute()
    {
        $sched_ids = $this->schedules->pluck('sched_id');
        $schedules = Schedule::whereIn('sched_id', $sched_ids)->current()->get();

        $units = 0;
        $courses = '';

        foreach($schedules as $schedule){
            if($schedule->course->type == 4){
                $units += $schedule->course->units;
                $courses .= $schedule->course->code;
            }
        }

        $nstp_courses = collect([
            'courses' => $courses,
            'units' => $units
        ]);

        return $nstp_courses;
    }

    public function getRetakeCoursesAttribute()
    {
        $sched_ids = $this->schedules->pluck('sched_id');
        $schedules = Schedule::whereIn('sched_id', $sched_ids)->current()->get();

        $course_ids = StudentGrade::where([['stud_id', $this->stud_id], ['remarks','!=','PASSED']])->pluck('course_id');
        $student_courses = Course::whereIn('course_id', $course_ids)->get();

        $lec_units = 0;
        $lab_units = 0;
        $has_lab_room = 0;
        $courses = '';

        foreach($student_courses as $course){
            foreach($schedules as $schedule){
                if($schedule->course->description == $course->description){
                    $lec_units += $schedule->course->lec_units;
                    $lab_units += $schedule->course->lab_units;
                    if($schedule->course->has_lab_room == 1){
                        $has_lab_room += 1;
                    }
                    $courses .= $schedule->course->code;
                }
            }
        }

        $retake_courses = collect([
            'courses' => $courses,
            'lec_units' => $lec_units,
            'lab_units' => $lab_units,
            'has_lab_room' => $has_lab_room
        ]);

        return $retake_courses;
    }


    public function getBalancesAttribute()
    {
        $student_collections = CashierCollectionDetail::where('account_id', $this->stud_id)->pluck('bal_id');
        $student_balances = CashierBalance::with('fee')->where('account_id', $this->stud_id)->whereNotIn('bal_id', $student_collections)->get();

        return $student_balances;
    }

    // public function getCollectionAttribute()
    // {
    //     $student_collection = CashierCollection::where([['account_id', $this->stud_id],['sem_id', 2], ['ay_id', 20], ['is_active', 1]])->get();
    //     return $student_collection;
    // }

    // public function getCollectionsDetailAttribute()
    // {
    //     // $student_collections = CashierCollectionDetail::where('account_id', $this->stud_id)
    //     // ->join('cashier_fee_types', 'cashier_fee_types.fee_type_id','=','cashier_collection_details.fee_type_id')
    //     // ->orderBy('cashier_fee_types.sequence', 'asc')
    //     // ->get();

    //     $student_collections = CashierCollectionDetail::with('fee_type')->where('account_id', $this->stud_id)->get();

    //     return $student_collections;
    // }

    // public function getUnifastCollectionAttribute()
    // {
    //     $student_collection = $this->collection->where('scholarship_id', 1)->first();
    //     $student_collections = $this->collections_detail->where('col_id', $student_collection->col_id);
    //     return $student_collections;
    // }

    public function getRetakeCourseIdsAttribute()
    {
        $grades = $this->grades->where('remarks','!=','PASSED')->unique('course_id');

        return $grades->pluck('course_id');
    }

    public function getTotalAssessmentAttribute()
    {
        if(!$this->collection){
            $balances = $this->balances->sum('cost');
            return $balances;
        }else {
            $balances = $this->balances->sum('cost');
            $collections = $this->collection->collection_details->sum('amount');

            return $balances + $collections;
        }
    }

    public function getTotalAmountDueAttribute()
    {
        $balances = $this->balances->sum('cost');
        $collections = $this->collection->collection_details->sum('amount');

        if($balances > $collections){
            $amount_due = $balances - $collections;
        } else {
            $amount_due = $collections - $balances;
        }
        
        return $balances;
    }
}
