<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GST_Treatment extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "m_gst_treatment";

    protected $fillable = [
        'title',
        'desc',
        'active',
    ];

    // Scope to get only active records
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

}
