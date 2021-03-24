<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //use SoftDeletes;
    public $table = 'zones';

    public $timestamps = FALSE;

    protected $fillable = [
		'country_id',
		'name',
		'code',
    ];
}
