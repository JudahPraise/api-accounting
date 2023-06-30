<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierCollectionDetail extends Model
{
    use HasFactory;

    protected $table = "cashier_collection_details";

    protected $primaryKey = 'cd_id';

    protected $fillable = [ 'account_id', 'fee_id', 'fee_type_id', 'balance_id', 'col_id', 'amount', 'is_active',];

    public function fee()
    {
        return $this->belongsTo(CashierFee::class, 'fee_id');
    }

    public function fee_type()
    {
        return $this->belongsTo(CashierFeeType::class, 'fee_type_id');
    }
}
