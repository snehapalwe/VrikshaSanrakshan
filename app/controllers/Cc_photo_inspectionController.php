<?php 
/**
 * Cc_photo_inspection Page Controller
 * @category  Controller
 */
class Cc_photo_inspectionController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "cc_photo_inspection";
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
			"latitude", 
			"longitude", 
			"enter_name_of_tree", 
			"name_of_tree", 
			"upload_photo_of_tree", 
			"inspection_date", 
			"tree_count");
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
				cc_photo_inspection.id LIKE ? OR 
				cc_photo_inspection.rec_id LIKE ? OR 
				cc_photo_inspection.latitude LIKE ? OR 
				cc_photo_inspection.longitude LIKE ? OR 
				cc_photo_inspection.name_of_tree LIKE ? OR 
				cc_photo_inspection.upload_photo_of_tree LIKE ? OR 
				cc_photo_inspection.inspection_date LIKE ? OR 
				cc_photo_inspection.tree_count LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "cc_photo_inspection/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("cc_photo_inspection.id", ORDER_TYPE);
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
				$record['inspection_date'] = human_date($record['inspection_date']);
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
		$page_title = $this->view->page_title = "Cc Photo Inspection";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("cc_photo_inspection/list.php", $data); //render the full page
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
			"latitude", 
			"longitude", 
			"upload_photo_of_tree", 
			"name_of_tree", 
			"inspection_date", 
			"photo", 
			"photo2", 
			"photo3", 
			"tree_count");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("cc_photo_inspection.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['inspection_date'] = human_date($record['inspection_date']);
			$page_title = $this->view->page_title = "View  Cc Photo Inspection";
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
		return $this->render_view("cc_photo_inspection/view.php", $record);
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
			$fields = $this->fields = array("rec_id","latitude","longitude","enter_name_of_tree","upload_photo_of_tree","name_of_tree","tree_count");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'upload_photo_of_tree' => 'required',
				'name_of_tree' => 'required',
				'tree_count' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'latitude' => 'sanitize_string',
				'longitude' => 'sanitize_string',
				'upload_photo_of_tree' => 'sanitize_string',
				'name_of_tree' => 'sanitize_string',
				'tree_count' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$params = array($modeldata['rec_id']);
$value  = $db->rawQueryValue("SELECT trees_added FROM commencement_certificate WHERE id = ?", $params);
// Increamenting the count of persons & storing it into `$total` varaible
$total = $value[0]+1;
$table_data = array(
    "trees_added" => $total
);
$db->where("id", $modeldata['rec_id']);
$bool = $db->update("commencement_certificate", $table_data);

$db->where("id", $modeldata['rec_id']);
$bool = $db->update("commencement_certificate", $table_data);
$db->where("id", $modeldata['rec_id']);
$ocdata = $db->getOne("commencement_certificate", '*');
if($total>=$ocdata['no_of_trees_if_available']+0){
$db->where("id", $modeldata['rec_id']);
$bool = $db->update("commencement_certificate", ['inspection_report_by_cg'=>1]);
 
}

		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("commencement_certificate");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Cc Photo Inspection";
		$this->render_view("cc_photo_inspection/add.php");
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
		$fields = $this->fields = array("id","rec_id","latitude","longitude","upload_photo_of_tree","name_of_tree","tree_count");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'upload_photo_of_tree' => 'required',
				'name_of_tree' => 'required',
				'tree_count' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'latitude' => 'sanitize_string',
				'longitude' => 'sanitize_string',
				'upload_photo_of_tree' => 'sanitize_string',
				'name_of_tree' => 'sanitize_string',
				'tree_count' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("cc_photo_inspection.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("cc_photo_inspection");
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
						return	$this->redirect("cc_photo_inspection");
					}
				}
			}
		}
		$db->where("cc_photo_inspection.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Cc Photo Inspection";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("cc_photo_inspection/edit.php", $data);
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
		$db->where("cc_photo_inspection.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("cc_photo_inspection");
	}
}
