<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("payment2/add");
$can_edit = ACL::is_allowed("payment2/edit");
$can_view = ACL::is_allowed("payment2/view");
$can_delete = ACL::is_allowed("payment2/delete");
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
                    <h4 class="record-title">View Receipt</h4>
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
                        $jei=new User_infoController();
                        $db = $jei->GetModel();
                        $pay1=$db->get("payments",999999,"id,timestamp");
                        $pay2=$db->get("payments2",999999,"id,timestamp");
                        $rec_no=0;
                        foreach($pay2 as $p){
                        $p['type']=2;
                        $pay1[]=$p;
                        }
                        if(date("m")>=4){
                        $rec_no="VVMC/".(date("y")).(date("y")+1)."/$rec_no";
                        }else{ 
                        $rec_no="VVMC/".(date("y")-1).(date("y"))."/$rec_no";
                        }
                        usort($pay1, function($a, $b) {
                        return strtotime($a['timestamp']) <=> strtotime($b['timestamp']);
                        });
                        $i=0;
                        foreach($pay1 as $p){
                        $i++;
                        if($p['id']==$data['id'] && isset($p['type'])){
                        $rec_no=$i;
                        break;
                        }
                        }
                        if(date("m")>=4){
                        $rec_no="VVMC/".(date("y")).(date("y")+1)."/$rec_no";
                        }else{ 
                        $rec_no="VVMC/".(date("y")-1).(date("y"))."/$rec_no";
                        }
                        ?>
                        <?php
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        $subject = "";
                        // Fetch request sub-entry data
                        if($data['db_name']=="occupancy_certificate"){ 
                        $db->where("id", $data['rec_id']);
                        $application_id = $db->getOne("occupancy_certificate", " application_no as oc_application_id");
                        }else{
                        $db->where("id", $data['rec_id']);
                        $application_id = $db->getOne("commencement_certificate", " application_no  as oc_application_id");
                        }
                        $subject = "";
                        // Fetch request sub-entry data
                        if ($data['db_name'] == "occupancy_certificate") {
                        $subject = "वृक्ष प्राधिकरण विभागाचा बांधकाम अंतिम ना-हरकत दाखला";
                        } else if ($data['db_name'] == "commencement_certificate") {
                        $subject = "वृक्ष प्राधिकरण विभागाचा बांधकाम प्रारंभ ना-हरकत दाखला";
                        }
                        ?>
                        <!DOCTYPE html>
                        <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <title>Receipt</title>
                                        <style>
                                            body {
                                            font-family: Arial, sans-serif;
                                            margin: 40px; /* Margin outside the entire receipt */
                                            line-height: 1.2;
                                            background-color: #fff; /* White background to match the receipt */
                                            }
                                            .container {
                                            width: 100%;
                                            max-width: 800px;
                                            margin: 40px; /* Centering the container */
                                            padding: 20px; /* Internal spacing */
                                            }
                                            .receipt-section {
                                            position: relative; /* For absolute positioning of copy-label */
                                            margin-bottom: 20px; /* Space between sections */
                                            }
                                            .header-container {
                                            display: flex;
                                            justify-content: space-between; /* Space between logo, title, and QR code */
                                            align-items: center; /* Vertically center the items */
                                            margin-bottom: 10px;
                                            }
                                            .title-section {
                                            text-align: center; /* Center the title text */
                                            flex-grow: 1; /* Allow the title section to take up remaining space */
                                            }
                                            .header {
                                            font-size: 18px;
                                            font-weight: bold;
                                            margin-bottom: 5px;
                                            color: #000;
                                            }
                                            .subheader {
                                            font-size: 16px;
                                            color: #000;
                                            }
                                            .logo {
                                            width: 85px;
                                            height: 85px;
                                            }
                                            .qr-code {
                                            width: 100px;
                                            height: 100px;
                                            }
                                            .copy-label {
                                            position: absolute;
                                            top: -20px; /* Moved up to avoid closeness to QR code */
                                            right: 0;
                                            font-size: 12px;
                                            color: #000;
                                            }
                                            table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin-bottom: 10px;
                                            border: 2px solid #000; /* Bold outer border on table */
                                            }
                                            th, td {
                                            border: 1px solid #000; /* Thin inner borders */
                                            padding: 5px; /* Reduced padding to match the compact look */
                                            text-align: left;
                                            font-size: 12px;
                                            }
                                            th {
                                            font-weight: normal;
                                            }
                                            .signature {
                                            text-align: right;
                                            font-size: 12px;
                                            margin-top: 40px; /* Space above signature */
                                            color: #000;
                                            }
                                            .footer {
                                            font-size: 10px;
                                            margin-top: 10px;
                                            color: #000;
                                            text-align: left; /* Left-aligned footer */
                                            }
                                            .divider {
                                            border-top: 2px dashed #000; /* Dashed line for divider */
                                            margin: 20px 0;
                                            text-align: center;
                                            position: relative;
                                            }
                                            .divider::before {
                                            content: '✂'; /* Scissor icon */
                                            position: absolute;
                                            top: -10px;
                                            left: 50%;
                                            transform: translateX(-50%);
                                            font-size: 14px;
                                            background-color: #fff;
                                            padding: 0 5px;
                                            }
                                            .print-button {
                                            display: block;
                                            width: 150px;
                                            margin: 20px auto 20px; /* Space above and below */
                                            padding: 10px;
                                            background-color: #007bff;
                                            color: #fff;
                                            text-align: center;
                                            border: none;
                                            border-radius: 5px;
                                            cursor: pointer;
                                            font-size: 14px;
                                            }
                                            .print-button:hover {
                                            background-color: #0056b3;
                                            }
                                            @media print {
                                            body {
                                            margin: 0;
                                            padding: 0;
                                            }
                                            body * {
                                            visibility: hidden;
                                            }
                                            #printable-section, #printable-section * {
                                            visibility: visible;
                                            }
                                            #printable-section {
                                            position: relative; /* instead of absolute */
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            page-break-after: avoid;
                                            margin: 0;
                                            padding: 0;
                                            }
                                            @page {
                                            margin: 10mm; /* or reduce as needed */
                                            }
                                            button, .sidebar, .navbar, footer {
                                            display: none !important;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <?php
                                        // Function to convert number to Marathi words
                                        function numberToMarathiWords($number) {
                                        $marathiUnits = [
                                        0 => 'शून्य', 1 => 'एक', 2 => 'दोन', 3 => 'तीन', 4 => 'चार',
                                        5 => 'पाच', 6 => 'सहा', 7 => 'सात', 8 => 'आठ', 9 => 'नऊ',
                                        10 => 'दहा', 11 => 'अकरा', 12 => 'बारा', 13 => 'तेरा', 14 => 'चौदा',
                                        15 => 'पंधरा', 16 => 'सोळा', 17 => 'सतरा', 18 => 'अठरा', 19 => 'एकोणीस'
                                        ];
                                        $marathiTens = [
                                        2 => 'वीस', 3 => 'तीस', 4 => 'चाळीस', 5 => 'पन्नास',
                                        6 => 'साठ', 7 => 'सत्तर', 8 => 'ऐंशी', 9 => 'नव्वद'
                                        ];
                                        $marathiHundreds = 'शे';
                                        $marathiThousands = 'हजार';
                                        if ($number == 0) {
                                        return $marathiUnits[0];
                                        }
                                        $words = '';
                                        // Handle thousands
                                        if ($number >= 1000) {
                                        $thousands = floor($number / 1000);
                                        $number = $number % 1000;
                                        if ($thousands <= 19) {
                                        $words .= $marathiUnits[$thousands] . ' ' . $marathiThousands;
                                        } else {
                                        $tens = floor($thousands / 10);
                                        $units = $thousands % 10;
                                        $words .= ($tens ? $marathiTens[$tens] : '');
                                        $words .= ($units ? ' ' . $marathiUnits[$units] : '') . ' ' . $marathiThousands;
                                        }
                                        }
                                        // Handle hundreds
                                        if ($number >= 100) {
                                        $hundreds = floor($number / 100);
                                        $number = $number % 100;
                                        $words .= ($words ? ' ' : '') . $marathiUnits[$hundreds] . ' ' . $marathiHundreds;
                                        }
                                        // Handle tens and units
                                        if ($number > 0) {
                                        $words .= ($words ? ' ' : '');
                                        if ($number <= 19) {
                                        $words .= $marathiUnits[$number];
                                        } else {
                                        $tens = floor($number / 10);
                                        $units = $number % 10;
                                        $words .= $marathiTens[$tens];
                                        $words .= ($units ? ' ' . $marathiUnits[$units] : '');
                                        }
                                        }
                                        return trim($words);
                                        }
                                        $amountInMarathi = numberToMarathiWords($data['amount']);
                                        // Format timestamp to show only the date
                                        $formattedTimestamp = !empty($data['timestamp']) && strtotime($data['timestamp']) 
                                        ? date('d-m-Y', strtotime($data['timestamp'])) 
                                        : '';
                                        ?>
                                        <div id="printable-section"> 
                                            <div class="container">
                                                <button class="print-button" onclick="window.print()">Print Receipt</button>
                                                <!-- Office Copy -->
                                                <div class="receipt-section">
                                                    <div class="header-container">
                                                        <img src="<?php echo SITE_ADDR.SITE_LOGO ?>" class="logo" alt="Logo">
                                                            <!-- Alternative path: <img src="<?php echo SITE_ADDR ?>" class="logo" alt="Logo"> -->
                                                                <div class="title-section">
                                                                    <div class="header">वसई विरार शहर महानगरपालिका</div>
                                                                    <div class="subheader">Receipt / पावती</div>
                                                                </div>
                                                            </div>
                                                            <table>
                                                                <tr>
                                                                    <th>Receipt No./पावती क्र.</th>
                                                                    <td><?php echo $rec_no; ?></td>
                                                                    <th>Date of Receipt/दिनांक</th>
                                                                    <td><?php echo $data['timestamp']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>CFC Reference/सी.एफ.सी निदेश</th>
                                                                    <td>        </td>
                                                                    <th>Counter Reference/रिडकी निदेश</th>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Received From/कोणाकडून</th>
                                                                    <td colspan="3"><?php echo $data['recieved_from']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Amount/रक्कम</th>
                                                                    <td colspan="3"><?php echo $data['amount']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Amount In Words/अंशरी रक्कम</th>
                                                                    <td colspan="3"><?php echo $amountInMarathi; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Subject/विषय</th>
                                                                    <td colspan="3"><?php echo $subject; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Payment_Mode/देण्याचा प्रकार</th>
                                                                    <td><?php echo $data['payment_mode']; ?></td>
                                                                    <th>Amount/रक्कम</th>
                                                                    <td><?php echo $data['amount']; ?></td>
                                                                </tr>
                                                                <!--<tr>-->
                                                                    <!--    <th>Bank Name/बँकेचे नाव</th>-->
                                                                    <!--    <td colspan="3"><?php echo $data['bankname']; ?></td>-->
                                                                <!--</tr>-->
                                                                <tr>
                                                                    <th>Application No./आणि क्रमांक</th>
                                                                    <td><?php echo $application_id['oc_application_id']; ?></td>
                                                                    <th>Date/दिनांक</th>
                                                                    <td><?php echo $data['timestamp']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Details/माहिती</th>
                                                                    <td><?php echo $data['amount']; ?></td>
                                                                    <th>Payable Amount/देय रक्कम</th>
                                                                    <td><?php echo $data['amount']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Received Amount/स्वीकारलेली रक्कम</th>
                                                                    <td><?php echo $data['amount']; ?></td>
                                                                    <th>Total Received Amt/एकूण स्वीकारलेली रक्कम</th>
                                                                    <td><?php echo $data['amount']; ?></td>
                                                                </tr>
                                                            </table>
                                                            <div class="signature">Signature of Authorized Officer</div>
                                                            <!--<div class="footer">/30-05-2025</div>-->
                                                        </div>
                                                        <?php  if(USER_ROLE!=2){ ?>
                                                        <hr>
                                                            <div class="receipt-section">
                                                                <div class="header-container">
                                                                    <img src="<?php echo SITE_ADDR.SITE_LOGO ?>" class="logo" alt="Logo">
                                                                        <!-- Alternative path: <img src="<?php echo SITE_ADDR ?>" class="logo" alt="Logo"> -->
                                                                            <div class="title-section">
                                                                                <div class="header">वसई विरार शहर महानगरपालिका</div>
                                                                                <div class="subheader">Receipt / पावती</div>
                                                                            </div>
                                                                        </div>
                                                                        <table>
                                                                            <tr>
                                                                                <th>Receipt No./पावती क्र.</th>
                                                                                <td><?php echo $rec_no; ?></td>
                                                                                <th>Date of Receipt/दिनांक</th>
                                                                                <td><?php echo $data['timestamp']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>CFC Reference/सी.एफ.सी निदेश</th>
                                                                                <td>        </td>
                                                                                <th>Counter Reference/रिडकी निदेश</th>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Received From/कोणाकडून</th>
                                                                                <td colspan="3"><?php echo $data['recieved_from']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Amount/रक्कम</th>
                                                                                <td colspan="3"><?php echo $data['amount']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Amount In Words/अंशरी रक्कम</th>
                                                                                <td colspan="3"><?php echo $amountInMarathi; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Subject/विषय</th>
                                                                                <td colspan="3"><?php echo $subject; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Payment_Md/देण्याचा प्रकार</th>
                                                                                <td><?php echo $data['payment_mode']; ?></td>
                                                                                <th>Amount/रक्कम</th>
                                                                                <td><?php echo $data['amount']; ?></td>
                                                                            </tr>
                                                                            <!--<tr>-->
                                                                                <!--    <th>Bank Name/बँकेचे नाव</th>-->
                                                                                <!--    <td colspan="3"><?php echo $data['bankname']; ?></td>-->
                                                                            <!--</tr>-->
                                                                            <tr>
                                                                                <th>Application No./आणि क्रमांक</th>
                                                                                <td><?php echo $application_id['oc_application_id']; ?></td>
                                                                                <th>Date/दिनांक</th>
                                                                                <td><?php echo $data['timestamp']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Details/माहिती</th>
                                                                                <td><?php echo $data['amount']; ?></td>
                                                                                <th>Payable Amount/देय रक्कम</th>
                                                                                <td><?php echo $data['amount']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Received Amount/स्वीकारलेली रक्कम</th>
                                                                                <td><?php echo $data['amount']; ?></td>
                                                                                <th>Total Received Amt/एकूण स्वीकारलेली रक्कम</th>
                                                                                <td><?php echo $data['amount']; ?></td>
                                                                            </tr>
                                                                        </table>
                                                                        <div class="signature">Signature of Authorized Officer</div>
                                                                        <!--<div class="footer">/30-05-2025</div>-->
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </body>
                                                    </html>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
