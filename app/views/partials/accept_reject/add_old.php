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
                    <h4 class="record-title">Add New Accept Reject</h4>
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
                        <form id="accept_reject-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("accept_reject/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-db_name"  value="<?php  echo $this->set_field_value('db_name',""); ?>" type="hidden" placeholder="Enter Db Name"  required="" name="db_name"  class="form-control " />
                                    <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                        <div class="form-group ">
                                            <label class="control-label" for="status">STATUS  <span class="text-danger">*</span></label>
                                            <div id="ctrl-status-holder" class=""> 
                                                <select required=""  id="ctrl-status" name="status"  placeholder="Select a value ..."    class="custom-select" >
                                                    <option value="">Select a value ...</option>
                                                    <?php 
                                                    $status_options = $comp_model -> accept_reject_status_option_list();
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
        </section>
