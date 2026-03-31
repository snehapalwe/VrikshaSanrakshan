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
                    <h4 class="record-title"><strong style='color: black;'>APPROVE OR REJECT</strong></h4>
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
                        <form id="accept_reject2-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("accept_reject2/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-db_name"  value="<?php  echo $this->set_field_value('db_name',""); ?>" type="hidden" placeholder="Enter Db Name"  readonly required="" name="db_name"  class="form-control " />
                                    <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                        <div class="form-group ">
                                            <label class="control-label" for="status">STATUS <span class="text-danger">*</span></label>
                                            <div id="ctrl-status-holder" class=""> 
                                                <select  id="ctrl-status" name="status"  required="" placeholder="Select a value ..."    class="custom-select" >
                                                    <option value="">Select a value ...</option>
                                                    <?php 
                                                    $status_options = $comp_model -> accept_reject2_status_option_list();
                                                    if(!empty($status_options)){
                                                    foreach($status_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    $selected = $this->set_field_selected('status',$value, "");
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
                                            <label class="control-label" for="remark">REMARK  <span class="text-danger">*</span></label>
                                            <div id="ctrl-remark-holder" class=""> 
                                                <input id="ctrl-remark"  value="<?php  echo $this->set_field_value('remark',""); ?>" type="text" placeholder="Enter Remark"  required="" name="remark"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="upload_rejection_note">Upload Rejection Note <span class="text-danger">*</span></label>
                                                <div id="ctrl-upload_rejection_note-holder" class=""> 
                                                    <div class="dropzone " input="#ctrl-upload_rejection_note" fieldname="upload_rejection_note"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="300" maximum="1">
                                                        <input name="upload_rejection_note" id="ctrl-upload_rejection_note" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_rejection_note',""); ?>" type="text"  />
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
                                        //     $("#ctrl-upload_rejection_note").parents(".form-control").hide();
                                        //     $("#ctrl-status").on("change",function(){
                                        //     if($("#ctrl-status").val()=="REJECT"){
                                        //     $("#ctrl-upload_rejection_note").parents(".form-control").show();
                                        //     $("#ctrl-upload_rejection_note").prop('required',true); 
                                        //     } 
                                        //     });
                                        </script>
                                        <script>
                                            $(document).ready(function(){
                                                // Hide the whole form group initially
                                                $("#ctrl-upload_rejection_note").closest(".form-group").hide();
                                            
                                                $("#ctrl-status").on("change", function(){
                                                    if ($(this).val() == "REJECT") {
                                                        $("#ctrl-upload_rejection_note").closest(".form-group").show();
                                                        $("#ctrl-upload_rejection_note").prop("required", true);
                                                    } else {
                                                        $("#ctrl-upload_rejection_note").closest(".form-group").hide();
                                                        $("#ctrl-upload_rejection_note").prop("required", false);
                                                    }
                                                });
                                                <?php if(isset($_GET['recommend'])){
                                                    
                                                     ?>
                                                     $("#ctrl-status").val("ACCEPT");
                                                     $("#ctrl-status").parents(".form-group").hide();
                                                     <?php
                                                    
                                                } ?>
                                            });
                                        </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
