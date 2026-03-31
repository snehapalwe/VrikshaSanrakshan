<?php 
/**
 * Refund Page Controller
 * @category  Controller
 */
class RefundController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "refund";
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
			"application_id", 
			"id+0 AS tree_photo", 
			"status", 
			"amount", 
			"date_of_permission", 
			"no_of_tree_cut", 
			"no_of_tree_planted", 
			"upload_original_reciept", 
			"complete_address_of_plantation", 
			"bank_name", 
			"account_number", 
			"ifsc_code", 
			"account_holder_name", 
			"timestamp", 
			"user_id", 
			"flag_inspection");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(USER_ROLE==2){
$db->where("user_id",USER_ID);
}
if(USER_ROLE==4){
    $db->where("status","0",">");
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				refund.id LIKE ? OR 
				refund.application_id LIKE ? OR 
				id+0 LIKE ? OR 
				refund.status LIKE ? OR 
				refund.amount LIKE ? OR 
				refund.date_of_permission LIKE ? OR 
				refund.no_of_tree_cut LIKE ? OR 
				refund.no_of_tree_planted LIKE ? OR 
				refund.upload_original_reciept LIKE ? OR 
				refund.complete_address_of_plantation LIKE ? OR 
				refund.bank_name LIKE ? OR 
				refund.account_number LIKE ? OR 
				refund.ifsc_code LIKE ? OR 
				refund.account_holder_name LIKE ? OR 
				refund.timestamp LIKE ? OR 
				refund.user_id LIKE ? OR 
				refund.flag_inspection LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "refund/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("refund.id", ORDER_TYPE);
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
				$record['date_of_permission'] = human_date($record['date_of_permission']);
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
		$page_title = $this->view->page_title = "Refund";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("refund/list.php", $data); //render the full page
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
			"date_of_permission", 
			"application_id", 
			"no_of_tree_cut", 
			"no_of_tree_planted", 
			"upload_original_reciept", 
			"complete_address_of_plantation", 
			"bank_name", 
			"account_number", 
			"ifsc_code", 
			"account_holder_name", 
			"timestamp", 
			"status", 
			"amount", 
			"user_id", 
			"flag_inspection");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("refund.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['date_of_permission'] = human_date($record['date_of_permission']);
			$page_title = $this->view->page_title = "View  Refund";
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
		return $this->render_view("refund/view.php", $record);
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
			$fields = $this->fields = array("date_of_permission","application_id","no_of_tree_cut","no_of_tree_planted","upload_original_reciept","complete_address_of_plantation","bank_name","account_number","ifsc_code","account_holder_name","user_id");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'date_of_permission' => 'required',
				'application_id' => 'required',
				'no_of_tree_cut' => 'required',
				'no_of_tree_planted' => 'required',
				'upload_original_reciept' => 'required',
				'complete_address_of_plantation' => 'required',
				'bank_name' => 'required',
				'account_number' => 'required',
				'ifsc_code' => 'required',
				'account_holder_name' => 'required',
			);
			$this->sanitize_array = array(
				'date_of_permission' => 'sanitize_string',
				'application_id' => 'sanitize_string',
				'no_of_tree_cut' => 'sanitize_string',
				'no_of_tree_planted' => 'sanitize_string',
				'upload_original_reciept' => 'sanitize_string',
				'complete_address_of_plantation' => 'sanitize_string',
				'bank_name' => 'sanitize_string',
				'account_number' => 'sanitize_string',
				'ifsc_code' => 'sanitize_string',
				'account_holder_name' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['user_id'] = USER_ID;
			//Check if Duplicate Record Already Exit In The Database
			$db->where("application_id", $modeldata['application_id']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['application_id']." Already exist!";
			} 
			if($this->validated()){
		# Statement to execute before adding record
		$x                           = $modeldata['application_id'] ;
$modeldata['application_id'] = str_replace("SAT/TCP/2425/","",$modeldata['application_id']);
$db->where("id",$modeldata['application_id']);
$rec = $db->getOne("application_form","*");
$modeldata['amount'] = $rec['amount'];
$modeldata['status'] = 0;
$no = $modeldata['no_of_tree_planted'];
$db->where("application_type","FULL TREE CUT");
$db->where("id",$modeldata['application_id']);
$rec = $db->getOne("application_form","*");
if($rec['flag_accept']!="1"){
        $this->set_flash_msg("Application ID Invalid or not accepted", "danger");
        return  $this->redirect("refund");
}
    $modeldata['application_id'] = $x;
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
for($i=0;$i<$no;$i++){
    $db->insert("report_of_tree",["rec_id"=>$rec_id]);
    $db->insert("photo_of_inspection_refund",["rec_id"=>$rec_id]);
}
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("refund");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Refund";
		$this->render_view("refund/add.php");
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
				$db->where("refund.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("refund");
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
						return	$this->redirect("refund");
					}
				}
			}
		}
		$db->where("refund.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Refund";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("refund/edit.php", $data);
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
		$db->where("refund.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("refund");
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
		# Statement to execute after adding record
		if(USER_ROLE==4 && $data['status']==3){
$modeldata['status'] = 2;
}
		# End of before update statement
				$db->where("refund.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("refund");
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
						return	$this->redirect("refund");
					}
				}
			}
		}
		$db->where("refund.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Refund";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("refund/edit2.php", $data);
	}
}
