<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        "name",
        "type",
        "unit",
        "sku_number",
        "hsn_code",
        "sac_code",
        "tax_preference",
        "currency",
        "selling_price",
        "selling_account",
        "cost_price",
        "purchase_account",
        "intra_tax_rate_id",
        "inter_tax_rate_id",
        "s_desc",
        "p_desc",
        "track_inventry",
        "stock_in_hand",
    ];

    public static function getTaxPreferenceEnumValues()
    {
        return [
            'Taxable',
            'Non-Taxable',
            'Out of Scope',
            'Non-GST supply',
        ];
    }
    
    public function currencysym()
    {
        return $this->belongsTo(Currency::class, 'currency','code');
    }

    public function getSellingPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getCostPriceAttribute($value)
    {
        return number_format($value, 2);
    }

}
