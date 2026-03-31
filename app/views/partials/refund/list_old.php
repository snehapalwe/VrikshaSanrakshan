<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("refund/add");
$can_edit = ACL::is_allowed("refund/edit");
$can_view = ACL::is_allowed("refund/view");
$can_delete = ACL::is_allowed("refund/delete");
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
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Refund</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("refund/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Add New Refund 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('refund'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('refund'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('refund'); ?>">
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
                            <div id="refund-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-sno">#</th>
                                                <th  class="td-application_id"> Application Id</th>
                                                <th  class="td-tree_photo"> Tree Photos</th>
                                                <th  class="td-status"> Status</th>
                                                <th  class="td-amount"> Amount</th>
                                                <th  class="td-date_of_permission"> Date Of Permission</th>
                                                <th  class="td-no_of_tree_cut"> No Of Tree Cut</th>
                                                <th  class="td-no_of_tree_planted"> No Of Tree Planted</th>
                                                <th  class="td-upload_original_reciept"> Upload Original Reciept</th>
                                                <th  class="td-complete_address_of_plantation"> Complete Address Of Plantation</th>
                                                <th  class="td-bank_name"> Bank Name</th>
                                                <th  class="td-account_number"> Account Number</th>
                                                <th  class="td-ifsc_code"> Ifsc Code</th>
                                                <th  class="td-account_holder_name"> Account Holder Name</th>
                                                <th  class="td-timestamp"> Timestamp</th>
                                                <th  class="td-flag_inspection"> Flag Inspection</th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <th class="td-sno"><?php echo $counter; ?></th>
                                                <td class="td-application_id"> <?php echo $data['application_id']; ?></td>
                                                <td class="td-tree_photo"> <span><a class='btn btn-sm btn-success' href='<?php echo SITE_ADDR  ?>report_of_tree/?rec_id=<?php echo $data['id'] ?>'>PLANTATION PHOTOS</a></span></td>
                                                <td class="td-status"> <span><?php  $s=$data['status']; 
                                                    if(USER_ROLE==3){
                                                    $can_edit=1;
                                                    }
                                                    if($s==0){
                                                    echo "UPLOAD TREE PHOTOS";
                                                    }
                                                    if($s==1){
                                                    echo "PENDING AT AUTH 1";
                                                    if($data['flag_inspection']>0 && USER_ROLE==4){
                                                    echo "<a class='btn btn-sm btn-success'  href='".SITE_ADDR."refund/edit2/".$data['id']."'>TAKE A ACTION</a>";
                                                    }
                                                    }
                                                    if($s==2){
                                                    echo "PENDING AT HOD";
                                                    }
                                                    if($s==-1){
                                                    echo "REJECT  ";
                                                    $can_edit=0;
                                                    }
                                                    if($s==3){
                                                    echo "ACCEPT BY HOD";
                                                    $can_edit=0;
                                                    }
                                                ?></span></td>
                                                <td class="td-amount"> <?php echo $data['amount']; ?></td>
                                                <td class="td-date_of_permission"> <?php echo $data['date_of_permission']; ?></td>
                                                <td class="td-no_of_tree_cut"> <?php echo $data['no_of_tree_cut']; ?></td>
                                                <td class="td-no_of_tree_planted"> <?php echo $data['no_of_tree_planted']; ?></td>
                                                <td class="td-upload_original_reciept"><?php Html :: page_link_file($data['upload_original_reciept']); ?></td>
                                                <td class="td-complete_address_of_plantation"> <?php echo $data['complete_address_of_plantation']; ?></td>
                                                <td class="td-bank_name"> <?php echo $data['bank_name']; ?></td>
                                                <td class="td-account_number"> <?php echo $data['account_number']; ?></td>
                                                <td class="td-ifsc_code"> <?php echo $data['ifsc_code']; ?></td>
                                                <td class="td-account_holder_name"> <?php echo $data['account_holder_name']; ?></td>
                                                <td class="td-timestamp"> <?php echo $data['timestamp']; ?></td>
                                                <td class="td-flag_inspection"> <?PHP if(USER_ROLE==4 || $data['flag_inspection']>0){?> <span><a class='btn btn-sm btn-info' href='<?php echo SITE_ADDR  ?>photo_of_inspection_refund/?rec_id=<?php echo $data['id'] ?>'>TREE INSPECTION PHOTOS</a></span>
                                                    </span><?php } ?> <span><?php 
                                                    $x= $data['flag_inspection']; 
                                                    if($x==0){
                                                    if(USER_ROLE==4 ){
                                                    echo "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."refund_inspection/add?rec_id=".$data['id']."' target='_blank'>INSPECTION</a>";}
                                                    }else{
                                                    echo "<a class='btn btn-sm btn-warning' href='".SITE_ADDR."refund_inspection/view/".$x."' target='_blank'>INSPECTION</a>";
                                                    }
                                                    ?>
                                                </td>
                                                <th class="td-btn">
                                                    <?php if($can_view){ ?>
                                                    <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("refund/view/$rec_id"); ?>">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_edit){ ?>
                                                    <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("refund/edit/$rec_id"); ?>">
                                                        <i class="fa fa-edit"></i> Approve 
                                                    </a>
                                                    <?php } ?>
                                                </th>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <!--endrecord-->
                                        </tbody>
                                        <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <?php 
                                    if(empty($records)){
                                    ?>
                                    <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                        <i class="fa fa-ban"></i> No record found
                                    </h4>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if( $show_footer && !empty($records)){
                                ?>
                                <div class=" border-top mt-2">
                                    <div class="row justify-content-center">    
                                        <div class="col-md-auto justify-content-center">    
                                            <div class="p-3 d-flex justify-content-between">    
                                                <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                <a class="btn  btn-sm btn-primary export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                    </a>
                                                </div>
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
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
