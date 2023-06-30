<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonUnifastGrantee extends Model
{
    use HasFactory;

    protected $table = 'non_unifast_grantees';

    protected $primaryKey = 'nug_id';

    protected $fillable = [ 'nug_id', 'stud_id', 'sem_id', 'ay_id'];

}
