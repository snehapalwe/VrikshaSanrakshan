<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Occupancy Certificate</h4>
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
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("occupancy_certificate/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="cc_number">CC APPLICATION NUMBER <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-cc_number"  value="<?php  echo $data['cc_number']; ?>" type="text" placeholder="ENTER CC APPLICATION NUMBER"  required="" name="cc_number"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="type_of_residence">TYPE OF RESIDENCE <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-type_of_residence" name="type_of_residence"  placeholder="Select a value ..."    class="custom-select" >
                                                        <option value="">Select a value ...</option>
                                                        <?php
                                                        $rec = $data['type_of_residence'];
                                                        $type_of_residence_options = $comp_model -> occupancy_certificate_type_of_residence_option_list();
                                                        if(!empty($type_of_residence_options)){
                                                        foreach($type_of_residence_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = ( $value == $rec ? 'selected' : null );
                                                        ?>
                                                        <option 
                                                            <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                        </option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="applicant_full_name">APPLICANT FULL NAME <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-applicant_full_name"  value="<?php  echo $data['applicant_full_name']; ?>" type="text" placeholder="ENTER APPLICANT FULL NAME"  required="" name="applicant_full_name"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="mobile_no">MOBILE NUMBER <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-mobile_no"  value="<?php  echo $data['mobile_no']; ?>" type="number" placeholder="ENTER MOBILE NUMBER" min="1000000000" max="9999999999" step="1"  required="" name="mobile_no"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="applicant_address">APPLICANT ADDRESS <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-applicant_address"  value="<?php  echo $data['applicant_address']; ?>" type="text" placeholder="ENTER APPLICANT ADDRESS"  required="" name="applicant_address"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="property_owner_name">PROPERTY OWNER NAME <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-property_owner_name"  value="<?php  echo $data['property_owner_name']; ?>" type="text" placeholder="ENTER PROPERTY OWNER NAME"  required="" name="property_owner_name"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="ward">WARD <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <select required=""  id="ctrl-ward" name="ward"  placeholder="Select a value ..."    class="custom-select" >
                                                                        <option value="">Select a value ...</option>
                                                                        <?php
                                                                        $rec = $data['ward'];
                                                                        $ward_options = $comp_model -> occupancy_certificate_ward_option_list();
                                                                        if(!empty($ward_options)){
                                                                        foreach($ward_options as $option){
                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                        $selected = ( $value == $rec ? 'selected' : null );
                                                                        ?>
                                                                        <option 
                                                                            <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                                                        </option>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="address_of_plot">ADDRESS OF PLOT <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-address_of_plot"  value="<?php  echo $data['address_of_plot']; ?>" type="text" placeholder="ENTER ADDRESS OF PLOT"  required="" name="address_of_plot"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="latitude">LATITUDE <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-latitude"  value="<?php  echo $data['latitude']; ?>" type="text" placeholder="ENTER LATITUDE"  readonly required="" name="latitude"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="longitude">LONGITUDE <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-longitude"  value="<?php  echo $data['longitude']; ?>" type="text" placeholder="ENTER LONGITUDE"  readonly required="" name="longitude"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="google_link">GOOGLE LINK <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <input id="ctrl-google_link"  value="<?php  echo $data['google_link']; ?>" type="text" placeholder="ENTER GOOGLE LINK"  readonly required="" name="google_link"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <label class="control-label" for="architech_name">ARCHITECT NAME <span class="text-danger">*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="">
                                                                                    <input id="ctrl-architech_name"  value="<?php  echo $data['architech_name']; ?>" type="text" placeholder="ENTER ARCHITECT NAME"  required="" name="architech_name"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <label class="control-label" for="architect_address">ARCHITECT ADDRESS <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="">
                                                                                        <input id="ctrl-architect_address"  value="<?php  echo $data['architect_address']; ?>" type="text" placeholder="ENTER ARCHITECT ADDRESS"  required="" name="architect_address"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <label class="control-label" for="architect_pin_code">ARCHITECT PIN CODE <span class="text-danger">*</span></label>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="">
                                                                                            <input id="ctrl-architect_pin_code"  value="<?php  echo $data['architect_pin_code']; ?>" type="number" placeholder="ENTER ARCHITECT PIN CODE" step="1"  required="" name="architect_pin_code"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="architect_mobile_number">ARCHITECT MOBILE NUMBER <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <input id="ctrl-architect_mobile_number"  value="<?php  echo $data['architect_mobile_number']; ?>" type="number" placeholder="ENTER ARCHITECT MOBILE NUMBER" min="1000000000" max="9999999999" step="1"  required="" name="architect_mobile_number"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-4">
                                                                                                <label class="control-label" for="builder_name">BUILDER NAME  <span class="text-danger">*</span></label>
                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="">
                                                                                                    <input id="ctrl-builder_name"  value="<?php  echo $data['builder_name']; ?>" type="text" placeholder="ENTER BUILDER NAME "  required="" name="builder_name"  class="form-control " />
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <label class="control-label" for="builder_address">BUILDER ADDRESS <span class="text-danger">*</span></label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="">
                                                                                                        <input id="ctrl-builder_address"  value="<?php  echo $data['builder_address']; ?>" type="text" placeholder="ENTER BUILDER ADDRESS"  required="" name="builder_address"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-4">
                                                                                                        <label class="control-label" for="builder_pin_code">BUILDER PIN CODE <span class="text-danger">*</span></label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="">
                                                                                                            <input id="ctrl-builder_pin_code"  value="<?php  echo $data['builder_pin_code']; ?>" type="number" placeholder="ENTER BUILDER PIN CODE" step="1"  required="" name="builder_pin_code"  class="form-control " />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-4">
                                                                                                            <label class="control-label" for="builder_mobile_number">BUILDER MOBILE NUMBER <span class="text-danger">*</span></label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-8">
                                                                                                            <div class="">
                                                                                                                <input id="ctrl-builder_mobile_number"  value="<?php  echo $data['builder_mobile_number']; ?>" type="number" placeholder="ENTER BUILDER MOBILE NUMBER" min="1000000000" max="9999999999" step="1"  required="" name="builder_mobile_number"  class="form-control " />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <div class="row">
                                                                                                            <div class="col-sm-4">
                                                                                                                <label class="control-label" for="mouje">MOUJE / VILLAGE NAME <span class="text-danger">*</span></label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-8">
                                                                                                                <div class="">
                                                                                                                    <input id="ctrl-mouje"  value="<?php  echo $data['mouje']; ?>" type="text" placeholder="ENTER MOUJE / VILLAGE NAME"  required="" name="mouje"  class="form-control " />
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group ">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-4">
                                                                                                                    <label class="control-label" for="plot_area_in_sq_mtr">PLOT AREA (Sq Mtr) <span class="text-danger">*</span></label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <div class="">
                                                                                                                        <input id="ctrl-plot_area_in_sq_mtr"  value="<?php  echo $data['plot_area_in_sq_mtr']; ?>" type="number" placeholder="ENTER PLOT AREA (Sq Mtr)" step="1"  required="" name="plot_area_in_sq_mtr"  class="form-control " />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-4">
                                                                                                                        <label class="control-label" for="survey_no">SURVEY NUMBER <span class="text-danger">*</span></label>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <div class="">
                                                                                                                            <input id="ctrl-survey_no"  value="<?php  echo $data['survey_no']; ?>" type="text" placeholder="ENTER SURVEY NUMBER"  required="" name="survey_no"  class="form-control " />
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="form-group ">
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-sm-4">
                                                                                                                            <label class="control-label" for="no_of_trees_if_available">NO OF TREES <span class="text-danger">*</span></label>
                                                                                                                        </div>
                                                                                                                        <div class="col-sm-8">
                                                                                                                            <div class="">
                                                                                                                                <input id="ctrl-no_of_trees_if_available"  value="<?php  echo $data['no_of_trees_if_available']; ?>" type="number" placeholder="ENTER NO OF TREES" step="1"  required="" name="no_of_trees_if_available"  class="form-control " />
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <label class="control-label" for="phisical_colored_map_with_tree_located">PHYSICAL COLORED MAP WITH TREE LOCATED <span class="text-danger">*</span></label>
                                                                                                                            </div>
                                                                                                                            <div class="col-sm-8">
                                                                                                                                <div class="">
                                                                                                                                    <div class="dropzone required" input="#ctrl-phisical_colored_map_with_tree_located" fieldname="phisical_colored_map_with_tree_located"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="phisical_colored_map_with_tree_located" id="ctrl-phisical_colored_map_with_tree_located" required="" class="dropzone-input form-control" value="<?php  echo $data['phisical_colored_map_with_tree_located']; ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <?php Html :: uploaded_files_list($data['phisical_colored_map_with_tree_located'], '#ctrl-phisical_colored_map_with_tree_located'); ?>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group ">
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-sm-4">
                                                                                                                                    <label class="control-label" for="google_map_with_polygone">GOOGLE MAP WITH POLYGONE <span class="text-danger">*</span></label>
                                                                                                                                </div>
                                                                                                                                <div class="col-sm-8">
                                                                                                                                    <div class="">
                                                                                                                                        <div class="dropzone required" input="#ctrl-google_map_with_polygone" fieldname="google_map_with_polygone"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                            <input name="google_map_with_polygone" id="ctrl-google_map_with_polygone" required="" class="dropzone-input form-control" value="<?php  echo $data['google_map_with_polygone']; ?>" type="text"  />
                                                                                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <?php Html :: uploaded_files_list($data['google_map_with_polygone'], '#ctrl-google_map_with_polygone'); ?>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <div class="row">
                                                                                                                                    <div class="col-sm-4">
                                                                                                                                        <label class="control-label" for="document_7_12">DOCUMENT 7 12 <span class="text-danger">*</span></label>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-sm-8">
                                                                                                                                        <div class="">
                                                                                                                                            <div class="dropzone required" input="#ctrl-document_7_12" fieldname="document_7_12"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                                <input name="document_7_12" id="ctrl-document_7_12" required="" class="dropzone-input form-control" value="<?php  echo $data['document_7_12']; ?>" type="text"  />
                                                                                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            <?php Html :: uploaded_files_list($data['document_7_12'], '#ctrl-document_7_12'); ?>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="form-group ">
                                                                                                                                    <div class="row">
                                                                                                                                        <div class="col-sm-4">
                                                                                                                                            <label class="control-label" for="oc_affidavit">UPLOAD CC <span class="text-danger">*</span></label>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-sm-8">
                                                                                                                                            <div class="">
                                                                                                                                                <div class="dropzone required" input="#ctrl-oc_affidavit" fieldname="oc_affidavit"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                                    <input name="oc_affidavit" id="ctrl-oc_affidavit" required="" class="dropzone-input form-control" value="<?php  echo $data['oc_affidavit']; ?>" type="text"  />
                                                                                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <?php Html :: uploaded_files_list($data['oc_affidavit'], '#ctrl-oc_affidavit'); ?>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="form-ajax-status"></div>
                                                                                                                                <div class="form-group text-center">
                                                                                                                                    <button class="btn btn-primary" type="submit">
                                                                                                                                        Update
                                                                                                                                        <i class="fa fa-send"></i>
                                                                                                                                    </button>
                                                                                                                                </div>
                                                                                                                            </form>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </section>
