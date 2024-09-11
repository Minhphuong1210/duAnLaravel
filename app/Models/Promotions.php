<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    use HasFactory;
    const DISCOUNT_Percentage ='percentage';
    const DISCOUNT_Fixed ='fixed';

    const STATUS_Active = 'active';
    const STATUS_InActive = 'inactive';

    protected $fillable = [
        'code',
        'discount',
        'discount_type',
        'start_date',
        'end_date',
        'usage_limit',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        if ($this->end_date < Carbon::now() && $value === 'active') {
        
            $this->attributes['status'] = 'inactive';
            $this->save();
            return 'inactive';
        }

        return $value;
    }
}
