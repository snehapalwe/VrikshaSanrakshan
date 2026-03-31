<?php 
/**
 * Photo_of_inspection_refund Page Controller
 * @category  Controller
 */
class Photo_of_inspection_refundController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "photo_of_inspection_refund";
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
			"upload_photo_of_tree");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(isset($_GET['rec_id'])){
$db->where("rec_id",$_GET['rec_id']);
}else{
    $db->where("rec_id",0);
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				photo_of_inspection_refund.id LIKE ? OR 
				photo_of_inspection_refund.rec_id LIKE ? OR 
				photo_of_inspection_refund.latitude LIKE ? OR 
				photo_of_inspection_refund.longitude LIKE ? OR 
				photo_of_inspection_refund.upload_photo_of_tree LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "photo_of_inspection_refund/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("photo_of_inspection_refund.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Photo Of Inspection Refund";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("photo_of_inspection_refund/list.php", $data); //render the full page
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
			"upload_photo_of_tree");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("photo_of_inspection_refund.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Photo Of Inspection Refund";
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
		return $this->render_view("photo_of_inspection_refund/view.php", $record);
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
			$fields = $this->fields = array("rec_id","latitude","longitude","upload_photo_of_tree");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'upload_photo_of_tree' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'latitude' => 'sanitize_string',
				'longitude' => 'sanitize_string',
				'upload_photo_of_tree' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("photo_of_inspection_refund");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Photo Of Inspection Refund";
		$this->render_view("photo_of_inspection_refund/add.php");
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
		$fields = $this->fields = array("id","rec_id","latitude","longitude","upload_photo_of_tree");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'latitude' => 'required',
				'longitude' => 'required',
				'upload_photo_of_tree' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'latitude' => 'sanitize_string',
				'longitude' => 'sanitize_string',
				'upload_photo_of_tree' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("photo_of_inspection_refund.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
		# Statement to execute after adding record
                    $this->set_flash_msg("Record added successfully", "success");
                    return  $this->redirect("photo_of_inspection_refund/?rec_id=".$modeldata['rec_id']);
		# End of after update statement
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("photo_of_inspection_refund");
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
						return	$this->redirect("photo_of_inspection_refund");
					}
				}
			}
		}
		$db->where("photo_of_inspection_refund.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Photo Of Inspection Refund";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("photo_of_inspection_refund/edit.php", $data);
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
		$db->where("photo_of_inspection_refund.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("photo_of_inspection_refund");
	}
}
