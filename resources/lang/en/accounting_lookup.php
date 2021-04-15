<?php

return [
    'documents'=>[
        'all'                   =>'All',
        'credit_note'           =>'Credit Notes',
        'credit_from_supplier'  =>'Credit From Supplier',
        'credit_to_supplier'    =>'Credit To Supplier',
        'debit_note'            =>'Debit Notes',
        'goods_delivery_note'   =>'Goods Delivery Notes',
        'goods_received_note'   =>'Goods Received Notes',
        'purchase_order'        =>'Purchase Orders',
        'quotation'             =>'Quotations',
        'receipts'              =>'Receipts',
        'payment_made'          => 'Payments Made',
        'return_debit'          =>'Return Debits',
        'sales_order'           =>'Sales Orders',
        'supplier_invoice'      =>'Supplier Invoices',
        'tax_invoice'           =>'Tax Invoices',
        'transactions'          =>'Transactions'
    ],
    'tax_types'=>[
        '00'    =>['field'=>'tax_type_non_vat_vendor','trans'=>'NON VAT Vendor', 'impact'=>0],
        '01'    =>['field'=>'tax_type_vat_standard','trans'=>'VAT Standard', 'impact'=>1],
        '02'    =>['field'=>'tax_type_zero_rated', 'trans'=>'Zero Rated', 'impact'=>0],
        '03'    =>['field'=>'tax_type_exempt','trans'=>'Exempt', 'impact'=>0],
        '04'    =>['field'=>'tax_type_bad','trans'=>'Bad', 'impact'=>0],
        '05'    =>['field'=>'tax_type_capital','trans'=>'Capital', 'impact'=>0],
        '06'    =>['field'=>'tax_type_vat_adj','trans'=>'VAT Adjustment', 'impact'=>0],
        '07'    =>['field'=>'tax_type_acc_exceed45','trans'=>'Account Exceed 45', 'impact'=>1],
        '08'    =>['field'=>'tax_type_acc_less45','trans'=>'Account Less 45', 'impact'=>1],
        '09'    =>['field'=>'tax_type_export','trans'=>'Export', 'impact'=>1],
        '10'    =>['field'=>'tax_type_change','trans'=>'Change', 'impact'=>1]
    ],

    'payment_terms'=>[
        0   =>'Cash Sale Account',
        1   =>'Last Invoice',
        2   =>'Weekly',
        3   =>'Fortnightly',
        4   =>'30 Days',
        5   =>'60 Days',
        6   =>'90 Days',
        7   =>'120 Days'
    ],
    'ledger' =>[
        'groups'=>[
            'Expenses' =>'Expenses',
            'Retained' =>'Retained',
            'Assets'    =>'Assets',
            'Liability' =>'Liability',
            'Income'    =>'Income'
        ],
        'category'=>[
            ''=>'Other',
            'sales' =>'Sales',
            'other_income'  =>'Other Income',
            'cost_of_sales' =>'Cost of Sales',
            'expenses'      =>'Expenses',
            'retained_income'=>'Retained Income',
            'long_term_borrowings' =>'Long Term Borrowings',
        ],
        'balance'=>[
            'D'     =>'Debit',
            'C'     =>'Credit'
        ],
    ],
    'journal_groups'=>[
        'general_ledger'    =>'General Ledger',
        'customer'          =>'Customer',
        'supplier'          =>'Supplier'
    ],
    'journal'=>[
        'general_ledger'    =>
        [
            'title'    =>  'General Ledger',
            'name'=>[
                'general_journal'       =>'General Journal',
                'payroll_journal'       =>'Payroll Journal',
                'depreciation_journal'       =>'Depreciation Journal',
                'accruals'       =>'Accruals',
                'reversal_of_accruals'       =>'Reversal of Accruals',
                'pos_journal'       =>'POS Journal',
                'currency_variance'       =>'Currency Variance',
                'receipt_journal'       =>'Receipt Journal',
                'deposit_journal'       =>'Deposit Journal',
            ]
        ],
        'customer'          =>[
            'title'         =>'Customer',
            'name'          =>[
                'sales'              =>'Sales',
                'sales_credits'       =>'Sales Credits',
                'customer_journal'    =>'Customer Journal',
                'currency_variance'       =>'Currency Variance',
                'receipt_journal'       =>'Receipt Journal',
                'deposit_journal'       =>'Deposit Journal',
            ]
        ],
        'supplier'          =>[
            'title'         =>'Supplier',
            'name'          =>[
                'goods_received_note'       =>'Goods Received Note',
                'purchases'                 =>'Purchases',
                'purchase_returns'       =>'Purchase Returns',
                'supplier_journal'       =>'Supplier Journal',
                'currency_variance'       =>'Currency Variance',
                'receipt_journal'       =>'Receipt Journal',
                'deposit_journal'       =>'Deposit Journal',
            ],
        ],
    ],
    'vat'=>[
        'rate' =>'15',
        'reverse'=>'0.15'
    ]
];
