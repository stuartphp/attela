<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDirective extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_directives';

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
    protected $fillable = [
        'employee_id',
        'name ',
        'sars_number',
        'percentage',

    ];
}
