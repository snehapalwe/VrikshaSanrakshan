<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home / मुख्यपृष्ठ', 
			'icon' => ''
		),
			    
		array(
			'path' => 'api/offlineredirect', 
			'label' => 'Process Offline Application', 
			'icon' => ''
		),
		
		array(
			'path' => 'user_info', 
			'label' => 'User Info', 
			'icon' => ''
		),
		
// 		array(
// 			'path' => 'application_form', 
// 			'label' => 'Application Form / अर्ज', 
// 			'icon' => ''
// 		),
		
		array(
			'path' => 'commencement_certificate', 
			'label' => 'Commencement Certificate Application <br> वृक्ष प्राधिकरण बांधकाम प्रारंभ ना-हरकत प्रमाणपत्र', 
			'icon' => ''
		),
		
		array(
			'path' => 'occupancy_certificate', 
			'label' => 'Occupancy Certificate Application <br> वृक्ष प्राधिकरण बांधकाम अंतिम ना-हरकत प्रमाणपत्र', 
			'icon' => ''
		),
		
		array(
			'path' => 'user_info', 
			'label' => 'Master', 
			'icon' => '',
'submenu' => array(
		array(
			'path' => 'master_name_of_tree', 
			'label' => 'Master Name Of Tree', 
			'icon' => ''
		),
		
		array(
			'path' => 'master_for_name_of_news_paper', 
			'label' => 'Master For Name Of News Paper', 
			'icon' => ''
		),
		
		array(
			'path' => 'master_residence', 
			'label' => 'Master Residence', 
			'icon' => ''
		)
	)
		),
		
// 		array(
// 			'path' => 'objections/', 
// 			'label' => 'Objections/आक्षेप', 
// 			'icon' => ''
// 		),
		
		array(
			'path' => 'ccav_orders', 
			'label' => 'Ccav Orders', 
			'icon' => ''
		),
		
		array(
			'path' => 'login_token', 
			'label' => 'Login Token', 
			'icon' => ''
		),
		
		array(
			'path' => 'certificate_data', 
			'label' => 'Certificate Data', 
			'icon' => ''
		),
		
		array(
			'path' => 'accept_reject', 
			'label' => 'Accept Reject', 
			'icon' => ''
		),
		
		array(
			'path' => 'authorization_sequence', 
			'label' => 'Authorization Sequence', 
			'icon' => ''
		),
		
		array(
			'path' => 'role_permissions/add', 
			'label' => 'View2', 
			'icon' => ''
		),
		
		array(
			'path' => 'label_names', 
			'label' => 'Label Names', 
			'icon' => ''
		)
	);
		
	
	
			public static $cut_purpose = array(
		array(
			"value" => "CONSTRUCTION PURPOSE", 
			"label" => "CONSTRUCTION PURPOSE", 
		),
		array(
			"value" => "DANGEROUS CONDITION", 
			"label" => "DANGEROUS CONDITION", 
		),);
		
			public static $application_type = array(
		array(
			"value" => "PARTIAL TREE CUT", 
			"label" => "PARTIAL TREE CUT", 
		),
		array(
			"value" => "FULL TREE CUT", 
			"label" => "FULL TREE CUT", 
		),);
		
			public static $status = array(
		array(
			"value" => "2", 
			"label" => "SEND TO HOD FOR APPROVAL", 
		),);
		
			public static $resolution = array(
		array(
			"value" => "CORRECT OBJECTION SEND TO HOD", 
			"label" => "CORRECT OBJECTION SEND TO HOD", 
		),
		array(
			"value" => "WRONG OBJECTION", 
			"label" => "WRONG OBJECTION", 
		),);
		
			public static $purpose = array(
		array(
			"value" => "Security Deposit", 
			"label" => "Security Deposit", 
		),
		array(
			"value" => "Tree Fund", 
			"label" => "Tree Fund", 
		),);
		
			public static $payment_mode = array(
		array(
			"value" => "OFFLINE", 
			"label" => "OFFLINE", 
		),);
		
			public static $status2 = array(
		array(
			"value" => "-1", 
			"label" => "REJECT", 
		),
		array(
			"value" => "3", 
			"label" => "ACCEPT", 
		),);
		
			public static $decision = array(
		array(
			"value" => "CORRECT OBJECTION REJECT APPLICATION", 
			"label" => "CORRECT OBJECTION REJECT APPLICATION", 
		),
		array(
			"value" => "WRONG OBJECTION KEEP TO HOD", 
			"label" => "WRONG OBJECTION KEEP TO HOD", 
		),
		array(
			"value" => "WRONG OBJECTION SEND TO AUTH 1", 
			"label" => "WRONG OBJECTION SEND TO AUTH 1", 
		),);
		
			public static $final_decision = array(
		array(
			"value" => "ACCEPT GRANT PERMISSION", 
			"label" => "ACCEPT GRANT PERMISSION", 
		),
		array(
			"value" => "REJECT", 
			"label" => "REJECT", 
		),);
		
			public static $demand = array(
		array(
			"value" => "YES", 
			"label" => "YES", 
		),
		array(
			"value" => "NO", 
			"label" => "NO", 
		),);
		
			public static $db_name = array(
		array(
			"value" => "commencement_certificate", 
			"label" => "commencement_certificate", 
		),);
		
			public static $payment_mode2 = array(
		array(
			"value" => "Online", 
			"label" => "Online", 
		),);
		
			public static $report = array(
		array(
			"value" => "Approve", 
			"label" => "Approve", 
		),
		array(
			"value" => "Reject", 
			"label" => "Reject", 
		),);
		
}