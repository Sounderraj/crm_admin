<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leads extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        "name",
        "title",
        "company_name",
        "phone",
        "location",
        "leads_owner",
        "leads_status",
        "leads_score",
    ];

    public static function getLeadStatusEnumValues()
    {
        return ['OPEN - NotContacted', 'OPEN - Contacted', 'CLOSED'];
    }
}

