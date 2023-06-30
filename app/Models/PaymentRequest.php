<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $table = 'requests';
    
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'account_id',
        'fee_id',
        'fee_type_id',
        'bal_id',
        'qty',
        'amount',
        'total',
    ];

    public function fee(){
        return $this->belongsTo(CashierFee::class, 'fee_id');
    }
}
