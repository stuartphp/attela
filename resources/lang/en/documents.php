<?php
/**
 * Created by iTec Assist
 * Website: https://itecassist.co.za
 * User: Stuart Harrison
 * Date: 2020-06-08
 * Time: 05:06:22 AM
 */

return [
	'title'=>'Documents',
	'fields'=>[
		'gcs'		=>'Gcs',
		'account_number'		=>'Account Number',
		'entity_id'		=>'Entity Id',
		'entity_name'		=>'Entity Name',
		'physical_address'		=>'Physical Address',
		'delivery_address'		=>'Delivery Address',
		'tax_exempt'		=>'Tax Exempt',
		'tax_reference'		=>'Tax Reference',
		'sales_code'		=>'Sales Code',
		'discount_perc'		=>'Discount Perc',
		'exchange_rate'		=>'Exchange Rate',
		'terms'		=>'Terms',
		'expire_delivery'		=>'Expire Delivery',
		'freight_method'		=>'Freight Method',
        'ship_deliver'		=>'Ship Deliver',
        'action_date'		=>'Action Date',
		'document_number'		=>'Document Number',
		'document_reference'		=>'Document Reference',
		'reference_number'		=>'Reference Number',
		'user_id'		=>'User Id',
		'document_type'		=>'Document Type',
		'inclusive'		=>'Inclusive',
		'note'		=>'Note',
		'total_nett_price'		=>'Total Nett Price',
		'total_excl'		=>'Total Excl',
		'total_discount'		=>'Total Discount',
		'total_tax'		=>'Total Tax',
		'total_amount'		=>'Total Amount',
		'total_due'		=>'Total Due',
		'is_locked'		=>'Is Locked',
		'is_paid'		=>'Is Paid',
	],
    'documents'=>[
        'calendar'=>'Calendar',
        'credit_note'=>'Credit Note',
        'credit_from_supplier'=>'Credit From Supplier',
        'debit_note'=>'Debit Note',
        'goods_delivery_note'=>'Goods Delivery Note',
        'goods_received_note'=>'Goods Received Note',
        'purchase_order'=>'Purchase Order',
        'purchase_order_helper'=>'A purchase order is created by a business to communicate a list of goods or services they’d like to purchase from a supplier',
        'quotation'=>'Quotation',
        'receipts'=>'Receipt',
        'return_debit'=>'Return Debit',
        'return_debit_helper'=>'A Return Debit is the return of funds to a consumer, forcibly initiated by the issuing bank of the instrument used by a consumer to settle a debt. Specifically, it is the reversal of a prior outbound transfer of funds from a consumer\'s bank account, or credit card.',
        'sales_order'=>'Sales Order',
        'sales_order_helper'=>'A sales order is created by a supplier to confirm that they can supply the goods and services requested for purchase by the buying party. It confirms that the supplier has reviewed and accepted the terms and details of the purchase order – including prices, quantities, payment methods, and the ability to deliver to the specified addresses on time.',
        'supplier_invoice'=>'Supplier Invoice',
        'supplier_invoice_helper'=>'A supplier invoice is the bill issued by a vendor for goods delivered or services rendered to a customer. The recipient of a supplier invoice issues its own invoices to its customers, and so may refer to supplier invoices as vendor invoices to more clearly differentiate them.',
        'statement' =>'Statement',
        'tax_invoice'=>'Tax Invoice',
        'transaction_list'=>'Transaction List'
    ],
    'doc'=>[
        'code'              =>'Code',
        'description'       =>'Description',
        'options'           =>'Options',
        'unit'              =>'Unit',
        'quantity'          =>'Quantity',
        'price_excl'        =>'Price Excl.',
        'vat'               =>'VAT',
        'discount'          =>'Disc.'
    ],
    'rounding'  =>'Rounding',
    'discount'  =>'Discount'
];
