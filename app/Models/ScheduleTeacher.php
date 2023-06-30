<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleTeacher extends Model
{
    use HasFactory;

    protected $table = "schedules_teachers";

    public function teacher(){

        return $this->hasOne(Employee::class,'p_id', 'p_id');

    }
}
