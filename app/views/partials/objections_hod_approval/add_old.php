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
                    <h4 class="record-title">Add New Objections Hod Approval</h4>
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
                        <form id="objections_hod_approval-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("objections_hod_approval/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  readonly required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="objection_id">OBJECTION ID  <span class="text-danger">*</span></label>
                                        <div id="ctrl-objection_id-holder" class=""> 
                                            <input id="ctrl-objection_id"  value="<?php  echo $this->set_field_value('objection_id',""); ?>" type="text" placeholder="Enter Objection Id"  readonly required="" name="objection_id"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="decision">DECISION  <span class="text-danger">*</span></label>
                                            <div id="ctrl-decision-holder" class=""> 
                                                <select required=""  id="ctrl-decision" name="decision"  placeholder="Select a value ..."    class="custom-select" >
                                                    <option value="">Select a value ...</option>
                                                    <?php
                                                    $decision_options = Menu :: $decision;
                                                    if(!empty($decision_options)){
                                                    foreach($decision_options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    $selected = $this->set_field_selected('decision', $value, "");
                                                    ?>
                                                    <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                        <?php echo $label ?>
                                                    </option>                                   
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="decision_upload">DECISION UPLOAD  <span class="text-danger">*</span></label>
                                            <div id="ctrl-decision_upload-holder" class=""> 
                                                <div class="dropzone required" input="#ctrl-decision_upload" fieldname="decision_upload"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                    <input name="decision_upload" id="ctrl-decision_upload" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('decision_upload',""); ?>" type="text"  />
                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="remark">REMARK  <span class="text-danger">*</span></label>
                                                <div id="ctrl-remark-holder" class=""> 
                                                    <input id="ctrl-remark"  value="<?php  echo $this->set_field_value('remark',""); ?>" type="text" placeholder="Enter Remark"  required="" name="remark"  class="form-control " />
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
