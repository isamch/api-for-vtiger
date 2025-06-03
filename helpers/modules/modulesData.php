<?php

function getModuleData($moduleName)
{

	$modulesData = [
		'Contacts' => [
			'tabid' => 4,
			'moduleId' => 12,
			'name' => 'Contacts',
			'summaryFields' => [
				'salutationtype',
				'firstname',
				'lastname',
				// 'account_id',
				'title',
				'assigned_user_id',
				'mailingcity',
				'mailingcountry',
				'createdtime',
				'modifiedtime',
				'id',
			],
			'quickCreateFields' => [
				'salutationtype',
				'firstname',
				'lastname',
				'phone',
				'email',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Assets',
				'Calendar',
				'Campaigns',
				'Contacts',
				'Documents',
				'Emails',
				'HelpDesk',
				'Invoice',
				'ModComments',
				'PBXManager',
				'Potentials',
				'Products',
				'Project',
				'Quotes',
				'SalesOrder',
				'ServiceContracts',
				'Services'
			],
		],
		'Accounts' => [
			'tabid' => 6,
			'moduleId' => 11,
			'name' => 'Accounts',
			'summaryFields' => [
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
			'quickCreateFields' => [
				'accountname',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
		],
		'Leads' => [
			'tabid' => 7,
			'moduleId' => 10,
			'name' => 'Leads',
			'summaryFields' => [
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
			'quickCreateFields' => [
				'lastname',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Calendar',
				'Campaigns',
				'Documents',
				'Emails',
				'ModComments',
				'PBXManager',
				'Products',
				'Services'
			],
		],
		'Documents' => [
			'tabid' => 8,
			'moduleId' => 15,
			'name' => 'Documents',
			'summaryFields' => [
				'notes_title',
				'notecontent',
				'filename',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'notes_title',
				'filename',
				'assigned_user_id',
				'filelocationtype'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Accounts',
				'Assets',
				'Contacts',
				'Faq',
				'HelpDesk',
				'Invoice',
				'Leads',
				'Potentials',
				'Products',
				'Project',
				'PurchaseOrder',
				'Quotes',
				'SalesOrder',
				'ServiceContracts',
				'Services'
			],
		],
		'Calendar' => [
			'tabid' => 9,
			'moduleId' => 9,
			'name' => 'Calendar',
			'summaryFields' => [
				'subject',
				'date_start',
				'due_date',
				'activitytype',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'subject',
				'assigned_user_id',
				'date_start',
				'taskstatus'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Contacts'
			],
		],
		'Emails' => [
			'tabid' => 10,
			'moduleId' => 16,
			'name' => 'Emails',
			'summaryFields' => [
				'subject',
				'date_start',
				'parent_id',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'click_count'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Contacts',
				'Documents'
			],
		],
		'HelpDesk' => [
			'tabid' => 13,
			'moduleId' => 17,
			'name' => 'HelpDesk',
			'summaryFields' => [
				'ticket_title',
				'parent_id',
				'priority',
				'status',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'ticket_title',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Calendar',
				'Documents',
				'Emails',
				'ModComments',
				'Project',
				'ServiceContracts',
				'Services'
			],
		],
		'Faq' => [
			'tabid' => 15,
			'moduleId' => 3,
			'name' => 'Faq',
			'summaryFields' => [
				'question',
				'category',
				'product_id',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Documents',
				'ModComments'
			],
		],
		'Campaigns' => [
			'tabid' => 26,
			'moduleId' => 1,
			'name' => 'Campaigns',
			'summaryFields' => [
				'campaignname',
				'campaignstatus',
				'closingdate',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'campaignname',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Accounts',
				'Calendar',
				'Contacts',
				'Leads',
				'Potentials'
			],
		],
		'Assets' => [
			'tabid' => 38,
			'moduleId' => 27,
			'name' => 'Assets',
			'summaryFields' => [
				'assetname',
				'product',
				'serialnumber',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'assetname',
				'serialnumber',
				'datesold',
				'dateinservice',
				'assetstatus',
				'assigned_user_id',
				'account',
				'contact'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Documents',
				'HelpDesk'
			],
		],
		'ModComments' => [
			'tabid' => 42,
			'moduleId' => 28,
			'name' => 'ModComments',
			'quickCreateFields' => [
				'commentcontent',
				'assigned_user_id',
				'createdtime',
				'modifiedtime'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [],
		],
		'PBXManager' => [
			'tabid' => 34,
			'moduleId' => 24,
			'name' => 'PBXManager',
			'summaryFields' => [],
			'quickCreateFields' => [],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [],
		],
		'Products' => [
			'name' => 'Products',
			'summaryFields' => [
				'productname',
				'productcode',
				'unit_price',
				'qty_per_unit',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'productname',
				'qtyinstock',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Accounts',
				'Assets',
				'Contacts',
				'Documents',
				'HelpDesk',
				'Invoice',
				'Leads',
				'Potentials',
				'PriceBooks',
				'Products',
				'PurchaseOrder',
				'Quotes',
				'SalesOrder'
			],
		],
		'Vendors' => [
			'name' => 'Vendors',
			'summaryFields' => [
				'vendorname',
				'phone',
				'email',
				'website',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'vendorname'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Contacts',
				'Emails',
				'Products',
				'PurchaseOrder'
			],
		],
		'PriceBooks' => [
			'name' => 'PriceBooks',
			'summaryFields' => [
				'bookname',
				'active',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'bookname',
				'currency_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Products',
				'Services'
			],
		],
		'Quotes' => [
			'name' => 'Quotes',
			'summaryFields' => [
				'subject',
				'quote_stage',
				'potential_id',
				'validtill',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'hdnS_H_Percent'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Calendar',
				'Documents',
				'ModComments',
				'SalesOrder'
			],
		],
		'PurchaseOrder' => [
			'name' => 'PurchaseOrder',
			'summaryFields' => [
				'subject',
				'vendor_id',
				'requisition_no',
				'tracking_no',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'hdnS_H_Percent'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Calendar',
				'Documents',
				'ModComments'
			],
		],
		'SalesOrder' => [
			'name' => 'SalesOrder',
			'summaryFields' => [
				'subject',
				'quote_id',
				'due_date',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'hdnS_H_Percent'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Calendar',
				'Documents',
				'Invoice',
				'ModComments'
			],
		],
		'Invoice' => [
			'tabid' => 23,
			'moduleId' => 7,
			'name' => 'Invoice',
			'summaryFields' => [
				'subject',
				'salesorder_id',
				'invoicedate',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'hdnS_H_Percent'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Assets',
				'Calendar',
				'Documents',
				'ModComments'
			],
		],
		'ServiceContracts' => [
			'name' => 'ServiceContracts',
			'summaryFields' => [
				'subject',
				'contract_no',
				'start_date',
				'due_date',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'subject'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Documents',
				'HelpDesk'
			],
		],
		'Services' => [
			'name' => 'Services',
			'summaryFields' => [
				'servicename',
				'service_no',
				'unit_price',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'servicename'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Accounts',
				'Contacts',
				'Documents',
				'HelpDesk',
				'Invoice',
				'Leads',
				'Potentials',
				'PriceBooks',
				'PurchaseOrder',
				'Quotes',
				'SalesOrder'
			],
		],
		'ProjectMilestone' => [
			'name' => 'ProjectMilestone',
			'summaryFields' => [
				'projectmilestonename',
				'projectid',
				'milestonedate',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'projectmilestonename',
				'projectmilestonedate',
				'projectid',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [],
		],
		'ProjectTask' => [
			'name' => 'ProjectTask',
			'summaryFields' => [
				'projecttaskname',
				'projectid',
				'startdate',
				'enddate',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'projecttaskname',
				'projectid',
				'assigned_user_id',
				'startdate',
				'projecttaskstatus'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Documents',
				'Emails',
				'ModComments'
			],
		],
		'Project' => [
			'name' => 'Project',
			'summaryFields' => [
				'projectname',
				'startdate',
				'targetenddate',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [
				'projectname',
				'startdate',
				'targetenddate',
				'assigned_user_id'
			],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Calendar',
				'Documents',
				'Emails',
				'HelpDesk',
				'ModComments',
				'ProjectMilestone',
				'ProjectTask',
				'Quotes'
			],
		],
		'SMSNotifier' => [
			'name' => 'SMSNotifier',
			'summaryFields' => [
				'message',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [
				'Accounts',
				'Contacts',
				'Leads'
			],
		],
		'Webforms' => [
			'name' => 'Webforms',
			'summaryFields' => [
				'name',
				'targetmodule',
				'publicid',
				'assigned_user_id',
				'createdtime',
				'modifiedtime',
				'id'
			],
			'quickCreateFields' => [],
			'createFields' => [],
			'excludedFields' => [],
			'excludedTypes' => [
				'image',
				'file',
				'url',
			],
			'relatedModules' => [],
		],
	];

	return $modulesData[$moduleName];
}
