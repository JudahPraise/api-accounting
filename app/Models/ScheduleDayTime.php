<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDayTime extends Model
{
    use HasFactory;

    protected $primaryKey = 'dt_id';

    protected $table = "schedules_daytime";

    protected $fillable = ['sched_id', 'day_id', 'time_start_id', 'time_end_id', 'room_id'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'sched_id', 'sched_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id', 'day_id')->withDefault();
    }

    public function time_start()
    {
        return $this->belongsTo(Time::class, 'time_start_id', 'time_id')->withDefault();
    }

    public function time_end()
    {
        return $this->belongsTo(Time::class, 'time_end_id', 'time_id')->withDefault();
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id')->withDefault();
    }
}
