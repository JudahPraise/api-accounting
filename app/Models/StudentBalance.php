<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentBalance extends Model
{
    use HasFactory;

    public static function procstudenttotalbalancepersem($stud_id)
    {
        $balances = static::hydrate(
            DB::select(
                'call procstudenttotalbalancepersem('.$stud_id.')'
            )
        );
        
        return $balances;
    }

}
