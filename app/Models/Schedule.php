<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = "schedules";

    public $incrementing = false;

    protected $primaryKey = 'sched_id';

    public function daytime(){
        return $this->hasOne(ScheduleDayTime::class, 'sched_id', 'sched_id')->withDefault();
    }
    
    public function block(){
        return $this->hasOne(ScheduleBlock::class, 'sched_id', 'sched_id')->withDefault();
    }

    public function course(){
        return $this->belongsTo(Course::class,'course_id', 'course_id');
    }

    public function teachers(){
        return $this->hasMany(ScheduleTeacher::class,'sched_id', 'sched_id');
    }

    public function scopeCurrent($query)
    {
        return $query->where([['sem_id', 2], ['ay_id', 20]]);
    }

}
