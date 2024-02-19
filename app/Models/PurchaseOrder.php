<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "salesorders";

    protected $fillable = [
        'customer_id',
        'sale_order_id',
        'reference_num',
        'saleorder_date',
        'place_of_supply',
        'expected_shipment_date',
        'payment_terms',
        'delivery_method_id',
        'customer_code',
        'customer_purchase_order_num',
        'customer_purchase_order_date',
        'vendor_code',
        'order_status',
        'total_amount',
        'customer_notes',
        'terms_and_conditions',
        'attachment_url',
    ];


    public static function getFiscalYear()
    {
        $currentYear = now()->year;
        $startMonth = 4; // Fiscal year start month (April)
    
        // Determine the fiscal year based on the current month
        if (now()->month < $startMonth) {
            $fiscalStartYear = $currentYear - 1;
            $fiscalEndYear = $currentYear;
        } else {
            $fiscalStartYear = $currentYear;
            $fiscalEndYear = $currentYear + 1;
        }
    
        return substr($fiscalStartYear, -2) . '-' . substr($fiscalEndYear, -2);
    }

    public static function getSaleOrderNumber()
    {
        $fiscalYear = static::getFiscalYear();
        $maxId = static::maxId();
    
        return 'PF/' . $fiscalYear . '/' . ($maxId + 1);
    }

    public static function maxId()
    {
        return static::max('id') ?? 0;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
