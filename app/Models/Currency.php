<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "m_currencies";

    protected $fillable = [
        'code',
        'name',
        'symbol',
        'active',
        'is_default'
    ];

    // Scope to get only active records
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeGetBaseCurrency($query)
    {
        return $query->select('code')->where('active', true)->where('is_default', 1);
    }

    public function scopeGetSymbolByCode($query,$code)
    {
        return $query->select('symbol')->where('active', true)->where('code', $code)->first();
    }

    // Scope to get all Currencies
    public static function getAllCurrencies()
    {
        return DB::table('m_currencies_default')->select('code','name','symbol')->get()->toArray();
    }

}
