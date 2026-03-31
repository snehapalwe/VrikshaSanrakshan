<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><strong style='color: black;'>COMMENCEMENT CERTIFICATE</strong>  </h4>
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
                        <form id="commencement_certificate-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("commencement_certificate/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="type_of_residence">TYPE OF RESIDENCE  <span class="text-danger">*</span></label>
                                    <div id="ctrl-type_of_residence-holder" class=""> 
                                        <select required=""  id="ctrl-type_of_residence" name="type_of_residence"  placeholder="Select a value ..."    class="custom-select" >
                                            <option value="">Select a value ...</option>
                                            <?php 
                                            $type_of_residence_options = $comp_model -> commencement_certificate_type_of_residence_option_list();
                                            if(!empty($type_of_residence_options)){
                                            foreach($type_of_residence_options as $option){
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            $selected = $this->set_field_selected('type_of_residence',$value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                            </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="applicant_full_name">APPLICANT FULL NAME  <span class="text-danger">*</span></label>
                                    <div id="ctrl-applicant_full_name-holder" class=""> 
                                        <input id="ctrl-applicant_full_name"  value="<?php  echo $this->set_field_value('applicant_full_name',""); ?>" type="text" placeholder="Enter Applicant Full Name"  readonly required="" name="applicant_full_name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="mobile_no">MOBILE NUMBER  <span class="text-danger">*</span></label>
                                        <div id="ctrl-mobile_no-holder" class=""> 
                                            <input id="ctrl-mobile_no"  value="<?php  echo $this->set_field_value('mobile_no',""); ?>" type="number" placeholder="Enter Mobile No" min="1000000000" max="9999999999" step="1"  readonly required="" name="mobile_no"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="applicant_address">APPLICANT ADDRESS  <span class="text-danger">*</span></label>
                                            <div id="ctrl-applicant_address-holder" class=""> 
                                                <input id="ctrl-applicant_address"  value="<?php  echo $this->set_field_value('applicant_address',""); ?>" type="text" placeholder="Enter Applicant Address"  readonly required="" name="applicant_address"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="property_owner_name">PROPERTY OWNER NAME  <span class="text-danger">*</span></label>
                                                <div id="ctrl-property_owner_name-holder" class=""> 
                                                    <input id="ctrl-property_owner_name"  value="<?php  echo $this->set_field_value('property_owner_name',""); ?>" type="text" placeholder="Enter Property Owner Name"  readonly required="" name="property_owner_name"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="ward">WARD  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-ward-holder" class=""> 
                                                        <select required=""  id="ctrl-ward" name="ward"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                            <?php 
                                                            $ward_options = $comp_model -> commencement_certificate_ward_option_list();
                                                            if(!empty($ward_options)){
                                                            foreach($ward_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $selected = $this->set_field_selected('ward',$value, "");
                                                            ?>
                                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                <?php echo $label; ?>
                                                            </option>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="address_of_plot">ADDRESS OF PLOT  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-address_of_plot-holder" class=""> 
                                                        <input id="ctrl-address_of_plot"  value="<?php  echo $this->set_field_value('address_of_plot',""); ?>" type="text" placeholder="Enter Address Of Plot"  readonly required="" name="address_of_plot"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="latitude">LATITUDE  <span class="text-danger">*</span></label>
                                                        <div id="ctrl-latitude-holder" class=""> 
                                                            <input id="ctrl-latitude"  value="<?php  echo $this->set_field_value('latitude',""); ?>" type="text" placeholder="Enter Latitude"  readonly required="" name="latitude"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="longitude">Longitude <span class="text-danger">*</span></label>
                                                            <div id="ctrl-longitude-holder" class=""> 
                                                                <input id="ctrl-longitude"  value="<?php  echo $this->set_field_value('longitude',""); ?>" type="text" placeholder="Enter Longitude"  readonly required="" name="longitude"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="google_link">GOOGLE LINK  <span class="text-danger">*</span></label>
                                                                <div id="ctrl-google_link-holder" class=""> 
                                                                    <input id="ctrl-google_link"  value="<?php  echo $this->set_field_value('google_link',""); ?>" type="text" placeholder="Enter Google Link"  readonly required="" name="google_link"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="architech_name">ARCHITECT NAME  <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-architech_name-holder" class=""> 
                                                                        <input id="ctrl-architech_name"  value="<?php  echo $this->set_field_value('architech_name',""); ?>" type="text" placeholder="Enter Architech Name"  readonly required="" name="architech_name"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label class="control-label" for="architect_address">ARCHITECT ADDRESS  <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-architect_address-holder" class=""> 
                                                                            <input id="ctrl-architect_address"  value="<?php  echo $this->set_field_value('architect_address',""); ?>" type="text" placeholder="Enter Architect Address"  readonly required="" name="architect_address"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <label class="control-label" for="architect_pin_code">ARCHITECT PIN CODE  <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-architect_pin_code-holder" class=""> 
                                                                                <input id="ctrl-architect_pin_code"  value="<?php  echo $this->set_field_value('architect_pin_code',""); ?>" type="text" placeholder="Enter Architect Pin Code"  readonly required="" name="architect_pin_code"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <label class="control-label" for="architect_mobile_number">ARCHITECT MOBILE NUMBER  <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-architect_mobile_number-holder" class=""> 
                                                                                    <input id="ctrl-architect_mobile_number"  value="<?php  echo $this->set_field_value('architect_mobile_number',""); ?>" type="number" placeholder="Enter Architect Mobile Number" maxlength="9999999999" minlength="1000000000" min="1000000000" max="9999999999" step="1"  readonly required="" name="architect_mobile_number"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <label class="control-label" for="builder_name">BUILDER NAME  <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-builder_name-holder" class=""> 
                                                                                        <input id="ctrl-builder_name"  value="<?php  echo $this->set_field_value('builder_name',""); ?>" type="text" placeholder="Enter Builder Name"  readonly required="" name="builder_name"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label class="control-label" for="builder_address">BUILDER ADDRESS  <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-builder_address-holder" class=""> 
                                                                                            <input id="ctrl-builder_address"  value="<?php  echo $this->set_field_value('builder_address',""); ?>" type="text" placeholder="Enter Builder Address"  readonly required="" name="builder_address"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label class="control-label" for="builder_pin_code">BUILDER PIN CODE  <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-builder_pin_code-holder" class=""> 
                                                                                                <input id="ctrl-builder_pin_code"  value="<?php  echo $this->set_field_value('builder_pin_code',""); ?>" type="text" placeholder="Enter Builder Pin Code"  readonly required="" name="builder_pin_code"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label class="control-label" for="builder_mobile_number">BUILDER MOBILE NUMBER  <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-builder_mobile_number-holder" class=""> 
                                                                                                    <input id="ctrl-builder_mobile_number"  value="<?php  echo $this->set_field_value('builder_mobile_number',""); ?>" type="number" placeholder="Enter Builder Mobile Number" maxlength="9999999999" minlength="1000000000" min="1000000000" max="9999999999" step="1"  readonly required="" name="builder_mobile_number"  class="form-control " />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <label class="control-label" for="plot_area_in_sq_mtr">PLOT AREA (SQ.M)  <span class="text-danger">*</span></label>
                                                                                                    <div id="ctrl-plot_area_in_sq_mtr-holder" class=""> 
                                                                                                        <input id="ctrl-plot_area_in_sq_mtr"  value="<?php  echo $this->set_field_value('plot_area_in_sq_mtr',""); ?>" type="number" placeholder="Enter Plot Area In Sq Mtr" step="1"  readonly required="" name="plot_area_in_sq_mtr"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <label class="control-label" for="survey_no">SURVEY NO. <span class="text-danger">*</span></label>
                                                                                                        <div id="ctrl-survey_no-holder" class=""> 
                                                                                                            <input id="ctrl-survey_no"  value="<?php  echo $this->set_field_value('survey_no',""); ?>" type="text" placeholder="Enter SURVEY NO."  readonly required="" name="survey_no"  class="form-control " />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group ">
                                                                                                            <label class="control-label" for="mouje">MOUJE / VILLAGE NAME <span class="text-danger">*</span></label>
                                                                                                            <div id="ctrl-mouje-holder" class=""> 
                                                                                                                <input id="ctrl-mouje"  value="<?php  echo $this->set_field_value('mouje',""); ?>" type="text" placeholder="Enter MOUJE / VILLAGE NAME"  readonly required="" name="mouje"  class="form-control " />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <label class="control-label" for="no_of_trees_if_available">NO OF TREES <span class="text-danger">*</span></label>
                                                                                                                <div id="ctrl-no_of_trees_if_available-holder" class=""> 
                                                                                                                    <input id="ctrl-no_of_trees_if_available"  value="<?php  echo $this->set_field_value('no_of_trees_if_available',""); ?>" type="number" placeholder="Enter NO OF TREES" step="1"  required="" name="no_of_trees_if_available"  class="form-control " />
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="form-group ">
                                                                                                                    <label class="control-label" for="phisical_colored_map_with_tree_located">PHYSICAL COLORED MAP WITH TREE LOCATED  <span class="text-danger">*</span></label>
                                                                                                                    <div id="ctrl-phisical_colored_map_with_tree_located-holder" class=""> 
                                                                                                                        <div class="dropzone required" input="#ctrl-phisical_colored_map_with_tree_located" fieldname="phisical_colored_map_with_tree_located"    data-multiple="true" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="15" maximum="4">
                                                                                                                            <input name="phisical_colored_map_with_tree_located" id="ctrl-phisical_colored_map_with_tree_located" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('phisical_colored_map_with_tree_located',""); ?>" type="text"  />
                                                                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <label class="control-label" for="google_map_with_polygone">GOOGLE MAP WITH POLYGON  <span class="text-danger">*</span></label>
                                                                                                                        <div id="ctrl-google_map_with_polygone-holder" class=""> 
                                                                                                                            <div class="dropzone required" input="#ctrl-google_map_with_polygone" fieldname="google_map_with_polygone"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                <input name="google_map_with_polygone" id="ctrl-google_map_with_polygone" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('google_map_with_polygone',""); ?>" type="text"  />
                                                                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group ">
                                                                                                                            <label class="control-label" for="document_7_12_">DOCUMENT 7-12  <span class="text-danger">*</span></label>
                                                                                                                            <div id="ctrl-document_7_12_-holder" class=""> 
                                                                                                                                <div class="dropzone required" input="#ctrl-document_7_12_" fieldname="document_7_12_"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                    <input name="document_7_12_" id="ctrl-document_7_12_" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('document_7_12_',""); ?>" type="text"  />
                                                                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <label class="control-label" for="cc_affidavit">AFFIDAVIT <span class="text-danger">*</span></label>
                                                                                                                                <div id="ctrl-cc_affidavit-holder" class=""> 
                                                                                                                                    <div class="dropzone required" input="#ctrl-cc_affidavit" fieldname="cc_affidavit"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="cc_affidavit" id="ctrl-cc_affidavit" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('cc_affidavit',""); ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                                                                                                                <div class="form-ajax-status"></div>
                                                                                                                                <button class="btn btn-primary" type="submit">
                                                                                                                                    Submit
                                                                                                                                    <i class="fa fa-send"></i>
                                                                                                                                </button>
                                                                                                                            </div>
                                                                                                                        </form>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div  class="">
                                                                                                        <div class="container">
                                                                                                            <div class="row ">
                                                                                                                <div class="col-md-12 comp-grid">
                                                                                                                    <div class="">
                                                                                                                        <script>
                                                                                                                            $(document).ready(function() {
                                                                                                                            // Fetch IP address
                                                                                                                            $.get("https://api64.ipify.org/?format=json", function(data) {
                                                                                                                            $("#ctrl-address").val(data.ip);
                                                                                                                            });
                                                                                                                            // Function to update Google Maps link
                                                                                                                            function updateGoogleLink() {
                                                                                                                            const lat = $('#ctrl-latitude').val();
                                                                                                                            const lng = $('#ctrl-longitude').val();
                                                                                                                            if (lat && lng) {
                                                                                                                            $('#ctrl-google_link').val(`https://www.google.com/maps?q=${lat},${lng}`);
                                                                                                                            return true; // success
                                                                                                                            }
                                                                                                                            return false; // still waiting
                                                                                                                            }
                                                                                                                            // Watch for manual input changes
                                                                                                                            $('#ctrl-latitude, #ctrl-longitude').on('input change', updateGoogleLink);
                                                                                                                            // Auto-retry until lat/lng available (useful when fetched async)
                                                                                                                            const interval = setInterval(() => {
                                                                                                                            if (updateGoogleLink()) {
                                                                                                                            clearInterval(interval); // stop once link is updated
                                                                                                                            }
                                                                                                                            }, 1000); // check every 1 second (adjust if needed)
                                                                                                                            });
                                                                                                                        </script>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </section>
<script>

 $.getJSON("https://singlewindowsystemkdmc.in/api/common/tree_cc/<?php echo USER_NAME ?>", function(data) {
    data.forEach(function(group) {
        var $ctrl = $("#ctrl-" + group.field);

        if ($ctrl.is("select")) {
            // Try to select option by its visible text (label)
            var matched = false;
            $ctrl.find("option").each(function() {
                if ($(this).text().trim() === group.value.trim()) {
                    $(this).prop("selected", true);
                    matched = true;
                    return false; // stop loop
                }
            });

            // Fallback: if label not matched, try selecting by value
            if (!matched) {
                $ctrl.val(group.value);
            }

        } else {
            // For inputs, textareas, etc.
            $ctrl.val(group.value);
        }

        // Handle readonly / disabled logic
        if (group.value && group.value.trim() !== "") {
            $ctrl.prop("readonly", true);
            // For selects, use disable instead of readonly
            if ($ctrl.is("select")) {
                $ctrl.css('pointer-events', 'none');
            } else {
                $ctrl.css('pointer-events', 'none');
            }
        } else {
            $ctrl.removeAttr("readonly");
            $ctrl.prop("disabled", false);
        }

        // Hide fields with URL values
        if (group.value.startsWith("http://") || group.value.startsWith("https://")) {
            // $ctrl.parents(".form-group").hide();
        }
    });
});

</script>