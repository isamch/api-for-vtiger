<?php
function getSummaryFields(string $moduleName): array
{
	$summaryFields = [
		'Contacts' => [
			'firstname',
			'lastname',
			'account_id',
			'title',
			'assigned_user_id',
			'mailingcity',
			'mailingcountry',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Leads' => [
			'firstname',
			'lastname',
			'company',
			'leadsource',
			'website',
			'assigned_user_id',
			'city',
			'country',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Accounts' => [
			'accountname',
			'industry',
			'website',
			'phone',
			'assigned_user_id',
			'bill_city',
			'bill_country',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Potentials' => [
			'potentialname',
			'related_to',
			'sales_stage',
			'amount',
			'closingdate',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Documents' => [
			'notes_title',
			'notecontent',
			'filename',
			// 'folderid',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Calendar' => [
			'subject',
			'date_start',
			'due_date',
			'activitytype',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Emails' => [
			'subject',
			'date_start',
			'parent_id',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'HelpDesk' => [
			'ticket_title',
			'parent_id',
			'priority',
			'status',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Products' => [
			'productname',
			'productcode',
			'unit_price',
			'qty_per_unit',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Faq' => [
			'question',
			'category',
			'product_id',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Vendors' => [
			'vendorname',
			'phone',
			'email',
			'website',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'PriceBooks' => [
			'bookname',
			'active',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Quotes' => [
			'subject',
			'quote_stage',
			'potential_id',
			'validtill',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'PurchaseOrder' => [
			'subject',
			'vendor_id',
			'requisition_no',
			'tracking_no',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'SalesOrder' => [
			'subject',
			'quote_id',
			'due_date',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Invoice' => [
			'subject',
			'salesorder_id',
			'invoicedate',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Campaigns' => [
			'campaignname',
			'campaignstatus',
			'closingdate',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'ServiceContracts' => [
			'subject',
			'contract_no',
			'start_date',
			'due_date',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Services' => [
			'servicename',
			'service_no',
			'unit_price',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Assets' => [
			'assetname',
			'product',
			'serialnumber',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'ProjectMilestone' => [
			'projectmilestonename',
			'projectid',
			'milestonedate',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'ProjectTask' => [
			'projecttaskname',
			'projectid',
			'startdate',
			'enddate',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Project' => [
			'projectname',
			'startdate',
			'targetenddate',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'SMSNotifier' => [
			'message',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],
		'Webforms' => [
			'name',
			'targetmodule',
			'publicid',
			'assigned_user_id',
			'createdtime',
			'modifiedtime',
			'id'
		],

		// Modules not needing summary fields (or system modules)
		'Rss' => [],
		'Reports' => [],
		'Our Sites' => [],
		'Webmails' => [],
		'MailManager' => [],
		'PBXManager' => [],
		'Google' => [],
		'RecycleBin' => [],
	];

	return $summaryFields[$moduleName] ?? [];
}
