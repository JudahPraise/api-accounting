<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "academic_years";

    public function enrolment()
    {
        return $this->belongsTo(Enrolment::class, 'ay_id', 'ay_id');
    }
}
