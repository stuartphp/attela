<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //use SoftDeletes;
    public $table = 'countries';

    public $timestamps = FALSE;

    protected $fillable = [
		'country',
		'iso_code_2',
		'iso_code_3',
    ];
}
