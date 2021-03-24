<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetupLeave extends Model
{
    public $table = 'setup_leave';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
        'company_id',
        'leave_type',
        'leave_cycle',
        'estimated_value',

    ];
}
