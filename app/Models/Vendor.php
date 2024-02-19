<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "vendors";

    protected $fillable = [
        "vendor_type",
        "salutation",
        "first_name",
        "last_name",
        "email",
        "mobile",
        "company_name",
        "vendor_name",
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


}
