<?php 
/**
 * Tippani_data Page Controller
 * @category  Controller
 */
class Tippani_dataController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "tippani_data";
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
			"application_number", 
			"application_date", 
			"town_planning_cc_date", 
			"village_and_survey_number", 
			"number_of_trees_to_be_planted", 
			"name_of_trees_to_be_planted", 
			"tippni_data", 
			"cc_not_taken_remark", 
			"building_address_details");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				tippani_data.id LIKE ? OR 
				tippani_data.rec_id LIKE ? OR 
				tippani_data.db_name LIKE ? OR 
				tippani_data.application_number LIKE ? OR 
				tippani_data.application_date LIKE ? OR 
				tippani_data.town_planning_cc_date LIKE ? OR 
				tippani_data.village_and_survey_number LIKE ? OR 
				tippani_data.number_of_trees_to_be_planted LIKE ? OR 
				tippani_data.name_of_trees_to_be_planted LIKE ? OR 
				tippani_data.tippni_data LIKE ? OR 
				tippani_data.cc_not_taken_remark LIKE ? OR 
				tippani_data.building_address_details LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "tippani_data/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("tippani_data.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Tippani Data";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("tippani_data/list.php", $data); //render the full page
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
			"application_number", 
			"application_date", 
			"town_planning_cc_date", 
			"village_and_survey_number", 
			"number_of_trees_to_be_planted", 
			"name_of_trees_to_be_planted", 
			"tippni_data", 
			"cc_not_taken_remark", 
			"building_address_details");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("tippani_data.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Tippani Data";
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
		return $this->render_view("tippani_data/view.php", $record);
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
			$fields = $this->fields = array("rec_id","application_number","application_date","town_planning_cc_date","village_and_survey_number","number_of_trees_to_be_planted","name_of_trees_to_be_planted","tippni_data","cc_not_taken_remark","building_address_details");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'application_number' => 'required',
				'application_date' => 'required',
				'town_planning_cc_date' => 'required',
				'village_and_survey_number' => 'required',
				'number_of_trees_to_be_planted' => 'required|numeric',
				'name_of_trees_to_be_planted' => 'required',
				'tippni_data' => 'required',
				'building_address_details' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'application_number' => 'sanitize_string',
				'application_date' => 'sanitize_string',
				'town_planning_cc_date' => 'sanitize_string',
				'village_and_survey_number' => 'sanitize_string',
				'number_of_trees_to_be_planted' => 'sanitize_string',
				'name_of_trees_to_be_planted' => 'sanitize_string',
				'tippni_data' => 'sanitize_string',
				'cc_not_taken_remark' => 'sanitize_string',
				'building_address_details' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$db->where("id",$modeldata['rec_id']);
$db->update("occupancy_certificate",["tippni"=>$rec_id]);
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("occupancy_certificate");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Tippani Data";
		$this->render_view("tippani_data/add.php");
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
		$fields = $this->fields = array("id","rec_id","application_number","application_date","town_planning_cc_date","village_and_survey_number","number_of_trees_to_be_planted","name_of_trees_to_be_planted","tippni_data","cc_not_taken_remark","building_address_details");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'application_number' => 'required',
				'application_date' => 'required',
				'town_planning_cc_date' => 'required',
				'village_and_survey_number' => 'required',
				'number_of_trees_to_be_planted' => 'required|numeric',
				'name_of_trees_to_be_planted' => 'required',
				'tippni_data' => 'required',
				'building_address_details' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'application_number' => 'sanitize_string',
				'application_date' => 'sanitize_string',
				'town_planning_cc_date' => 'sanitize_string',
				'village_and_survey_number' => 'sanitize_string',
				'number_of_trees_to_be_planted' => 'sanitize_string',
				'name_of_trees_to_be_planted' => 'sanitize_string',
				'tippni_data' => 'sanitize_string',
				'cc_not_taken_remark' => 'sanitize_string',
				'building_address_details' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("tippani_data.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("tippani_data");
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
						return	$this->redirect("tippani_data");
					}
				}
			}
		}
		$db->where("tippani_data.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Tippani Data";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("tippani_data/edit.php", $data);
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
		$db->where("tippani_data.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("tippani_data");
	}
}
