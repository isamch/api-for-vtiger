LOG ["moduleName", "Contacts", "recordId", "12x12", "formData",
{"account_id": "", "assigned_user_id": "19x1", "assistant": "", "assistantphone": "", "birthday": "", "contact_id": "", "contact_no": "CON6", "createdtime": "2025-05-25 13:43:11", "department": "", "description": "", "donotcall": "0", "email": "", "emailoptout": "0", "fax": "", "firstname": "isam", "homephone": "", "id": "12x12", "imagename": "", "isconvertedfromlead": "0", "lastname": "chajia", "leadsource": "", "mailingcity": "", "mailingcountry": "", "mailingpobox": "", "mailingstate": "", "mailingstreet": "", "mailingzip": "", "mobile": "", "modifiedby": "admin", "modifiedtime": "2025-05-25 13:43:11", "notify_owner": "0", "othercity": "", "othercountry": "", "otherphone": "", "otherpobox": "", "otherstate": "", "otherstreet": "", "otherzip": "", "phone": "", "portal": "0", "reference": "0", "salutationtype": "aa", "secondaryemail": "", "source": "CRM", "starred": "0", "support_end_date": "", "support_start_date": "", "tags": "", "title": ""}]



LOG formData {"activitytype": "Task", "assigned_user_id": "19x1", "contact_id": "", "createdtime": "2025-06-02 10:27:11", "date_start": "2025-06-03", "description": "", "due_date": "2025-06-02", "duration_hours": "12", "duration_minutes": "33", "eventstatus": "", "id": "9x30", "location": "", "modifiedby": "19x1", "modifiedtime": "2025-06-02 11:22:26", "notime": "no", "parent_id": "13x28", "recurringtype": "", "reminder_time": "no", "sendnotification": "no", "source": "CRM", "starred": "no", "subject": "trs", "tags": "", "taskpriority": "", "taskstatus": "Pending Input", "time_end": "", "time_start": "19-01-01", "visibility": "Private"}

ERROR Error updating module record: [Error: {"error":"Update failed","details":{"success":false,"error":{"message":"Unknown Error while processing request","code":"INTERNAL_SERVER_ERROR"}}}]



LOG formData {"activitytype": "Task", "assigned_user_id": "19x1", "contact_id": "", "createdtime": "2025-06-02 10:27:11", "date_start": "2025-06-04", "description": "", "due_date": "2025-06-02", "duration_hours": "-11", "duration_minutes": "-22", "eventstatus": "", "id": "9x30", "location": "", "modifiedby": "19x1", "modifiedtime": "2025-06-02 11:39:27", "notime": "no", "parent_id": "13x28", "recurringtype": "", "reminder_time": "no", "sendnotification": "no", "source": "CRM", "starred": "no", "subject": "trs", "tags": "", "taskpriority": "", "taskstatus": "Pending Input", "time_end": "", "time_start": "10:22:00", "visibility": "Private"}


'Campaigns' => '1',
'Vendors' => '2',
'Faq' => '3',
'Quotes' => '4',
'PurchaseOrder' => '5',
'SalesOrder' => '6',
'Invoice' => '7',
'PriceBooks' => '8',
'Calendar' => '9',
'Leads' => '10',
'Accounts' => '11',
'Contacts' => '12',
'Potentials' => '13',
'Products' => '14',
'Documents' => '15',
'Emails' => '16',
'HelpDesk' => '17',
'Events' => '18',
'Users' => '19',
'Groups' => '20',
'Currency' => '21',
'DocumentFolders' => '22',
'CompanyDetails' => '23',
'PBXManager' => '24',
'ServiceContracts' => '25',
'Services' => '26',
'Assets' => '27',
'ModComments' => '28',
'ProjectMilestone' => '29',
'ProjectTask' => '30',
'Project' => '31',
'SMSNotifier' => '32',
'LineItem' => '33',
'Tax' => '34',
'ProductTaxes' => '35' ,
'Remboursement' => '38',
'Reglement' => '37'


Key Fields
First Name	
mr isam
Last Name	
chajia
Organization Name	
Title	
Assigned To	
isam chajia
Mailing City	
Mailing Country



<?php
function getSummaryFields(string $moduleName): array {
    $summaryFields = [
        'Contacts' => [
            'firstname', 'lastname', 'account_id', 'title', 'assigned_user_id', 'mailingcity', 'mailingcountry'
        ],
        'Leads' => [
            'firstname', 'lastname', 'company', 'leadsource', 'website', 'assigned_user_id', 'city', 'country'
        ],
        'Accounts' => [
            'accountname', 'industry', 'website', 'phone', 'assigned_user_id', 'bill_city', 'bill_country'
        ],
        'Potentials' => [
            'potentialname', 'related_to', 'sales_stage', 'amount', 'closingdate', 'assigned_user_id'
        ],
        'Documents' => [
            'notes_title', 'filename', 'folderid', 'assigned_user_id'
        ],
        'Calendar' => [
            'subject', 'date_start', 'due_date', 'activitytype', 'assigned_user_id'
        ],
        'Emails' => [
            'subject', 'date_start', 'parent_id', 'assigned_user_id'
        ],
        'HelpDesk' => [
            'ticket_title', 'parent_id', 'priority', 'status', 'assigned_user_id'
        ],
        'Products' => [
            'productname', 'productcode', 'unit_price', 'qty_per_unit', 'assigned_user_id'
        ],
        'Faq' => [
            'question', 'category', 'product_id', 'assigned_user_id'
        ],
        'Vendors' => [
            'vendorname', 'phone', 'email', 'website', 'assigned_user_id'
        ],
        'PriceBooks' => [
            'bookname', 'active', 'assigned_user_id'
        ],
        'Quotes' => [
            'subject', 'quote_stage', 'potential_id', 'validtill', 'assigned_user_id'
        ],
        'PurchaseOrder' => [
            'subject', 'vendor_id', 'requisition_no', 'tracking_no', 'assigned_user_id'
        ],
        'SalesOrder' => [
            'subject', 'quote_id', 'due_date', 'assigned_user_id'
        ],
        'Invoice' => [
            'subject', 'salesorder_id', 'invoicedate', 'assigned_user_id'
        ],
        'Campaigns' => [
            'campaignname', 'campaignstatus', 'closingdate', 'assigned_user_id'
        ],
        'ServiceContracts' => [
            'subject', 'contract_no', 'start_date', 'due_date', 'assigned_user_id'
        ],
        'Services' => [
            'servicename', 'service_no', 'unit_price', 'assigned_user_id'
        ],
        'Assets' => [
            'assetname', 'product', 'serialnumber', 'assigned_user_id'
        ],
        'ProjectMilestone' => [
            'projectmilestonename', 'projectid', 'milestonedate', 'assigned_user_id'
        ],
        'ProjectTask' => [
            'projecttaskname', 'projectid', 'startdate', 'enddate', 'assigned_user_id'
        ],
        'Project' => [
            'projectname', 'startdate', 'targetenddate', 'assigned_user_id'
        ],
        'SMSNotifier' => [
            'message', 'assigned_user_id'
        ],
        'Webforms' => [
            'name', 'targetmodule', 'publicid', 'assigned_user_id'
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
