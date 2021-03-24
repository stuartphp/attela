<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollLookup extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payroll_lookup';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Un Comment if you want to use soft deletes
     *
     * @var array
     */
    protected $fillable = ['lookup','name','value',];
}
