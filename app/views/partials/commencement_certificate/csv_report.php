<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("commencement_certificate/add");
$can_edit = ACL::is_allowed("commencement_certificate/edit");
$can_view = ACL::is_allowed("commencement_certificate/view");
$can_delete = ACL::is_allowed("commencement_certificate/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="">
                        <!-- Page bread crumbs components-->
                        <?php
                        if(!empty($field_name) || !empty($_GET['search'])){
                        ?>
                        <hr class="sm d-block d-sm-none" />
                        <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                            <ul class="breadcrumb m-0 p-1">
                                <?php
                                if(!empty($field_name)){
                                ?>
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none" href="<?php print_link('commencement_certificate'); ?>">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                </li>
                                <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                    <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                </li>
                                <?php 
                                }   
                                ?>
                                <?php
                                if(get_value("search")){
                                ?>
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none" href="<?php print_link('commencement_certificate'); ?>">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item text-capitalize">
                                    Search
                                </li>
                                <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                        <!--End of Page bread crumbs components-->
                        <?php
                        }
                        ?>
                    </div>
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
                    <div  class=" animated fadeIn page-content">
                        <?php
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        $from_date = $_GET['from_date'] ?? '';
                        $to_date   = $_GET['to_date'] ?? '';
                        if(!empty($from_date) && !empty($to_date)){
                        $db->where("DATE(date)", $from_date, ">=");
                        $db->where("DATE(date)", $to_date, "<=");
                        }
                        $db->where("status", 11);
                        $db->where("permission_upload","","!=");
                        $records = $db->get("commencement_certificate");
                        /* =====================
                        BUILD CSV DATA
                        ===================== */
                        $csvData = "\xEF\xBB\xBF";
                        $csvData .= "Sr No,BPMS Project Code,Application No,Applicant Name,Survey No,Application Date,Area (Sq Mtr),Trees Existing,Total Trees,NOC Ref\n";
                        $sr = 1;
                        foreach($records as $row){
                        $app_date = date("jS F Y", strtotime($row['date']));
                        $noc_date = date("jS F Y", strtotime($row['updated_timestamp']));
                        $noc = "जा.क्र.कडोंमपा/उद्यान/वृअ/वृप्रा/".$row['outward_no']." (".$noc_date.")";
                        $csvData .= $sr.",,"
                        .$row['application_no'].","
                        ."\"".$row['applicant_full_name']."\","
                        ."\"".$row['survey_no']."\","
                        .$app_date.","
                        .$row['plot_area_in_sq_mtr'].","
                        ."\"".$row['names_of_trees_be_planted']."\","
                        .$row['trees_to_be_planted'].","
                        ."\"".$noc."\"\n";
                        $sr++;
                        }
                        ?>
                        <!DOCTYPE html>
                        <html>
                            <head>
                                <meta charset="UTF-8">
                                    <title>Commencement Certificate Report</title>
                                    <style>
                                        body{
                                        font-family: Arial,"Noto Sans Devanagari",sans-serif;
                                        font-size:14px;
                                        margin:20px;
                                        }
                                        .report-form{
                                        background:#f9f9f9;
                                        padding:15px;
                                        border:1px solid #ccc;
                                        border-radius:5px;
                                        margin-bottom:20px;
                                        display:inline-block;
                                        }
                                        .report-form label{
                                        font-weight:bold;
                                        color:#003366;
                                        margin-right:8px;
                                        }
                                        .report-form input{
                                        padding:6px 10px;
                                        border:1px solid #ccc;
                                        border-radius:4px;
                                        }
                                        .btn{
                                        padding:8px 16px;
                                        border-radius:4px;
                                        text-decoration:none;
                                        color:white;
                                        font-weight:bold;
                                        }
                                        .btn-success{
                                        background:#28a745;
                                        }
                                        .btn-danger{
                                        background:#dc3545;
                                        }
                                        .table{
                                        width:100%;
                                        border-collapse:collapse;
                                        margin-top:15px;
                                        }
                                        .table th,
                                        .table td{
                                        border:1px solid black;
                                        padding:8px;
                                        }
                                        .table th{
                                        background:#003366;
                                        color:white;
                                        text-align:center;
                                        }
                                        .center{
                                        text-align:center;
                                        }
                                        .right{
                                        text-align:right;
                                        }
                                        @media print{
                                        .report-form{
                                        display:none;
                                        }
                                        table, th, td{
                                        border:1px solid black !important;
                                        border-collapse:collapse !important;
                                        }
                                        }
                                    </style>
                                </head>
                                <body>
                                    <h2 style="color:#003366;">COMMENCEMENT CERTIFICATE REPORT</h2>
                                    <br>
                                        <form method="GET" class="report-form">
                                            <label>From Date :</label>
                                            <input type="date" name="from_date" value="<?= htmlspecialchars($from_date) ?>">
                                                <label style="margin-left:15px;">To Date :</label>
                                                <input type="date" name="to_date" value="<?= htmlspecialchars($to_date) ?>">
                                                    <button type="submit">Show Report</button>
                                                    <a href="javascript:void(0);" onclick="downloadCSV()" class="btn btn-success" style="margin-left:15px;">
                                                        Download Excel
                                                    </a>
                                                    <button type="button" onclick="window.print()" class="btn btn-danger" style="margin-left:10px;">
                                                        Download PDF
                                                    </button>
                                                </form>
                                                <table class="table">
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Application No.</th>
                                                        <th>Applicant Name</th>
                                                        <th>Survey No.</th>
                                                        <th>Application Date</th>
                                                        <th>Area (Sq. Mtr.)</th>
                                                        <th>Trees Existing</th>
                                                        <th>Total Trees</th>
                                                        <th>NOC Reference No. & Date</th>
                                                    </tr>
                                                    <?php if(!empty($records)): ?>
                                                    <?php $sr=1; ?>
                                                    <?php foreach($records as $row): ?>
                                                    <?php
                                                    $app_date = date("jS F Y", strtotime($row['date']));
                                                    $noc_date = date("jS F Y", strtotime($row['updated_timestamp']));
                                                    $noc = "जा.क्र.कडोंमपा/उद्यान/वृअ/वृप्रा/".$row['outward_no']." (".$noc_date.")";
                                                    ?>
                                                    <tr>
                                                        <td class="center"><?= $sr ?></td>
                                                        <td><?= htmlspecialchars($row['application_no']) ?></td>
                                                        <td><?= htmlspecialchars($row['applicant_full_name']) ?></td>
                                                        <td><?= htmlspecialchars($row['survey_no']) ?></td>
                                                        <td><?= $app_date ?></td>
                                                        <td class="right"><?= $row['plot_area_in_sq_mtr'] ?></td>
                                                        <td><?= htmlspecialchars($row['names_of_trees_be_planted']) ?></td>
                                                        <td class="center"><?= $row['trees_to_be_planted'] ?></td>
                                                        <td><?= $noc ?></td>
                                                    </tr>
                                                    <?php $sr++; ?>
                                                    <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr>
                                                        <td colspan="9" class="center" style="padding:30px;">No Records Found</td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </table>
                                                <script>
                                                    function downloadCSV(){
                                                    var csv = `<?php echo $csvData; ?>`;
                                                    var blob = new Blob([csv], { type: 'text/csv' });
                                                    var link = document.createElement("a");
                                                    link.href = window.URL.createObjectURL(blob);
                                                    link.download = "commencement_certificate_report.csv";
                                                    document.body.appendChild(link);
                                                    link.click();
                                                    document.body.removeChild(link);
                                                    }
                                                </script>
                                            </body>
                                        </html>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
