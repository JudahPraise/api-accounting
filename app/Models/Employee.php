<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $primaryKey = 'p_id';

    protected $hidden = 'p_id';

    public function cashier()
    {
        return $this->belongsTo(CashierUser::class, 'p_id', 'p_id');
    }

    public function getIdKeyAttribute()
    {
        return encrypt($this->p_id);
    }


}
