<?php
/**
 * Created by iTec Assist
 * Website: https://itecassist.co.za
 * User: Stuart Harrison
 * Date: 2020-06-08
 * Time: 05:06:24 AM
 */

return [
	'title'=>'Payslip Definitions',
	'fields'=>[
		'transaction_code'=>'Transaction Code',
        'description'=>'Default Description',
        'transaction_type'=>'Transaction Type',
        'report_description'=>'Report Description',
        'payslip_description'=>'Payslip Description',
        'irp5_code'=>'IRP5 Code',
        'irp5_description'=>'IRP5 Description',
        'effective_from'=>'Effective From',
        'effective_to'=>'Effective To',
        'taxability'=>'Taxability',
        'taxable'=>'Taxable %',
        'directive_mandatory'=>'Directive Mandatory',
        'oid_include'=>'OID Include',
        'uif_include'=>'UIF Include',
        'uif_use_tax'=>'UIF Use Tax %',
        'sdl_include'=>'SDL Include',
        'sdl_use_tax'=>'SDL Use Tax %',
        'rf_lable_include'=>'RF Lable Include',
        'rf_lable_use_tax'=>'RF Lable Use Tax %',
        'eti_include'=>'ETI Include',
        'eti_use_tax'=>'ETI Use Tax %',
        'multiplier' => 'Multiplier'
    ],
    'transaction_type'=>[
        0=>'CompanyContribution',
        1=>'Deduction',
        2=>'Earning',
        3=>'FringeBenefit',
    ],
    'taxability'=>[
        0=>'Normal',
        1=>'NotTaxable',
        2=>'Periodic'
    ]
];
