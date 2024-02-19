<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "customers";

    protected $fillable = [
        "customer_type",
        "salutation",
        "first_name",
        "last_name",
        "email",
        "mobile",
        "company_name",
        "customer_name",
        "work_phone",
        "status",
        "remarks",
        "gst_treatment",
        "gst_treatment_id",
        "gstin",
        "business_legal_name",
        "pan",
        "place_of_supply",
        "tax_preference",
        "currency",
        "opening_balance",
        "payment_terms",
        // "billing_attention",
        "billing_country",
        "billing_street",
        "billing_city",
        "billing_state",
        "billing_zip_code",
        "billing_phone",
        "billing_fax",
        // "shipping_attention",
        "shipping_country",
        "shipping_street",
        "shipping_city",
        "shipping_state",
        "shipping_zip_code",
        "shipping_phone",
        "shipping_fax"
    ];

    public static function getSalutationEnumValues()
    {
        return ['Mr.', 'Mrs.', 'Ms.','Miss','Dr.'];
    }

    public function gsttreatments()
    {
        return $this->belongsTo(GST_Treatment::class, 'gst_treatment_id');
    }
}
