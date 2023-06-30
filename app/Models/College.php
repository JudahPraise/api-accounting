<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'college_id';

    protected $table = "colleges";

    protected $fillable = ['college_id', 'description', 'college_code', 'p_id', 'is_active'];

    public function dean()
    {
        return $this->hasOne(Employee::class, 'p_id', 'p_id');
    }

    public function programs()
    {
        return $this->hasMany(Program::class, 'college_id', 'college_id');
    }

    public function getDeanNameAttribute()
    {
        
        if($this->dean) {

            $length = Str::length($this->dean->middlename);

            if($length > 0)
            {
                $fullname = $this->dean->firstname.' '.$this->dean->middlename[0].'. '.$this->dean->lastname;
            
                return $fullname;
            }

            return $this->dean->firstname.' '.$this->dean->lastname;
        }

        return "";
    }
}
