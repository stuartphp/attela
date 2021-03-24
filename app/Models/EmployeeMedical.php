<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeMedical extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_medicals';

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
        'members',
        'private_contribution',
        'private_adjustment',
        'private_total',
        'company_employee_contribution',
        'company_employee_contribution_adjustment',
        'company_employee_total_contribution',
        'company_contribution ',
        'company_contribution_adjustment',
        'company_total_contribution'
    ];
}
