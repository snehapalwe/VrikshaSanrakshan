<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("photo_of_inspection/add");
$can_edit = ACL::is_allowed("photo_of_inspection/edit");
$can_view = ACL::is_allowed("photo_of_inspection/view");
$can_delete = ACL::is_allowed("photo_of_inspection/delete");
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
                    <h4 class="record-title">View  Photo Of Inspection</h4>
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
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-latitude">
                                        <th class="title"> Latitude: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['latitude']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("photo_of_inspection/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="latitude" 
                                                data-title="Enter Latitude" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['latitude']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-longitude">
                                        <th class="title"> Longitude: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['longitude']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("photo_of_inspection/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="longitude" 
                                                data-title="Enter Longitude" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['longitude']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-upload_photo_of_tree">
                                        <th class="title"> Upload Photo Of Tree: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['upload_photo_of_tree']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("photo_of_inspection/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="upload_photo_of_tree" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['upload_photo_of_tree']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-width">
                                        <th class="title"> Width: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="any" 
                                                data-value="<?php echo $data['width']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("photo_of_inspection/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="width" 
                                                data-title="Enter Width" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['width']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-height">
                                        <th class="title"> Height: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="any" 
                                                data-value="<?php echo $data['height']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("photo_of_inspection/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="height" 
                                                data-title="Enter Height" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['height']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-feet">
                                        <th class="title"> Feet: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="any" 
                                                data-value="<?php echo $data['feet']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("photo_of_inspection/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="feet" 
                                                data-title="Enter Feet" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['feet']; ?> 
                                            </span>
                                        </td>
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
                                <a class="btn btn-sm btn-info"  href="<?php print_link("photo_of_inspection/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("photo_of_inspection/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
