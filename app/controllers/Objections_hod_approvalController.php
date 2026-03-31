<?php 
/**
 * Objections_hod_approval Page Controller
 * @category  Controller
 */
class Objections_hod_approvalController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "objections_hod_approval";
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
			"objection_id", 
			"decision", 
			"decision_upload", 
			"remark", 
			"status");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(isset($_GET['rec_id'])){
$db->where("rec_id",$_GET['rec_id']);
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				objections_hod_approval.id LIKE ? OR 
				objections_hod_approval.rec_id LIKE ? OR 
				objections_hod_approval.objection_id LIKE ? OR 
				objections_hod_approval.decision LIKE ? OR 
				objections_hod_approval.decision_upload LIKE ? OR 
				objections_hod_approval.remark LIKE ? OR 
				objections_hod_approval.status LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "objections_hod_approval/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("objections_hod_approval.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Objections Hod Approval";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("objections_hod_approval/list.php", $data); //render the full page
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
			"objection_id", 
			"decision", 
			"decision_upload", 
			"remark", 
			"status");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("objections_hod_approval.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Objections Hod Approval";
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
		return $this->render_view("objections_hod_approval/view.php", $record);
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
			$fields = $this->fields = array("rec_id","objection_id","decision","decision_upload","remark","status");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'objection_id' => 'required',
				'decision' => 'required',
				'decision_upload' => 'required',
				'remark' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'objection_id' => 'sanitize_string',
				'decision' => 'sanitize_string',
				'decision_upload' => 'sanitize_string',
				'remark' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status'] = "1";
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("objections_hod_approval");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Objections Hod Approval";
		$this->render_view("objections_hod_approval/add.php");
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
		$fields = $this->fields = array("id","rec_id","objection_id","decision","decision_upload","remark","status");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'objection_id' => 'required',
				'decision' => 'required',
				'decision_upload' => 'required',
				'remark' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'objection_id' => 'sanitize_string',
				'decision' => 'sanitize_string',
				'decision_upload' => 'sanitize_string',
				'remark' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['status'] = "1";
			if($this->validated()){
		# Statement to execute after adding record
if($modeldata['decision']=="CORRECT OBJECTION REJECT APPLICATION"){
//make final decision
$re=$db->insert("accept_reject",[
"db_name"=>"application_form",
"rec_id"=>$modeldata['rec_id'],
"status"=>"REJECT", 
"remark"=>$modeldata['remark'] 
]);
$db->where("id",$modeldata['rec_id']);
$db->update("application_form",["status"=>-2 ]);
}elseif($modeldata['decision']=="WRONG OBJECTION KEEP TO HOD"){ 
$db->where("id",$modeldata['rec_id']);
$db->update("application_form",["status"=>3]);
}else{
    $db->where("id",$modeldata['rec_id']);
    $db->update("application_form",["status"=>2]);
}
		# End of before update statement
				$db->where("objections_hod_approval.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("objections_hod_approval");
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
						return	$this->redirect("objections_hod_approval");
					}
				}
			}
		}
		$db->where("objections_hod_approval.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Objections Hod Approval";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("objections_hod_approval/edit.php", $data);
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
		$db->where("objections_hod_approval.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("objections_hod_approval");
	}
}
