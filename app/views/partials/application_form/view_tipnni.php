<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("application_form/add");
$can_edit = ACL::is_allowed("application_form/edit");
$can_view = ACL::is_allowed("application_form/view");
$can_delete = ACL::is_allowed("application_form/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Application Form</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        error_reporting(0);
                        $jei=new User_infoController();
                        $db=$jei->GetModel();
                        $name="";
                        if($data['application_type']=="PARTIAL TREE CUT"){
                        $name="PARTIAL_TIPNNI";
                        }else{
                        if($data['cut_purpose']=="CONSTRUCTION PURPOSE"){
                        $name="FULL_CONSTRUCT_TIPNNI";
                        }else{
                        $name="FULL_DANGEROUS_TIPNNI";
                        }
                        }
                        $db->where("name",$name);
                        $string=$db->getOne("certificate_data","cert_data")['cert_data'];
                        foreach($data as $k=>$d){
                        if(date("Y",strtotime($d))>2010 && str_contains('-',$d)){
                        if(date("d",strtotime($d))>0){
                        $string=str_replace("{{getval.application.$k}}",date("d-m-Y h:i:s A",strtotime($d)),$string); 
                        $string=str_replace("{{getval.application.dateonly_$k}}",date("d-m-Y",strtotime($d)),$string); 
                        }else{ 
                        $string=str_replace("{{getval.application.$k}}",date("d-m-Y",strtotime($d)),$string);
                        }
                        }else{
                        $string=str_replace("{{getval.application.$k}}",$d,$string);
                        }
                        }
                        $db->where("id",$data['flag_inspection']);
                        $ins=$db->getOne("inspection","*");
                        foreach($ins as $k=>$d){
                        if(date("Y",strtotime($d))>2010 && str_contains('-',$d)){
                        if(date("d",strtotime($d))>0){
                        $string=str_replace("{{getval.inspection.$k}}",date("d-m-Y h:i:s A",strtotime($d)),$string); 
                        $string=str_replace("{{getval.inspection.dateonly_$k}}",date("d-m-Y",strtotime($d)),$string); 
                        }else{ 
                        $string=str_replace("{{getval.inspection.$k}}",date("d-m-Y",strtotime($d)),$string);
                        }
                        }else{
                        $string=str_replace("{{getval.inspection.$k}}",$d,$string);
                        }
                        }
                        $db->where("id",$data['flag_payment']);
                        $payment=$db->getOne("payments","*");
                        foreach($payment as $k=>$d){
                        if(date("Y",strtotime($d))>2010 && str_contains('-',$d)){
                        if(date("H",strtotime($d))>0){
                        $string=str_replace("{{getval.payment.$k}}",date("d-m-Y h:i:s A",strtotime($d)),$string); 
                        $string=str_replace("{{getval.payment.dateonly_$k}}",date("d-m-Y",strtotime($d)),$string); 
                        }else{ 
                        $string=str_replace("{{getval.payment.$k}}",date("d-m-Y",strtotime($d)),$string);
                        }
                        }else{
                        $string=str_replace("{{getval.payment.$k}}",$d,$string);
                        }
                        }
                        $db->where("id",$data['flag_order']);
                        $order=$db->getOne("orders","*");
                        foreach($order as $k=>$d){
                        if(date("Y",strtotime($d))>2010 && str_contains('-',$d)){
                        if(date("H",strtotime($d))>0){
                        $string=str_replace("{{getval.order.$k}}",date("d-m-Y h:i:s A",strtotime($d)),$string); 
                        $string=str_replace("{{getval.order.dateonly_$k}}",date("d-m-Y",strtotime($d)),$string); 
                        }else{ 
                        $string=str_replace("{{getval.order.$k}}",date("d-m-Y",strtotime($d)),$string);
                        }
                        }else{
                        $string=str_replace("{{getval.order.$k}}",$d,$string);
                        }
                        }
                        $db->where("id",$data['flag_advertisement']);
                        $paper_notice=$db->getOne("paper_notice","*");
                        foreach($paper_notice as $k=>$d){
                        if(date("Y",strtotime($d))>2010 && str_contains('-',$d)){
                        if(date("H",strtotime($d))>0){
                        $string=str_replace("{{getval.paper_notice.$k}}",date("d-m-Y h:i:s A",strtotime($d)),$string); 
                        $string=str_replace("{{getval.paper_notice.dateonly_$k}}",date("d-m-Y",strtotime($d)),$string); 
                        }else{ 
                        $string=str_replace("{{getval.paper_notice.$k}}",date("d-m-Y",strtotime($d)),$string);
                        }
                        }else{
                        $string=str_replace("{{getval.paper_notice.$k}}",$d,$string);
                        }
                        }
                        $db->where("rec_id",$data['id']);
                        $treephoto=$db->get("photo_of_tree",999999,"*");
                        $name="";
                        $count=count($treephoto);
                        $table="<table border='1'><tr><th>अ.क्र.</th><th>झाडाचा प्रकार व नग</th>";
                            $table.="<th>तक्रारीचे स्वरूप </th><th>शेरा </th>";
                            $string=str_replace("{{getval.tree.count}}",$count,$string);
                            foreach($treephoto as $k=>$tree){
                            if($name!=""){
                            $name.=", ";
                            }
                            $name.=$tree['name_of_tree'];
                            $table.="<tr>";
                                $table.="<td>".($k+1)."</td>";
                                $table.="<td>".$tree['name_of_tree']."</td>";
                                $table.="<td>".$data['applicant_name'].",".$data['applicant_address'].",".$data['peth'].",".$data['id'].",".$tree['name_of_tree']."</td>";
                                $table.="<td>".$ins['remark']."</td>";
                            $table.="</tr>";
                            }
                            $string=str_replace("{{getval.tree.combined_names}}",$name,$string);
                            $string=str_replace("{{getval.today}}",date("d-m-Y"),$string);
                            $string=str_replace("{{getval.table}}",$table,$string);
                            $counter = 0;
                            if(!empty($data)){
                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                            $counter++;
                            ?>
                            <div id="page-report-body" class="">
                                <style>
                                    @media print {
                                    * {
                                    margin: 0 !important;
                                    padding: 0 !important;
                                    }
                                    html, body {
                                    height: auto !important;
                                    overflow: hidden !important;
                                    }
                                    }
                                    #printarea {
                                    margin-bottom: 0 !important;
                                    padding-bottom: 0 !important;
                                    }
                                    #main {
                                    padding-bottom: 0 !important;
                                    margin-bottom: 0 !important;
                                    }
                                </style>
                                <div>
                                    <a href="#"  class="btn btn-danger" onclick="printDiv('printarea')"  >PRINT</a>
                                </div>
                                <div id="main" class>
                                    <div id="printarea">
                                        <?php
                                        // Clean up multiple trailing <br>, &nbsp;, or spaces
                                            $string = preg_replace('/(<br\s*\/?>\s*)+$/i', '', $string); 
                                            $string = preg_replace('/(&nbsp;|\s)+$/', '', $string);
                                            echo $string;
                                            ?>
                                        </div> 
                                    </div>
                                    <script>
                                        function printDiv(divName) {
                                        var printContents = document.getElementById(divName).innerHTML;
                                        var originalContents = document.body.innerHTML;
                                        document.body.innerHTML = printContents;
                                        window.print();
                                        setTimeout(function() {
                                        document.body.innerHTML = originalContents;
                                        }, 2000);                                    }
                                    </script>
                                </div>
                                <?php
                                }
                                else{
                                ?>
                                <!-- Empty Record Message -->
                                <div class="text-muted p-3">
                                    <i class="fa fa-ban"></i> No Record Found
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
