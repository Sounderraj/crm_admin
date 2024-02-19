<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxRatesDefault extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "m_tax_rates_default";

    protected $fillable = [
        "intra_tax_rate_id",
        "inter_tax_rate_id",
    ];

}
