<?php 
/**
 * Objections Page Controller
 * @category  Controller
 */
class ObjectionsController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "objections";
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
			"rec_id", 
			"name_of_applicant", 
			"mobile", 
			"email", 
			"date_of_ad", 
			"name_of_news_paper", 
			"description", 
			"upload_attachment", 
			"flag_payment", 
			"meeting_date", 
			"meeting_time", 
			"resolution", 
			"upload", 
			"remark", 
			"timestamp", 
			"user_id");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
if(isset($_GET['rec_id'])){
    $db->where("rec_id",$_GET['rec_id']);
    $db->where("flag_payment","0",">");
    }else{
    if(USER_ROLE==2){
    $db->where("user_id",USER_ID);
    }else{
    $db->where("flag_payment","0",">");
}
}
if(isset($_GET['pending'])){
$db->where("resolution","");
}
if(isset($_GET['resolved'])){
$db->where("resolution","","!=");
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				objections.id LIKE ? OR 
				objections.rec_id LIKE ? OR 
				objections.name_of_applicant LIKE ? OR 
				objections.mobile LIKE ? OR 
				objections.email LIKE ? OR 
				objections.date_of_ad LIKE ? OR 
				objections.name_of_news_paper LIKE ? OR 
				objections.description LIKE ? OR 
				objections.upload_attachment LIKE ? OR 
				objections.flag_payment LIKE ? OR 
				objections.meeting_date LIKE ? OR 
				objections.meeting_time LIKE ? OR 
				objections.resolution LIKE ? OR 
				objections.upload LIKE ? OR 
				objections.remark LIKE ? OR 
				objections.timestamp LIKE ? OR 
				objections.user_id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "objections/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("objections.id", ORDER_TYPE);
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
				$record['date_of_ad'] = human_date($record['date_of_ad']);
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
		$page_title = $this->view->page_title = "Objections";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("objections/list.php", $data); //render the full page
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
			"rec_id", 
			"name_of_applicant", 
			"mobile", 
			"email", 
			"date_of_ad", 
			"name_of_news_paper", 
			"description", 
			"upload_attachment", 
			"flag_payment", 
			"meeting_date", 
			"meeting_time", 
			"resolution", 
			"upload", 
			"remark", 
			"timestamp", 
			"user_id");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("objections.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['date_of_ad'] = human_date($record['date_of_ad']);
$record['timestamp'] = human_datetime($record['timestamp']);
			$page_title = $this->view->page_title = "View  Objections";
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
		return $this->render_view("objections/view.php", $record);
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
			$fields = $this->fields = array("rec_id","name_of_applicant","mobile","email","date_of_ad","name_of_news_paper","description","upload_attachment","user_id");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'name_of_applicant' => 'required',
				'mobile' => 'required|numeric',
				'email' => 'required|valid_email',
				'date_of_ad' => 'required',
				'name_of_news_paper' => 'required',
				'description' => 'required',
				'upload_attachment' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'name_of_applicant' => 'sanitize_string',
				'mobile' => 'sanitize_string',
				'email' => 'sanitize_string',
				'date_of_ad' => 'sanitize_string',
				'name_of_news_paper' => 'sanitize_string',
				'description' => 'sanitize_string',
				'upload_attachment' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['user_id'] = USER_ID;
			if($this->validated()){
		# Statement to execute before adding record
		$modeldata['rec_id']       = str_replace("SAT/TCP/2425/","",$modeldata['rec_id']);
$modeldata['flag_payment'] = 1;
$db->where("id",$modeldata['rec_id']);
$db->where("application_type!='PARTIAL TREE CUT'");
$rec = $db->getOne("application_form","*");
if($rec['user_id']==USER_ID){
    $this->set_flash_msg("You cannot apply for objection on your own application", "danger");
    return  $this->redirect("objections");
}
        $db->where("id",$modeldata['rec_id']);
        $db->update("application_form",["flag_objection"=>1]);
if($rec['flag_advertisement']>0 && $rec['status']==2){
}else{
    $this->set_flash_msg("No such application exists or application is not open for objections", "success");
    return  $this->redirect("objections");
}
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("objections");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Objections";
		$this->render_view("objections/add.php");
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
		$fields = $this->fields = array("id","meeting_date","meeting_time");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'meeting_date' => 'required',
				'meeting_time' => 'required',
			);
			$this->sanitize_array = array(
				'meeting_date' => 'sanitize_string',
				'meeting_time' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("objections.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("objections");
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
						return	$this->redirect("objections");
					}
				}
			}
		}
		$db->where("objections.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Objections";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("objections/edit.php", $data);
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
		$db->where("objections.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("objections");
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
		$fields = $this->fields = array("id","resolution","upload","remark");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'resolution' => 'required',
				'remark' => 'required',
			);
			$this->sanitize_array = array(
				'resolution' => 'sanitize_string',
				'upload' => 'sanitize_string',
				'remark' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute after adding record
		$db->where("id",$rec_id);
$rec = $db->getOne("objections","*");
if($modeldata['resolution']=="CORRECT OBJECTION SEND TO HOD"){
    $db->insert("objections_hod_approval",[
        "rec_id"=>$rec['rec_id'],
        "objection_id"=>$rec_id
    ]);
    $db->where("id",$rec['rec_id']);
    $db->update("application_form",["status"=>"2.5"]);
}
		# End of before update statement
				$db->where("objections.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("objections");
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
						return	$this->redirect("objections");
					}
				}
			}
		}
		$db->where("objections.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Objections";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("objections/edit2.php", $data);
	}
}
