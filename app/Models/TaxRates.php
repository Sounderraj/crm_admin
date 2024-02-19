<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxRates extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "m_tax_rates";

    protected $fillable = [
        "tax_name",
        "tax_type",
        "tax_rate_percentage",
    ];

    public static function getTaxTypeEnumValues()
    {
        return ['CGST', 'SGST', 'IGST','UTGST','Cess'];
    }
}
