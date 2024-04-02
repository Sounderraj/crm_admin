<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaceOfSupply extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "m_place_of_supply";

    protected $fillable = [
        'short_code',
        'name',
        'type',
    ];

    public static function getPlaceOfSupplyTypeEnumValues()
    {
        return ['Intra-state', 'Inter-state'];
    }

}
