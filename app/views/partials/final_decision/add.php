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
                    <h4 class="record-title">Add New Final Decision</h4>
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
                        <form id="final_decision-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("final_decision/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  readonly required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="upload">UPLOAD  </label>
                                        <div id="ctrl-upload-holder" class=""> 
                                            <div class="dropzone " input="#ctrl-upload" fieldname="upload"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                <input name="upload" id="ctrl-upload" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload',"NA"); ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="meeting_date">Meeting Date <span class='text-danger'>*</span> </label>
                                            <div id="ctrl-meeting_date-holder" class="input-group"> 
                                                <input id="ctrl-meeting_date" class="form-control datepicker  datepicker"  value="<?php  echo $this->set_field_value('meeting_date',""); ?>" type="datetime" name="meeting_date" placeholder="Enter Meeting Date  " data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="upload_meeting_resolution">Upload Meeting Resolution <span class='text-danger'>*</span> </label>
                                                <div id="ctrl-upload_meeting_resolution-holder" class=""> 
                                                    <div class="dropzone " input="#ctrl-upload_meeting_resolution" fieldname="upload_meeting_resolution"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                        <input name="upload_meeting_resolution" id="ctrl-upload_meeting_resolution" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_meeting_resolution',""); ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="resolution_number">Resolution Number <span class='text-danger'>*</span> </label>
                                                    <div id="ctrl-resolution_number-holder" class=""> 
                                                        <input id="ctrl-resolution_number"  value="<?php  echo $this->set_field_value('resolution_number',""); ?>" type="text" placeholder="Enter Resolution Number  "  name="resolution_number"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="resolution_date">Resolution Date <span class='text-danger'>*</span> </label>
                                                        <div id="ctrl-resolution_date-holder" class="input-group"> 
                                                            <input id="ctrl-resolution_date" class="form-control datepicker  datepicker"  value="<?php  echo $this->set_field_value('resolution_date',""); ?>" type="datetime" name="resolution_date" placeholder="Enter Resolution Date  " data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="final_decision">FINAL DECISION  <span class="text-danger">*</span></label>
                                                            <div id="ctrl-final_decision-holder" class=""> 
                                                                <select required=""  id="ctrl-final_decision" name="final_decision"  placeholder="Select a value ..."    class="custom-select" >
                                                                    <option value="">Select a value ...</option>
                                                                    <?php
                                                                    $final_decision_options = Menu :: $final_decision;
                                                                    if(!empty($final_decision_options)){
                                                                    foreach($final_decision_options as $option){
                                                                    $value = $option['value'];
                                                                    $label = $option['label'];
                                                                    $selected = $this->set_field_selected('final_decision', $value, "");
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
                                        </div>
                                        <div class="col-md-12 comp-grid">
                                            <div class=""><Script>
                                                $(document).ready(function() {
                                                $.getJSON("<?php echo SITE_ADDR ?>api/get_app_det/"+$("#ctrl-rec_id").val(),function(data){
                                                if(data.application_type=="PARTIAL TREE CUT"){
                                                $("#ctrl-meeting_date").parents(".form-group").hide();
                                                $("#ctrl-upload_meeting_resolution").parents(".form-group").hide();
                                                $("#ctrl-resolution_number").parents(".form-group").hide();
                                                $("#ctrl-resolution_date").parents(".form-group").hide();
                                                }else{
                                                $("#ctrl-meeting_date").prop("required",true);
                                                $("#ctrl-upload_meeting_resolution").prop("required",true);
                                                $("#ctrl-resolution_number").prop("required",true);
                                                $("#ctrl-resolution_date").prop("required",true);
                                                let datePickr = $('#ctrl-meeting_date').flatpickr({altInput: true,
                                                altFormat: "d-m-Y",
                                                dateFormat: "Y-m-d" });
                                                console.log(data);
                                                datePickr.set('minDate', data.date );    
                                                datePickr.set('maxDate', "today");    
                                                let datePickr2 = $('#ctrl-resolution_date').flatpickr({altInput: true,
                                                altFormat: "d-m-Y",
                                                dateFormat: "Y-m-d" });
                                                console.log(data);
                                                datePickr2.set('minDate', data.date );    
                                                datePickr2.set('maxDate', "today");  
                                                }
                                                });
                                                });
                                            </Script></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
