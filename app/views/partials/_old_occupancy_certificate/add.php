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
                    <h4 class="record-title"><strong style='color: black;'>OCCUPANCY CERTIFICATE</strong>
                    </h4>
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
                        <form id="occupancy_certificate-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("occupancy_certificate/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="cc_number">CC Application Number  <span class="text-danger">*</span> </label>
                                    <div id="ctrl-cc_number-holder" class=""> 
                                        <input id="ctrl-cc_number"  value="<?php  echo $this->set_field_value('cc_number',""); ?>" type="text" placeholder="Enter CC Application Number" step="1" required  name="cc_number"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="type_of_residence">TYPE OF RESIDENCE  <span class="text-danger">*</span></label>
                                        <div id="ctrl-type_of_residence-holder" class=""> 
                                            <select required=""  id="ctrl-type_of_residence" name="type_of_residence"  placeholder="Select a value ..."    class="custom-select" >
                                                <option value="">Select a value ...</option>
                                                <?php 
                                                $type_of_residence_options = $comp_model -> occupancy_certificate_type_of_residence_option_list();
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
                                            <input id="ctrl-applicant_full_name"  value="<?php  echo $this->set_field_value('applicant_full_name',""); ?>" type="text" placeholder="Enter Applicant Full Name"  required="" name="applicant_full_name"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="mobile_no">MOBILE NUMBER  <span class="text-danger">*</span></label>
                                            <div id="ctrl-mobile_no-holder" class=""> 
                                                <input id="ctrl-mobile_no"  value="<?php  echo $this->set_field_value('mobile_no',""); ?>" type="number" placeholder="Enter Mobile No" min="1000000000" max="9999999999" step="1"  required="" name="mobile_no"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="applicant_address">APPLICANT ADDRESS  <span class="text-danger">*</span></label>
                                                <div id="ctrl-applicant_address-holder" class=""> 
                                                    <input id="ctrl-applicant_address"  value="<?php  echo $this->set_field_value('applicant_address',""); ?>" type="text" placeholder="Enter Applicant Address"  required="" name="applicant_address"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="property_owner_name">PROPERTY OWNER NAME  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-property_owner_name-holder" class=""> 
                                                        <input id="ctrl-property_owner_name"  value="<?php  echo $this->set_field_value('property_owner_name',""); ?>" type="text" placeholder="Enter Property Owner Name"  required="" name="property_owner_name"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="ward">WARD  <span class="text-danger">*</span></label>
                                                        <div id="ctrl-ward-holder" class=""> 
                                                            <select required=""  id="ctrl-ward" name="ward"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php 
                                                                $ward_options = $comp_model -> occupancy_certificate_ward_option_list();
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
                                                            <input id="ctrl-address_of_plot"  value="<?php  echo $this->set_field_value('address_of_plot',""); ?>" type="text" placeholder="Enter Address Of Plot"  required="" name="address_of_plot"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="latitude">LATITUDE  <span class="text-danger">*</span></label>
                                                            <div id="ctrl-latitude-holder" class=""> 
                                                                <input id="ctrl-latitude"  value="<?php  echo $this->set_field_value('latitude',""); ?>" type="text" placeholder="Enter Latitude"  readonly required="" name="latitude"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="longitude">LONGITUDE  <span class="text-danger">*</span></label>
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
                                                                            <input id="ctrl-architech_name"  value="<?php  echo $this->set_field_value('architech_name',""); ?>" type="text" placeholder="Enter Architech Name"  required="" name="architech_name"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <label class="control-label" for="architect_address">ARCHITECT ADDRESS  <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-architect_address-holder" class=""> 
                                                                                <input id="ctrl-architect_address"  value="<?php  echo $this->set_field_value('architect_address',""); ?>" type="text" placeholder="Enter Architect Address"  required="" name="architect_address"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <label class="control-label" for="architect_pin_code">ARCHITECT PIN CODE  <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-architect_pin_code-holder" class=""> 
                                                                                    <input id="ctrl-architect_pin_code"  value="<?php  echo $this->set_field_value('architect_pin_code',""); ?>" type="number" placeholder="Enter Architect Pin Code" step="1"  required="" name="architect_pin_code"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <label class="control-label" for="architect_mobile_number">ARCHITECT MOBILE NUMBER  <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-architect_mobile_number-holder" class=""> 
                                                                                        <input id="ctrl-architect_mobile_number"  value="<?php  echo $this->set_field_value('architect_mobile_number',""); ?>" type="number" placeholder="Enter Architect Mobile Number" min="1000000000" max="9999999999" step="1"  required="" name="architect_mobile_number"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label class="control-label" for="builder_name">BUILDER NAME  <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-builder_name-holder" class=""> 
                                                                                            <input id="ctrl-builder_name"  value="<?php  echo $this->set_field_value('builder_name',""); ?>" type="text" placeholder="Enter Builder Name"  required="" name="builder_name"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label class="control-label" for="builder_address">BUILDER ADDRESS  <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-builder_address-holder" class=""> 
                                                                                                <input id="ctrl-builder_address"  value="<?php  echo $this->set_field_value('builder_address',""); ?>" type="text" placeholder="Enter Builder Address"  required="" name="builder_address"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label class="control-label" for="builder_pin_code">BUILDER PIN CODE  <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-builder_pin_code-holder" class=""> 
                                                                                                    <input id="ctrl-builder_pin_code"  value="<?php  echo $this->set_field_value('builder_pin_code',""); ?>" type="number" placeholder="Enter Builder Pin Code" step="1"  required="" name="builder_pin_code"  class="form-control " />
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <label class="control-label" for="builder_mobile_number">BUILDER MOBILE NUMBER  <span class="text-danger">*</span></label>
                                                                                                    <div id="ctrl-builder_mobile_number-holder" class=""> 
                                                                                                        <input id="ctrl-builder_mobile_number"  value="<?php  echo $this->set_field_value('builder_mobile_number',""); ?>" type="number" placeholder="Enter Builder Mobile Number" min="1000000000" max="9999999999" step="1"  required="" name="builder_mobile_number"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <label class="control-label" for="mouje">MOUJE / VILLAGE NAME <span class="text-danger">*</span></label>
                                                                                                        <div id="ctrl-mouje-holder" class=""> 
                                                                                                            <input id="ctrl-mouje"  value="<?php  echo $this->set_field_value('mouje',""); ?>" type="text" placeholder="Enter MOUJE / VILLAGE NAME"  required="" name="mouje"  class="form-control " />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group ">
                                                                                                            <label class="control-label" for="plot_area_in_sq_mtr">PLOT AREA (Sq Mtr) <span class="text-danger">*</span></label>
                                                                                                            <div id="ctrl-plot_area_in_sq_mtr-holder" class=""> 
                                                                                                                <input id="ctrl-plot_area_in_sq_mtr"  value="<?php  echo $this->set_field_value('plot_area_in_sq_mtr',""); ?>" type="number" placeholder="Enter PLOT AREA (Sq Mtr)" step="1"  required="" name="plot_area_in_sq_mtr"  class="form-control " />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <label class="control-label" for="survey_no">Survey No <span class="text-danger">*</span></label>
                                                                                                                <div id="ctrl-survey_no-holder" class=""> 
                                                                                                                    <input id="ctrl-survey_no"  value="<?php  echo $this->set_field_value('survey_no',""); ?>" type="text" placeholder="Enter Survey No"  required="" name="survey_no"  class="form-control " />
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="form-group ">
                                                                                                                    <label class="control-label" for="no_of_trees_if_available">No Of Trees  <span class="text-danger">*</span></label>
                                                                                                                    <div id="ctrl-no_of_trees_if_available-holder" class=""> 
                                                                                                                        <input id="ctrl-no_of_trees_if_available"  value="<?php  echo $this->set_field_value('no_of_trees_if_available',""); ?>" type="number" placeholder="Enter No Of Trees " step="1"  required="" name="no_of_trees_if_available"  class="form-control " />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <label class="control-label" for="phisical_colored_map_with_tree_located">Physical Colored Map With Tree Located <span class="text-danger">*</span></label>
                                                                                                                        <div id="ctrl-phisical_colored_map_with_tree_located-holder" class=""> 
                                                                                                                            <div class="dropzone required" input="#ctrl-phisical_colored_map_with_tree_located" fieldname="phisical_colored_map_with_tree_located"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
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
                                                                                                                                <label class="control-label" for="document_7_12">DOCUMENT 7-12  <span class="text-danger">*</span></label>
                                                                                                                                <div id="ctrl-document_7_12-holder" class=""> 
                                                                                                                                    <div class="dropzone required" input="#ctrl-document_7_12" fieldname="document_7_12"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="document_7_12" id="ctrl-document_7_12" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('document_7_12',""); ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="form-group ">
                                                                                                                                    <label class="control-label" for="oc_affidavit">Affidavit <span class="text-danger">*</span></label>
                                                                                                                                    <div id="ctrl-oc_affidavit-holder" class=""> 
                                                                                                                                        <div class="dropzone required" input="#ctrl-oc_affidavit" fieldname="oc_affidavit"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                            <input name="oc_affidavit" id="ctrl-oc_affidavit" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('oc_affidavit',""); ?>" type="text"  />
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
                                                                                                                        <div class=""><div></div>
                                                                                                                            <script>
                                                                                                                                $(document).ready(function() {
                                                                                                                                $.get("https://api64.ipify.org/?format=json", function(data, status){
                                                                                                                                $("#ctrl-address").val(data.ip);
                                                                                                                                });
                                                                                                                                });
                                                                                                                                // Note: This example requires that you consent to location sharing when
                                                                                                                                // prompted by your browser. If you see the error "The Geolocation service
                                                                                                                                // failed.", it means you probably did not give permission for the browser to
                                                                                                                                // locate you.
                                                                                                                                let map, infoWindow;
                                                                                                                                function initMap() {
                                                                                                                                infoWindow = new google.maps.InfoWindow();
                                                                                                                                // Try HTML5 geolocation.
                                                                                                                                if (navigator.geolocation) {
                                                                                                                                navigator.geolocation.getCurrentPosition(
                                                                                                                                (position) => {
                                                                                                                                $('#ctrl-latitude').val(position.coords.latitude);
                                                                                                                                $('#ctrl-longitude').val(position.coords.longitude);
                                                                                                                                $('#ctrl-google_link').val("https://www.google.com/maps?q="+position.coords.latitude+","+position.coords.longitude);
                                                                                                                                },
                                                                                                                                () => {
                                                                                                                                handleLocationError(true, infoWindow, map.getCenter());
                                                                                                                                }
                                                                                                                                );
                                                                                                                                } else {
                                                                                                                                // Browser doesn't support Geolocation
                                                                                                                                handleLocationError(false, infoWindow, map.getCenter());
                                                                                                                                }
                                                                                                                                }
                                                                                                                                function toRad(Value) 
                                                                                                                                {
                                                                                                                                return Value * Math.PI / 180;
                                                                                                                                }
                                                                                                                                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                                                                                                                                infoWindow.setPosition(pos);
                                                                                                                                infoWindow.setContent(
                                                                                                                                browserHasGeolocation
                                                                                                                                ? "Error: The Geolocation service failed."
                                                                                                                                : "Error: Your browser doesn't support geolocation."
                                                                                                                                );
                                                                                                                                }
                                                                                                                                function geocodeLatLng(lat, lng, geocoder) {
                                                                                                                                const latlng = {
                                                                                                                                lat: parseFloat(lat),
                                                                                                                                lng: parseFloat(lng),
                                                                                                                                };
                                                                                                                                geocoder.geocode({ location: latlng }, (results, status) => {
                                                                                                                                if (status === "OK") {
                                                                                                                                if (results[0]) {
                                                                                                                                window.alert(results[0].formatted_address);
                                                                                                                                } else {
                                                                                                                                window.alert("No results found");
                                                                                                                                }
                                                                                                                                } else {
                                                                                                                                window.alert("Geocoder failed due to: " + status);
                                                                                                                                }
                                                                                                                                });
                                                                                                                                }
                                                                                                                            </script>
                                                                                                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbuXFdCBUA-laYamjRg5MoTcsx8FlUd60&callback=initMap&libraries=&v=weekly"
                                                                                                                            async ></script></div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </section>
<script>

<?php $jei=new User_infoController();
$db=$jei->GetModel();
$db->where("user_id",USER_ID);
$rec=$db->getOne("commencement_certificate");
$fmap=[
['oc'=>'cc_number','cc'=>'cc_application_id'],
['oc'=>'type_of_residence','cc'=>'type_of_residence'],
['oc'=>'applicant_full_name','cc'=>'applicant_full_name'],
['oc'=>'mobile_no','cc'=>'mobile_no'],
['oc'=>'applicant_address','cc'=>'applicant_address'],
['oc'=>'property_owner_name','cc'=>'property_owner_name'],
['oc'=>'ward','cc'=>'ward'],
['oc'=>'address_of_plot','cc'=>'address_of_plot'],
['oc'=>'architech_name','cc'=>'architech_name'],
['oc'=>'architect_address','cc'=>'architect_address'],
['oc'=>'architect_pin_code','cc'=>'architect_pin_code'], 
['oc'=>'architect_mobile_number','cc'=>'architect_mobile_number'],
['oc'=>'builder_name','cc'=>'builder_name'],
['oc'=>'builder_address','cc'=>'builder_address'],
['oc'=>'builder_pin_code','cc'=>'builder_pin_code'],
['oc'=>'builder_mobile_number','cc'=>'builder_mobile_number'],
['oc'=>'mouje','cc'=>'mouje'],
['oc'=>'plot_area_in_sq_mtr','cc'=>'plot_area_in_sq_mtr'],
['oc'=>'survey_no','cc'=>'survey_no'],
];
foreach($fmap as $f){
    ?>
    $("#ctrl-<?php $f['oc'] ?>").val("<?php echo $rec[$f['cc']] ?>");
    <?php
}
?>

 $.getJSON("https://singlewindowsystemkdmc.in/api/common/tree_oc/<?php echo USER_NAME ?>", function(data) {
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