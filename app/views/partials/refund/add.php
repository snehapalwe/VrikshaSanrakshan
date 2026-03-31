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
                    <h4 class="record-title">Refund/परतावा</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-sm-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="refund-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("refund/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="date_of_permission">DATE OF PERMISSION  <span class="text-danger">*</span></label>
                                    <div id="ctrl-date_of_permission-holder" class="input-group"> 
                                        <input id="ctrl-date_of_permission" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('date_of_permission',""); ?>" type="datetime" name="date_of_permission" placeholder="Enter Date Of Permission" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="application_id">APPLICATION ID  <span class="text-danger">*</span></label>
                                        <div id="ctrl-application_id-holder" class=""> 
                                            <input id="ctrl-application_id"  value="<?php  echo $this->set_field_value('application_id',""); ?>" type="text" placeholder="Enter Application Id"  required="" name="application_id"  data-url="api/json/refund_application_id_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                                <div class="check-status"></div> 
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="no_of_tree_cut">NUMBER OF TREES CUT  <span class="text-danger">*</span></label>
                                            <div id="ctrl-no_of_tree_cut-holder" class=""> 
                                                <input id="ctrl-no_of_tree_cut"  value="<?php  echo $this->set_field_value('no_of_tree_cut',""); ?>" type="text" placeholder="Enter No Of Tree Cut"  readonly required="" name="no_of_tree_cut"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="no_of_tree_planted">NUMBER OF TREES PLANTED  <span class="text-danger">*</span></label>
                                                <div id="ctrl-no_of_tree_planted-holder" class=""> 
                                                    <input id="ctrl-no_of_tree_planted"  value="<?php  echo $this->set_field_value('no_of_tree_planted',""); ?>" type="text" placeholder="Enter No Of Tree Planted"  readonly required="" name="no_of_tree_planted"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="upload_original_reciept">UPLOAD ORIGINAL RECEIPT  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-upload_original_reciept-holder" class=""> 
                                                        <div class="dropzone required" input="#ctrl-upload_original_reciept" fieldname="upload_original_reciept"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                            <input name="upload_original_reciept" id="ctrl-upload_original_reciept" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_original_reciept',""); ?>" type="text"  />
                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="complete_address_of_plantation">COMPLETE ADDRESS OF PLANTATION  <span class="text-danger">*</span></label>
                                                        <div id="ctrl-complete_address_of_plantation-holder" class=""> 
                                                            <textarea placeholder="Enter Complete Address Of Plantation" id="ctrl-complete_address_of_plantation"  required="" rows="5" name="complete_address_of_plantation" class=" form-control"><?php  echo $this->set_field_value('complete_address_of_plantation',""); ?></textarea>
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="bank_name">BANK NAME  <span class="text-danger">*</span></label>
                                                        <div id="ctrl-bank_name-holder" class=""> 
                                                            <input id="ctrl-bank_name"  value="<?php  echo $this->set_field_value('bank_name',""); ?>" type="text" placeholder="Enter Bank Name"  required="" name="bank_name"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="account_number">ACCOUNT NUMBER  <span class="text-danger">*</span></label>
                                                            <div id="ctrl-account_number-holder" class=""> 
                                                                <input id="ctrl-account_number"  value="<?php  echo $this->set_field_value('account_number',""); ?>" type="text" placeholder="Enter Account Number"  required="" name="account_number"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="ifsc_code">IFSC CODE  <span class="text-danger">*</span></label>
                                                                <div id="ctrl-ifsc_code-holder" class=""> 
                                                                    <input id="ctrl-ifsc_code"  value="<?php  echo $this->set_field_value('ifsc_code',""); ?>" type="text" placeholder="Enter Ifsc Code"  required="" name="ifsc_code"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="account_holder_name">ACCOUNT HOLDER NAME  <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-account_holder_name-holder" class=""> 
                                                                        <input id="ctrl-account_holder_name"  value="<?php  echo $this->set_field_value('account_holder_name',""); ?>" type="text" placeholder="Enter Account Holder Name"  required="" name="account_holder_name"  class="form-control " />
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
