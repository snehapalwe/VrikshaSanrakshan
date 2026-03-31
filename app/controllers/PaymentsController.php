<?php 
/**
 * Payments Page Controller
 * @category  Controller
 */
class PaymentsController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "payments";
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
			"recieved_from", 
			"amount", 
			"payment_mode", 
			"timestamp", 
			"text", 
			"purpose", 
			"db_name");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				payments.id LIKE ? OR 
				payments.rec_id LIKE ? OR 
				payments.recieved_from LIKE ? OR 
				payments.amount LIKE ? OR 
				payments.payment_mode LIKE ? OR 
				payments.timestamp LIKE ? OR 
				payments.text LIKE ? OR 
				payments.purpose LIKE ? OR 
				payments.db_name LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "payments/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("payments.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Payments";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("payments/list.php", $data); //render the full page
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
			"recieved_from", 
			"amount", 
			"payment_mode", 
			"timestamp", 
			"text", 
			"rec_id", 
			"purpose", 
			"db_name");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("payments.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Payments";
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
		return $this->render_view("payments/view.php", $record);
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
			$fields = $this->fields = array("rec_id","amount","recieved_from","purpose","db_name");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'amount' => 'required|numeric',
				'recieved_from' => 'required',
				'purpose' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'purpose' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['db_name'] = "application_form";
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$db->where("id",$modeldata['rec_id']);
$db->update("application_form",["demand_id"=>$rec_id]);
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("application_form");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Payments";
		$this->render_view("payments/add.php");
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
		$fields = $this->fields = array("id","rec_id","amount","payment_mode","recieved_from","db_name");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
				'recieved_from' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['db_name'] = "application_form";
			if($this->validated()){
				$db->where("payments.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
		# Statement to execute after adding record
			$db->where("id",$modeldata['rec_id']);
$db->update("application_form",["status"=>4]);
		# End of after update statement
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
		$db->where("payments.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Payments";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("payments/edit.php", $data);
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
		$db->where("payments.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("payments");
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view2($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"recieved_from", 
			"amount", 
			"payment_mode", 
			"timestamp", 
			"text", 
			"rec_id", 
			"purpose", 
			"db_name");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("payments.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Payments";
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
		return $this->render_view("payments/view2.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add2($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("amount","payment_mode","recieved_from","rec_id","db_name");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
				'recieved_from' => 'required',
				'rec_id' => 'required',
			);
			$this->sanitize_array = array(
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'rec_id' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['db_name'] = "application_form";
			if($this->validated()){
		# Statement to execute before adding record
		$rec_id = $modeldata['rec_id'];
                $db->where("id",$rec_id);
                $rec=$db->getOne("application_form","*");
                $data = [["desc"=>"Tree Cut Fees","amt"=>$rec['amount']],["desc"=>"Advertisement Fees","amt"=>$rec['advertisement_fees']]];
                $en   = json_encode($data,true);
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
            $db->where("id",$rec['id']);
            $db->update("application_form",["flag_payment"=>$rec_id,"status"=>1]);
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("application_form");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Payments";
		$this->render_view("payments/add2.php");
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add3($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("amount","payment_mode","recieved_from","rec_id","db_name");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
				'recieved_from' => 'required',
				'rec_id' => 'required',
				'db_name' => 'required',
			);
			$this->sanitize_array = array(
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'rec_id' => 'sanitize_string',
				'db_name' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute before adding record
		$dbname = $modeldata['db_name'];
$db_name = $modeldata['db_name'];
$rec_id = $modeldata['rec_id'];
$db->where("id", $rec_id);
$rec = $db->getOne($db_name, "*");
$newstatus = "";
    if ( intval($rec['status']) == 2) {
        $newstatus = "7";
        // Update status only if newstatus is set
        $db->where("id", $rec_id);
        $db->update($db_name, ["status" => $newstatus]);
    } 
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
$db->where("id",$modeldata['rec_id']);
$db->update($modeldata['db_name'],["paid_1"=>$rec_id]);
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("$db_name");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Payments";
		$this->render_view("payments/add3.php");
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add4($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("amount","payment_mode","recieved_from","rec_id","db_name");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
				'recieved_from' => 'required',
				'rec_id' => 'required',
				'db_name' => 'required',
			);
			$this->sanitize_array = array(
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'rec_id' => 'sanitize_string',
				'db_name' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute before adding record
		$db_name = $modeldata['db_name'];
$rec_id = $modeldata['rec_id'];
$db->where("id", $rec_id);
$rec = $db->getOne($db_name, "*");
$newstatus = "";
if (1) {
    if (USER_ROLE == 9 && intval($rec['status']) == 9) {
    $newstatus = "13";
        // Update status only if newstatus is set
        $db->where("id", $rec_id);
        $db->update($db_name, ["status" => $newstatus]);
    }
}
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$dbname = $modeldata['db_name'];
$db->where("id",$modeldata['rec_id']);
$db->update($modeldata['db_name'],["paid_2"=>$rec_id]);
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("$dbname");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Payments";
		$this->render_view("payments/add4.php");
	}
}
