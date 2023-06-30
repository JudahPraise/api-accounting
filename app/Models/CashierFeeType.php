<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierFeeType extends Model
{
    use HasFactory;

    protected $table = 'cashier_fee_types';

    protected $primaryKey = 'fee_type_id';

    protected $fillable = [ 'name', 'account_type', 'is_active'];

    protected $appends = ['year_level'];

    public function fees()
    {
        return $this->hasMany(CashierFee::class, 'fee_type_id', 'fee_type_id')->where('is_active', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeStudent($query)
    {
        return $query->where('account_type', 1)->orWhere('account_type', 2);
    }

    public function scopeOthers($query)
    {
        return $query->whereNot('is_assessment', 1);
    }

    public function getFeeAmountAttribute()
    {
        $amount = $this->fees->sum('cost');

        return $amount;
    }
    
}
