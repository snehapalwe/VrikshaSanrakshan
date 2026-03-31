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
                    <h4 class="record-title">Add New Photo Of Tree</h4>
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
                        <form id="photo_of_tree-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("photo_of_tree/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  readonly required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="latitude">Latitude/अक्षांश <span class="text-danger">*</span></label>
                                        <div id="ctrl-latitude-holder" class=""> 
                                            <input id="ctrl-latitude"  value="<?php  echo $this->set_field_value('latitude',""); ?>" type="text" placeholder="Enter Latitude/अक्षांश"  readonly required="" name="latitude"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="longitude">Longitude/रेखांश <span class="text-danger">*</span></label>
                                            <div id="ctrl-longitude-holder" class=""> 
                                                <input id="ctrl-longitude"  value="<?php  echo $this->set_field_value('longitude',""); ?>" type="text" placeholder="Enter Longitude/रेखांश"  readonly required="" name="longitude"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="upload_photo_of_tree">UPLOAD PHOTO OF TREE  <span class="text-danger">*</span></label>
                                                <div id="ctrl-upload_photo_of_tree-holder" class=""> 
                                                    <div class="dropzone required" input="#ctrl-upload_photo_of_tree" fieldname="upload_photo_of_tree"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                        <input name="upload_photo_of_tree" id="ctrl-upload_photo_of_tree" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_photo_of_tree',""); ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
                                                    </div>
                                                    <small class="form-text"> <b><p class='text-danger' style='font-weight: bold;'>Note - Click the tree photo from the location of the tree <br>टीप - कृपया झाड कापण्याच्या ठिकाणावरूनच झाडाचा फोटो क्लिक करा</p></b></small>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="name_of_tree">NAME OF TREE  <span class="text-danger">*</span></label>
                                                        <div id="ctrl-name_of_tree-holder" class=""> 
                                                            <select required=""  id="ctrl-name_of_tree" name="name_of_tree"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php 
                                                                $name_of_tree_options = $comp_model -> photo_of_tree_name_of_tree_option_list();
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
                    </section>
