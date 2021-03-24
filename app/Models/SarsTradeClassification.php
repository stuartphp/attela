<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SarsTradeClassification extends Model
{
    //use SoftDeletes;
    public $table = 'sars_trade_classifications';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
    		'trade_code',
		'description',

    ];
}
