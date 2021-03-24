<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCountry extends Model
{
    //use SoftDeletes;
    public $table = 'company_countries';

    public $timestamps = FALSE;

    protected $fillable = [
        'company_id',
		'country_id',
        'name',
		'iso_code_2',
		'iso_code_3',
        'is_active'
    ];
}
