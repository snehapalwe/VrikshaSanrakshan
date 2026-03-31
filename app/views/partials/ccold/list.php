<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("commencement_certificate/add");
$can_edit = ACL::is_allowed("commencement_certificate/edit");
$can_view = ACL::is_allowed("commencement_certificate/view");
$can_delete = ACL::is_allowed("commencement_certificate/delete");
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
                    <h4 class="record-title">Commencement Certificate</h4>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('commencement_certificate'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('commencement_certificate'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('commencement_certificate'); ?>">
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
                            <div id="commencement_certificate-list-records">
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
                                                <?php if (!empty($data['application_no'])): ?>
                                                <div class="mb-2">
                                                    <strong style="font-weight: 500 !important; color: #000 !important;">
                                                        Application No.:
                                                    </strong>  
                                                    <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                        <?php echo $data['application_no']; ?>
                                                    </span>
                                                </div>
                                                <?php endif; ?>
                                                <span>
                                                    <?php 
                                                    // echo $data['status'];
                                                    // echo "<br>";
                                                        $x = $data['status']+0;
                                                        if($data['paid_1']>0){
                                                        echo "<a class='btn btn-sm btn-success' href='" . SITE_ADDR . "payments/view/" . $data['paid_1'] . "'>View Payment Receipt</a><br>"; 
                                                            }
                                                            if($data['paid_2']>0){
                                                            echo "<a class='btn btn-sm btn-info' href='" . SITE_ADDR . "payments/view/" . $data['paid_2'] . "'>View Demand Receipt</a><br>"; 
                                                                }
                                                                if ($x == -2) { 
                                                                echo "<b><span class='text-danger'>REJECTED</span></b><br>";
                                                                    }
                                                                if ($x == -3) { 
                                                                echo "<b><span class='text-danger'>CANCELLED</span></b><br>";
                                                                    }
                                                                    if ($x == -1) {
                                                                    echo "<b><span class='text-danger'>UPLOAD TREE PHOTOS</span></b><br>";
                                                                        }
                                                                        if ($x == 2) {
                                                                              if (USER_ROLE != 7) {
                                                                                    echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "api/cancel_appl/commencement_certificate/" . $data['id'] . "' onclick=\"return confirm('Are you sure you want to cancel this application?');\">Cancel Application</a><br>";
                                                                              }
                                                                        echo "<b><span class='text-danger'>Pending at CG - Please visit KDMC Office for payment</span></b><br>";
                                                                            if (USER_ROLE == 7) {
                                                                            echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "payments/add3/?db_name=commencement_certificate&rec_id=" . $data['id'] . "&recieved_from=".$data['applicant_full_name']."'>Make Payment</a><br>";
                                                                                }
                                                                                }
                                                                                if ($x == 7) {
                                                                                    
                                                                                    
                                                                                if (USER_ROLE == 7) {
                                                                                if ($data['no_of_trees_if_available'] > $data['trees_added']){
                                                                                // if ($data['trees_added'] == 0){
                                                                                echo "<b>Add Tree Photo To Proceed</b><br>";
                                                                                    echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "cc_photo_inspection/add?rec_id=" . $data['id'] . "'>Add Photo</a><br>";
                                                                                        }
                                                                                        echo "<br><a class='btn btn-sm btn-warning' href='" . SITE_ADDR . "cc_photo_inspection/list?rec_id=" . $data['id'] . "'>View Tree Photo</a><br>";
                                                                                            if ($data['no_of_trees_if_available'] <= $data['trees_added']){
                                                                                            if (!isset($data['inspection_report_by_cg']) || trim($data['inspection_report_by_cg']) === '') {
                                                                                            echo "<a href='" . SITE_ADDR . "commencement_certificate/inspection_report_upload/" . $data['id'] . "' class='btn btn-danger btn-sm'>Upload Inspection Report</a><br>";
                                                                                                }else{
                                                                                                echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "accept_reject2/add/?db_name=commencement_certificate&rec_id=" . $data['id'] . "'>ACCEPT/REJECT</a><br>";
                                                                                                    }
                                                                                                    }
                                                                                                    }
                                                                                                    echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>PENDING AT CG</span>";
                                                                                                    }
                                                                                                    if ($x == 9) {
                                                                                                    echo "<br><a class='btn btn-sm btn-warning' href='" . SITE_ADDR . "cc_photo_inspection/list?rec_id=" . $data['id'] . "'>View Tree Photo</a><br>";
                                                                                                        if(USER_ROLE==2){
                                                                                                        if ($data['demand'] == "YES") {
                                                                                                        echo "<a class='btn btn-sm btn-danger' href='#' onclick='#'>Pay Demand (Rs. ".$data['amount'].") by visiting KDMC Office</a><br>";
                                                                                                            }
                                                                                                            }
                                                                                                            if (USER_ROLE == 9) {
                                                                                                            if (!isset($data['demand']) || trim($data['demand']) === '') {
                                                                                                            echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "commencement_certificate/demand_button/" . $data['id'] . "'>Demand</a><br>";
                                                                                                                }
                                                                                                                if ($data['demand'] == "YES") {
                                                                                                                echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "payments/add4/?db_name=commencement_certificate&rec_id=" . $data['id'] . "&amount=".$data['amount']."&recieved_from=".$data['applicant_full_name']."'>Pay Demand (Rs. ".$data['amount'].")</a><br>";
                                                                                                                    }else if($data['demand'] == "NO"){
                                                                                                                    if (!isset($data['tippni_data']) || trim($data['tippni_data']) === '') {
                                                                                                                    if(USER_ROLE == 9){
                                                                                                                    echo "<a href='" . SITE_ADDR . "commencement_certificate/tippni_data/" . $data['id'] . "' class='btn btn-danger btn-sm'>Add Tippni Data</a><br>";
                                                                                                                        }
                                                                                                                        }
                                                                                                                        if (isset($data['tippni_data']) && trim($data['tippni_data']) != '') {
                                                                                                                        echo "<a class='btn btn-sm btn-success' href='" . SITE_ADDR . "commencement_certificate/tippni/" . $data['id'] . "'>Generate Tippni</a><br>";
                                                                                                                            echo "<a href='" . SITE_ADDR . "commencement_certificate/tippni_upload/" . $data['id'] . "' class='btn btn-danger btn-sm'>Upload Tippni </a><br><br>";
                                                                                                                                } 
                                                                                                                                if (isset($data['tippni_upload']) && trim($data['tippni_upload']) !== '' ) { //&& 0
                                                                                                                                // echo "<a class='btn btn-sm btn-success' href='" . SITE_ADDR . "commencement_certificate/permission/" . $data['id'] . "'>Generate Permission</a><br>";
                                                                                                                                    // echo "<a href='" . SITE_ADDR . "commencement_certificate/permission_upload/" . $data['id'] . "' class='btn btn-success btn-sm'>Upload Permission </a><br>";
                                                                                                                                        echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "accept_reject2/add/?db_name=commencement_certificate&rec_id=" . $data['id'] . "'>ACCEPT/REJECT</a><br>";
                                                                                                                                            }
                                                                                                                                            }
                                                                                                                                            }
                                                                                                                                            echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>PENDING AT GS</span>";
                                                                                                                                            }
                                                                                                                                            if($x == 13){
                                                                                                                                            echo "<br><a class='btn btn-sm btn-warning' href='" . SITE_ADDR . "cc_photo_inspection/list?rec_id=" . $data['id'] . "'>View Tree Photo</a><br>";
                                                                                                                                                if(USER_ROLE == 9){
                                                                                                                                                if (!isset($data['tippni_data']) || trim($data['tippni_data']) === '') {
                                                                                                                                                echo "<a href='" . SITE_ADDR . "commencement_certificate/tippni_data/" . $data['id'] . "' class='btn btn-success btn-sm'>Add Tippni Data</a><br>";
                                                                                                                                                    }
                                                                                                                                                    if (isset($data['tippni_data']) && trim($data['tippni_data']) != '') {
                                                                                                                                                    echo "<a class='btn btn-sm btn-success' href='" . SITE_ADDR . "commencement_certificate/tippni/" . $data['id'] . "'>Generate Tippni</a><br>";
                                                                                                                                                        echo "<a href='" . SITE_ADDR . "commencement_certificate/tippni_upload/" . $data['id'] . "' class='btn btn-warning btn-sm'>Upload Tippni </a><br><br>";
                                                                                                                                                            } 
                                                                                                                                                            if (isset($data['tippni_upload']) && trim($data['tippni_upload']) !== '' ) { //&& 0
                                                                                                                                                            // echo "<a class='btn btn-sm btn-success' href='" . SITE_ADDR . "commencement_certificate/permission/" . $data['id'] . "'>Generate Permission</a><br>";
                                                                                                                                                                // echo "<a href='" . SITE_ADDR . "commencement_certificate/permission_upload/" . $data['id'] . "' class='btn btn-success btn-sm'>Upload Permission </a><br>";
                                                                                                                                                                    echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "accept_reject2/add/?db_name=commencement_certificate&rec_id=" . $data['id'] . "'>ACCEPT/REJECT</a><br>";
                                                                                                                                                                        }
                                                                                                                                                                        } 
                                                                                                                                                                        echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>PENDING AT GS</span>";
                                                                                                                                                                        }
                                                                                                                                                                        if ($x == 10) {
                                                                                                                                                                        echo "<br><a class='btn btn-sm btn-warning' href='" . SITE_ADDR . "cc_photo_inspection/list?rec_id=" . $data['id'] . "'>View Tree Photo</a><br>";
                                                                                                                                                                            if (USER_ROLE == 10) {
                                                                                                                                                                            echo "<a class='btn btn-sm btn-danger' href='" . SITE_ADDR . "accept_reject2/add/?db_name=commencement_certificate&rec_id=" . $data['id'] . "'>ACCEPT/REJECT</a><br>";
                                                                                                                                                                                }
                                                                                                                                                                                echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>PENDING AT DMC</span>";
                                                                                                                                                                                }
                                                                                                                                                                                if (USER_ROLE == 9) {
                                                                                                                                                                                if ( $data['permission_upload'] == '' && $data['status']+0==11) {
                                                                                                                                                                                echo "<a class='btn btn-sm btn-success' href='" . SITE_ADDR . "commencement_certificate/permission/" . $data['id'] . "'>Generate Permission</a><br>";
                                                                                                                                                                                    echo "<a href='" . SITE_ADDR . "commencement_certificate/permission_upload/" . $data['id'] . "' class='btn btn-danger btn-sm'>Upload Permission </a><br>"; 
                                                                                                                                                                                        }
                                                                                                                                                                                        }
                                                                                                                                                                                        if ($x == "11") {
                                                                                                                                                                                        echo "<br><a class='btn btn-sm btn-warning' href='" . SITE_ADDR . "cc_photo_inspection/list?rec_id=" . $data['id'] . "'>View Tree Photo</a><br>";
                                                                                                                                                                                            $cert_up=0;
                                                                                                                                                                                            if (!empty($data['permission_upload'])) {
                                                                                                                                                                                            echo "<br><a href='" . $data['permission_upload'] . "' target='_blank' class='btn btn-sm btn-success'>View Permission</a><br>";
                                                                                                                                                                                                $cert_up=1;
                                                                                                                                                                                                }
                                                                                                                                                                                                if($cert_up){
                                                                                                                                                                                                echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>PROCESS COMPLETED</span>";
                                                                                                                                                                                                }else{
                                                                                                                                                                                                echo "<span style='font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;'>PROCESS COMPLETED - UPLOAD PENDING AT GS</span>";
                                                                                                                                                                                                }
                                                                                                                                                                                                }
                                                                                                                                                                                                if($data['tippni_upload']!="" && USER_ROLE!=2){ 
                                                                                                                                                                                                echo "<br><a href='" . $data['tippni_upload'] . "' class='btn btn-success btn-sm'>View Tippni </a><br><br>";
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>
                                                                                                                                                                                                </span>
                                                                                                                                                                                                <?php
                                                                                                                                                                                                if (isset($data['inspection_report_by_cg']) && trim($data['inspection_report_by_cg']) !== '')
                                                                                                                                                                                                echo "<br><a href='".$data['inspection_report_by_cg']."' class='btn btn-success'>Inspection Report/ पाहणी अहवाल</a>"; 
                                                                                                                                                                                                    ?>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Type Of Residence:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['type_of_residence']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Applicant Full Name:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['applicant_full_name']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Mobile No:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['mobile_no']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Applicant Address:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['applicant_address']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Property Owner Name:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['property_owner_name']; ?></div>
                                                                                                                                                                                                    <?php if (!empty($data['ward'])): ?>
                                                                                                                                                                                                    <div class="mb-2">
                                                                                                                                                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                                                                                                            Ward:
                                                                                                                                                                                                        </strong>  
                                                                                                                                                                                                        <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                                                                                                                                                                            <?php echo $data['ward']; ?>
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Address Of Plot:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['address_of_plot']; ?></div>
                                                                                                                                                                                                    <?php
                                                                                                                                                                                                    $link = $data['google_link'];
                                                                                                                                                                                                    // Ensure it starts with http:// or https://
                                                                                                                                                                                                    if (!preg_match('/^https?:\/\//', $link)) {
                                                                                                                                                                                                    $link = 'https://' . $link;  // or 'http://' based on expected input
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>
                                                                                                                                                                                                    <a href="<?php echo htmlspecialchars($link); ?>" target="_blank">
                                                                                                                                                                                                        <button class='btn btn-success' type="button">Open Google Link</button>
                                                                                                                                                                                                    </a>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            No Of Trees :  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['no_of_trees_if_available']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Trees Added:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['trees_added']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Architech Name:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['architech_name']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Architect Address:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['architect_address']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Architect Pin Code:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['architect_pin_code']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Architect Mobile Number:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['architect_mobile_number']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Builder Name:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['builder_name']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Builder Address:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['builder_address']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Builder Pin Code:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['builder_pin_code']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Builder Mobile Number:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['builder_mobile_number']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Plot Area In Sq Mtr:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['plot_area_in_sq_mtr']; ?></div>
                                                                                                                                                                                                    <?php if (!empty($data['phisical_colored_map_with_tree_located'])): ?>
                                                                                                                                                                                                    <div class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                                                                                                                                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                                                                                                            Physical Colored Map Tree:
                                                                                                                                                                                                        </strong>  
                                                                                                                                                                                                        <a href="<?php echo htmlspecialchars($data['phisical_colored_map_with_tree_located'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                                                                                                            target="_blank" onclick="return autoPrintImage(this.href);"
                                                                                                                                                                                                            class="btn btn-info btn-sm">
                                                                                                                                                                                                            View Map
                                                                                                                                                                                                        </a>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                                    <?php if (!empty($data['architech_application'])): ?>
                                                                                                                                                                                                    <div class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                                                                                                                                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                                                                                                            Architech Application:
                                                                                                                                                                                                        </strong>  
                                                                                                                                                                                                        <a href="<?php echo htmlspecialchars($data['architech_application'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                                                                                                            target="_blank" onclick="return autoPrintImage(this.href);"
                                                                                                                                                                                                            class="btn btn-info btn-sm">
                                                                                                                                                                                                            View Application Doc
                                                                                                                                                                                                        </a>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                                    <?php if (!empty($data['google_map_with_polygone'])): ?>
                                                                                                                                                                                                    <div class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                                                                                                                                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                                                                                                            Google Map With Polygone:
                                                                                                                                                                                                        </strong>  
                                                                                                                                                                                                        <a href="<?php echo htmlspecialchars($data['google_map_with_polygone'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                                                                                                            target="_blank" onclick="return autoPrintImage(this.href);"
                                                                                                                                                                                                            class="btn btn-info btn-sm">
                                                                                                                                                                                                            View Map
                                                                                                                                                                                                        </a>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                                    <?php if (!empty($data['document_7_12_'])): ?>
                                                                                                                                                                                                    <div class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                                                                                                                                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                                                                                                            7_12 Document:
                                                                                                                                                                                                        </strong>  
                                                                                                                                                                                                        <a href="<?php echo htmlspecialchars($data['document_7_12_'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                                                                                                            target="_blank" onclick="return autoPrintImage(this.href);"
                                                                                                                                                                                                            class="btn btn-info btn-sm">
                                                                                                                                                                                                            View 7_12 Doc
                                                                                                                                                                                                        </a>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                                    <?php if (!empty($data['cc_affidavit'])): ?>
                                                                                                                                                                                                    <div class="mb-2" style="display: flex; justify-content: space-between; align-items: center;">
                                                                                                                                                                                                        <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                                                                                                            CC Affidavit:
                                                                                                                                                                                                        </strong>  
                                                                                                                                                                                                        <a href="<?php echo htmlspecialchars($data['cc_affidavit'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                                                                                                            target="_blank" onclick="return autoPrintImage(this.href);"
                                                                                                                                                                                                            class="btn btn-info btn-sm">
                                                                                                                                                                                                            View Affidavit
                                                                                                                                                                                                        </a>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <?php endif; ?>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Date:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['date']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Latitude:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['latitude']; ?></div>
                                                                                                                                                                                                    <div class="mb-2">  
                                                                                                                                                                                                        <span class="font-weight-light text-muted ">
                                                                                                                                                                                                            Longitude:  
                                                                                                                                                                                                        </span>
                                                                                                                                                                                                    <?php echo $data['longitude']; ?></div>
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
