<?php

function getExcludedFields(string $moduleName): array {
  $excludedFields = [ 
    "Documents" => [
      "imagename",
      "folderid",
    ],
    "Contacts" => [],
    "Leads" => [],
    "Accounts" => [],
    "Potentials" => [],
    "Calendar" => [],
    "Emails" => [],
    "HelpDesk" => [],
    "Products" => [],
    "Faq" => [],
    "Vendors" => [],
    "PriceBooks" => [],
    "Quotes" => [],
    "PurchaseOrder" => [],
    "SalesOrder" => [],
    "Invoice" => [],
    "Campaigns" => [],
    "ServiceContracts" => [],
    "Services" => [],
    "Assets" => [],
    "ProjectMilestone" => [],
    "ProjectTask" => [],
    "Project" => [],
    "SMSNotifier" => [],
    "Webforms" => [],
    "Rss" => [],
    "Reports" => [],
    "Our Sites" => [],
    "Webmails" => [],
    "MailManager" => [],
    "PBXManager" => [],
    "Google" => [],
    "RecycleBin" => []
  ];

  return $excludedFields[$moduleName] ?? [];
}
