<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("application_form/add");
$can_edit = ACL::is_allowed("application_form/edit");
$can_view = ACL::is_allowed("application_form/view");
$can_delete = ACL::is_allowed("application_form/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="grid" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Application Form / अर्ज</h4>
                </div>
                <div class="col-sm-3 ">
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('application_form'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('application_form'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('application_form'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="application_form-list-records">
                                <?php
                                if(!empty($records)){
                                ?>
                                <div id="page-report-body">
                                    <div class="row sm-gutters page-data" id="page-data-<?php echo $page_element_id; ?>">
                                        <!--record-->
                                        <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                        $counter++;
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="bg-light p-2 mb-3 animated bounceIn">
                                                <?php if (!empty($data['id'])): ?>
                                                <div class="mb-2">
                                                    <span><b>Application No : </b></span>
                                                    <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                        <span style="font-weight: bold;"> <?php echo $data['application_no']; ?> </span>
                                                    </span>
                                                </div>
                                                <?php endif; ?>
                                                <?php if (!empty($data['application_type'])): ?>
                                                <div class="mb-2">
                                                    <span class="font-weight-light text-muted ">
                                                        APPLICATION TYPE :
                                                    </span>  
                                                    <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                        <?php echo $data['application_type']; ?>
                                                    </span>
                                                </div>
                                                <?php endif; ?>
                                                <span><?php $x= $data['status']; 
                                                    $show="";
                                                    $pi=USER_ROLE==2?1:0;
                                                    $trr=0;
                                                    if($data['status'] == 0.5){
                                                    echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>Pending at CG - Please visit VVCMC Office for payment</span>";
                                                    }
                                                    if($x==-2){ 
                                                    $show = "<b><span style='font-weight: bold;' class='text-danger'>REJECTED</span></b>";
                                                    }
                                                    if($x==-1){
                                                    $trr=1;
                                                    $show = "<b><span style='font-weight: bold;' class='text-danger'>UPLOAD TREE PHOTOS</span></b>";
                                                    }
                                                    if($x==1){
                                                    if($data['flag_inspection']){
                                                    $show = "PENDING AT CG"; 
                                                    }
                                                    else{
                                                    $show = "PENDING AT CG FOR INSPECTION"; 
                                                    }
                                                    } 
                                                    if($x==2){
                                                    $show = "PENDING AT CG";
                                                    } 
                                                    if($x==2.5){
                                                    $show = "PENDING AT HOD OBJECTION RESULT";
                                                    if(USER_ROLE==3){ 
                                                    $show= "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."objections_hod_approval/?rec_id=".$data['id']."'  >ACCEPT/REJECT OBJECTION RAISED</a>";
                                                    }
                                                    }
                                                    if($x==3  ){
                                                    $show = "PENDING AT HOD";
                                                    if(USER_ROLE==3){ 
                                                    $show= "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."accept_reject/add/?db_name=application_form&rec_id=".$data['id']."'  >ACCEPT/REJECT</a>";
                                                    }
                                                    }
                                                    if($x==1 ){ // && 0
                                                    if($data['flag_inspection']+0>0){
                                                    if(USER_ROLE==7 && $data['upload_tipnni']==""){ 
                                                    $show= " <a class='btn btn-sm btn-success' href='".SITE_ADDR."application_form/view_tipnni/".$data['id']."'  >GENERATE TIPPNI</a>";
                                                    $show.= " <a class='btn btn-sm btn-danger' href='".SITE_ADDR."application_form/edit_tipnni/".$data['id']."'  >UPLOAD TIPPNI</a>";
                                                    }
                                                    }
                                                    }
                                                    if($x==4){ 
                                                    $show = "PENDING AT THE CG FOR DOCUMENT UPLOADS";
                                                    if(USER_ROLE==7 && $data['upload_tipnni']==""){ 
                                                    $show= " <a class='btn btn-sm btn-success' href='".SITE_ADDR."application_form/view_tipnni/".$data['id']."'  >GENERATE TIPPNI</a>";
                                                    $show.= " <a class='btn btn-sm btn-danger' href='".SITE_ADDR."application_form/edit_tipnni/".$data['id']."'  >UPLOAD TIPPNI</a>";
                                                    }
                                                    if(USER_ROLE==7 && $data['upload_permission']=="" && $data['upload_tipnni']!=""){ 
                                                    $show= " <a class='btn btn-sm btn-success' href='".SITE_ADDR."application_form/view_permission/".$data['id']."'  >GENERATE PERMISSION</a>";
                                                    $show.= " <a class='btn btn-sm btn-danger' href='".SITE_ADDR."application_form/edit_permission/".$data['id']."'  >UPLOAD PERMISSION</a><br><br>";
                                                        }
                                                        }
                                                        if($x==4.5){ 
                                                        $show = "Pending at CG - Please visit VVCMC Office for payment";
                                                        if(USER_ROLE==7 && $data['demand_id']==0){ 
                                                        $show= "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."payments/add/?rec_id=".$data['id']."'  >DEMAND</a>"; 
                                                        }
                                                        if(USER_ROLE==7 && $data['demand_id']!=0){ 
                                                        $show= "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."payments/edit/".$data['demand_id']."'  >PAY DEMAND</a>"; 
                                                        } 
                                                        }
                                                        if($x==5){ 
                                                        $show = "COMPLETED"; 
                                                        if((USER_ROLE==7 || USER_ROLE==3)  ){ 
                                                        $show.= " <br><a class='btn btn-sm btn-success' href='".$data['upload_tipnni']."'  >VIEW TIPPNI</a>"; 
                                                            }
                                                            $show.= "<br><a class='btn btn-sm btn-success' href='".$data['upload_permission']."'  >VIEW PERMISSION</a><br>"; 
                                                                }
                                                                if($data['demand_id']!=0 && $x!=4.5){ 
                                                                $show.= " <a class='btn btn-sm btn-info' href='".SITE_ADDR."payments/view/".$data['demand_id']."'  >  VIEW DEMAND RECEIPT</a>"; 
                                                                } 
                                                                //  ECHO $show;
                                                                if($show!=""){
                                                                echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>$show</span>";
                                                                }
                                                            ?></span>
                                                            <br>
                                                                <br>
                                                                    <span><a class='btn tree-photo-btn btn-sm btn-<?php if($trr){echo "danger"; }else{ echo "warning"; } ?>' href='<?php echo SITE_ADDR  ?>photo_of_tree/?rec_id=<?php echo $data['id'] ?>'> <?php if($trr){echo "PLEASE UPLOAD TREEE PHOTOS / कृपया झाडांचे फोटो अपलोड करा"; }else{ echo "TREE PHOTOS"; } ?> </a></span>
                                                                    <style>
                                                                        .tree-photo-btn {
                                                                        white-space: normal;
                                                                        width: 70%;
                                                                        word-wrap: break-word;
                                                                        text-align: center;
                                                                        display: inline-block;
                                                                        }
                                                                    </style>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            Amount / रक्कम:  
                                                                        </span>
                                                                    <?php echo $data['amount']; ?></div>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            No Of Trees / झाडांची संख्या:  
                                                                        </span>
                                                                    <?php echo $data['no_of_trees']; ?></div>
                                                                    <span>
                                                                        <?php 
                                                                        $x = $data['flag_payment']; 
                                                                        if ($x > 0.5) {
                                                                        // Use different URL based on USER_ROLE
                                                                        $payment_view_url = (USER_ROLE == 2) 
                                                                        ? SITE_ADDR . "payments/view2/$x" 
                                                                        : SITE_ADDR . "payments/view/$x";
                                                                        echo "<a href='$payment_view_url' target='_blank' class='btn btn-sm btn-success'>VIEW RECEIPT</a>";
                                                                        }     
                                                                        if ($data['status'] == 0.5 && USER_ROLE == 7) {
                                                                        echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "payments/add2/?rec_id=" . $data['id'] . "&amount=".$data['amount']."&recieved_from=".$data['applicant_name']."' target=''>PAY APPLICATION FEES</a>";
                                                                        }
                                                                        if ($data['status'] == 0) {
                                                                        echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "api/online_pay_confirm/application/" . $data['id'] . "/$pi' target='_blank'>CONFIRM APPLICATION</a>";
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            Applicant Full Name / अर्जदाराचे संपूर्ण नाव:  
                                                                        </span>
                                                                    <?php echo $data['applicant_name']; ?></div>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            MOBILE NUMBER :  
                                                                        </span>
                                                                    <?php echo $data['mobile_no']; ?></div>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            Applicant Address / अर्जदाराचा पत्ता:  
                                                                        </span>
                                                                    <?php echo $data['applicant_address']; ?></div>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            Property Owner Name/मालमत्तेच्या मालकाचे नाव:  
                                                                        </span>
                                                                    <?php echo $data['property_owner_name']; ?></div>
                                                                    <?php if (!empty($data['peth'])): ?>
                                                                    <div class="mb-2">
                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                            Ward/प्रभाग :
                                                                        </strong>  
                                                                        <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                                            <?php echo $data['peth']; ?>
                                                                        </span>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            City Survey Number / शहर सर्वे नंबर :  
                                                                        </span>
                                                                    <?php echo $data['city_survey_number']; ?></div>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            Reason To Cut Tree / झाड कापण्याचे कारण:  
                                                                        </span>
                                                                    <?php echo $data['cut_purpose']; ?></div>
                                                                    <div class="mb-2">  
                                                                        <span class="font-weight-light text-muted ">
                                                                            Address of Tree / झाडाचा पत्ता:  
                                                                        </span>
                                                                    <?php echo $data['location_of_tree']; ?></div>
                                                                    <?php if (!empty($data['extract_7_12'])): ?>
                                                                    <div class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                            Uploaded Extract_7_12:
                                                                        </strong>  
                                                                        <a href="<?php echo htmlspecialchars($data['extract_7_12'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                            target="_blank" onclick="return autoPrintImage(this.href);"
                                                                            class="btn btn-info btn-sm">
                                                                            View Document
                                                                        </a>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <?php if (!empty($data['noc_of_property'])): ?>
                                                                    <div class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                            NOC of Property:
                                                                        </strong>  
                                                                        <a href="<?php echo htmlspecialchars($data['noc_of_property'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                            target="_blank" onclick="return autoPrintImage(this.href);"
                                                                            class="btn btn-info btn-sm">
                                                                            View Uploaded NOC
                                                                        </a>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <?PHP if(USER_ROLE==7 || $data['flag_inspection']>0){
                                                                    if ($data['status'] != 0.5){
                                                                    ?> <span>
                                                                        <a class='btn btn-sm btn-<?php echo ($data['flag_ins_photo']) ? "success" : "danger"; ?>' 
                                                                            href='<?php echo SITE_ADDR ?>photo_of_inspection/?rec_id=<?php echo $data['id'] ?>'>
                                                                            <?php echo ($data['flag_ins_photo']) ? "VIEW TREE INSPECTION PHOTOS" : "ADD TREE INSPECTION PHOTOS"; ?>
                                                                        </a>
                                                                    </span>
                                                                    </span><?php }} ?> <span><?php 
                                                                    $x= $data['flag_inspection']; 
                                                                    if($x==0){
                                                                    if(USER_ROLE==7 ){///&& $data['application_type']!='PARTIAL TREE CUT'){
                                                                    if($data['flag_ins_photo']){
                                                                    echo "<br>";
                                                                        echo "<br>";
                                                                            echo "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."inspection/add?rec_id=".$data['id']."' target='_blank'>DO INSPECTION</a>";}
                                                                            }
                                                                            }else{
                                                                            if(USER_ROLE!=2){
                                                                            echo "<a class='btn btn-sm btn-warning' href='".SITE_ADDR."inspection/view/".$x."' target='_blank'>INSPECTION</a>";
                                                                            }
                                                                            if($data['application_type']=="FULL TREE CUT"){
                                                                            if(USER_ROLE==7 && $data['upload_tipnni']==""){ 
                                                                            //  echo  "<a class='btn btn-sm btn-success' href='".SITE_ADDR."application_form/view_tipnni/".$data['id']."'  >GENERATE TIPPNI</a>";
                                                                            //  echo   "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."application_form/edit_tipnni/".$data['id']."'  >UPLOAD TIPPNI</a>";
                                                                            }else{
                                                                            if($data['flag_ins_photo']&&$data['flag_inspection']>0&&USER_ROLE==7&&$data['status']==1 && $data['flag_order']+$data['flag_advertisement']>0){ 
                                                                            echo " <a class='btn btn-sm btn-danger' href='".SITE_ADDR."accept_reject/add?rec_id=".$data['id']."&db_name=application_form' >ACCEPT/REJECT </a>";
                                                                            }
                                                                            }
                                                                            }else{
                                                                            if($data['flag_ins_photo']&&$data['flag_inspection']>0&&USER_ROLE==7&&$data['status']==1
                                                                            && ($data['upload_tipnni']!=""  )){ 
                                                                            echo " <a class='btn btn-sm btn-danger' href='".SITE_ADDR."accept_reject/add?rec_id=".$data['id']."&db_name=application_form' >ACCEPT/REJECT </a>";
                                                                            }
                                                                            }
                                                                            }
                                                                            ?>
                                                                            <span><?php 
                                                                                $x= $data['flag_inspection']; 
                                                                                $y= $data['flag_order']; 
                                                                                $z= $data['flag_advertisement']; 
                                                                                if($x>0&& ($y==0 &&$z==0)){
                                                                                if($data['application_type']=="FULL TREE CUT" && $data['cut_purpose']!="DANGEROUS CONDITION"){
                                                                                if(USER_ROLE==7 && $data['application_type']!="PARTIAL TREE CUT"){
                                                                                if($data['upload_tipnni']!=""){
                                                                                echo "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."application_form/view_advt_tipnni/".$data['id']."' > VIEW ADVERTISEMENT TIPNNI</a>";
                                                                                echo "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."paper_notice/add?rec_id=".$data['id']."' target='_blank'> ADD ADVERTISEMENT</a>";
                                                                                }
                                                                                }
                                                                                }
                                                                                if($data['application_type']=="FULL TREE CUT" && $data['cut_purpose']=="DANGEROUS CONDITION"){
                                                                                if(USER_ROLE==7 && $data['application_type']!="PARTIAL TREE CUT"){ 
                                                                                //  echo "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."orders/add?rec_id=".$data['id']."' target='_blank'> ADD ORDER</a>";
                                                                                }
                                                                                }
                                                                                }else{
                                                                                if($z!=0 && $data['application_type']!="PARTIAL TREE CUT"){
                                                                                if(USER_ROLE!=2){
                                                                                echo "<a class='btn btn-sm btn-info' href='".SITE_ADDR."paper_notice/view/".$z."' target='_blank'>VIEW ADVERTISEMENT</a>";
                                                                                }
                                                                                //give decision
                                                                                if(USER_ROLE==7 && $data['status']==1){
                                                                                if($data['status']+0==1 && $data['application_type']=="FULL TREE CUT"){
                                                                                //send forward
                                                                                echo " <a class='btn btn-sm btn-danger' href='".SITE_ADDR."accept_reject/add?rec_id=".$data['id']."&db_name=application_form' >ACCEPT/REJECT (SEND TO HOD)</a>";
                                                                                }
                                                                                }
                                                                                }
                                                                                }
                                                                            ?></span>
                                                                            <span><?php 
                                                                                $x= $data['flag_inspection']; 
                                                                                $y= $data['flag_order']; 
                                                                                $z= $data['flag_advertisement']; 
                                                                                if($data['application_type']=="FULL TREE CUT"){
                                                                                if($z==0){
                                                                                if($y==0 ){
                                                                                if(USER_ROLE==7 && $data['status']=='1' && $x && $data['cut_purpose']=="DANGEROUS CONDITION"){
                                                                                if($data['upload_tipnni']!=""){
                                                                                echo "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."orders/add?rec_id=".$data['id']."' target='_blank'> ADD ORDER</a>";
                                                                                }
                                                                                }
                                                                                }else{
                                                                                if($y!=0){
                                                                                if(USER_ROLE!=2){
                                                                                echo "<a class='btn btn-sm btn-info' href='".SITE_ADDR."orders/view/".$y."' target='_blank'>VIEW ORDER</a>";
                                                                                }
                                                                                } 
                                                                                }
                                                                                }
                                                                                }
                                                                            ?></span>
                                                                            <span><?php 
                                                                                $x= $data['flag_objection'];  
                                                                                if($x>0 ){
                                                                                echo "<a class='btn btn-sm btn-danger page-modal modal-page' href='".SITE_ADDR."objections/list?rec_id=".$data['id']."' target='_blank'> VIEW OBJECTIONS</a>";
                                                                                } 
                                                                                if($data['status']+0==2 && $data['application_type']=="FULL TREE CUT" && USER_ROLE==7){
                                                                                //send forward
                                                                                echo " <a class='btn btn-sm btn-danger' href='".SITE_ADDR."accept_reject/add?rec_id=".$data['id']."&db_name=application_form' >ACCEPT/REJECT (SEND TO HOD)</a>";
                                                                                }
                                                                            ?></span>
                                                                            <div class="mb-2">  
                                                                                <span class="font-weight-light text-muted ">
                                                                                    Timestamp / दिनांक आणि वेळ :  
                                                                                </span>
                                                                            <?php echo $data['timestamp']; ?></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                    <!--endrecord-->
                                                                </div>
                                                                <div class="row sm-gutters search-data" id="search-data-<?php echo $page_element_id; ?>"></div>
                                                                <div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if($show_footer == true){
                                                            ?>
                                                            <div class=" border-top mt-2">
                                                                <div class="row justify-content-center">    
                                                                    <div class="col-md-auto">   
                                                                    </div>
                                                                    <div class="col">   
                                                                        <?php
                                                                        if($show_pagination == true){
                                                                        $pager = new Pagination($total_records, $record_count);
                                                                        $pager->route = $this->route;
                                                                        $pager->show_page_count = true;
                                                                        $pager->show_record_count = true;
                                                                        $pager->show_page_limit =true;
                                                                        $pager->limit_count = $this->limit_count;
                                                                        $pager->show_page_number_list = true;
                                                                        $pager->pager_link_range=5;
                                                                        $pager->render();
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            }
                                                            else{
                                                            ?>
                                                            <div class="text-muted  animated bounce p-3">
                                                                <h4><i class="fa fa-ban"></i> No record found</h4>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
