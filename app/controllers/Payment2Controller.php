<?php 
/**
 * Payment2 Page Controller
 * @category  Controller
 */
class Payment2Controller extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "payment2";
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
			"timestamp");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				payment2.id LIKE ? OR 
				payment2.rec_id LIKE ? OR 
				payment2.db_name LIKE ? OR 
				payment2.recieved_from LIKE ? OR 
				payment2.amount LIKE ? OR 
				payment2.payment_mode LIKE ? OR 
				payment2.purpose LIKE ? OR 
				payment2.timestamp LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "payment2/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("payment2.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Payment2";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("payment2/list.php", $data); //render the full page
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
			"timestamp");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("payment2.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Payment2";
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
		return $this->render_view("payment2/view.php", $record);
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
			$fields = $this->fields = array("rec_id","db_name","recieved_from","amount","payment_mode","purpose");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'db_name' => 'required',
				'recieved_from' => 'required',
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'db_name' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'purpose' => 'sanitize_string',
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
    if ( intval($rec['status']) == 2) {
        $newstatus = "7";
        // Update status only if newstatus is set
        $db->where("id", $rec_id);
        $db->update($db_name, ["status" => $newstatus]);
    } 
$db->where("id",$modeldata['rec_id']);
$db->update($modeldata['db_name'],["paid_1"=>$rec_id]);
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("$db_name");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Payment2";
		$this->render_view("payment2/add.php");
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
		$fields = $this->fields = array("id","rec_id","db_name","recieved_from","amount","payment_mode","purpose");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'db_name' => 'required',
				'recieved_from' => 'required',
				'amount' => 'required|numeric',
				'payment_mode' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'db_name' => 'sanitize_string',
				'recieved_from' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'payment_mode' => 'sanitize_string',
				'purpose' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("payment2.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("payment2");
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
						return	$this->redirect("payment2");
					}
				}
			}
		}
		$db->where("payment2.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Payment2";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("payment2/edit.php", $data);
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
		$db->where("payment2.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("payment2");
	}
}
