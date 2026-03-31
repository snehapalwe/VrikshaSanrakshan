<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("objections/add");
$can_edit = ACL::is_allowed("objections/edit");
$can_view = ACL::is_allowed("objections/view");
$can_delete = ACL::is_allowed("objections/delete");
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
                    <h4 class="record-title">View  Objections</h4>
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
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-name_of_applicant">
                                        <th class="title"> Name Of Applicant: </th>
                                        <td class="value"> <?php echo $data['name_of_applicant']; ?></td>
                                    </tr>
                                    <tr  class="td-mobile">
                                        <th class="title"> Mobile: </th>
                                        <td class="value"> <?php echo $data['mobile']; ?></td>
                                    </tr>
                                    <tr  class="td-email">
                                        <th class="title"> Email: </th>
                                        <td class="value"> <?php echo $data['email']; ?></td>
                                    </tr>
                                    <tr  class="td-date_of_ad">
                                        <th class="title"> Date Of Ad: </th>
                                        <td class="value"> <?php echo $data['date_of_ad']; ?></td>
                                    </tr>
                                    <tr  class="td-name_of_news_paper">
                                        <th class="title"> Name Of News Paper: </th>
                                        <td class="value"> <?php echo $data['name_of_news_paper']; ?></td>
                                    </tr>
                                    <tr  class="td-description">
                                        <th class="title"> Description: </th>
                                        <td class="value"> <?php echo $data['description']; ?></td>
                                    </tr>
                                    <tr  class="td-upload_attachment">
                                        <th class="title"> Upload Attachment: </th>
                                        <td class="value"><?php Html :: page_link_file($data['upload_attachment']); ?></td>
                                    </tr>
                                    <tr  class="td-meeting_date">
                                        <th class="title"> Meeting Date: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '<?php echo date_now(); ?>', maxDate: ''}" 
                                                data-value="<?php echo $data['meeting_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("objections/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="meeting_date" 
                                                data-title="Enter Meeting Date/बैठकीची तारीख" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['meeting_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-meeting_time">
                                        <th class="title"> Meeting Time: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['meeting_time']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("objections/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="meeting_time" 
                                                data-title="Enter Meeting Time/भेटीची वेळ" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="time" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['meeting_time']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-resolution">
                                        <th class="title"> Resolution: </th>
                                        <td class="value"> <?php echo $data['resolution']; ?></td>
                                    </tr>
                                    <tr  class="td-upload">
                                        <th class="title"> Upload: </th>
                                        <td class="value"><?php Html :: page_link_file($data['upload']); ?></td>
                                    </tr>
                                    <tr  class="td-remark">
                                        <th class="title"> Remark: </th>
                                        <td class="value"> <?php echo $data['remark']; ?></td>
                                    </tr>
                                    <tr  class="td-timestamp">
                                        <th class="title"> Timestamp: </th>
                                        <td class="value"> <?php echo $data['timestamp']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                            <a class="btn  btn-sm btn-primary export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                </a>
                                <?php if($can_edit){ ?>
                                <a class="btn btn-sm btn-info"  href="<?php print_link("objections/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("objections/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                    <i class="fa fa-times"></i> Delete
                                </a>
                                <?php } ?>
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
