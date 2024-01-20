<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Estimate extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        "quote_date",
        "expiry_date",
        "customer_id",
        "estimate_number",
        "reference_number",
        "subject_name",
        "rate",
        "status",
    ];

    public static function getStatusEnumValues()
    {
        return ['DRAFT', 'SENT', 'PENDING APPROVAL', 'ACCEPTED', 'INVOICED', 'DECLINED'];
    }

    public static function getStatusEnumValues_ForButton()
    {
        return [
            'DRAFT' => 'primary',
            'SENT' => 'success',
            'PENDING APPROVAL' => 'warning',
            'ACCEPTED' => 'info',
            'INVOICED' => 'secondary',
            'DECLINED' => 'danger',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Register the creating event to generate estimate_number
        static::creating(function ($estimate) {
            $estimate->estimate_number = 'QUT-' . now()->format('y') .'-'. ($estimate->maxId() + 1);
        });
    }

    // Helper function to get the maximum id
    public static function maxId()
    {
        return static::max('id') ?? 0;
    }

}
