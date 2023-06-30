<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashierBalance extends Model
{
    use HasFactory;
 
    protected $table = "cashier_balances";

    protected $primaryKey = 'bal_id';

    protected $fillable = ['account_id','account_type','fee_id','fee_type_id','sem_id','ay_id','cost','status'];

    public function fee()
    {
        return $this->belongsTo(CashierFee::class, 'fee_id');
    }

    public function fee_types()
    {
        return $this->hasMany(CashierFeeType::class, 'fee_type_id');
    }

    public function scopeCurrent($query)
    {
        return $query->where([['sem_id', 2], ['ay_id', 20]]);
    }

    public static function procStudentBalance($stud_id)
    {
        $balances = static::hydrate(
            DB::select(
                'call procstudentbalance('.$stud_id.')'
            )
        );
        
        return $balances;
    }
}
