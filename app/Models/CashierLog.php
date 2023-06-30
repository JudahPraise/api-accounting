<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierLog extends Model
{
    use HasFactory;

    protected $table = 'cashier_logs';

    protected $primaryKey = 'log_id';

    protected $fillable = [ 'user_id', 'ip_address', 'browser', 'action', 'description'];
}
