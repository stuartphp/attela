<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePaymentDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_payment_details';

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
    protected $fillable = ['employee_id',
    'payslip_language',
    'bank_branch_code',
    'bank_name',
    'account_number',
    'account_holder',
    'account_holder_relationship',
    'account_holder_id_number',
    'account_type',
    'is_foreign_account',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
