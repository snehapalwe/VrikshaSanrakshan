<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="">
        <div class="container-fluid text-center">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""><?php  if(USER_ROLE==2 ){ ?></div><div class=""><div class="container mt-5">
                        <?php
                        $buttons = [
                        [
                        "apply" => ["url" => "application_form/add?application_type=PARTIAL TREE CUT", "label" => "Tree Trimming Application / वृक्ष छाटणी परवानगी"],
                        "view" => ["url" => "application_form/list", "label" => "View Application / आपला अर्ज पहा"]
                        ],
                        [
                        "apply" => ["url" => "application_form/add?application_type=FULL TREE CUT", "label" => "Full Tree Cutting Application / वृक्ष तोडने परवानगी"],
                        "view" => ["url" => "application_form/list", "label" => "View Application / आपला अर्ज पहा"]
                        ],
                        [
                        "apply" => ["url" => "commencement_certificate/add", "label" => "Commencement Certificate Application / वृक्ष प्राधिकरण बांधकाम प्रारंभ ना-हरकत प्रमाणपत्र"],
                        "view" => ["url" => "commencement_certificate/list", "label" => "View Commencement Certificate Application / वृक्ष प्राधिकरण बांधकाम प्रारंभ ना-हरकत प्रमाणपत्र पहा"]
                        ],
                        [
                        "apply" => ["url" => "occupancy_certificate/add", "label" => "Occupancy Certificate Application / वृक्ष प्राधिकरण बांधकाम अंतिम ना-हरकत प्रमाणपत्र"],
                        "view" => ["url" => "occupancy_certificate/list", "label" => "View Occupancy Certificate Application / वृक्ष प्राधिकरण बांधकाम अंतिम ना-हरकत प्रमाणपत्र पहा"]
                        ],
                        [
                        "apply" => ["url" => "objections/add", "label" => "Objection Application / आक्षेप नोंदविणे"],
                        "view" => ["url" => "paper_notice/list", "label" => "Objection Information / आक्षेप माहिती"]
                        ],
                        [
                        "apply" => ["url" => "refund/add", "label" => "Refund / परतावा"],
                        "view" => ["url" => "refund/list", "label" => "Refund Information / परतावा माहिती"]
                        ],
                        ];
                        foreach ($buttons as $pair) {
                        ?>
                        <div class="row mb-3">
                            <div class="col-md-6 text-center">
                                <a class="btn-dashboard btn-apply" href="<?php echo SITE_ADDR . $pair['apply']['url']; ?>">
                                    <?php echo $pair['apply']['label']; ?>
                                </a>
                            </div>
                            <div class="col-md-6 text-center">
                                <a class="btn-dashboard btn-status" href="<?php echo SITE_ADDR . $pair['view']['url']; ?>">
                                    <?php echo $pair['view']['label']; ?>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    </div><div class="">
                    <style>
                        /* General Button Styling */
                        .btn-dashboard {
                        font-size: 14px;
                        font-weight: bold;
                        padding: 14px 24px;
                        border-radius: 8px;
                        text-transform: uppercase;
                        transition: transform 0.2s ease-in-out;
                        border: none;
                        cursor: pointer;
                        display: inline-block;
                        width: 400px;
                        text-align: left;
                        padding-left: 20px;
                        margin: 6px 0; /* Reduced vertical space */
                        white-space: normal;
                        word-wrap: break-word;
                        text-decoration: none !important; /* No underline */
                        color: white !important;
                        }
                        /* Apply Button - Soft Green */
                        .btn-apply {
                        background: linear-gradient(135deg, #32CD32, #006400);
                        color: white;
                        box-shadow: 0 2px 6px rgba(50, 205, 50, 0.2); /* Reduced glow */
                        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                        }
                        .btn-apply:hover {
                        color: #eaffea !important;
                        transform: scale(1.03); /* Slight zoom only */
                        box-shadow: 0 3px 8px rgba(50, 205, 50, 0.3); /* Softer glow */
                        text-decoration: none !important;
                        }
                        /* View Button - Soft Gold */
                        .btn-status {
                        background: linear-gradient(135deg, #ffd700, #b8860b);
                        color: white;
                        box-shadow: 0 2px 6px rgba(255, 215, 0, 0.3); /* Reduced glow */
                        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                        }
                        .btn-status:hover {
                        color: #fff5b7 !important;
                        transform: scale(1.03);
                        box-shadow: 0 3px 8px rgba(255, 215, 0, 0.3); /* Softer glow */
                        text-decoration: none !important;
                        }
                    </style> 
                <script>
                    $("#topbar ul:first").hide();
                </script>
                <style>
                    body {
                    /*background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('<?php echo SITE_ADDR ?>bgimg.jpg');*/
                    margin: 0;
                    padding: 0;
                    height: 100vh; /* Full viewport height */
                    width: 100vw; /* Full viewport width */ 
                    background-size: cover; /* Ensures the image covers the entire page */
                    background-position: center; /* Centers the image */
                    background-repeat: no-repeat; /* Prevents tiling */
                    }
                </style>
            <?php } ?></div>
        </div>
    </div>
</div>
</div>
<div  class="">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 comp-grid">
                </div>
                <?php if(USER_ROLE==1 || USER_ROLE==3 || USER_ROLE==7 || USER_ROLE==9 || USER_ROLE==10 || USER_ROLE==12){ ?>
                </div>
                <div class=""><h2 style="font-size: 20px; font-weight: 600; margin-bottom: 10px; margin-top: 10px; color: #003366;">
                    Overall Summary Report
                </h2>
                <?php 
                    $jei = new User_infoController();
                    $db = $jei->GetModel();
                    $user_id = get_active_user("id"); 
                    $user_name = get_active_user("name"); 
                    $services = [
                    "Commencement Certificate Application / वृक्ष प्राधिकरण बांधकाम प्रारंभ ना-हरकत प्रमाणपत्र" => "commencement_certificate",
                    "Occupancy Certificate Application / वृक्ष प्राधिकरण बांधकाम अंतिम ना-हरकत प्रमाणपत्र" => "occupancy_certificate"
                    ];
                ?>
                            <div class="stock-report-table-container"> 
                                <table class="stock-report-table">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name of Service</th>
                                        <th>Total Applications Received</th>
                                        <th>Pending at Garden Inspector</th>
                                        <th>Pending at Garden Superintendent</th>
                                        <th>Pending at Chief Garden Superintendent</th>
                                        <th>Completed Applications</th>
                                        <th>Reverted Applications</th>
                                        <th>Rejected Applications</th>
                                    </tr>
                                    <?php
                                    $i = 0;
                                    foreach ($services as $service_name => $table_name) {
                                    $i++;
                                    
                                    // Fetch total count
                                    $count = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch citizen pending count
                                    $db->where("status", "0");
                                    $count_pending_at_citizen = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch pending auth1 approval count
                                    $db->where("status", "7");
                                    $count_pending_at_auth1 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch pending auth2 approval count
                                    $db->where("status=9 or status=13 or status=10 or (status=11 and permission_upload='')");
                                    $count_pending_at_auth2 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch pending auth3 approval count
                                    $db->where("status", "10");
                                    $count_pending_at_auth3 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch pending auth4 approval count
                                    $db->where("status", "4");
                                    $count_pending_at_auth4 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch completed count
                                    $db->where("status", "11");
                                    $db->where("permission_upload", "","!=");
                                    $count_completed = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch rejected count
                                    $db->where("status", "-2");
                                    $count_rejected = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Fetch reverted count
                                    $db->where("status", "-100");
                                    $count_reverted = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
        
                                    // Total Count
                                    $count_total=$count-$count_pending_at_citizen;
        
                                    echo "<tr>";
                                        echo "<td>" . $i . "</td>";                          // Sr. No.
                                        echo "<td>" . $service_name . "</td>";               // Services
                                        echo "<td><span style='background-color: #ffc107; color: #212529; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $count_total . "</span></td>";
                                        // Pending at Auth1 – Light Blue
                                        echo "<td><span style='background-color: #bee5eb; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $count_pending_at_auth1 . "</span></td>";
                                        // Pending at Auth2 – Light Teal
                                        echo "<td><span style='background-color: #d1ecf1; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $count_pending_at_auth2 . "</span></td>";
                                        // Pending at Auth3 – Light Purple
                                        echo "<td><span style='background-color: #e2d9f3; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $count_pending_at_auth3 . "</span></td>";
                                        // Completed – Green
                                        echo "<td><span style='background-color: #28a745; color: #fff; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $count_completed . "</span></td>";
                                        // Reverted – Orange
                                        echo "<td><span style='background-color: #fd7e14; color: #fff; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $count_reverted . "</span></td>";
                                        // Rejected – Red
                                        echo "<td><span style='background-color: #dc3545; color: #fff; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $count_rejected . "</span></td>";
                                    echo "</tr>"; 
                                    }
                                    ?>
                                </table>
                            </div>
                        </br>
                        </br>
                </div> 
                <!-- End of Div Tag -->
                
                <!-- New Dashboard Function-->
                <div class="col-md-12 comp-grid">
                <div class=""><h2 style="font-size: 20px; font-weight: 600; margin-bottom: 10px; margin-top: 10px; color: #003366;">
                    Ward wise Report
                </h2>
                <form method="GET" style="margin-bottom: 20px;">
                    <label for="from_date">From: </label>
                    <input type="date" id="from_date" name="from_date" value="<?= $_GET['from_date'] ?? '' ?>" required>
                        <label for="to_date" style="margin-left: 10px;">To: </label>
                        <input type="date" id="to_date" name="to_date" value="<?= $_GET['to_date'] ?? '' ?>" required>
                            <button type="submit" style="margin-left: 10px;">Filter</button>
                        </form>
                        <style>
                            form {
                            background: #f9f9f9;
                            padding: 15px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            display: inline-block;
                            margin-bottom: 20px;
                            }
                            form label {
                            font-weight: bold;
                            color: #003366;
                            margin-right: 5px;
                            }
                            form input[type="date"] {
                            padding: 5px 10px;
                            margin-right: 10px;
                            border: 1px solid #ccc;
                            border-radius: 3px;
                            }
                            form button {
                            background-color: #003366;
                            color: #fff;
                            padding: 6px 12px;
                            border: none;
                            border-radius: 3px;
                            cursor: pointer;
                            }
                            form button:hover {
                            background-color: #005b9a;
                            }
                            button {
                            padding: 6px 12px;
                            background-color: #28a745;
                            border: none;
                            color: white;
                            border-radius: 4px;
                            font-weight: bold;
                            cursor: pointer;
                            }
                            button:hover {
                            background-color: #218838;
                            }
                        </style>
                        <?php 
                        $from_date = $_GET['from_date'] ?? '';
                        $to_date = $_GET['to_date'] ?? '';
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        
                        // Fetch logged-in user's details
                        $user_id = get_active_user("id"); 
                        $user_name = get_active_user("name"); 
                        
                        // Define services with respective table names
                        $services = [
                            "Tree Commencement Certificate" => "commencement_certificate",
                            "Tree Occupancy Certificate" => "occupancy_certificate"
                        ];
                        ?>
                        
                        <div class="wide-report-table-container"> 
                            <table class="wide-report-table">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name of Service</th>
                                    <th>Total Applications Received</th>
                                    <!--<th>Pending at Citizen</th>-->
                                    <th>Pending at Auth1</th>
                                    <th>Pending at Auth2</th>
                                    <!-- <th>Pending at Auth2-A</th> -->
                                    <!-- <th>Pending at Auth2-B</th> -->
                                    <!-- <th>Pending at Auth2-C</th> -->
                                    <!-- <th>Pending at Auth2-D</th> -->
                                    <!-- <th>Pending at Auth2-E</th> -->
                                    <!-- <th>Pending at Auth2-F</th> -->
                                    <!-- <th>Pending at Auth2-G</th> -->
                                    <!-- <th>Pending at Auth2-H</th> -->
                                    <!-- <th>Pending at Auth2-I</th> -->
                                    <th>Pending at Auth3</th>
                                    <!--<th>Pending at Auth4</th>-->
                                    <th>Completed Applications</th>
                                    <th>Reverted Applications</th>
                                    <th>Rejected Applications</th>
                                </tr>
                                <?php
                                $i = 0;
                                $zones = ['A','B','C','D','E','F','G','H','I','J'];
                                foreach ($services as $service_name => $table_name) {
                                $i++;
                                // Fetch counts
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $db->where("status", "0");
                                // Total count without pending at citizen
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_pending_at_citizen = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                $count_total=$count-$count_pending_at_citizen;
                                $db->where("status", "7");
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_pending_at_auth1 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                // $db->where("status", "9");
                                    $db->where("(status=9 or status=13 or status=10 or (status=11 and permission_upload=''))");
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_pending_at_auth2 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                // Zone-wise Auth2 counts
                                // $auth2_zone_counts = [];
                                // foreach ($zones as $zone) {
                                // $db->where("status", "9");
                                // $db->where("zone_value", $zone);
                                // if ($from_date && $to_date) {
                                // $db->where("DATE(timestamp)", $from_date, ">=");
                                // $db->where("DATE(timestamp)", $to_date, "<=");
                                // }
                                // $auth2_zone_counts[$zone] = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                // }
                                $db->where("status", "10");
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_pending_at_auth3 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                $db->where("status", "4");
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_pending_at_auth4 = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                $db->where("status", "11"); 
                                $db->where("permission_upload", "","!=");
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_completed = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                $db->where("status", "-2");
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_rejected = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                $db->where("status", "-100");
                                if ($from_date && $to_date) {
                                $db->where("DATE(timestamp)", $from_date, ">=");
                                $db->where("DATE(timestamp)", $to_date, "<=");
                                }
                                $count_rev = $db->getOne($table_name, "count(id) as num")['num'] ?? 0;
                                // Output table row
                                echo "<tr>";
                                    echo "<td>$i</td>";
                                    echo "<td>$service_name</td>";
                                    echo "<td><span style='background-color: #ffc107; color: #212529; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_total</span></td>";
                                    // echo "<td><span style='background-color: #e2e3e5; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_pending_at_citizen</span></td>";
                                    echo "<td><span style='background-color: #bee5eb; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_pending_at_auth1</span></td>";
                                    echo "<td><span style='background-color: #d1ecf1; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_pending_at_auth2</span></td>";
                                    // foreach ($zones as $zone) {
                                    //     echo "<td><span style='background-color: #d1ecf1; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>" . $auth2_zone_counts[$zone] . "</span></td>";
                                    // }
                                    echo "<td><span style='background-color: #e2d9f3; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_pending_at_auth3</span></td>";
                                    // echo "<td><span style='background-color: #ffe5b4; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_pending_at_auth4</span></td>";
                                    echo "<td><span style='background-color: #B8FFB8; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_completed</span></td>";
                                    echo "<td><span style='background-color: #fd7e14; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_rev</span></td>";
                                    echo "<td><span style='background-color: #FFB8B8; color: #000; padding: 2px 6px; border-radius: 3px; font-weight: bold;'>$count_rejected</span></td>";
                                echo "</tr>";
                                }
                                ?>
                            </table>
                            <br><br>
                                <button onclick="exportTableToExcel('reportTable', 'ward_report')" style="margin-right: 10px;">Export to Excel</button>
                                <button onclick="printTable()" style="margin-right: 10px;">Export to PDF</button>
                                <script>
                                    function exportTableToExcel(tableID, filename = '') {
                                    const tableSelect = document.querySelector('.wide-report-table-container table');
                                    const tableHTML = tableSelect.outerHTML;
                                    const blob = new Blob(
                                    ['\ufeff' + tableHTML],
                                    { type: 'application/vnd.ms-excel;charset=utf-8;' }
                                    );
                                    const downloadLink = document.createElement('a');
                                    const url = URL.createObjectURL(blob);
                                    downloadLink.href = url;
                                    downloadLink.download = filename ? filename + '.xls' : 'ward_report.xls';
                                    downloadLink.click();
                                    URL.revokeObjectURL(url);
                                    }
                                    function printTable() {
                                    const divToPrint = document.querySelector('.wide-report-table-container').innerHTML;
                                    const newWin = window.open('', '_blank');
                                    newWin.document.write('<html><head><title>PDF Export</title></head><body>');
                                        newWin.document.write('<h2>Ward Wise Report</h2>');
                                        newWin.document.write(divToPrint);
                                    newWin.document.write('</body></html>');
                                    newWin.document.close();
                                    newWin.print();
                                    }
                                </script>
                            </div>
                        </br>
                    </br>
                </div>
                <!-- End of Div Tag -->
            </div>
        </div>
    </div>
</div>
<div  class="">
    <div class="container d-none">
        <div class="row ">
            <div class="col comp-grid">
                <div class="card card-body">
                    <?php 
                    $chartdata = $comp_model->barchart_applicationspermonth();
                    ?>
                    <div>
                        <h4>Applications per month</h4>
                        <small class="text-muted"></small>
                    </div>
                    <hr />
                    <canvas id="barchart_applicationspermonth"></canvas>
                    <script>
                        $(function (){
                        var chartData = {
                        labels : <?php echo json_encode($chartdata['labels']); ?>,
                        datasets : [
                        {
                        label: 'Application report monthly',
                        backgroundColor:'<?php echo random_color(0.9); ?>',
                        type:'bar',
                        borderWidth:3,
                        data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                        }
                        ]
                        }
                        var ctx = document.getElementById('barchart_applicationspermonth');
                        var chart = new Chart(ctx, {
                        type:'bar',
                        data: chartData,
                        options: {
                        scaleStartValue: 0,
                        responsive: true,
                        scales: {
                        xAxes: [{
                        ticks:{display: true},
                        gridLines:{display: true},
                        categoryPercentage: 1.0,
                        barPercentage: 0.8,
                        scaleLabel: {
                        display: true,
                        labelString: ""
                        },
                        }],
                        yAxes: [{
                        ticks: {
                        beginAtZero: true,
                        display: true
                        },
                        scaleLabel: {
                        display: true,
                        labelString: ""
                        }
                        }]
                        },
                        }
                        ,
                        })});
                    </script>
                </div>
            </div>
            <div class="col comp-grid">
                <div class="card card-body">
                    <?php 
                    $chartdata = $comp_model->piechart_totalapplication();
                    ?>
                    <div>
                        <h4>Total Application</h4>
                        <small class="text-muted"></small>
                    </div>
                    <hr />
                    <canvas id="piechart_totalapplication"></canvas>
                    <script>
                        $(function (){
                        var chartData = {
                        labels : <?php echo json_encode($chartdata['labels']); ?>,
                        datasets : [
                        {
                        label: 'Total Application',
                        backgroundColor:[
                        <?php 
                        foreach($chartdata['labels'] as $g){
                        echo "'" . random_color(0.9) . "',";
                        }
                        ?>
                        ],
                        borderWidth:3,
                        data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                        }
                        ]
                        }
                        var ctx = document.getElementById('piechart_totalapplication');
                        var chart = new Chart(ctx, {
                        type:'pie',
                        data: chartData,
                        options: {
                        responsive: true,
                        scales: {
                        yAxes: [{
                        ticks:{display: false},
                        gridLines:{display: false},
                        scaleLabel: {
                        display: true,
                        labelString: ""
                        }
                        }],
                        xAxes: [{
                        ticks:{display: false},
                        gridLines:{display: false},
                        scaleLabel: {
                        display: true,
                        labelString: ""
                        }
                        }],
                        },
                        }
                        ,
                        })});
                    </script>
                </div>
                <div class=""><div></div>
                <?php } ?></div>
            </div>
        </div>
    </div>
</div>
</div>
