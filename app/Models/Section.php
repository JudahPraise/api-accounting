<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "sections";

    protected $primaryKey = 'section_id';

    public function program()
    {
        return $this->belongsTo(programs::class, 'program_id', 'program_id');
    }

    public function major()
    {
        return $this->belongsTo(majors::class, 'major_id', 'major_id');
    }
}
