<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("occupancy_certificate/add");
$can_edit = ACL::is_allowed("occupancy_certificate/edit");
$can_view = ACL::is_allowed("occupancy_certificate/view");
$can_delete = ACL::is_allowed("occupancy_certificate/delete");
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
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <!-- //tipnni -->
                        <script>var global_userrole = 0;</script>
                        <?php
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        // Fetch request sub-entry data
                        $db->where("rec_id", $data['id']);
                        $inspection = $db->get("oc_photo_inspection", "inspection_date, name_of_tree");
                        // Format date
                        if (!empty($inspection)) {
                        $inspection = $inspection[0];
                        $inspection['inspection_date'] = date("d-m-Y", strtotime($inspection['inspection_date']));
                        } else {
                        $inspection = ['inspection_date' => '', 'name_of_tree' => ''];
                        }
                        ?>
                        <!DOCTYPE html>
                        <html lang="mr">
                            <head>
                                <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                                    </head>
                                    <body>
                                         <style>
                                            @media print {
                                            body *, #main * { display:none; }
                                            #main, #main #printarea, #main #printarea * { display:block ; }
                                            }
                                        </style>
                                        <div>
                                            <a href="#"  class="btn btn-danger" onclick="printDiv('printarea')"  >PRINT</a>
                                        </div>
                                        <div id="main" class>
                                            <div id="printarea"   >
                                                 
                                        <style>
                                            * {
                                            box-sizing: border-box;
                                            }
                                            body {
                                            font-family: Arial, sans-serif;
                                            margin: 40px;
                                            line-height: 1.6;
                                            background: #fff;
                                            }
                                            .container {
                                            max-width: 800px;
                                            margin-top:0px;
                                            margin-bottom:0px;
                                            margin: 50px;
                                            padding: 0px; /* Adjust padding for neat spacing */
                                            border: 0;
                                            background-color: #fff;
                                            }
                                            h1 {
                                            text-align: center;
                                            font-size: 24px;
                                            margin-bottom: 20px;
                                            }
                                            h2 {
                                            font-size: 18px;
                                            margin-top: 20px;
                                            margin-bottom: 10px;
                                            }
                                            p, ul, ol {
                                            font-size: 16px;
                                            margin-bottom: 10px;
                                            }
                                            table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin-top: 20px;
                                            }
                                            th, td {
                                            border: 1px solid #000;
                                            padding: 8px;
                                            text-align: left;
                                            }
                                            .signature {
                                            margin-top: 40px;
                                            text-align: right;
                                            }
                                            .head_content {
                                            text-align: right;
                                            margin-bottom: 5px;
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
                                            }
                                        </style>
                                                
                                        <div id="printable-section" style="padding:"> 
                                            <div class="container">
                                                <p><h1>कल्याण डोंबिवली महानगरपालिका <br> कल्याण उद्यान व वृक्ष प्राधिकरण विभाग</h1></p>
                                                    <br> <p class="head_content"><strong>कार्यालयीन टिपणी क्र. <?php echo $data['application_no']; ?></strong> </p>
                                                    <br> <br> <p class="head_content"><strong>दिनांक:</strong> <?php echo date('jS F Y', strtotime($data['updated_timestamp'])); ?></p>
                                                    <p><strong>मा. सादर,</strong> <br>
                                                    </p>
                                                    <br> 
                                                        <p>  सादर प्रस्तुत प्रकरणी सदर <?php echo $data['address_of_plot']; ?> भूखंडाची पाहणी केली असता, सदर भूखंडावर नव्याने बांधण्यात आलेली इमारत आढळून आलेली असून खालील प्रमाणे वृक्ष लागवड करण्यात आलेली आहे</p>
                                                        <?php
                                                        $rec_id=$data['id'];
                                                        $jei = new User_infoController();
                                                        $db=$jei->GetModel();
                                                        $db->where("rec_id",$rec_id);
                                                        $db->groupby("name_of_tree");
                                                        $db->groupby("enter_name_of_tree");
                                                        $rec=$db->get("oc_photo_inspection",9999,"sum(tree_count) as c,name_of_tree,enter_name_of_tree");
                                                        ?>
                                                       <br> <br>  <table style="width:100%; border:1px solid black; border-collapse: collapse;">
                                                            <tr>
                                                                <th style="border:1px solid black; padding:5px;">Sr. No</th>
                                                                <th style="border:1px solid black; padding:5px;">Name of Tree</th>
                                                                <th style="border:1px solid black; padding:5px;">Tree Count</th>
                                                            </tr>
                                                            <?php 
                                                            $i = 1;
                                                            foreach ($rec as $r) { 
                                                            ?>
                                                            <tr>
                                                                <td style="border:1px solid black; padding:5px;"><?php echo $i++; ?></td>
                                                                <td style="border:1px solid black; padding:5px;"><?php echo $r['name_of_tree']=="Other"?$r['enter_name_of_tree']:$r['name_of_tree']; // print_r($r)?></td>
                                                                <td style="border:1px solid black; padding:5px;"><?php echo $r['c']; ?></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </table>
                                                       <br> <br>  <p>एकूण : <?php echo $data['number_of_trees_to_be_planted']; ?> झाडे </p>
                                                      <br> <br>   <p>महाराष्ट्र (नागरी क्षेत्र) झाडांचे  जतन व संरक्षण अधिनियम १९७५ चे प्रकरण-४ , कलम-७ (ज) ची पूर्तता झाल्याने वृक्ष लागवड  दाखला देणे कामी प्रकरण  मंजुरीसत्व  सादर
                                                            <br><br>
                                                                <div class="signature">
                                                       <br> <br>              <p>उद्यान  निरीक्षक &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </div>
                                                                </body>
                                                            </html>
                                                        </div>
                                                    </div>    </div> 
                                                        </div>
                                                        <style>
                                                            .dotted-line {
                                                            border-top: 4px dotted #000;
                                                            position: relative;
                                                            }
                                                            .scissor-image {
                                                            position: absolute;
                                                            top: -17px; /* Adjust this value to position the scissor image correctly */
                                                            left: 0%; /* Center the image horizontally */
                                                            transform: translateX(-50%);
                                                            width: 30px; /* Adjust the width of the scissor image */
                                                            }
                                                        </style>
                                                        <script>
                                                            function printDiv(divName) {
                                                            var printContents = document.getElementById(divName).innerHTML;
                                                            var originalContents = document.body.innerHTML;
                                                            document.body.innerHTML = printContents;
                                                            window.print();
                                                            setTimeout(function() {
                                                            document.body.innerHTML = originalContents;
                                                            }, 2000);
                                                            }
                                                        </script>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
