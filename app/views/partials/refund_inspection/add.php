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
                    <h4 class="record-title">Add New Refund Inspection</h4>
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
                        <form id="refund_inspection-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("refund_inspection/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  readonly required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="report_upload">REPORT UPLOAD  <span class="text-danger">*</span></label>
                                        <div id="ctrl-report_upload-holder" class=""> 
                                            <div class="dropzone required" input="#ctrl-report_upload" fieldname="report_upload"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                <input name="report_upload" id="ctrl-report_upload" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('report_upload',""); ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
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
                                                    <label class="control-label" for="date">DATE  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-date-holder" class="input-group"> 
                                                        <input id="ctrl-date" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('date',""); ?>" type="datetime" name="date" placeholder="Enter Date" data-enable-time="false" data-min-date="<?php echo date_now(); ?>" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="remark">REMARK  <span class="text-danger">*</span></label>
                                                        <div id="ctrl-remark-holder" class=""> 
                                                            <textarea placeholder="Enter Remark" id="ctrl-remark"  required="" rows="5" name="remark" class=" form-control"><?php  echo $this->set_field_value('remark',""); ?></textarea>
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
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
