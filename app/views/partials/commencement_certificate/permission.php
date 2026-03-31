<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("commencement_certificate/add");
$can_edit = ACL::is_allowed("commencement_certificate/edit");
$can_view = ACL::is_allowed("commencement_certificate/view");
$can_delete = ACL::is_allowed("commencement_certificate/delete");
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
                        <?php
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        // Fetch request sub-entry data
                        $db->where("rec_id", $data['id']);
                        $inspection = $db->get("cc_photo_inspection", null, ["inspection_date", "name_of_tree"]);
                        // Format date
                        if (!empty($inspection)) {
                        $inspection = $inspection[0];
                        $inspection['inspection_date'] = !empty($inspection['inspection_date'])
                        ? date("d-m-Y", strtotime($inspection['inspection_date']))
                        : '';
                        } else {
                        $inspection = ['inspection_date' => '', 'name_of_tree' => ''];
                        }
                        ?>
                        <!DOCTYPE html>
                        <html lang="mr">
                            <head>
                                <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <title>वृक्षप्राधिकरण अभिप्राय पत्र</title>
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
                                            margin: 10px;
                                            padding: 0;
                                            line-height: 1.6;
                                            background: #fff;
                                            }
                                            .container {
                                            max-width: 800px;
                                            margin: 10px;
                                            padding: 0px; /* Adjust padding for neat spacing */
                                            border: 0;
                                            background-color: #fff;
                                            }
                                            .header, .footer {
                                            text-align: center;
                                            margin-bottom: 20px;
                                            }
                                            .content {
                                            text-align: justify;
                                            }
                                            .table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin: 20px 0;
                                            }
                                            .table th, .table td {
                                            border: 1px solid #000;
                                            padding: 10px;
                                            text-align: left;
                                            }
                                            .signature {
                                            margin-top: 30px;
                                            text-align: right;
                                            }
                                            .content p,
                                            .content ol,
                                            .content ul {
                                            margin-bottom: 1em;
                                            }
                                            hr {
                                            border: 0;
                                            border-top: 1px solid #000;
                                            margin: 20px 0;
                                            }
                                            .header-row {
                                            display: flex;
                                            justify-content: space-evenly;
                                            align-items: center;
                                            padding: 10px;
                                            }
                                            .header-left,
                                            .header-center,
                                            .header-right {
                                            flex: 1;
                                            }
                                            .header-left {
                                            text-align: left;
                                            }
                                            .header-center {
                                            text-align: center;
                                            }
                                            .header-right {
                                            text-align: right;
                                            }
                                            .header-left h2,
                                            .header-left h3,
                                            .header-right p {
                                            margin: 0;
                                            }
                                            .header-logo {
                                            height: 80px;
                                            }
                                            #printable-section {
                                            margin:40px !important;
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
                                            margin: 0 auto !important;
                                            padding: 0 !important;
                                            width: 100%;
                                            overflow: hidden !important;
                                            page-break-after: avoid !important;
                                            page-break-before: avoid !important;
                                            page-break-inside: avoid !important;
                                            break-inside: avoid !important;
                                            }
                                            html, body {
                                            height: auto !important;
                                            overflow: hidden !important;
                                            }
                                            @page {
                                            size: A4;
                                            margin: 10mm 8mm;
                                            }
                                            button, .sidebar, .navbar, footer {
                                            display: none !important;
                                            }
                                            }
                                        </style>
                                                <div id="printable-section"> 
                                                <div class=" " style="border:1px solid black;padding:50px">
                                                    <!-- Your Tippni content here -->
                                                    <div class="header-row">
                                                        <!-- Left: Address -->
                                                        <!-- Center: Logo -->
                                                        <div class="" >
                                                            <img src="<?php echo SITE_ADDR ?>assets/images/permission_logo.png" alt="Logo" class="header-logo">
                                                            </div>
                                                            <div class="">
                                                                <h2>कल्याण डोंबिवली महानगरपालिका कल्याण</h2>
                                                                <h3>उद्यान व वृक्ष प्राधिकरण विभाग</h3>
                                                            </div>
                                                            <!-- Right: Contact Info -->
                                                            </div><br>
                                                            <div class="header-right">
                                                                <p> <STRONG>जा.क्र.कडोंमपा/उद्यान/वृअ/वृप्रा/ <?php echo $data['outward_no']; ?></STRONG></p>
                                                                <p><STRONG>दिनांक:</STRONG><?php echo date('jS F Y', strtotime($data['updated_timestamp'])); ?></p>
                                                            </div><br>
                                                                <br>
                                                            <div class="content">
                                                                <p><strong>प्रति,</strong> <br><strong><?php echo $data['applicant_full_name']; ?> </strong><br> <?php echo $data['applicant_address']; ?> </p>
                                                                <br>
                                                                <br>
                                                                    <p><strong>विषय:</strong> महाराष्ट्र (नागरीक्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 चे प्रकरण 8  कलम 19 (क) मधील तरतुदीनुसार जमीनीच्या विकासासाठी वृक्ष अधिकाऱ्याचा ना हरकत <br>
                                                                        <strong>संदर्भ:</strong>
                                                                        १. आपला <?php echo $data['date']; ?> रोजीचा प्राप्त अर्ज.<br>
                                                                            २. द्वारा <?php echo $data['architech_name']; ?> (वास्तुशिल्पकार)           
                                                                        </p>
                                                                        <p> उपरोक्त संदर्भिय पत्र क्र. १ अन्वये आपण बांधकाम परवानगी प्राप्त करणे करिता उद्यान व वृक्ष प्राधिकरण ना हरकत दाखला अपेक्षिला आहे. तद्अनुषंगाने, <?php echo $data['address_of_plot']; ?> (जागेचा पत्ता) या परिसरातील स.नं. /सि.टी.स.नं  <?php echo $data['survey_no']; ?>,  मौजे <?php echo $data['mouje']; ?>  या भूखंडावर दि. <?php echo date('jS F Y', strtotime($inspection['inspection_date'])); ?> रोजी पाहणी केली असता, सद्य:स्थितीत सदर भूखंडावर खालीलप्रमाणे झाडे आढळुन आलेली आहेत.  </p>  
                                                                        <p>झाडांची नावे: <?php echo $data['names_of_trees_be_planted']; ?> व संख्या: <?php echo $data['trees_to_be_planted']; ?>  <br>
                                                                        एकूण <?php echo $data['trees_to_be_planted']; ?> झाडे आहेत. (क्षेत्रफळ <?php echo $data['plot_area_in_sq_mtr']; ?> चौ.मी.)</p>
                                                                    या प्रमाणे एकूण <?php echo $data['trees_to_be_planted']; ?> झाडे आढळलेली आहेत. तरी खालील अटी/शर्ती नुसार आपणांस महाराष्ट्र (नागरीक्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 चे प्रकरण 8  कलम 19 (क) मधील तरतुदीनुसार जमीनीच्या विकासासाठी वृक्ष अधिकाऱ्याचा ना हरकत दाखला देण्यात येत आहे. </p>
                                                                    <p><strong>अटी/शर्ती, </strong>
                                                                        <ol>
                                                                            <li>इमारत बांधकामात बाधीत होत असल्यास झाडे तोडणे/पुनर्रोपण करणेबाबत मा.वृक्ष प्राधिकरणाची परवानगी घेणे बंधनकारक राहील.</li>
                                                                            <li> बांधकाम करण्यात आलेल्या इमारतीमध्ये व परिसरात पर्यावरणाचा समतोल राखला जाईल यासाठी पक्षांकरिता कृत्रिम घरटी किंवा तत्सम व्यवस्था करण्यात यावी.</li>
                                                                            <li>आपण विकसित करीत असलेल्या इमारतीच्या मोकळ्या जागेत वापर परवाना मिळण्यापूर्वी वड, पिंपळ, उंबर, ताम्हण, बकुळ, निम, कदंब, सातविन, टेबेबुईया, बूच, बदाम, सिल्वर ओक इ. जातीची 6 फुट उंची असलेल्या ............. वृक्ष रोपांची लागवड करणे बंधनकारक आहे.</li>
                                                                            <li>सदर भूखंडावर आपण काही चुकीची माहिती दिली आहे, असे निदर्शनास आल्यास आपण महापालिकेची दिशाभूल केल्याचे समजण्यात येईल व सदर दाखला आपोआप रद्द झाल्याचे समजण्यात येईल.</li>
                                                                        </ol></p>
                                                                        <div class="signature"><br>
                                                                <br><br>
                                                                <br>
                                                                            <p>(संजय जाधव)<br>वृक्ष अधिकारी,<br>कल्याण डोंबिवली महानगरपालिका,<br>कल्याण,</p>
                                                                            </div>
                                                                            <p><strong>प्रतः</strong> नगररचनाकार, नगररचना विभाग, क. डॉ.म.पा.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                </div>
                                                            </body>
                                                        </html>
                                                    </div> 
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
                                </div>
                            </div>
                        </section>
