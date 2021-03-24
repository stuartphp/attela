<?php
return [
    'title' =>'Hours Worked',
    'fields'=>[
        'employee_id'   =>'Employee',
        'hours_per_day' =>'Working Hours per Day',
        'days_per_week' =>'Working Days per Week',
        'ave_days_pm'   =>'Average Working Days per Month',
        'annual_salary' =>'Annual Salary',
        'fixed_salary'  =>'Fixed Salary',
        'rate_per_day'  =>'Rate Per Day',
        'rate_per_hour'  =>'Rate Per Hour',
        'is_advised'    =>'This employee must not be paid unless hours or days worked are advised',
    ],
    'rates' =>'Rates',
    'hours' =>'Hours',
    'average' => 'Averages',
    'compensation'  =>'Compensation',
    'ave_hours_pw'  =>'Working Hours per Week',
    'ave_hours_bw'  =>'Working Hours per Biweek',
    'days_per_bw'  =>'Working Days per Biweek',
    'ave_hours_pm'  =>'Working Hours per Month',
    'rate_pd'       =>'Rate per Day',
    'rate_ph'       =>'Rate per Hour',
    'overtime'      =>'Overtime',
    'overtime_sub'  =>[
        'normal'    =>[
            'name'  =>'Normal Hours',
            'value' =>1
        ],
        'time15'    =>[
            'name'  => 'Time adn Half',
            'value' => 1.5
        ],
        'double'    =>[
            'name'  =>'Double Time',
            'value' =>2
        ]
        ],
    'helpe' =>[
        'is_advised'    =>'Select this option if hours should be advised. If selected, Salary or Wage will not default to the payslip.'
    ],
    'i_want_to_pay' =>'I want to pay ',
];

