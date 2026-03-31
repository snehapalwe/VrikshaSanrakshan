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
                    <h4 class="record-title">Add New Master Zone</h4>
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
                        <form id="master_zone-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("master_zone/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="zone_name">ZONE NAME  <span class="text-danger">*</span></label>
                                    <div id="ctrl-zone_name-holder" class=""> 
                                        <input id="ctrl-zone_name"  value="<?php  echo $this->set_field_value('zone_name',""); ?>" type="text" placeholder="Enter Zone Name"  required="" name="zone_name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="peth">PETH  <span class="text-danger">*</span></label>
                                        <div id="ctrl-peth-holder" class=""> 
                                            <input id="ctrl-peth"  value="<?php  echo $this->set_field_value('peth',""); ?>" type="text" placeholder="Enter Peth"  required="" name="peth"  class="form-control " />
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
                            <div class=""><Script>
                                $.getJSON("<?php echo SITE_ADDR ?>api/get_app_det/"+$("#ctrl-rec_id").val(),function(data){
                                let datePickr = $('#ctrl-inspection_date').flatpickr({altInput: true,
                                altFormat: "d-m-Y",
                                dateFormat: "Y-m-d" });
                                datePickr.set('minDate', data.date );    
                                })
                            </Script></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
