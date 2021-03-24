<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeJob extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_jobs';

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
    'effective_date',
    'end_date',
    'job_title',
    'store_id',
    'job_position',
    'reports_to',
    // 'compensation_pay_rate',
    // 'compensation_pay_per',
    // 'compensation_pay_type',
    // 'compensation_pay_schedule',
    // 'overtime_allowed',
    'change_reason',];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function report()
    {
        return $this->belongsTo(Employee::class, 'reports_to', 'id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function position()
    {
        return $this->belongsTo(EmployeePosition::class, 'job_position', 'id');
    }
}
