<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public $table = 'assets';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
    		'company_id',
		'asset_number',
		'asset_type_id',
		'employee_id',
		'serial_number',
		'description',

    ];
}
