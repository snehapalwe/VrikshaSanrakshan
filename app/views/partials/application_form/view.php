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
                                        <th class="title"> Application Id / अर्ज क्र: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-applicant_name">
                                        <th class="title"> Applicant Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['applicant_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="applicant_name" 
                                                data-title="Enter Applicant Full Name / अर्जदाराचे संपूर्ण नाव" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['applicant_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-location_of_tree">
                                        <th class="title"> Location Of Tree: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['location_of_tree']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="location_of_tree" 
                                                data-title="Enter Address of Tree / झाडाचा पत्ता" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['location_of_tree']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-no_of_trees">
                                        <th class="title"> No Of Trees: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_of_trees']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="no_of_trees" 
                                                data-title="Enter No Of Trees / झाडांची संख्या" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_of_trees']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-cut_purpose">
                                        <th class="title"> Cut Purpose: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $cut_purpose); ?>' 
                                                data-value="<?php echo $data['cut_purpose']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="cut_purpose" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['cut_purpose']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-amount">
                                        <th class="title"> Amount: </th>
                                        <td class="value"> <?php echo $data['amount']; ?></td>
                                    </tr>
                                    <tr  class="td-extract_7_12">
                                        <th class="title"> Extract 7 12: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['extract_7_12']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="extract_7_12" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['extract_7_12']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-noc_of_property">
                                        <th class="title"> Noc Of Property: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['noc_of_property']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="noc_of_property" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['noc_of_property']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tree_dimensions">
                                        <th class="title"> Tree Dimensions: </th>
                                        <td class="value"> <?php echo $data['tree_dimensions']; ?></td>
                                    </tr>
                                    <tr  class="td-tree_color_photo">
                                        <th class="title"> Tree Color Photo: </th>
                                        <td class="value"> <?php echo $data['tree_color_photo']; ?></td>
                                    </tr>
                                    <tr  class="td-reason_to_cut_tree">
                                        <th class="title"> Reason To Cut Tree: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['reason_to_cut_tree']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="reason_to_cut_tree" 
                                                data-title="Enter Reason To Cut Tree / झाड कापण्याचे कारण" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['reason_to_cut_tree']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-timestamp">
                                        <th class="title"> Timestamp: </th>
                                        <td class="value"> <?php echo $data['timestamp']; ?></td>
                                    </tr>
                                    <tr  class="td-details">
                                        <th class="title"> Details: </th>
                                        <td class="value"> <?php echo $data['details']; ?></td>
                                    </tr>
                                    <tr  class="td-name_of_person_present">
                                        <th class="title"> Name Of Person Present: </th>
                                        <td class="value"> <?php echo $data['name_of_person_present']; ?></td>
                                    </tr>
                                    <tr  class="td-photo_upload">
                                        <th class="title"> Photo Upload: </th>
                                        <td class="value"><?php Html :: page_link_file($data['photo_upload']); ?></td>
                                    </tr>
                                    <tr  class="td-application_type">
                                        <th class="title"> Application Type: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $application_type); ?>' 
                                                data-value="<?php echo $data['application_type']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="application_type" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['application_type']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-subject">
                                        <th class="title"> Subject: </th>
                                        <td class="value"> <?php echo $data['subject']; ?></td>
                                    </tr>
                                    <tr  class="td-upload">
                                        <th class="title"> Upload: </th>
                                        <td class="value"> <?php echo $data['upload']; ?></td>
                                    </tr>
                                    <tr  class="td-city_survey_number">
                                        <th class="title"> City Survey Number: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['city_survey_number']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="city_survey_number" 
                                                data-title="Enter City Survey Number / शहर सर्वे नंबर " 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['city_survey_number']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-peth">
                                        <th class="title"> Peth: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/application_form_peth_option_list'); ?>' 
                                                data-value="<?php echo $data['peth']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="peth" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['peth']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-advertisement_fees">
                                        <th class="title"> Advertisement Fees: </th>
                                        <td class="value"> <?php echo $data['advertisement_fees']; ?></td>
                                    </tr>
                                    <tr  class="td-flag_inspection">
                                        <th class="title"> Flag Inspection: </th>
                                        <td class="value"> <?php echo $data['flag_inspection']; ?></td>
                                    </tr>
                                    <tr  class="td-flag_payment">
                                        <th class="title"> Flag Payment: </th>
                                        <td class="value"> <?php echo $data['flag_payment']; ?></td>
                                    </tr>
                                    <tr  class="td-flag_order">
                                        <th class="title"> Flag Order: </th>
                                        <td class="value"> <?php echo $data['flag_order']; ?></td>
                                    </tr>
                                    <tr  class="td-flag_advertisement">
                                        <th class="title"> Flag Advertisement: </th>
                                        <td class="value"> <?php echo $data['flag_advertisement']; ?></td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span title="<?php echo human_datetime($data['status']); ?>" class="has-tooltip">
                                                <?php echo relative_date($data['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-flag_objection">
                                        <th class="title"> Flag Objection: </th>
                                        <td class="value"> <?php echo $data['flag_objection']; ?></td>
                                    </tr>
                                    <tr  class="td-property_owner_name">
                                        <th class="title"> Property Owner Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['property_owner_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="property_owner_name" 
                                                data-title="Enter Property Owner Name/मालमत्तेच्या मालकाचे नाव" 
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
                                    <tr  class="td-applicant_address">
                                        <th class="title"> Applicant Address: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['applicant_address']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="applicant_address" 
                                                data-title="Enter Applicant Address / अर्जदाराचा पत्ता" 
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
                                    <tr  class="td-mobile_no">
                                        <th class="title"> Mobile No: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-max="9999999999" 
                                                data-min="1000000000" 
                                                data-value="<?php echo $data['mobile_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="mobile_no" 
                                                data-title="Enter Mobile No" 
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
                                <a class="btn btn-sm btn-info"  href="<?php print_link("application_form/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("application_form/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
