<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";

    protected $primaryKey = "course_id";

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id', 'program_id');
    }
}
