<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleBlock extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "schedules_blocking";

    protected $fillable = ['program_id', 'block_id', 'sched_id'];

    public function schedules(){

        return $this->hasMany(Schedule::class, 'sched_id', 'sched_id');
    }

    public function program(){

        return $this->hasOne(Program::class, 'program_id', 'program_id');

    }

    public function get_block(){

        return $this->hasOne(Block::class, 'block_id', 'block_id');

    }

    public function schedule(){

        return $this->hasOne(Schedule::class, 'sched_id', 'sched_id');

    }
}
