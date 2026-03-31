<?php 
/**
 * Application_form Page Controller
 * @category  Controller
 */
class Application_formController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "application_form";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"application_type", 
			"status", 
			"id+0 AS tree_photo", 
			"amount", 
			"no_of_trees", 
			"flag_payment", 
			"applicant_name", 
			"mobile_no", 
			"applicant_address", 
			"property_owner_name", 
			"peth", 
			"city_survey_number", 
			"cut_purpose", 
			"location_of_tree", 
			"extract_7_12", 
			"noc_of_property", 
			"user_id", 
			"flag_inspection", 
			"flag_advertisement", 
			"flag_order", 
			"flag_objection", 
			"flag_final_decision", 
			"flag_reject", 
			"flag_accept", 
			"timestamp", 
			"approval_date", 
			"flag_ins_photo", 
			"upload_tipnni", 
			"upload_permission", 
			"demand_id", 
			"fy", 
			"count", 
			"application_no");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(USER_ROLE==2){
    $db->where("user_id",USER_ID);
}
if(isset($_GET['status'])){
$st = $_GET['status'];
if($st==0){
    $db->where("status>-1 and status<3");
    }else{
        $db->where("status",$st);
    }
}
if(USER_ROLE==4){
    $db->where("status","0.5",">=");
}
if(USER_ROLE==7){
    $db->where("(status>=0.5 or status=-1)");
    $db->where("peth",get_active_user("ward"));
}
if(USER_ROLE==3){
    $db->where("status","2",">=");
}
if(isset($_GET['rec_id'])){
$db->where("id",$_GET['rec_id']);
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				application_form.id LIKE ? OR 
				application_form.application_type LIKE ? OR 
				application_form.status LIKE ? OR 
				id+0 LIKE ? OR 
				application_form.amount LIKE ? OR 
				application_form.advertisement_fees LIKE ? OR 
				application_form.no_of_trees LIKE ? OR 
				application_form.flag_payment LIKE ? OR 
				application_form.applicant_name LIKE ? OR 
				application_form.mobile_no LIKE ? OR 
				application_form.applicant_address LIKE ? OR 
				application_form.property_owner_name LIKE ? OR 
				application_form.peth LIKE ? OR 
				application_form.city_survey_number LIKE ? OR 
				application_form.cut_purpose LIKE ? OR 
				application_form.location_of_tree LIKE ? OR 
				application_form.reason_to_cut_tree LIKE ? OR 
				application_form.extract_7_12 LIKE ? OR 
				application_form.noc_of_property LIKE ? OR 
				application_form.tree_color_photo LIKE ? OR 
				application_form.user_id LIKE ? OR 
				application_form.details LIKE ? OR 
				application_form.name_of_person_present LIKE ? OR 
				application_form.photo_upload LIKE ? OR 
				application_form.subject LIKE ? OR 
				application_form.upload LIKE ? OR 
				application_form.flag_inspection LIKE ? OR 
				application_form.flag_advertisement LIKE ? OR 
				application_form.flag_order LIKE ? OR 
				application_form.flag_objection LIKE ? OR 
				application_form.flag_final_decision LIKE ? OR 
				application_form.flag_reject LIKE ? OR 
				application_form.flag_accept LIKE ? OR 
				application_form.timestamp LIKE ? OR 
				application_form.approval_date LIKE ? OR 
				application_form.flag_ins_photo LIKE ? OR 
				application_form.upload_tipnni LIKE ? OR 
				application_form.upload_permission LIKE ? OR 
				application_form.demand_id LIKE ? OR 
				application_form.fy LIKE ? OR 
				application_form.count LIKE ? OR 
				application_form.application_no LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "application_form/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("application_form.id", ORDER_TYPE);
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
				$record['timestamp'] = human_datetime($record['timestamp']);
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
		$page_title = $this->view->page_title = "Application Form";
		$this->render_view("application_form/list.php", $data); //render the full page
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
			"applicant_name", 
			"location_of_tree", 
			"no_of_trees", 
			"cut_purpose", 
			"amount", 
			"extract_7_12", 
			"noc_of_property", 
			"tree_dimensions", 
			"tree_color_photo", 
			"reason_to_cut_tree", 
			"timestamp", 
			"details", 
			"name_of_person_present", 
			"photo_upload", 
			"application_type", 
			"subject", 
			"upload", 
			"city_survey_number", 
			"peth", 
			"advertisement_fees", 
			"flag_inspection", 
			"flag_payment", 
			"flag_order", 
			"flag_advertisement", 
			"status", 
			"flag_objection", 
			"flag_final_decision", 
			"flag_reject", 
			"flag_accept", 
			"property_owner_name", 
			"approval_date", 
			"flag_ins_photo", 
			"applicant_address", 
			"upload_tipnni", 
			"upload_permission", 
			"demand_id", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("application_form.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Application Form";
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
		return $this->render_view("application_form/view.php", $record);
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
			$fields = $this->fields = array("application_type","applicant_name","mobile_no","applicant_address","property_owner_name","peth","city_survey_number","location_of_tree","no_of_trees","cut_purpose","reason_to_cut_tree","extract_7_12","noc_of_property","user_id");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'application_type' => 'required',
				'applicant_name' => 'required',
				'mobile_no' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'applicant_address' => 'required',
				'property_owner_name' => 'required',
				'peth' => 'required',
				'city_survey_number' => 'required',
				'location_of_tree' => 'required',
				'no_of_trees' => 'required|numeric',
				'extract_7_12' => 'required',
				'noc_of_property' => 'required',
			);
			$this->sanitize_array = array(
				'application_type' => 'sanitize_string',
				'applicant_name' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'applicant_address' => 'sanitize_string',
				'property_owner_name' => 'sanitize_string',
				'peth' => 'sanitize_string',
				'city_survey_number' => 'sanitize_string',
				'location_of_tree' => 'sanitize_string',
				'no_of_trees' => 'sanitize_string',
				'cut_purpose' => 'sanitize_string',
				'reason_to_cut_tree' => 'sanitize_string',
				'extract_7_12' => 'sanitize_string',
				'noc_of_property' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['user_id'] = USER_ID;
			if($this->validated()){
		# Statement to execute before adding record
		$rate = 0; 
if($modeldata['application_type']=="PARTIAL TREE CUT"){
    $mak                             = $modeldata['no_of_trees'] ;
    $rate                            = $mak*200;
    $modeldata['advertisement_fees'] = 0;//partial no fees
}else{
    $mak                             = $modeldata['no_of_trees'] ;
    $rate                            = $mak*200;
    $modeldata['advertisement_fees'] = 0;//partial no fees
} 
$modeldata['amount'] = $rate;
$modeldata['status'] = -1;
if(date("m")+0>=4){
$fy = date("y")."-".(date("y")+1);
}else{
    $fy = (date("y")-1)."-".(date("y"));
}
$db->where("application_type",$modeldata['application_type']);
$db->where("fy",$fy);
$c = round($db->getOne($tablename,"MAX(count) AS intx")['intx']);
$modeldata['fy']    = $fy;
$modeldata['count'] = $c+1;
if($modeldata['application_type']=="FULL TREE CUT"){
    $modeldata['application_no'] = "VVMC/TCP/".$fy."/".$modeldata['count'];
}else{
    $modeldata['application_no'] = "VVMC/TTP/".$fy."/".$modeldata['count'];
}
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$ID = 0;
for($i=0;$i<$modeldata['no_of_trees'];$i++){
    $x = $db->insert("photo_of_tree",["rec_id"=>$rec_id]);
    if($ID==0){
        $ID = $x;
    }
    //if($modeldata['application_type']=='PARTIAL TREE CUT'){
    $db->insert("photo_of_inspection",["rec_id"=>$rec_id]);
//}
}
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("photo_of_tree/edit/$ID?rec_id=$rec_id");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Application Form";
		$this->render_view("application_form/add.php");
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
		$fields = $this->fields = array("id","application_type","applicant_name","mobile_no","applicant_address","property_owner_name","peth","city_survey_number","location_of_tree","no_of_trees","cut_purpose","reason_to_cut_tree","extract_7_12","noc_of_property","user_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'application_type' => 'required',
				'applicant_name' => 'required',
				'mobile_no' => 'required|numeric|max_numeric,9999999999|min_numeric,1000000000',
				'applicant_address' => 'required',
				'property_owner_name' => 'required',
				'peth' => 'required',
				'city_survey_number' => 'required',
				'location_of_tree' => 'required',
				'no_of_trees' => 'required|numeric',
				'extract_7_12' => 'required',
				'noc_of_property' => 'required',
			);
			$this->sanitize_array = array(
				'application_type' => 'sanitize_string',
				'applicant_name' => 'sanitize_string',
				'mobile_no' => 'sanitize_string',
				'applicant_address' => 'sanitize_string',
				'property_owner_name' => 'sanitize_string',
				'peth' => 'sanitize_string',
				'city_survey_number' => 'sanitize_string',
				'location_of_tree' => 'sanitize_string',
				'no_of_trees' => 'sanitize_string',
				'cut_purpose' => 'sanitize_string',
				'reason_to_cut_tree' => 'sanitize_string',
				'extract_7_12' => 'sanitize_string',
				'noc_of_property' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['user_id'] = USER_ID;
			if($this->validated()){
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/edit.php", $data);
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
		$db->where("application_form.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("application_form");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function licence($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/licence.php", $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function cert_view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"applicant_name", 
			"location_of_tree", 
			"no_of_trees", 
			"cut_purpose", 
			"amount", 
			"extract_7_12", 
			"noc_of_property", 
			"tree_dimensions", 
			"tree_color_photo", 
			"reason_to_cut_tree", 
			"timestamp", 
			"user_id", 
			"details", 
			"name_of_person_present", 
			"photo_upload", 
			"application_type", 
			"subject", 
			"upload", 
			"city_survey_number", 
			"peth", 
			"advertisement_fees", 
			"flag_inspection", 
			"flag_payment", 
			"flag_order", 
			"flag_advertisement", 
			"status", 
			"flag_objection", 
			"flag_final_decision", 
			"flag_reject", 
			"flag_accept", 
			"property_owner_name", 
			"approval_date", 
			"flag_ins_photo", 
			"applicant_address", 
			"upload_tipnni", 
			"upload_permission", 
			"demand_id", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("application_form.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Application Form";
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
		return $this->render_view("application_form/cert_view.php", $record);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function refund($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/refund.php", $data);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function postmortem($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","details","name_of_person_present","photo_upload");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'details' => 'required',
				'name_of_person_present' => 'required',
				'photo_upload' => 'required',
			);
			$this->sanitize_array = array(
				'details' => 'sanitize_string',
				'name_of_person_present' => 'sanitize_string',
				'photo_upload' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/postmortem.php", $data);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function objection_advertise($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","subject","upload");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'subject' => 'required',
				'upload' => 'required',
			);
			$this->sanitize_array = array(
				'subject' => 'sanitize_string',
				'upload' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/objection_advertise.php", $data);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit2($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","status");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'status' => 'required',
			);
			$this->sanitize_array = array(
				'status' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/edit2.php", $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view_tipnni($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"applicant_name", 
			"location_of_tree", 
			"no_of_trees", 
			"cut_purpose", 
			"amount", 
			"extract_7_12", 
			"noc_of_property", 
			"tree_dimensions", 
			"tree_color_photo", 
			"reason_to_cut_tree", 
			"timestamp", 
			"user_id", 
			"details", 
			"name_of_person_present", 
			"photo_upload", 
			"application_type", 
			"subject", 
			"upload", 
			"city_survey_number", 
			"peth", 
			"advertisement_fees", 
			"flag_inspection", 
			"flag_payment", 
			"flag_order", 
			"flag_advertisement", 
			"status", 
			"flag_objection", 
			"flag_final_decision", 
			"flag_reject", 
			"flag_accept", 
			"property_owner_name", 
			"approval_date", 
			"flag_ins_photo", 
			"applicant_address", 
			"upload_tipnni", 
			"upload_permission", 
			"demand_id", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("application_form.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Application Form";
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
		return $this->render_view("application_form/view_tipnni.php", $record);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view_permission($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"applicant_name", 
			"location_of_tree", 
			"no_of_trees", 
			"cut_purpose", 
			"amount", 
			"extract_7_12", 
			"noc_of_property", 
			"tree_dimensions", 
			"tree_color_photo", 
			"reason_to_cut_tree", 
			"timestamp", 
			"user_id", 
			"details", 
			"name_of_person_present", 
			"photo_upload", 
			"application_type", 
			"subject", 
			"upload", 
			"city_survey_number", 
			"peth", 
			"advertisement_fees", 
			"flag_inspection", 
			"flag_payment", 
			"flag_order", 
			"flag_advertisement", 
			"status", 
			"flag_objection", 
			"flag_final_decision", 
			"flag_reject", 
			"flag_accept", 
			"property_owner_name", 
			"approval_date", 
			"flag_ins_photo", 
			"applicant_address", 
			"upload_tipnni", 
			"upload_permission", 
			"demand_id", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("application_form.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Application Form";
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
		return $this->render_view("application_form/view_permission.php", $record);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit_tipnni($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","upload_tipnni");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'upload_tipnni' => 'required',
			);
			$this->sanitize_array = array(
				'upload_tipnni' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute after adding record
		$db->where("id",$rec_id);
$recdata = $db->getOne("application_form","*");
if($recdata['application_type']=="FULL TREE CUT"){
//$modeldata['status'] = "4.5";
}
		# End of before update statement
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/edit_tipnni.php", $data);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit_permission($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","upload_permission");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'upload_permission' => 'required',
			);
			$this->sanitize_array = array(
				'upload_permission' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute after adding record
		$modeldata['status'] = 5;
		# End of before update statement
				$db->where("application_form.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form");
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
						return	$this->redirect("application_form");
					}
				}
			}
		}
		$db->where("application_form.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form/edit_permission.php", $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view_advt_tipnni($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"applicant_name", 
			"location_of_tree", 
			"no_of_trees", 
			"cut_purpose", 
			"amount", 
			"extract_7_12", 
			"noc_of_property", 
			"tree_dimensions", 
			"tree_color_photo", 
			"reason_to_cut_tree", 
			"timestamp", 
			"user_id", 
			"details", 
			"name_of_person_present", 
			"photo_upload", 
			"application_type", 
			"subject", 
			"upload", 
			"city_survey_number", 
			"peth", 
			"advertisement_fees", 
			"flag_inspection", 
			"flag_payment", 
			"flag_order", 
			"flag_advertisement", 
			"status", 
			"flag_objection", 
			"flag_final_decision", 
			"flag_reject", 
			"flag_accept", 
			"property_owner_name", 
			"approval_date", 
			"flag_ins_photo", 
			"applicant_address", 
			"upload_tipnni", 
			"upload_permission", 
			"demand_id", 
			"fy", 
			"count", 
			"application_no", 
			"mobile_no");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("application_form.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Application Form";
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
		return $this->render_view("application_form/view_advt_tipnni.php", $record);
	}
}
