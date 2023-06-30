<?php

namespace App\Models;

use App\Models\Enrolment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'program_id';

    protected $table = "programs";
    

    protected $fillable = ['program_id', 'description', 'program_code', 'college_id', 'p_id', 'type', 'is_active'];

    public function major()
    {
        return $this->hasOne(Major::class,'program_id', 'program_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'college_id');
    }

    public function enrolment()
    {
        return $this->hasOne(Enrolment::class, 'program_id', 'program_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'p_id', 'p_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'program_id', 'program_id');
    }

    public function getAssessedCountAttribute()
    {
        $assessed = Enrolment::current()->where([['program_id','=',$this->program_id], ['isassessed','=',1]])->count();

        return $assessed;
    }

    public function getNotAssessedCountAttribute()
    {
        $assessed = Enrolment::current()->where([['program_id','=',$this->program_id], ['isassessed','=',0]])->count();

        return $assessed;
    }
}
