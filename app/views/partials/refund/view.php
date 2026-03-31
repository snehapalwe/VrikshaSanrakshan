<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("refund/add");
$can_edit = ACL::is_allowed("refund/edit");
$can_view = ACL::is_allowed("refund/view");
$can_delete = ACL::is_allowed("refund/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Refund</h4>
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
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-date_of_permission">
                                        <th class="title"> Date Of Permission: </th>
                                        <td class="value"> <?php echo $data['date_of_permission']; ?></td>
                                    </tr>
                                    <tr  class="td-application_id">
                                        <th class="title"> Application Id: </th>
                                        <td class="value"> <?php echo $data['application_id']; ?></td>
                                    </tr>
                                    <tr  class="td-no_of_tree_cut">
                                        <th class="title"> No Of Tree Cut: </th>
                                        <td class="value"> <?php echo $data['no_of_tree_cut']; ?></td>
                                    </tr>
                                    <tr  class="td-no_of_tree_planted">
                                        <th class="title"> No Of Tree Planted: </th>
                                        <td class="value"> <?php echo $data['no_of_tree_planted']; ?></td>
                                    </tr>
                                    <tr  class="td-upload_original_reciept">
                                        <th class="title"> Upload Original Reciept: </th>
                                        <td class="value"> <?php echo $data['upload_original_reciept']; ?></td>
                                    </tr>
                                    <tr  class="td-complete_address_of_plantation">
                                        <th class="title"> Complete Address Of Plantation: </th>
                                        <td class="value"> <?php echo $data['complete_address_of_plantation']; ?></td>
                                    </tr>
                                    <tr  class="td-bank_name">
                                        <th class="title"> Bank Name: </th>
                                        <td class="value"> <?php echo $data['bank_name']; ?></td>
                                    </tr>
                                    <tr  class="td-account_number">
                                        <th class="title"> Account Number: </th>
                                        <td class="value"> <?php echo $data['account_number']; ?></td>
                                    </tr>
                                    <tr  class="td-ifsc_code">
                                        <th class="title"> Ifsc Code: </th>
                                        <td class="value"> <?php echo $data['ifsc_code']; ?></td>
                                    </tr>
                                    <tr  class="td-account_holder_name">
                                        <th class="title"> Account Holder Name: </th>
                                        <td class="value"> <?php echo $data['account_holder_name']; ?></td>
                                    </tr>
                                    <tr  class="td-timestamp">
                                        <th class="title"> Timestamp: </th>
                                        <td class="value"> <?php echo $data['timestamp']; ?></td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $status2); ?>' 
                                                data-value="<?php echo $data['status']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("refund/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="status" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-amount">
                                        <th class="title"> Amount: </th>
                                        <td class="value"> <?php echo $data['amount']; ?></td>
                                    </tr>
                                    <tr  class="td-flag_inspection">
                                        <th class="title"> Flag Inspection: </th>
                                        <td class="value"> <?php echo $data['flag_inspection']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                            <a class="btn  btn-sm btn-primary export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                </a>
                                <?php if($can_edit){ ?>
                                <a class="btn btn-sm btn-info"  href="<?php print_link("refund/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("refund/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                    <i class="fa fa-times"></i> Delete
                                </a>
                                <?php } ?>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <!-- Empty Record Message -->
                            <div class="text-muted p-3">
                                <i class="fa fa-ban"></i> No Record Found
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
