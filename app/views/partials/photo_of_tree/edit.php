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
                    <h4 class="record-title"><?php
                        $jei=new User_infoController();
                        $db=$jei->GetModel();
                        $db->where("id",$data['id']);
                        $rec=$db->getOne("photo_of_tree","*");
                        $db->where("upload_photo_of_tree","","!=");
                        $db->where("rec_id",$rec['rec_id']);
                        $fill=$db->getOne("photo_of_tree","COUNT(*) as filled")['filled']+1;
                        $db->where("rec_id",$rec['rec_id']);
                        $tot=$db->getOne("photo_of_tree","COUNT(*) as total")['total']+0;
                    ?>Please Add Photo Of Tree (<?php echo $fill ?>/<?php echo $tot ?>)</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("photo_of_tree/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $data['rec_id']; ?>" type="hidden" placeholder="Enter Rec Id"  readonly required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="latitude">Latitude/अक्षांश <span class="text-danger">*</span></label>
                                        <div id="ctrl-latitude-holder" class=""> 
                                            <input id="ctrl-latitude"  value="<?php  echo $data['latitude']; ?>" type="text" placeholder="Enter Latitude/अक्षांश"  readonly required="" name="latitude"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="longitude">Longitude/रेखांश <span class="text-danger">*</span></label>
                                            <div id="ctrl-longitude-holder" class=""> 
                                                <input id="ctrl-longitude"  value="<?php  echo $data['longitude']; ?>" type="text" placeholder="Enter Longitude/रेखांश"  readonly required="" name="longitude"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="upload_photo_of_tree">UPLOAD PHOTO OF TREE  <span class="text-danger">*</span></label>
                                                <div id="ctrl-upload_photo_of_tree-holder" class=""> 
                                                    <div class="dropzone required" input="#ctrl-upload_photo_of_tree" fieldname="upload_photo_of_tree"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                        <input name="upload_photo_of_tree" id="ctrl-upload_photo_of_tree" required="" class="dropzone-input form-control" value="<?php  echo $data['upload_photo_of_tree']; ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
                                                    </div>
                                                    <?php Html :: uploaded_files_list($data['upload_photo_of_tree'], '#ctrl-upload_photo_of_tree'); ?>
                                                    <small class="form-text"> <b><p class='text-danger' style='font-weight: bold;'>Note - Click the tree photo from the location of the tree <br>टीप - कृपया झाड कापण्याच्या ठिकाणावरूनच झाडाचा फोटो क्लिक करा</p></b></small>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="name_of_tree">NAME OF TREE  <span class="text-danger">*</span></label>
                                                        <div id="ctrl-name_of_tree-holder" class=""> 
                                                            <select required=""  id="ctrl-name_of_tree" name="name_of_tree"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php
                                                                $rec = $data['name_of_tree'];
                                                                $name_of_tree_options = $comp_model -> photo_of_tree_name_of_tree_option_list();
                                                                if(!empty($name_of_tree_options)){
                                                                foreach($name_of_tree_options as $option){
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
