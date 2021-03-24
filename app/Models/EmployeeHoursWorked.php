<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeHoursWorked extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_hours_worked';

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
        'employee_benefit_id',
        'compensation_pay_type', 'compensation_pay_schedule', 'hours_per_day', 'days_per_week',
        'days_per_bw', 'ave_days_pm', 'ave_hours_pw', 'ave_hours_bw', 'ave_hours_pm', 'annual_salary', 'fixed_salary', 'rate_per_day', 'rate_per_hour', 'is_advised'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
