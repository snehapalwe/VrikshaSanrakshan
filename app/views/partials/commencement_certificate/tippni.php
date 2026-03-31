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
                        <!-- //tipnnithis ?  YES-->
                        <script>var global_userrole = 0;</script>
                        <?php
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        // Fetch request sub-entry data
                        $db->where("rec_id", $data['id']);
                        $inspection = $db->get("cc_photo_inspection", "inspection_date, name_of_tree");
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
                                        <title>वसई-विरार शहर महानगरपालिका - वृक्षप्राधिकरण नोटीस</title>
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
                                                <div id="printable-section"> 
                                                    <div class="container">
                                                    <div class=" " style="border:1px solid black;padding:50px">
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
                                                        <p><h1>कल्याण डोंबिवली महानगरपालिका <br> कल्याण उद्यान व वृक्ष प्राधिकरण विभाग</h1></p>
                                                            <p class="head_content"><strong>कार्यालयीन टिपणी क्र.<?php echo $data['cc_application_id']; ?></strong> </p>
                                                            <p class="head_content"><strong>विभाग:</strong> वृक्षप्राधिकरण / उद्यान</p>
                                                            <p><strong>दिनांक:</strong> <?php echo date('jS F Y', strtotime($data['updated_timestamp'])); ?></p>
                                                            <p><strong>मा. सादर,</strong></p>
                                                            <h2>विषय:</h2>
                                                            <p>महाराष्ट्र (नागरीक्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 चे प्रकरण 8  कलम 19 (क) मधील तरतुदीनुसार जमीनीच्या विकासासाठी वृक्ष अधिकाऱ्याचा ना हरकत दाखला देणेबाबत.</p>
                                                            <h2>संदर्भ:</h2>
                                                            <ol>
                                                                <li>विकासक यांचा विहीत नमुन्यातील , दि. <?php echo date('Y-m-d', strtotime($data['date'])); ?> रोजीचा प्राप्त अर्ज.</li>
                                                                <li>वास्तुविशारद - <?php echo $data['architech_name']; ?> यांचे पत्र.</li>
                                                                <li>सातबारा प्रती / मालमत्ता पत्रक.</li>
                                                                <li>वृक्षस्थितीदर्शक नकाशा.</li>
                                                                <li>Google प्रतिमा.</li>
                                                                <li>भूखंडाचे / झाडाचे फोटोग्राफ.</li>
                                                            </ol>
                                                            <p>उपरोक्त नमुद संदर् क्र.1 च्या अनुषंगाने गांव <?php echo $data['address_of_plot']; ?> या जमिनीवर <?php echo $data['type_of_residence']; ?> इमारतीचे बांधकाम करावयाचे असून या भूखंडाचे एकूण क्षेत्रफळ <?php echo $data['plot_area_in_sq_mtr']; ?> चौ.मी. आहे, असे वास्तुविशारद, <?php echo $data['architech_name']; ?> व विकासक, <?php echo $data['builder_name']; ?> यांनी कळविलेले आहे. वृक्ष प्राधिकरण विभागाने दि. <?php echo date('jS F Y', strtotime($data['updated_timestamp'])); ?> रोजी जागेवर केलेल्या स्थळ पाहणी अहवाला नुसार सदर इमारतीच्या बांधकाम करावयाच्या भूखंडावर खालीलप्रमाणे वृक्ष अस्तित्वात आहेत.</p>
                                                            <p>झाडांची नावे: <?php echo $data['names_of_trees_be_planted']; ?> व संख्या: <?php echo $data['trees_to_be_planted']; ?>  </p>
                                                            <p>वास्तुविशारद, <?php echo $data['architech_name']; ?> एन्ड <?php echo $data['builder_name']; ?> यांनी सादर केलेल्या अर्जानुसार भुखंडाचे एकूण क्षेत्रफळ <?php echo $data['plot_area_in_sq_mtr']; ?> चौ.मी. असून संदर्भ क्र. 1 च्या आदेशान्वये महाराष्ट्र (नागरीक्षेत्रे) झाडांचे संरक्षण व जतन अधिनियम, 1975 व महाराष्ट्र (नागरीक्षेत्रे) वृक्ष संरक्षण व संवर्धन नियम, 2009 मधील अनुसुची 1, कलम 7(एच) नुसार सदर भुखंडावर 1 वृक्ष प्रती 100 चौ.मी. प्रमाणे वृक्षलागवड करणे आवश्यक असून विकासकास खालील
                                                             नमुद वृक्ष प्रजातीपैकी भूखंडावर एकूण 
                                                            <!--तक्त्यात नमुद 16 वृक्ष प्रजातींपैकी भुखंडावर-->
                                                             ____________ वृक्षांची लागवड करुन सदर वृक्षांचे योग्यतेसंगोपन व संवर्धन करणे बंधनकारक राहील.
                                                                <!--<br>तरी विकासकाने पुढील नमुद प्रजातीपैकी किमान 2.5 फुट x 2.5 फुट x 2.5 फुट खड्डाखणून 2.0 मीटर उंचीच्या एकूण  <?php echo $data['trees_to_be_planted']; ?> झाडांची लागवड करुन त्यांची जोपासना करणे आवश्यक राहील.</p>-->
                                                                <br>
                                                                <p>वृक्षप्रजातीचे नाव -  वड, पिंपळ, उंबर, ताम्हण, बकुळ, निम, कदंब, सातविन, टेबेबुईया, फॉक्सटेल पाम, बॉटल पाम, बूच, बदाम, सिल्वर ओक, कांचन, करंज, स्पॅथोडीया, पेल्ट्राफोरम, खाया, बहावा, जंगली बदाम, सिताफळ, जांभूळ, आवळा व इतर भारतीय मुळ असलेली वृक्ष प्रजाती. </p>
                                                                <p>तरी विकासकाने वरील नमुद प्रजातीपैकी किमान 2.5 फुट x 2.5 फुट व 2.5 फुट खड्डा खणून 2.0 ते 2.5 मीटर उंचीची एकूण __________ झाडांची लागवड करून त्यांची जोपासना करणे आवश्यक राहील. </p>
                                                                <p>नमुद प्रस्तावानुसार सदर भूखंडावर कोणतेही झाड तोडण्यात आलेले नसून संबंधीतावर महाराष्ट्र (नागरी क्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 अंतर्गत कोणताही गुन्हा अथवा कारवाई प्रलंबित नाही. सबब बांधकाम परवानगी करिता मा. वृक्ष अधिकारी यांनी ना हरकत दाखल देण्यांस हरकत नाही. </p>
                                                                <br>
                                                                    <div class="signature">
                                                                        <p>
                                                                                 उद्यान अधिक्षक <br>
                                                                            उद्यान व वृक्षप्राधिकरण विभाग</p>
                                                                        </div>
                                                                    </body>
                                                                </html>
                                                            </div> 
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
