<?php 
/**
 * Commencement_certificate Page Controller
 * @category  Controller
 */
class Commencement_certificateController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "commencement_certificate";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
     
     
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function csv_report($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"application_type", 
			"applicant_full_name", 
			"applicant_address", 
			"property_owner_name", 
			"ward", 
			"address_of_plot", 
			"google_link", 
			"no_of_trees_if_available", 
			"trees_added", 
			"architech_name", 
			"architect_address", 
			"architect_pin_code", 
			"architect_mobile_number", 
			"builder_name", 
			"builder_address", 
			"builder_pin_code", 
			"builder_mobile_number", 
			"plot_area_in_sq_mtr", 
			"phisical_colored_map_with_tree_located", 
			"architech_application", 
			"google_map_with_polygone", 
			"document_7_12_", 
			"flag", 
			"status", 
			"user_id", 
			"inspection_report_by_cg", 
			"date", 
			"type_of_residence", 
			"tippni_upload", 
			"tippni_data", 
			"demand", 
			"cc_affidavit", 
			"permission_upload", 
			"cc_application_id", 
			"paid_1", 
			"paid_2", 
			"amount", 
			"trees_to_be_planted", 
			"names_of_trees_be_planted", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no", 
			"latitude", 
			"longitude", 
			"current_tiimestamp", 
			"updated_timestamp", 
			"mouje", 
			"survey_no");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				commencement_certificate.id LIKE ? OR 
				commencement_certificate.application_type LIKE ? OR 
				commencement_certificate.applicant_full_name LIKE ? OR 
				commencement_certificate.applicant_address LIKE ? OR 
				commencement_certificate.property_owner_name LIKE ? OR 
				commencement_certificate.ward LIKE ? OR 
				commencement_certificate.address_of_plot LIKE ? OR 
				commencement_certificate.google_link LIKE ? OR 
				commencement_certificate.no_of_trees_if_available LIKE ? OR 
				commencement_certificate.trees_added LIKE ? OR 
				commencement_certificate.architech_name LIKE ? OR 
				commencement_certificate.architect_address LIKE ? OR 
				commencement_certificate.architect_pin_code LIKE ? OR 
				commencement_certificate.architect_mobile_number LIKE ? OR 
				commencement_certificate.builder_name LIKE ? OR 
				commencement_certificate.builder_address LIKE ? OR 
				commencement_certificate.builder_pin_code LIKE ? OR 
				commencement_certificate.builder_mobile_number LIKE ? OR 
				commencement_certificate.plot_area_in_sq_mtr LIKE ? OR 
				commencement_certificate.phisical_colored_map_with_tree_located LIKE ? OR 
				commencement_certificate.architech_application LIKE ? OR 
				commencement_certificate.google_map_with_polygone LIKE ? OR 
				commencement_certificate.document_7_12_ LIKE ? OR 
				commencement_certificate.flag LIKE ? OR 
				commencement_certificate.status LIKE ? OR 
				commencement_certificate.user_id LIKE ? OR 
				commencement_certificate.inspection_report_by_cg LIKE ? OR 
				commencement_certificate.date LIKE ? OR 
				commencement_certificate.type_of_residence LIKE ? OR 
				commencement_certificate.tippni_upload LIKE ? OR 
				commencement_certificate.tippni_data LIKE ? OR 
				commencement_certificate.demand LIKE ? OR 
				commencement_certificate.cc_affidavit LIKE ? OR 
				commencement_certificate.permission_upload LIKE ? OR 
				commencement_certificate.cc_application_id LIKE ? OR 
				commencement_certificate.paid_1 LIKE ? OR 
				commencement_certificate.paid_2 LIKE ? OR 
				commencement_certificate.amount LIKE ? OR 
				commencement_certificate.trees_to_be_planted LIKE ? OR 
				commencement_certificate.names_of_trees_be_planted LIKE ? OR 
				commencement_certificate.fy LIKE ? OR 
				commencement_certificate.count LIKE ? OR 
				commencement_certificate.application_no LIKE ? OR 
				commencement_certificate.mobile_no LIKE ? OR 
				commencement_certificate.latitude LIKE ? OR 
				commencement_certificate.longitude LIKE ? OR 
				commencement_certificate.current_tiimestamp LIKE ? OR 
				commencement_certificate.updated_timestamp LIKE ? OR 
				commencement_certificate.mouje LIKE ? OR 
				commencement_certificate.survey_no LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "commencement_certificate/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("commencement_certificate.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Commencement Certificate";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("commencement_certificate/csv_report.php", $data); //render the full page
	}
	
	
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("application_no", 
			"id", 
			"status", 
			"type_of_residence", 
			"applicant_full_name", 
			"mobile_no", 
			"applicant_address", 
			"property_owner_name", 
			"ward", 
			"address_of_plot", 
			"google_link", 
			"no_of_trees_if_available", 
			"trees_added", 
			"architech_name", 
			"architect_address", 
			"architect_pin_code", 
			"architect_mobile_number", 
			"builder_name", 
			"builder_address", 
			"builder_pin_code", 
			"builder_mobile_number", 
			"plot_area_in_sq_mtr", 
			"survey_no", 
			"mouje", 
			"latitude", 
			"longitude", 
			"date", 
			"phisical_colored_map_with_tree_located", 
			"google_map_with_polygone", 
			"document_7_12_", 
			"cc_affidavit", 
			"user_id", 
			"inspection_report_by_cg", 
			"tippni_upload", 
			"tippni_data", 
			"demand", 
			"permission_upload", 
			"paid_1", 
			"paid_2", 
			"amount", 
			"trees_to_be_planted", 
			"names_of_trees_be_planted", 
			"fy", 
			"count", 
			"current_tiimestamp", 
			"updated_timestamp");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(USER_ROLE==2){
    $db->where("user_id",USER_ID);
}
if(USER_ROLE==2){
    // $db->where("status<12");
}
if(USER_ROLE==7){
    // $db->where("commencement_certificate.ward",get_active_user("ward"));
    $db->where("(status>=2  or status<=-1) ");
}
if(USER_ROLE==9){
    $db->where("(status>7  or status<=-1) ");
}
if(USER_ROLE==10){
    $db->where("(status>9  or status<=-1) ");
}
if(isset($_GET['id'])){
$db->where("id",$_GET['id']);
}

if (isset($_GET['status2']) && $_GET['status2']=="pending") {
    $db->where("(status IN (1,2,3,4,5,6,7,8,9,10,11,12,13) and permission_upload='')");
}
if (isset($_GET['status2']) && $_GET['status2']=="completed") {
    $db->where("(permission_upload!='')");
}
if (isset($_GET['status2']) && $_GET['status2']=="reverted") {
    $db->where("(status = '-100')");
}
if (isset($_GET['status2']) && $_GET['status2']=="rejected") {
    $db->where("(status = '-2')");
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				commencement_certificate.application_no LIKE ? OR 
				commencement_certificate.id LIKE ? OR 
				commencement_certificate.cc_application_id LIKE ? OR 
				commencement_certificate.status LIKE ? OR 
				commencement_certificate.type_of_residence LIKE ? OR 
				commencement_certificate.applicant_full_name LIKE ? OR 
				commencement_certificate.mobile_no LIKE ? OR 
				commencement_certificate.applicant_address LIKE ? OR 
				commencement_certificate.property_owner_name LIKE ? OR 
				commencement_certificate.ward LIKE ? OR 
				commencement_certificate.address_of_plot LIKE ? OR 
				commencement_certificate.google_link LIKE ? OR 
				commencement_certificate.no_of_trees_if_available LIKE ? OR 
				commencement_certificate.trees_added LIKE ? OR 
				commencement_certificate.architech_name LIKE ? OR 
				commencement_certificate.architect_address LIKE ? OR 
				commencement_certificate.architect_pin_code LIKE ? OR 
				commencement_certificate.architect_mobile_number LIKE ? OR 
				commencement_certificate.builder_name LIKE ? OR 
				commencement_certificate.builder_address LIKE ? OR 
				commencement_certificate.builder_pin_code LIKE ? OR 
				commencement_certificate.builder_mobile_number LIKE ? OR 
				commencement_certificate.plot_area_in_sq_mtr LIKE ? OR 
				commencement_certificate.survey_no LIKE ? OR 
				commencement_certificate.mouje LIKE ? OR 
				commencement_certificate.latitude LIKE ? OR 
				commencement_certificate.longitude LIKE ? OR 
				commencement_certificate.date LIKE ? OR 
				commencement_certificate.phisical_colored_map_with_tree_located LIKE ? OR 
				commencement_certificate.google_map_with_polygone LIKE ? OR 
				commencement_certificate.document_7_12_ LIKE ? OR 
				commencement_certificate.cc_affidavit LIKE ? OR 
				commencement_certificate.user_id LIKE ? OR 
				commencement_certificate.inspection_report_by_cg LIKE ? OR 
				commencement_certificate.tippni_upload LIKE ? OR 
				commencement_certificate.tippni_data LIKE ? OR 
				commencement_certificate.demand LIKE ? OR 
				commencement_certificate.permission_upload LIKE ? OR 
				commencement_certificate.paid_1 LIKE ? OR 
				commencement_certificate.paid_2 LIKE ? OR 
				commencement_certificate.amount LIKE ? OR 
				commencement_certificate.trees_to_be_planted LIKE ? OR 
				commencement_certificate.names_of_trees_be_planted LIKE ? OR 
				commencement_certificate.fy LIKE ? OR 
				commencement_certificate.count LIKE ? OR 
				commencement_certificate.current_tiimestamp LIKE ? OR 
				commencement_certificate.updated_timestamp LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "commencement_certificate/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("commencement_certificate.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['date'] = human_date($record['date']);
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Commencement Certificate";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("commencement_certificate/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"application_type", 
			"applicant_full_name", 
			"applicant_address", 
			"property_owner_name", 
			"ward", 
			"address_of_plot", 
			"google_link", 
			"no_of_trees_if_available", 
			"trees_added", 
			"architech_name", 
			"architect_address", 
			"architect_pin_code", 
			"architect_mobile_number", 
			"builder_name", 
			"builder_address", 
			"builder_pin_code", 
			"builder_mobile_number", 
			"plot_area_in_sq_mtr", 
			"phisical_colored_map_with_tree_located", 
			"architech_application", 
			"google_map_with_polygone", 
			"document_7_12_", 
			"flag", 
			"status", 
			"user_id", 
			"inspection_report_by_cg", 
			"date", 
			"type_of_residence", 
			"tippni_upload", 
			"tippni_data", 
			"demand", 
			"cc_affidavit", 
			"permission_upload", 
			"cc_application_id", 
			"paid_1", 
			"paid_2", 
			"amount", 
			"trees_to_be_planted", 
			"names_of_trees_be_planted", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no", 
			"latitude", 
			"longitude", 
			"current_tiimestamp", 
			"updated_timestamp", 
			"mouje", 
			"survey_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("commencement_certificate.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Commencement Certificate";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("commencement_certificate/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("type_of_residence","applicant_full_name","mobile_no","applicant_address","property_owner_name","ward","address_of_plot","latitude","longitude","google_link","architech_name","architect_address","architect_pin_code","architect_mobile_number","builder_name","builder_address","builder_pin_code","builder_mobile_number","plot_area_in_sq_mtr","survey_no","mouje","no_of_trees_if_available","phisical_colored_map_with_tree_located","google_map_with_polygone","document_7_12_","cc_affidavit","status","user_id","demand","paid_1");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'type_of_residence' => 'required',
				'applicant_full_name' => 'required',
				'mobile_no' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'applicant_address' => 'required',
				'property_owner_name' => 'required',
				'ward' => 'required',
				'address_of_plot' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'google_link' => 'required',
				'architech_name' => 'required',
				'architect_address' => 'required',
				'architect_pin_code' => 'required',
				'architect_mobile_number' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'builder_name' => 'required',
				'builder_address' => 'required',
				'builder_pin_code' => 'required',
				'builder_mobile_number' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'plot_area_in_sq_mtr' => 'required|numeric',
				'survey_no' => 'required',
				'mouje' => 'required',
				'no_of_trees_if_available' => 'required|numeric',
				'phisical_colored_map_with_tree_located' => 'required',
				'google_map_with_polygone' => 'required',
				'document_7_12_' => 'required', 
			);
			$this->sanitize_array = array(
				'type_of_residence' => 'sanitize_string',
				'applicant_full_name' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'applicant_address' => 'sanitize_string',
				'property_owner_name' => 'sanitize_string',
				'ward' => 'sanitize_string',
				'address_of_plot' => 'sanitize_string',
				'latitude' => 'sanitize_string',
				'longitude' => 'sanitize_string',
				'google_link' => 'sanitize_string',
				'architech_name' => 'sanitize_string',
				'architect_address' => 'sanitize_string',
				'architect_pin_code' => 'sanitize_string',
				'architect_mobile_number' => 'sanitize_string',
				'builder_name' => 'sanitize_string',
				'builder_address' => 'sanitize_string',
				'builder_pin_code' => 'sanitize_string',
				'builder_mobile_number' => 'sanitize_string',
				'plot_area_in_sq_mtr' => 'sanitize_string',
				'survey_no' => 'sanitize_string',
				'mouje' => 'sanitize_string',
				'no_of_trees_if_available' => 'sanitize_string',
				'phisical_colored_map_with_tree_located' => 'sanitize_string',
				'google_map_with_polygone' => 'sanitize_string',
				'document_7_12_' => 'sanitize_string',
				'cc_affidavit' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status'] = "7";
$modeldata['user_id'] = USER_ID;
$modeldata['demand'] = "NO";
$modeldata['paid_1'] = "1";
			if($this->validated()){$modeldata['applicant_full_name']=strtoupper($modeldata['applicant_full_name']);
$modeldata['architech_name']=strtoupper($modeldata['architech_name']);
 
		# Statement to execute before adding record
$modeldata['status'] = 7;
if(date("m")+0>=4){
$fy = date("y")."-".(date("y")+1);
}else{
    $fy = (date("y")-1)."-".(date("y"));
}
$db->where("fy",$fy);
$c = round($db->getOne($tablename,"MAX(count) AS intz")['intz']);
$modeldata['fy']    = $fy;
$modeldata['count'] = $c+1;
    $modeldata['application_no'] = "KDMC/TCC/".$fy."/".$modeldata['count'];
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$today = date('Y-m-d');
$currentDate = strtotime($today);
// Get current year
$year = date('Y');
// Check if today's date is before April (i.e., Jan/Feb/Mar)
if (date('m') < 4) {
    $startYear = $year - 1;
    $endYear = substr($year, -2); // last 2 digits of current year
} else {
    $startYear = $year;
    $endYear = substr($year + 1, -2); // last 2 digits of next year
}
$financialYear = $startYear . '-' . $endYear;
$id             = $rec_id; // use the inserted record ID
$generatedValue = "KDMC/CC/{$financialYear}/{$id}";
// Update the record
$table_data = array(
    "cc_application_id" => $generatedValue,
);
$db->where("id", $rec_id);
$bool = $db->update("commencement_certificate", $table_data);


  file_get_contents("https://singlewindowsystemkdmc.in/api/progress/$tablename/".USER_NAME."/pending/".urlencode($_SESSION['appl_type']));
$db->insert("application_mapping",["db_name"=>$tablename,"rec_id"=>$rec_id,"appl_type"=>$_SESSION['appl_type']]);

		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("commencement_certificate");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Commencement Certificate";
		$this->render_view("commencement_certificate/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","type_of_residence","applicant_full_name","mobile_no","applicant_address","property_owner_name","ward","address_of_plot","latitude","longitude","google_link","architech_name","architect_address","architect_pin_code","architect_mobile_number","builder_name","builder_address","builder_pin_code","builder_mobile_number","plot_area_in_sq_mtr","survey_no","mouje","no_of_trees_if_available","phisical_colored_map_with_tree_located","google_map_with_polygone","document_7_12_","cc_affidavit","status","user_id","demand","paid_1");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'type_of_residence' => 'required',
				'applicant_full_name' => 'required',
				'mobile_no' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'applicant_address' => 'required',
				'property_owner_name' => 'required',
				'ward' => 'required',
				'address_of_plot' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'google_link' => 'required',
				'architech_name' => 'required',
				'architect_address' => 'required',
				'architect_pin_code' => 'required',
				'architect_mobile_number' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'builder_name' => 'required',
				'builder_address' => 'required',
				'builder_pin_code' => 'required',
				'builder_mobile_number' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'plot_area_in_sq_mtr' => 'required|numeric',
				'survey_no' => 'required',
				'mouje' => 'required',
				'no_of_trees_if_available' => 'required|numeric',
				'phisical_colored_map_with_tree_located' => 'required',
				'google_map_with_polygone' => 'required',
				'document_7_12_' => 'required',
				'cc_affidavit' => 'required',
			);
			$this->sanitize_array = array(
				'type_of_residence' => 'sanitize_string',
				'applicant_full_name' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'applicant_address' => 'sanitize_string',
				'property_owner_name' => 'sanitize_string',
				'ward' => 'sanitize_string',
				'address_of_plot' => 'sanitize_string',
				'latitude' => 'sanitize_string',
				'longitude' => 'sanitize_string',
				'google_link' => 'sanitize_string',
				'architech_name' => 'sanitize_string',
				'architect_address' => 'sanitize_string',
				'architect_pin_code' => 'sanitize_string',
				'architect_mobile_number' => 'sanitize_string',
				'builder_name' => 'sanitize_string',
				'builder_address' => 'sanitize_string',
				'builder_pin_code' => 'sanitize_string',
				'builder_mobile_number' => 'sanitize_string',
				'plot_area_in_sq_mtr' => 'sanitize_string',
				'survey_no' => 'sanitize_string',
				'mouje' => 'sanitize_string',
				'no_of_trees_if_available' => 'sanitize_string',
				'phisical_colored_map_with_tree_located' => 'sanitize_string',
				'google_map_with_polygone' => 'sanitize_string',
				'document_7_12_' => 'sanitize_string',
				'cc_affidavit' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status'] = "7";
$modeldata['user_id'] = USER_ID;
$modeldata['demand'] = "NO";
$modeldata['paid_1'] = "1";
			if($this->validated()){
				$db->where("commencement_certificate.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("commencement_certificate");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("commencement_certificate");
					}
				}
			}
		}
		$db->where("commencement_certificate.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Commencement Certificate";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("commencement_certificate/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("commencement_certificate.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("commencement_certificate");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function inspection_report_upload($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","inspection_report_by_cg");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'inspection_report_by_cg' => 'required',
			);
			$this->sanitize_array = array(
				'inspection_report_by_cg' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("commencement_certificate.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("commencement_certificate");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("commencement_certificate");
					}
				}
			}
		}
		$db->where("commencement_certificate.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Commencement Certificate";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("commencement_certificate/inspection_report_upload.php", $data);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function tippni_upload($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","tippni_upload");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tippni_upload' => 'required',
			);
			$this->sanitize_array = array(
				'tippni_upload' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("commencement_certificate.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("commencement_certificate");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("commencement_certificate");
					}
				}
			}
		}
		$db->where("commencement_certificate.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Commencement Certificate";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("commencement_certificate/tippni_upload.php", $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function tippni($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"application_type", 
			"applicant_full_name", 
			"applicant_address", 
			"property_owner_name", 
			"ward", 
			"address_of_plot", 
			"google_link", 
			"no_of_trees_if_available", 
			"trees_added", 
			"architech_name", 
			"architect_address", 
			"architect_pin_code", 
			"architect_mobile_number", 
			"builder_name", 
			"builder_address", 
			"builder_pin_code", 
			"builder_mobile_number", 
			"plot_area_in_sq_mtr", 
			"phisical_colored_map_with_tree_located", 
			"architech_application", 
			"google_map_with_polygone", 
			"document_7_12_", 
			"flag", 
			"status", 
			"user_id", 
			"inspection_report_by_cg", 
			"date", 
			"type_of_residence", 
			"tippni_upload", 
			"tippni_data", 
			"demand", 
			"cc_affidavit", 
			"permission_upload", 
			"cc_application_id", 
			"paid_1", 
			"paid_2", 
			"amount", 
			"trees_to_be_planted", 
			"names_of_trees_be_planted", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no", 
			"latitude", 
			"longitude", 
			"current_tiimestamp", 
			"updated_timestamp", 
			"mouje", 
			"survey_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("commencement_certificate.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Commencement Certificate";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("commencement_certificate/tippni.php", $record);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function permission($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"application_type", 
			"applicant_full_name", 
			"applicant_address", 
			"property_owner_name", 
			"ward", 
			"address_of_plot", 
			"outward_no", 
			"google_link", 
			"no_of_trees_if_available", 
			"trees_added", 
			"architech_name", 
			"architect_address", 
			"architect_pin_code", 
			"architect_mobile_number", 
			"builder_name", 
			"builder_address", 
			"builder_pin_code", 
			"builder_mobile_number", 
			"plot_area_in_sq_mtr", 
			"phisical_colored_map_with_tree_located", 
			"architech_application", 
			"google_map_with_polygone", 
			"document_7_12_", 
			"flag", 
			"status", 
			"user_id", 
			"inspection_report_by_cg", 
			"date", 
			"type_of_residence", 
			"tippni_upload", 
			"tippni_data", 
			"demand", 
			"cc_affidavit", 
			"permission_upload", 
			"cc_application_id", 
			"paid_1", 
			"paid_2", 
			"amount", 
			"trees_to_be_planted", 
			"names_of_trees_be_planted", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no", 
			"latitude", 
			"longitude", 
			"current_tiimestamp", 
			"updated_timestamp", 
			"mouje", 
			"survey_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("commencement_certificate.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['date'] = human_date($record['date']);
			$page_title = $this->view->page_title = "View  Commencement Certificate";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("commencement_certificate/permission.php", $record);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
     
     
	function permission_upload($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","permission_upload");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'permission_upload' => 'required',
			);
			$this->sanitize_array = array(
				'permission_upload' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
			    
			    $db->where("id",$rec_id);
        $ui=$db->getOne($tablename,"*");
        $db->where("id",$ui['user_id']);
        $ui=$db->getOne("user_info","*"); 
        
        
        
                                  $names['Commencement Certificate']='CC';
                    $names['Revised Commencement Certificate']='RCC';
                    $names['Part Occupancy Certificate']='POC';
                    $names['Occupancy Certificate']='OC';
        $db->where("rec_id",$rec_id);
$db->where("db_name",$tablename);

$typeapi=$db->getOne("application_mapping","*")['appl_type'];
$passtype=$names[$typeapi];

file_get_contents("https://singlewindowsystemkdmc.in/api/progress/".$tablename."/".$ui['username']."/COMPLETE/".urlencode($typeapi));



function sendNocToKDMC($appl_no, $noc_type, $pdf_file_path,$T) {
     $url = "http://180.149.247.55/API/KDMC/get_noc_certificate.php";
     $url = "https://mahavastu.maharashtra.gov.in/API/KDMC/get_noc_certificate.php";

    // Check if file exists
 

 
file_put_contents("/home1/singlewindowsyst/public_html/uploads/nocs/$noc_type"."_".$appl_no.".pdf",file_get_contents($pdf_file_path));
    // Read and encode file to base64
     $base64_file = base64_encode(file_get_contents($pdf_file_path));

    // Prepare POST data
    $postData = [
        'appl_no'  => $appl_no,
        'noc_type' => $noc_type,
        'type_appl' => $T,
        'noc_file' => $base64_file,
        'noc_req' => "AP",
    ];

    // Initialize CURL
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set Basic Auth headers
    curl_setopt($ch, CURLOPT_USERPWD, "bpms:cXmnZK65rf*&DaaD");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    // Enable form-data POST
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute request
     $response = curl_exec($ch);

    if (curl_errno($ch)) {
       echo $error_msg = curl_error($ch);
        curl_close($ch);
        return ['status' => 'error', 'message' => $error_msg];
    }

    curl_close($ch);
    
    $x=file_get_contents("/home1/singlewindowsyst/public_html/logs/".$appl_no.".txt");
    $x.="
TYPE = $noc_type
    
$response";
file_put_contents("/home1/singlewindowsyst/public_html/logs/".$appl_no.".txt",$x);
    // Decode JSON response
    return json_decode($response, true);
} 



    $NAME="TPNOC"; 
    if($passtype!=""){
        
sendNocToKDMC($ui['username'],$NAME,$modeldata['permission_upload'],$passtype);
    }
    
    
     


				$db->where("commencement_certificate.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("commencement_certificate");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("commencement_certificate");
					}
				}
			}
		}
		$db->where("commencement_certificate.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Commencement Certificate";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("commencement_certificate/permission_upload.php", $data);
	}
	
	
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function demand_button($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","demand","amount");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'demand' => 'required',
				'amount' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'demand' => 'sanitize_string',
				'amount' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("commencement_certificate.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("commencement_certificate");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("commencement_certificate");
					}
				}
			}
		}
		$db->where("commencement_certificate.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Commencement Certificate";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("commencement_certificate/demand_button.php", $data);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function tippni_data($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","trees_to_be_planted","names_of_trees_be_planted");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'trees_to_be_planted' => 'required|numeric',
				'names_of_trees_be_planted' => 'required',
			);
			$this->sanitize_array = array(
				'trees_to_be_planted' => 'sanitize_string',
				'names_of_trees_be_planted' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("commencement_certificate.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("commencement_certificate");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("commencement_certificate");
					}
				}
			}
		}
		$db->where("commencement_certificate.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Commencement Certificate";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("commencement_certificate/tippni_data.php", $data);
	}
	function revert($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","no_of_trees_if_available","phisical_colored_map_with_tree_located","google_map_with_polygone","document_7_12_","cc_affidavit");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_of_trees_if_available' => 'required|numeric',
				'phisical_colored_map_with_tree_located' => 'required',
				'google_map_with_polygone' => 'required',
				'document_7_12_' => 'required',
				'cc_affidavit' => 'required',
			);
			$this->sanitize_array = array(
				'no_of_trees_if_available' => 'sanitize_string',
				'phisical_colored_map_with_tree_located' => 'sanitize_string',
				'google_map_with_polygone' => 'sanitize_string',
				'document_7_12_' => 'sanitize_string',
				'cc_affidavit' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("commencement_certificate.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
		# Statement to execute after adding record
$table_data = array(
    "status" => 7,
);
$db->where("id", $rec_id);
$bool = $db->update("commencement_certificate", $table_data);
		# End of after update statement
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("commencement_certificate");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("commencement_certificate");
					}
				}
			}
		}
		$db->where("commencement_certificate.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Commencement Certificate";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("commencement_certificate/revert.php", $data);
	}
	
}
