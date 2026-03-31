<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("occupancy_certificate/add");
$can_edit = ACL::is_allowed("occupancy_certificate/edit");
$can_view = ACL::is_allowed("occupancy_certificate/view");
$can_delete = ACL::is_allowed("occupancy_certificate/delete");
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
                    <h4 class="record-title">View  Occupancy Certificate</h4>
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
                                    <tr  class="td-application_type">
                                        <th class="title"> Application Type: </th>
                                        <td class="value"> <?php echo $data['application_type']; ?></td>
                                    </tr>
                                    <tr  class="td-applicant_full_name">
                                        <th class="title"> Applicant Full Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['applicant_full_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="applicant_full_name" 
                                                data-title="ENTER APPLICANT FULL NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['applicant_full_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-applicant_address">
                                        <th class="title"> Applicant Address: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['applicant_address']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="applicant_address" 
                                                data-title="ENTER APPLICANT ADDRESS" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['applicant_address']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-property_owner_name">
                                        <th class="title"> Property Owner Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['property_owner_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="property_owner_name" 
                                                data-title="ENTER PROPERTY OWNER NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['property_owner_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ward">
                                        <th class="title"> Ward: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/occupancy_certificate_ward_option_list'); ?>' 
                                                data-value="<?php echo $data['ward']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="ward" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ward']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-address_of_plot">
                                        <th class="title"> Address Of Plot: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['address_of_plot']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="address_of_plot" 
                                                data-title="ENTER ADDRESS OF PLOT" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['address_of_plot']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-google_link">
                                        <th class="title"> Google Link: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['google_link']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="google_link" 
                                                data-title="ENTER GOOGLE LINK" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['google_link']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-no_of_trees_if_available">
                                        <th class="title"> No Of Trees If Available: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_of_trees_if_available']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="no_of_trees_if_available" 
                                                data-title="ENTER NO OF TREES" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_of_trees_if_available']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-architech_name">
                                        <th class="title"> Architech Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['architech_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="architech_name" 
                                                data-title="ENTER ARCHITECT NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['architech_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-architect_address">
                                        <th class="title"> Architect Address: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['architect_address']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="architect_address" 
                                                data-title="ENTER ARCHITECT ADDRESS" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['architect_address']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-architect_pin_code">
                                        <th class="title"> Architect Pin Code: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['architect_pin_code']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="architect_pin_code" 
                                                data-title="ENTER ARCHITECT PIN CODE" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['architect_pin_code']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-architect_mobile_number">
                                        <th class="title"> Architect Mobile Number: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-max="9999999999" 
                                                data-min="1000000000" 
                                                data-value="<?php echo $data['architect_mobile_number']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="architect_mobile_number" 
                                                data-title="ENTER ARCHITECT MOBILE NUMBER" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['architect_mobile_number']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-builder_name">
                                        <th class="title"> Builder Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['builder_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="builder_name" 
                                                data-title="ENTER BUILDER NAME " 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['builder_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-builder_address">
                                        <th class="title"> Builder Address: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['builder_address']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="builder_address" 
                                                data-title="ENTER BUILDER ADDRESS" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['builder_address']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-builder_pin_code">
                                        <th class="title"> Builder Pin Code: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['builder_pin_code']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="builder_pin_code" 
                                                data-title="ENTER BUILDER PIN CODE" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['builder_pin_code']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-builder_mobile_number">
                                        <th class="title"> Builder Mobile Number: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-max="9999999999" 
                                                data-min="1000000000" 
                                                data-value="<?php echo $data['builder_mobile_number']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="builder_mobile_number" 
                                                data-title="ENTER BUILDER MOBILE NUMBER" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['builder_mobile_number']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-plot_area_in_sq_mtr">
                                        <th class="title"> Plot Area In Sq Mtr: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['plot_area_in_sq_mtr']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="plot_area_in_sq_mtr" 
                                                data-title="ENTER PLOT AREA (Sq Mtr)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['plot_area_in_sq_mtr']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-phisical_colored_map_with_tree_located">
                                        <th class="title"> Phisical Colored Map With Tree Located: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['phisical_colored_map_with_tree_located']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="phisical_colored_map_with_tree_located" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['phisical_colored_map_with_tree_located']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-architech_application">
                                        <th class="title"> Architech Application: </th>
                                        <td class="value"> <?php echo $data['architech_application']; ?></td>
                                    </tr>
                                    <tr  class="td-google_map_with_polygone">
                                        <th class="title"> Google Map With Polygone: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['google_map_with_polygone']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="google_map_with_polygone" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['google_map_with_polygone']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-document_7_12">
                                        <th class="title"> Document 7 12: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['document_7_12']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="document_7_12" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['document_7_12']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-cc_number">
                                        <th class="title"> Cc Number: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['cc_number']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="cc_number" 
                                                data-title="ENTER CC APPLICATION NUMBER" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['cc_number']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['status']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="status" 
                                                data-title="Enter Status" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date">
                                        <th class="title"> Date: </th>
                                        <td class="value"> <?php echo $data['date']; ?></td>
                                    </tr>
                                    <tr  class="td-type_of_residence">
                                        <th class="title"> Type Of Residence: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/occupancy_certificate_type_of_residence_option_list'); ?>' 
                                                data-value="<?php echo $data['type_of_residence']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="type_of_residence" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['type_of_residence']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-oc_affidavit">
                                        <th class="title"> Oc Affidavit: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['oc_affidavit']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="oc_affidavit" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['oc_affidavit']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-trees_added">
                                        <th class="title"> Trees Added: </th>
                                        <td class="value"> <?php echo $data['trees_added']; ?></td>
                                    </tr>
                                    <tr  class="td-oc_application_id">
                                        <th class="title"> Oc Application Id: </th>
                                        <td class="value"> <?php echo $data['oc_application_id']; ?></td>
                                    </tr>
                                    <tr  class="td-cc_certificate_copy">
                                        <th class="title"> Cc Certificate Copy: </th>
                                        <td class="value"> <?php echo $data['cc_certificate_copy']; ?></td>
                                    </tr>
                                    <tr  class="td-application_no">
                                        <th class="title"> Application No: </th>
                                        <td class="value"> <?php echo $data['application_no']; ?></td>
                                    </tr>
                                    <tr  class="td-mobile_no">
                                        <th class="title"> Mobile No: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-max="9999999999" 
                                                data-min="1000000000" 
                                                data-value="<?php echo $data['mobile_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="mobile_no" 
                                                data-title="ENTER MOBILE NUMBER" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['mobile_no']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-latitude">
                                        <th class="title"> Latitude: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['latitude']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="latitude" 
                                                data-title="ENTER LATITUDE" 
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
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="longitude" 
                                                data-title="ENTER LONGITUDE" 
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
                                    <tr  class="td-current_tiimestamp">
                                        <th class="title"> Current Tiimestamp: </th>
                                        <td class="value"> <?php echo $data['current_tiimestamp']; ?></td>
                                    </tr>
                                    <tr  class="td-updated_timestamp">
                                        <th class="title"> Updated Timestamp: </th>
                                        <td class="value"> <?php echo $data['updated_timestamp']; ?></td>
                                    </tr>
                                    <tr  class="td-mouje">
                                        <th class="title"> Mouje: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['mouje']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="mouje" 
                                                data-title="ENTER MOUJE / VILLAGE NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['mouje']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-survey_no">
                                        <th class="title"> Survey No: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['survey_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("occupancy_certificate/editfield/" . urlencode($data['oc_id'])); ?>" 
                                                data-name="survey_no" 
                                                data-title="ENTER SURVEY NUMBER" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['survey_no']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                            <a class="btn  btn-sm btn-primary export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                </a>
                                <?php if($can_edit){ ?>
                                <a class="btn btn-sm btn-info"  href="<?php print_link("occupancy_certificate/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("occupancy_certificate/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
