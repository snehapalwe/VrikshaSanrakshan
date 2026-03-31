<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("objections/add");
$can_edit = ACL::is_allowed("objections/edit");
$can_view = ACL::is_allowed("objections/view");
$can_delete = ACL::is_allowed("objections/delete");
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
                    <h4 class="record-title">Objections</h4>
                </div>
                <div class="col-sm-3 ">
                    <a  class="btn btn-primary" href="<?php print_link("objections/add") ?>">
                        Add New Objection 
                    </a>
                </div>
                <div class="col-sm-4 ">
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
                                    <a class="text-decoration-none" href="<?php print_link('objections'); ?>">
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
                                    <a class="text-decoration-none" href="<?php print_link('objections'); ?>">
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
                        <div id="objections-list-records">
                            <div id="page-report-body" class="table-responsive">
                                <table class="table  table-striped table-sm text-left">
                                    <thead class="table-header bg-light">
                                        <tr>
                                            <th class="td-sno">#</th>
                                            <th  class="td-name_of_applicant"> Name Of Applicant/अर्जदाराचे नाव</th>
                                            <th  class="td-mobile"> Mobile/मोबाईल</th>
                                            <th  class="td-email"> Email/ईमेल</th>
                                            <th  class="td-date_of_ad"> Date Of Ad/जाहिरातीची तारीख</th>
                                            <th  class="td-name_of_news_paper"> Name Of News Paper/वृत्तपत्राचे नाव</th>
                                            <th  class="td-description"> Description/वर्णन</th>
                                            <th  class="td-upload_attachment"> Upload Attachment/संलग्नक अपलोड करा</th>
                                            <th  class="td-meeting_date"> Meeting Date/बैठकीची तारीख</th>
                                            <th  class="td-meeting_time"> Meeting Time/भेटीची वेळ</th>
                                            <th  class="td-resolution"> Resolution/ठराव</th>
                                            <th  class="td-upload"> Upload/अपलोड करा</th>
                                            <th  class="td-remark"> Remark/शेरा</th>
                                            <th  class="td-timestamp"> Timestamp/टाईमस्टॅम्प</th>
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
                                            <td class="td-name_of_applicant"> <?php echo $data['name_of_applicant']; ?></td>
                                            <td class="td-mobile"> <?php echo $data['mobile']; ?></td>
                                            <td class="td-email"> <?php echo $data['email']; ?></td>
                                            <td class="td-date_of_ad"> <?php echo $data['date_of_ad']; ?></td>
                                            <td class="td-name_of_news_paper"> <?php echo $data['name_of_news_paper']; ?></td>
                                            <td class="td-description"> <?php echo $data['description']; ?></td>
                                            <td class="td-upload_attachment"><?php Html :: page_link_file($data['upload_attachment']); ?></td>
                                            <td class="td-meeting_date"> <?php echo $data['meeting_date']; ?></td>
                                            <td class="td-meeting_time"> <span><?php echo $x=$data['meeting_time'];
                                                $can_edit=1;
                                                if($x!=""){
                                                $can_edit=0;
                                                }
                                                if(USER_ROLE!=7){
                                                $can_edit=0;
                                                }
                                            ?></span></td>
                                            <td class="td-resolution"> <span><?php echo $y=$data['resolution']; 
                                                if($x!="" && $y=="" && USER_ROLE==7){
                                                echo "<a class='btn btn-sm btn-danger' href='".SITE_ADDR."objections/edit2/".$data['id']."'>MAKE A RESOLUTION</a>";
                                                }
                                            ?></span></td>
                                            <td class="td-upload"><?php Html :: page_link_file($data['upload']); ?></td>
                                            <td class="td-remark"> <?php echo $data['remark']; ?></td>
                                            <td class="td-timestamp"> <?php echo $data['timestamp']; ?></td>
                                            <th class="td-btn">
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("objections/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Give Meeting Date
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
