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
                    <h4 class="record-title">Add New Payments</h4>
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
                        <form id="payments-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("payments/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="amount">AMOUNT  <span class="text-danger">*</span></label>
                                        <div id="ctrl-amount-holder" class=""> 
                                            <input id="ctrl-amount"  value="<?php  echo $this->set_field_value('amount',""); ?>" type="number" placeholder="Enter Amount" step="1"  required="" name="amount"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="recieved_from">RECEIVED FROM  <span class="text-danger">*</span></label>
                                            <div id="ctrl-recieved_from-holder" class=""> 
                                                <input id="ctrl-recieved_from"  value="<?php  echo $this->set_field_value('recieved_from',""); ?>" type="text" placeholder="Enter Received From"  required="" name="recieved_from"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="purpose">PURPOSE  <span class="text-danger">*</span></label>
                                                <div id="ctrl-purpose-holder" class=""> 
                                                    <select required=""  id="ctrl-purpose" name="purpose"  placeholder="Select a value ..."    class="custom-select" >
                                                        <option value="">Select a value ...</option>
                                                        <?php
                                                        $purpose_options = Menu :: $purpose;
                                                        if(!empty($purpose_options)){
                                                        foreach($purpose_options as $option){
                                                        $value = $option['value'];
                                                        $label = $option['label'];
                                                        $selected = $this->set_field_selected('purpose', $value, "");
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
