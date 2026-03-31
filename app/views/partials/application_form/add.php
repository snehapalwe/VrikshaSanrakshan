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
                    <h4 class="record-title">Add New / नवीन नोंद </h4>
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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="application_form-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("application_form/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="application_type">Application Type / अर्जाचा प्रकार <span class="text-danger">*</span></label>
                                    <div id="ctrl-application_type-holder" class=""> 
                                        <select required=""  id="ctrl-application_type" name="application_type"  placeholder="Select a value ..."    class="custom-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                            $application_type_options = Menu :: $application_type;
                                            if(!empty($application_type_options)){
                                            foreach($application_type_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            $selected = $this->set_field_selected('application_type', $value, "");
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
                                    <label class="control-label" for="applicant_name">Applicant Full Name / अर्जदाराचे संपूर्ण नाव <span class="text-danger">*</span></label>
                                    <div id="ctrl-applicant_name-holder" class=""> 
                                        <input id="ctrl-applicant_name"  value="<?php  echo $this->set_field_value('applicant_name',""); ?>" type="text" placeholder="Enter Applicant Full Name / अर्जदाराचे संपूर्ण नाव"  required="" name="applicant_name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="mobile_no">MOBILE NUMBER  <span class="text-danger">*</span></label>
                                        <div id="ctrl-mobile_no-holder" class=""> 
                                            <input id="ctrl-mobile_no"  value="<?php  echo $this->set_field_value('mobile_no',""); ?>" type="number" placeholder="Enter Mobile No" min="1000000000" max="9999999999" step="1"  required="" name="mobile_no"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="applicant_address">Applicant Address / अर्जदाराचा पत्ता <span class="text-danger">*</span></label>
                                            <div id="ctrl-applicant_address-holder" class=""> 
                                                <input id="ctrl-applicant_address"  value="<?php  echo $this->set_field_value('applicant_address',""); ?>" type="text" placeholder="Enter Applicant Address / अर्जदाराचा पत्ता"  required="" name="applicant_address"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="property_owner_name">Property Owner Name/मालमत्तेच्या मालकाचे नाव <span class="text-danger">*</span></label>
                                                <div id="ctrl-property_owner_name-holder" class=""> 
                                                    <input id="ctrl-property_owner_name"  value="<?php  echo $this->set_field_value('property_owner_name',""); ?>" type="text" placeholder="Enter Property Owner Name/मालमत्तेच्या मालकाचे नाव"  required="" name="property_owner_name"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="peth">Ward / प्रभाग  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-peth-holder" class=""> 
                                                        <select required=""  id="ctrl-peth" name="peth"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                            <?php 
                                                            $peth_options = $comp_model -> application_form_peth_option_list();
                                                            if(!empty($peth_options)){
                                                            foreach($peth_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $selected = $this->set_field_selected('peth',$value, "");
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
                                                    <label class="control-label" for="city_survey_number">City Survey Number / शहर सर्वे नंबर  <span class="text-danger">*</span></label>
                                                    <div id="ctrl-city_survey_number-holder" class=""> 
                                                        <input id="ctrl-city_survey_number"  value="<?php  echo $this->set_field_value('city_survey_number',""); ?>" type="text" placeholder="Enter City Survey Number / शहर सर्वे नंबर "  required="" name="city_survey_number"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="location_of_tree">Address of Tree / झाडाचा पत्ता <span class="text-danger">*</span></label>
                                                        <div id="ctrl-location_of_tree-holder" class=""> 
                                                            <input id="ctrl-location_of_tree"  value="<?php  echo $this->set_field_value('location_of_tree',""); ?>" type="text" placeholder="Enter Address of Tree / झाडाचा पत्ता"  required="" name="location_of_tree"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="no_of_trees">No Of Trees / झाडांची संख्या <span class="text-danger">*</span></label>
                                                            <div id="ctrl-no_of_trees-holder" class=""> 
                                                                <input id="ctrl-no_of_trees"  value="<?php  echo $this->set_field_value('no_of_trees',""); ?>" type="number" placeholder="Enter No Of Trees / झाडांची संख्या" step="1"  required="" name="no_of_trees"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="cut_purpose">Reason To Cut Tree / झाड कापण्याचे कारण<span class='text-danger'>*</span> </label>
                                                                <div id="ctrl-cut_purpose-holder" class=""> 
                                                                    <select  id="ctrl-cut_purpose" name="cut_purpose"  placeholder="Select a value ..."    class="custom-select" >
                                                                        <option value="">Select a value ...</option>
                                                                        <?php
                                                                        $cut_purpose_options = Menu :: $cut_purpose;
                                                                        if(!empty($cut_purpose_options)){
                                                                        foreach($cut_purpose_options as $option){
                                                                        $value = $option['value'];
                                                                        $label = $option['label'];
                                                                        $selected = $this->set_field_selected('cut_purpose', $value, "");
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
                                                                <label class="control-label" for="reason_to_cut_tree">Reason To Cut Tree / झाड कापण्याचे कारण </label>
                                                                <div id="ctrl-reason_to_cut_tree-holder" class=""> 
                                                                    <input id="ctrl-reason_to_cut_tree"  value="<?php  echo $this->set_field_value('reason_to_cut_tree',""); ?>" type="text" placeholder="Enter Reason To Cut Tree / झाड कापण्याचे कारण"  name="reason_to_cut_tree"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="extract_7_12">Extract 7/12 / 7/12 उतारा  <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-extract_7_12-holder" class=""> 
                                                                        <div class="dropzone required" input="#ctrl-extract_7_12" fieldname="extract_7_12"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                                            <input name="extract_7_12" id="ctrl-extract_7_12" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('extract_7_12',""); ?>" type="text"  />
                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label class="control-label" for="noc_of_property">Noc Of Property /  मालमत्तेचा ना  हरकत दाखला  <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-noc_of_property-holder" class=""> 
                                                                            <div class="dropzone required" input="#ctrl-noc_of_property" fieldname="noc_of_property"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                                                <input name="noc_of_property" id="ctrl-noc_of_property" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('noc_of_property',""); ?>" type="text"  />
                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group form-submit-btn-holder text-center mt-3">
                                                                        <div class="form-ajax-status"></div>
                                                                        <button class="btn btn-primary" type="submit">
                                                                            Submit Application
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
                                                                    $("#ctrl-application_type").css("pointer-events",'none');
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
