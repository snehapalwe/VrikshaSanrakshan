<?php 
/**
 * Demand Page Controller
 * @category  Controller
 */
class DemandController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "demand";
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
			"db_name", 
			"recieved_from", 
			"amount", 
			"payment_mode", 
			"purpose", 
			"timestamp", 
			"chq_no", 
			"chq_date", 
			"bank");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				demand.id LIKE ? OR 
				demand.rec_id LIKE ? OR 
				demand.db_name LIKE ? OR 
				demand.recieved_from LIKE ? OR 
				demand.amount LIKE ? OR 
				demand.payment_mode LIKE ? OR 
				demand.purpose LIKE ? OR 
				demand.timestamp LIKE ? OR 
				demand.chq_no LIKE ? OR 
				demand.chq_date LIKE ? OR 
				demand.bank LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "demand/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("demand.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Demand";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("demand/list.php", $data); //render the full page
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
			"db_name", 
			"recieved_from", 
			"amount", 
			"payment_mode", 
			"purpose", 
			"timestamp", 
			"chq_no", 
			"chq_date", 
			"bank");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("demand.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Demand";
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
		return $this->render_view("demand/view.php", $record);
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
			$fields = $this->fields = array("rec_id","db_name","recieved_from","amount","payment_mode","purpose","chq_no","chq_date","bank");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'db_name' => 'required',
				'recieved_from' => 'required',
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
				'purpose' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'db_name' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'purpose' => 'sanitize_string',
				'chq_no' => 'sanitize_string',
				'chq_date' => 'sanitize_string',
				'bank' => 'sanitize_string',
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
		if($modeldata['db_name']=='occupancy_certificate'){
$db->where("id",$modeldata['rec_id']);
$db->update($modeldata['db_name'],["paid_2"=>$rec_id]);
}
if($modeldata['db_name']=='commencement_certificate'){
$db->where("id",$modeldata['rec_id']);
$db->update($modeldata['db_name'],["paid_2"=>$rec_id]);
}
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("$db_name");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Demand";
		$this->render_view("demand/add.php");
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
		$fields = $this->fields = array("id","rec_id","db_name","recieved_from","amount","payment_mode","purpose","chq_no","chq_date","bank");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'db_name' => 'required',
				'recieved_from' => 'required',
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
				'purpose' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'db_name' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'purpose' => 'sanitize_string',
				'chq_no' => 'sanitize_string',
				'chq_date' => 'sanitize_string',
				'bank' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("demand.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("demand");
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
						return	$this->redirect("demand");
					}
				}
			}
		}
		$db->where("demand.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Demand";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("demand/edit.php", $data);
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
		$db->where("demand.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("demand");
	}
}
