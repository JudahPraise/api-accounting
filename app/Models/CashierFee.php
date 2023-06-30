<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierFee extends Model
{
    use HasFactory;

    protected $table = 'cashier_fees';

    protected $primaryKey = 'fee_id';

    protected $fillable = [ 'fee_id', 'fee_type_id', 'name', 'description', 'cost', 'cabs', 'coverage', 'frequency', 'year_level', 'type', 'is_unifast', 'reference_number', 'date_of_approval', 'account_type'];
    
    protected $appends = ['id_key','description_text', 'account_type_text'];

    // protected $hidden = 'fee_id';

    public function getIdKeyAttribute()
    {
        return encrypt($this->fee_id);
    }

    public function type()
    {
        return $this->belongsTo(CashierFeeType::class, 'fee_type_id', 'fee_type_id');
    }

    public function getDescriptionTextAttribute()
    {
        switch ($this->cabs) {
            case 1:
                return $this->name.' (Cabuyeño)';
            
            case 2:
                return $this->name.' (Non-Cabuyeño)';
            
            default:
                return $this->name;
        }
    }

    public function getYearLevelTextAttribute()
    {
        return $this->year_level == 1 ? 'All year levels' : 'New student only';
    }

    public function getCoverageTextAttribute()
    {
        switch ($this->coverage) {
            case 1:
                return 'Per Unit';
            
            case 2:
                return 'Per Student';
            
            case 3:
                return 'Per Subject';
            case 4:
                return 'Per Hour';
            default:
                return 'N/A';
        }
    }

    public function getFrequencyTextAttribute()
    {
        switch ($this->frequency) {
            case 0:
                return 'N/A';
            default:
                return $this->frequency;
        }
    }

    public function getAccountTypeTextAttribute()
    {
        switch ($this->account_type) {
            case 1:
                return 'College';
                break;
            case 2:
                return 'SHS';
                break;
            case 3:
                return 'Faculty';
                break;
            case 4:
                return 'Others';
                break;
            default:
                # code...
                break;
        }
    }

    public function scopeCabuyenyo($query, $cabs)
    {
        return $query->where('cabs', $cabs)->orWhere('cabs', 2);
    }
}
