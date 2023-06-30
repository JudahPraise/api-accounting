<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierOtherAccount extends Model
{
    use HasFactory;

    protected $table = "cashier_other_accounts";

    protected $primaryKey = 'account_id';

    protected $fillable = ['account_name','is_active'];
}
