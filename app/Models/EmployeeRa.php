<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeRa extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_ras';

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
        'company_private ',
        'company_contribution',
        'employee_contribution',
        'from_date',
        'clearance_number',
        'end_date',
        
    ];
}
