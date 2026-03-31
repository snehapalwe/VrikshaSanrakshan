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
                    <h4 class="record-title"><strong style='color: black;'>OCCUPANCY CERTIFICATE INSPECTION</strong>  </h4>
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
                        <form id="oc_photo_inspection-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("oc_photo_inspection/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  readonly required="" name="rec_id"  class="form-control " />
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
                                                <label class="control-label" for="upload_photo_of_tree">UPLOAD PHOTO OF TREE  <span class="text-danger">*</span></label>
                                                <div id="ctrl-upload_photo_of_tree-holder" class=""> 
                                                    <div class="dropzone required" input="#ctrl-upload_photo_of_tree" fieldname="upload_photo_of_tree"    data-multiple="true" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="15" maximum="1">
                                                        <input name="upload_photo_of_tree" id="ctrl-upload_photo_of_tree" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_photo_of_tree',""); ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
                                                    </div>
                                                    <small class="form-text">You Can Upload Maximum 4 Photos</small>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="name_of_tree">NAME OF TREE  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-name_of_tree-holder" class=""> 
                                                        <select required=""  id="ctrl-name_of_tree" name="name_of_tree"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                            <?php 
                                                            $name_of_tree_options = $comp_model -> oc_photo_inspection_name_of_tree_option_list();
                                                            if(!empty($name_of_tree_options)){
                                                            foreach($name_of_tree_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $selected = $this->set_field_selected('name_of_tree',$value, "");
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
                                                    <label class="control-label" for="tree_count">Tree Count <span class="text-danger">*</span></label>
                                                    <div id="ctrl-tree_count-holder" class=""> 
                                                        <input id="ctrl-tree_count"  value="<?php  echo $this->set_field_value('tree_count',""); ?>" type="number" placeholder="Enter Tree Count" step="1"  required="" name="tree_count"  class="form-control " />
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
                                        <div class=""><script>
                                            $(document).ready(function () {
                                            // Fetch public IP address and populate address field
                                            $.get("https://api64.ipify.org/?format=json", function (data, status) {
                                            $("#ctrl-address").val(data.ip);
                                            });
                                            });
                                            let map, infoWindow;
                                            function initMap() {
                                            infoWindow = new google.maps.InfoWindow();
                                            // Try HTML5 geolocation
                                            if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(
                                            (position) => {
                                            $('#ctrl-latitude').val(position.coords.latitude);
                                            $('#ctrl-longitude').val(position.coords.longitude);
                                            },
                                            () => {
                                            handleLocationError(true, infoWindow, map?.getCenter());
                                            }
                                            );
                                            } else {
                                            // Browser doesn't support Geolocation
                                            handleLocationError(false, infoWindow, map?.getCenter());
                                            }
                                            }
                                            function toRad(value) {
                                            return value * Math.PI / 180;
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
                                        <!-- Google Maps JS API -->
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbuXFdCBUA-laYamjRg5MoTcsx8FlUd60&callback=initMap&libraries=&v=weekly" async></script></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
