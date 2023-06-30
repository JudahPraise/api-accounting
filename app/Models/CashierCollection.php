<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierCollection extends Model
{
    use HasFactory;

    protected $table = "cashier_collections";

    protected $primaryKey = 'col_id';

    protected $fillable = [ 'col_id', 'account_id', 'account_type', 'sem_id', 'ay_id', 'collection_date', 'amount', 'scholarship_id', 'or_no', 'remarks', 'is_active'];

    public function collection_details()
    {
        return $this->hasMany(CashierCollectionDetail::class, 'col_id');
    }
}
