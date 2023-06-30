<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'ss_id';

    protected $table = "students_schedule";

    public $appends = ['ay_id', 'sem_id'];

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'sched_id', 'sched_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'stud_id', 'stud_id');
    }

    public function getSemIdAttribute()
    {
        return $this->schedule->sem_id;
    }

    public function getAyIdAttribute()
    {
        return $this->schedule->sem_id;
    }
}
