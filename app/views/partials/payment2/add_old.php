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
                    <h4 class="record-title">Add New Payment2</h4>
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
                        <form id="payment2-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("payment2/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  readonly required="" name="rec_id"  class="form-control " />
                                    <input id="ctrl-db_name"  value="<?php  echo $this->set_field_value('db_name',""); ?>" type="hidden" placeholder="Enter Db Name" list="db_name_list"  readonly required="" name="db_name"  class="form-control " />
                                        <datalist id="db_name_list">
                                            <?php
                                            $db_name_options = Menu :: $db_name;
                                            if(!empty($db_name_options)){
                                            foreach($db_name_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = $this->set_field_selected('db_name', $value, "");
                                            ?>
                                            <option><?php  echo $this->set_field_value('db_name',""); ?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </datalist>
                                        <div class="form-group ">
                                            <label class="control-label" for="recieved_from">RECEIVED FROM  <span class="text-danger">*</span></label>
                                            <div id="ctrl-recieved_from-holder" class=""> 
                                                <input id="ctrl-recieved_from"  value="<?php  echo $this->set_field_value('recieved_from',""); ?>" type="text" placeholder="Enter Recieved From"  readonly required="" name="recieved_from"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="amount">AMOUNT  <span class="text-danger">*</span></label>
                                                <div id="ctrl-amount-holder" class=""> 
                                                    <input id="ctrl-amount"  value="<?php  echo $this->set_field_value('amount',"5000"); ?>" type="number" placeholder="Enter Amount" step="1"  readonly required="" name="amount"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="payment_mode">PAYMENT MODE  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-payment_mode-holder" class=""> 
                                                        <select required=""  id="ctrl-payment_mode" name="payment_mode"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                            <?php
                                                            $payment_mode_options = Menu :: $payment_mode2;
                                                            if(!empty($payment_mode_options)){
                                                            foreach($payment_mode_options as $option){
                                                            $value = $option['value'];
                                                            $label = $option['label'];
                                                            $selected = $this->set_field_selected('payment_mode', $value, "");
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
                                                    <label class="control-label" for="purpose">PURPOSE  </label>
                                                    <div id="ctrl-purpose-holder" class=""> 
                                                        <input id="ctrl-purpose"  value="<?php  echo $this->set_field_value('purpose',""); ?>" type="text" placeholder="Enter Purpose"  name="purpose"  class="form-control " />
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
