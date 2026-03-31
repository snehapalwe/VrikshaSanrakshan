<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * application_form_peth_option_list Model Action
     * @return array
     */
	function application_form_peth_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT peth AS value,peth AS label FROM master_zone ORDER BY peth ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * application_form_name_of_person_present_option_list Model Action
     * @return array
     */
	function application_form_name_of_person_present_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name AS value,name AS label FROM name_designation_master ORDER BY name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_info_username_value_exist Model Action
     * @return array
     */
	function user_info_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("user_info");
		return $exist;
	}

	/**
     * user_info_email_value_exist Model Action
     * @return array
     */
	function user_info_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user_info");
		return $exist;
	}

	/**
     * user_info_user_role_id_option_list Model Action
     * @return array
     */
	function user_info_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_info_ward_option_list Model Action
     * @return array
     */
	function user_info_ward_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT peth AS value,peth AS label FROM master_zone ORDER BY peth ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * paper_notice_name_of_news_paper_option_list Model Action
     * @return array
     */
	function paper_notice_name_of_news_paper_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT Name_of_news_paper AS value,Name_of_news_paper AS label FROM master_for_name_of_news_paper ORDER BY Name_of_news_paper ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * payments_payment_mode_option_list Model Action
     * @return array
     */
	function payments_payment_mode_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT 'CASH' AS label, 'CASH' AS value;";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * refund_application_id_value_exist Model Action
     * @return array
     */
	function refund_application_id_value_exist($val){
		$db = $this->GetModel();
		$db->where("application_id", $val);
		$exist = $db->has("refund");
		return $exist;
	}

	/**
     * photo_of_tree_name_of_tree_option_list Model Action
     * @return array
     */
	function photo_of_tree_name_of_tree_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name_of_tree AS value,name_of_tree AS label FROM master_name_of_tree ORDER BY name_of_tree ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * accept_reject_status_option_list Model Action
     * @return array
     */
	function accept_reject_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT 'ACCEPT' AS label, 'ACCEPT' AS value
UNION ALL
SELECT 'REJECT' AS label, 'REJECT' AS value";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * accept_reject2_status_option_list Model Action
     * @return array
     */
	function accept_reject2_status_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT 'APPROVE' AS label, 'ACCEPT' AS value
UNION ALL
SELECT 'REJECTION' AS label, 'REJECT' AS value
";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * cc_photo_inspection_name_of_tree_option_list Model Action
     * @return array
     */
	function cc_photo_inspection_name_of_tree_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name_of_tree AS value,name_of_tree AS label FROM master_name_of_tree ORDER BY name_of_tree ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * commencement_certificate_ward_option_list Model Action
     * @return array
     */
	function commencement_certificate_ward_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT zone_name AS value,zone_name AS label FROM master_zone ORDER BY zone_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * commencement_certificate_type_of_residence_option_list Model Action
     * @return array
     */
	function commencement_certificate_type_of_residence_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT residence_type_name AS value,residence_type_name AS label FROM master_residence ORDER BY residence_type_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * occupancy_certificate_ward_option_list Model Action
     * @return array
     */
	function occupancy_certificate_ward_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT zone_name AS value,zone_name AS label FROM master_zone ORDER BY zone_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * occupancy_certificate_type_of_residence_option_list Model Action
     * @return array
     */
	function occupancy_certificate_type_of_residence_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT residence_type_name AS value,residence_type_name AS label FROM master_residence ORDER BY residence_type_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * demand_payment_mode_option_list Model Action
     * @return array
     */
	function demand_payment_mode_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT 'CASH' AS label, 'CASH' AS value
UNION ALL
SELECT 'CHEQUE/DD', 'CHEQUE/DD'
UNION ALL
SELECT 'ONLINE', 'ONLINE'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * oc_photo_inspection_name_of_tree_option_list Model Action
     * @return array
     */
	function oc_photo_inspection_name_of_tree_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name_of_tree AS value,name_of_tree AS label FROM master_name_of_tree ORDER BY name_of_tree ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_totalpendingapplicationform Model Action
     * @return Value
     */
	function getcount_totalpendingapplicationform(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form WHERE status>0 and status<3 AND (peth=? OR ?=3)" ;
		$queryparams = array(get_active_user('ward'),USER_ROLE);
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalcompletedapplicationform Model Action
     * @return Value
     */
	function getcount_totalcompletedapplicationform(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form WHERE status=3 AND (peth=? OR ?=3)" ;
		$queryparams = array(get_active_user('ward'),USER_ROLE);
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalrejectedapplicationform Model Action
     * @return Value
     */
	function getcount_totalrejectedapplicationform(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form WHERE status=-1 AND (peth=? OR ?=3)" ;
		$queryparams = array(get_active_user('ward'),USER_ROLE);
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalobjections Model Action
     * @return Value
     */
	function getcount_totalobjections(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM objections " ;
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalpendingobjections Model Action
     * @return Value
     */
	function getcount_totalpendingobjections(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM objections WHERE resolution=''";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalresolvedobjections Model Action
     * @return Value
     */
	function getcount_totalresolvedobjections(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM objections WHERE resolution!=''";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totaltreeplanted Model Action
     * @return Value
     */
	function getcount_totaltreeplanted(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM report_of_tree";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_commencementcertificate Model Action
     * @return Value
     */
	function getcount_commencementcertificate(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM commencement_certificate WHERE ward=?   OR ?!=3"  ;
		$queryparams = array(get_active_user('ward'),USER_ROLE);
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_occupancycertificate Model Action
     * @return Value
     */
	function getcount_occupancycertificate(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM occupancy_certificate WHERE ward=?   OR ?!=3" ;
		$queryparams = array(get_active_user('ward'),USER_ROLE);
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_treereportmatrix Model Action
     * @return Value
     */
	function getcount_treereportmatrix(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM tree_report_matrix";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
	* barchart_applicationspermonth Model Action
	* @return array
	*/
	function barchart_applicationspermonth(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT 
    DATE_FORMAT(timestamp, '%b-%Y') AS month,
    COUNT(*) AS application_count
FROM application_form
WHERE peth=? OR ?=3
GROUP BY month
ORDER BY MAX(timestamp) DESC;
"  ;
		$queryparams = array(get_active_user('ward'),USER_ROLE);
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'application_count');
		$dataset_labels =  array_column($dataset1, 'month');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* piechart_totalapplication Model Action
	* @return array
	*/
	function piechart_totalapplication(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT 
    CASE 
        WHEN status IN (0, 1, 2) THEN 'Pending'
        WHEN status = 3 THEN 'Completed'
        WHEN status = -1 THEN 'Rejected'
    END AS status_category,
    COUNT(*) AS count
    FROM application_form 
WHERE peth=? OR ?=3
GROUP BY status_category" ;
		$queryparams = array(get_active_user('ward'),USER_ROLE);
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'count');
		$dataset_labels =  array_column($dataset1, 'status_category');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
