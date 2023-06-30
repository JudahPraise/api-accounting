<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'employees_account';

    protected $primaryKey = 'account_id';

    public function employee(){
        return $this->belongsTo(Employee::class, 'p_id', 'p_id');
    }

    public function cashier_user()
    {
        return $this->hasOne(CashierUser::class, 'p_id', 'p_id');
    }

    public function getUserRoleAttribute()
    {
        return $this->cashier_user->role;
    }
}
