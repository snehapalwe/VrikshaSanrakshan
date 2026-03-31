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
                    <h4 class="record-title">Edit  Payments</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("payments/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $data['rec_id']; ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="amount">AMOUNT  <span class="text-danger">*</span></label>
                                        <div id="ctrl-amount-holder" class=""> 
                                            <input id="ctrl-amount"  value="<?php  echo $data['amount']; ?>" type="number" placeholder="Enter Amount" step="1"  required="" name="amount"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="payment_mode">PAYMENT MODE  <span class="text-danger">*</span></label>
                                            <div id="ctrl-payment_mode-holder" class=""> 
                                                <select required=""  id="ctrl-payment_mode" name="payment_mode"  placeholder="Select a value ..."    class="custom-select" >
                                                    <option value="">Select a value ...</option>
                                                    <?php
                                                    $rec = $data['payment_mode'];
                                                    $payment_mode_options = $comp_model -> payments_payment_mode_option_list();
                                                    if(!empty($payment_mode_options)){
                                                    foreach($payment_mode_options as $option){
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
                                        <div class="form-group ">
                                            <label class="control-label" for="recieved_from">RECEIVED FROM  <span class="text-danger">*</span></label>
                                            <div id="ctrl-recieved_from-holder" class=""> 
                                                <input id="ctrl-recieved_from"  value="<?php  echo $data['recieved_from']; ?>" type="text" placeholder="Enter Received From"  required="" name="recieved_from"  class="form-control " />
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
                                <div class=""><div></div>
                                    <script>
                                        $("#ctrl-amount").prop("readonly",true);
                                    </script></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
