<?php

return [
    'nature_of_person'  => [
        'A' => 'Individual with ID/Passport',
        'B' => 'Individual without ID/Passport',
        'C' => 'Director of private company',
        'D' => 'Trust',
        'E' => 'Company/CC',
        'F' => 'Partnership',
        'G' => 'Corporation',
        'H' => 'Personal Service Provider',
        'N' => 'Pensioner',
    ],
    'certificate_type' =>[
        0 => 'IRP5',
        1 => 'IT3(a)',
        2 => 'ITREG',
    ],
    'payment_type' => [
        'cash'      => 'Cash',
        'cheque'    =>'Cheque',
        'eft'       =>'Electronic Funds Transfer',
        'bond'      =>'Bond',
        'cheque-transmission' => 'Cheque/Transmission',
        'savings'   =>'Savings',
        'joint'     =>'Joint',
        'own'       =>'Own',
        'third-party' =>'Third Party'
    ],
    'payment_frequency'=>[
        0   => 'Weekly',
        1   => 'Fortnightly',
        2   => 'Monthly',
        3   => 'Quarter',
        4   => 'Six Months',
        5   => 'Yearly'
    ],
    'tax_type' => [
        1   => 'Directive %',
        2   => 'Director Directive %',
        3   => 'Director PAYE',
        4   => 'Director Temporary',
        5   => 'Independent Contractor',
        6   => 'Labor Broker with IRP30',
        7   => 'Statutory Tables',
        8   => 'Temporary Part Time'
    ],
    'reason_no_uif' => [
        1   => 'Government',
        2   => 'Independent Contractor',
        3   => 'Learner',
        4   => 'Pension Income Only',
        5   => 'Repatriated',
        6   => 'Temporary'
    ]
];
