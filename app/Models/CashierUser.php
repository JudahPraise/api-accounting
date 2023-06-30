<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierUser extends Model
{
    use HasFactory;

    protected $table = 'cashier_users';

    protected $primaryKey = 'id';

    protected $fillable = ['p_id', 'role', 'status'];

    public function user(){

        return $this->belongsTo(User::class, 'p_id', 'p_id');
        
    }

    public function employee(){

        return $this->belongsTo(Employee::class, 'p_id', 'p_id');
        
    }

    public function getGetStatusAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Inactive';
                break;
            case 1:
                return 'Active';
                break;
        }
    }

    public function getGetRoleAttribute()
    {
        switch ($this->role) {
            case 1:
                return 'Superadmin';
                break;
            case 2:
                return 'Accountant';
                break;
            case 3:
                return 'Cashier';
                break;
            case 4:
                return 'Staff';
                break;
        }
    }
}
