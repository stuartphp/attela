<?php
/**
 * Created by iTec Assist
 * Website: https://itecassist.co.za
 * User: Stuart Harrison
 * Date: 2020-06-08
 * Time: 05:06:23 AM
 */

return [
	'title'=>'Journal Entries',
    'receipts'=>'Receipts',
    'select' =>'Select Journal',
	'fields'=>[
        'journal_code'       =>'Journal Code',
        'journal_type'       =>'Journal Type',
		'transaction_flow_id'		=>'Transaction Flow Id',
		'action_date'		=>'Action Date',
		'document_id'		=>'Document',
		'account_number'		=>'Account Number',
		'entity_name'		=>'Entity Name',
		'description'		=>'Description',
		'reference'		    =>'Reference',
		'type'		        =>'Type',
		'tax_type'		    =>'Tax Type',
		'ledger'		    =>'Ledger',
		'debit_amount'		=>'Debit Amount',
        'credit_amount'		=>'Credit Amount',
        'affect_journal'    =>'Affet Journal',
        'amount'=>'Amount'
	],
        'sub'=>[
        'action_date'		=>'Date',
        'document_id'		=>'Doc.',
        'account_number'		=>'Acc. Nr.',
        'entity_name'		=>'Name',
        'description'		=>'Description',
        'reference'		=>'Ref.',
        'type'		=>'Type',
        'tax_type'		=>'Tax Type',
        'ledger'		=>'Ledger',
        'debit_amount'		=>'Debit',
        'credit_amount'		=>'Credit',
        'amount'=>'Amount'
    ],
    'journal_groups'=>[
        'general_ledger'    =>'General Ledger',
        'customer'          =>'Customer',
        'supplier'          =>'Supplier'
    ],
    'journal_names'=>[
        'general_journal'       =>'General Journal',
        'payroll_journal'       =>'Payroll Journal',
        'depreciation_journal'  =>'Depreciation Journal',
        'accruals'              =>'Accruals',
        'reversal_of_accruals'  =>'Reversal of Accruals',
        'pos_journal'           =>'POS Journal',
        'currency_variance'     =>'Currency Variance',
        'receipt_journal'       =>'Receipt Journal',
        'deposit_journal'       =>'Deposit Journal',
        'sales'                 =>'Sales',
        'sales_credits'         =>'Sales Credits',
        'customer_journal'      =>'Customer Journal',
        'goods_received_note'   =>'Goods Received Note',
        'purchases'             =>'Purchases',
        'purchase_returns'      =>'Purchase Returns',
        'supplier_journal'      =>'Supplier Journal',
    ]
];
