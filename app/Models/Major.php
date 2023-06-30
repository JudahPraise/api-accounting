<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'major_id';

    protected $table = "programs_major";
}
