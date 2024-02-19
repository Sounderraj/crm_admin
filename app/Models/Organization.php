<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory; use SoftDeletes;

    protected $table = "organization";

    protected $fillable = [
        'org_name',
        'industry',
        'org_country',
        'org_street1',
        'org_street2',
        'org_city',
        'org_state',
        'org_zip_code',
        'org_phone',
        'org_fax',
        'org_website_url',
        'fiscal_year',
        'language',
        'time_zone',
        'TAN',
        'gst_registered',
        'GSTIN'
    ];

    public static function getIndustryEnumValues()
    {
        return [
            'Agency or Sales House',
            'Agriculture',
            'Agriculture',
            'Art & Design',
            'Automative',
            'Construction',
            'Cunsulting',
            'Education',
            'Engineering',
            'Entertainment',
            'Financial Services',
            'Agriculture',
            'Food Services',
            'Health Care',
            'Interior Design',
            'Legal',
            'Manufacturing',
            'Marketing',
            'Mining & Logistics',
            'Real Estate',
            'Retail Services',
            'Services',
            'Tele Communication',
            'Technology',
            'Technology',
            'Travel',
            'Web Development',
            'Web Designing',
        ];
    }
}
