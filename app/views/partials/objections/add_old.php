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
                    <h4 class="record-title">Add New Paper Cutting</h4>
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
                        <form id="objections-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("objections/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Application Id"  required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="name_of_applicant">Name Of Applicant/अर्जदाराचे नाव <span class="text-danger">*</span></label>
                                        <div id="ctrl-name_of_applicant-holder" class=""> 
                                            <input id="ctrl-name_of_applicant"  value="<?php  echo $this->set_field_value('name_of_applicant',""); ?>" type="text" placeholder="Enter Name Of Applicant/अर्जदाराचे नाव"  required="" name="name_of_applicant"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="mobile">Mobile/मोबाईल <span class="text-danger">*</span></label>
                                            <div id="ctrl-mobile-holder" class=""> 
                                                <input id="ctrl-mobile"  value="<?php  echo $this->set_field_value('mobile',""); ?>" type="number" placeholder="Enter Mobile/मोबाईल" maxlength="9999999999" minlength="1000000000" step="1"  required="" name="mobile"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="email">Email/ईमेल <span class="text-danger">*</span></label>
                                                <div id="ctrl-email-holder" class=""> 
                                                    <input id="ctrl-email"  value="<?php  echo $this->set_field_value('email',""); ?>" type="email" placeholder="Enter Email/ईमेल"  required="" name="email"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="date_of_ad">Date Of Ad/जाहिरातीची तारीख <span class="text-danger">*</span></label>
                                                    <div id="ctrl-date_of_ad-holder" class="input-group"> 
                                                        <input id="ctrl-date_of_ad" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('date_of_ad',""); ?>" type="datetime" name="date_of_ad" placeholder="Enter Date Of Ad/जाहिरातीची तारीख" data-enable-time="false" data-min-date="" data-max-date="<?php echo date_now(); ?>" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="name_of_news_paper">Name Of News Paper/वृत्तपत्राचे नाव <span class="text-danger">*</span></label>
                                                        <div id="ctrl-name_of_news_paper-holder" class=""> 
                                                            <input id="ctrl-name_of_news_paper"  value="<?php  echo $this->set_field_value('name_of_news_paper',""); ?>" type="text" placeholder="Enter Name Of News Paper/वृत्तपत्राचे नाव"  required="" name="name_of_news_paper"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="description">Description/वर्णन <span class="text-danger">*</span></label>
                                                            <div id="ctrl-description-holder" class=""> 
                                                                <textarea placeholder="Enter Description/वर्णन" id="ctrl-description"  required="" rows="5" name="description" class=" form-control"><?php  echo $this->set_field_value('description',""); ?></textarea>
                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="upload_attachment">Upload Attachment/संलग्नक अपलोड करा <span class="text-danger">*</span></label>
                                                            <div id="ctrl-upload_attachment-holder" class=""> 
                                                                <div class="dropzone required" input="#ctrl-upload_attachment" fieldname="upload_attachment"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                                    <input name="upload_attachment" id="ctrl-upload_attachment" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_attachment',""); ?>" type="text"  />
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
                                                <div class=""><Script>
                                                    $(document).ready(function() {
                                                    });
                                                </Script></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="">
                                    <div class="container">
                                        <div class="row ">
                                            <div class="col-md-12 comp-grid">
                                                <div class=""><Script>
                                                    $("#ctrl-rec_id").on("change",function(){
                                                    $.getJSON("<?php echo SITE_ADDR ?>api/get_app_status/"+($(this).val()).replace("SAT/TCP/2425/"),function(data){
                                                    if(data.all=="no"){
                                                    alert("No such application exists or not open for objections");
                                                    $("#ctrl-rec_id").val("");
                                                    } 
                                                    }); 
                                                    $.getJSON("<?php echo SITE_ADDR ?>api/get_app_det/"+($(this).val()).replace("SAT/TCP/2425/",""),function(json){
                                                    let datePickr = $('#ctrl-date_of_ad').flatpickr({altInput: true,
                                                    altFormat: "d-m-Y",
                                                    dateFormat: "Y-m-d" });
                                                    console.log(json);
                                                    datePickr.set('minDate', json.date );    
                                                    datePickr.set('maxDate', "today");    
                                                    });
                                                    });
                                                </Script></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
