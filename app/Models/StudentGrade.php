<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $table = 'students_grades';

    protected $primaryKey = 'grade_id';

    public function student()
    {
        return $this->belongsTo(Student::class, 'stud_id');
    }
}
