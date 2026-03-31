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
                        <?php
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        // Fetch request sub-entry data
                        $db->where("rec_id", $data['id']);
                        $inspection = $db->get("cc_photo_inspection", "inspection_date, name_of_tree");
                        $db->where("rec_id", $data['id']);
                        $tid = $db->getOne("tippani_data", "*");
                        foreach($tid as $k=>$t){
                        $data[$k]=$t;
                        }
                        // Format date
                        if (!empty($inspection)) {
                        $inspection = $inspection[0];
                        $inspection['inspection_date'] = date("d-m-Y", strtotime($inspection['inspection_date']));
                        } else {
                        $inspection = ['inspection_date' => '', 'name_of_tree' => ''];
                        }
                        $data['date']=date("d-m-Y",strtotime($data['date']));
                        $data['application_date']=date("d-m-Y",strtotime($data['application_date']));
                        ?>
                        <!DOCTYPE html>
                        <html lang="mr">
                            <head>
                                <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <title>ना-हरकत प्रमाणपत्र</title>
                                        <style>
                                            body {
                                            font-family: Arial, sans-serif;
                                            line-height: 1.6;
                                            margin: 20px;
                                            }
                                            .container {
                                            max-width: 800px;
                                            margin: 50px;
                                            padding: 20px;
                                            /* border: 1px solid #ccc; */
                                            }
                                            .header{
                                            text-align: center;
                                            }
                                            .header, .section, .footer {
                                            margin-bottom: 20px;
                                            }
                                            .header h1, .section h2 {
                                            color: #333;
                                            }
                                            .section p, .section ul {
                                            margin: 10px 0;
                                            }
                                            .bold {
                                            font-weight: bold;
                                            }
                                            .underline {
                                            text-decoration: underline;
                                            }
                                            .sub-header{
                                            text-align: right;
                                            }
                                            .sign{
                                            width: 100%;
                                            text-align: right;
                                            }
                                            .header-row {
                                            display: flex;
                                            justify-content: space-between;
                                            align-items: center;
                                            padding: 10px;
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
                                    </head>
                                    <body>
                                        <div id="printable-section">
                                            <!-- Your Tippni content here -->
                                            <div class="container">
                                                <div class="header-row">
                                                    <!-- Left: Address -->
                                                    <div class="header-left">
                                                        <h2>मुख्य कार्यालय, विरार</h2>
                                                        <h3>विरार (पूर्व) , पश्चिम </h3>
                                                        <h3>ता. वसई, जि. पालघर, पिन- 401 305.</h3>
                                                    </div>
                                                    <!-- Center: Logo -->
                                                    <div class="header-center">
                                                        <img src="<?php echo SITE_ADDR ?>assets/images/permission_logo.png" alt="Logo" class="header-logo">
                                                        </div>
                                                        <!-- Right: Contact Info -->
                                                        <div class="header-right">
                                                            <p><strong>दूरध्वनी :</strong> 0250-2525105/06/2529888/2529890</p>
                                                            <p><strong>फॅक्स :</strong> 0250-2525107.</p>
                                                            <p><strong>ई - मेल :</strong> vasaivirarcorporation@yahoo.com</p>
                                                            <br>
                                                                <p><strong>जावक :</strong> व.वि.श.म /</p>
                                                                <p><strong>दिनांक :</strong> <?php echo $data['date']; ?> </p>
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <div class="section">
                                                                <p class="bold">विषय:</p>
                                                                <p>वृक्ष अधिकारी यांचे नाहरकत प्रमाणपत्र मिळणेबाबत. (O.C.करीता) (____)</p>
                                                            </div>
                                                            <div class="section">
                                                                <p class="bold">संदर्भ:</p>
                                                                <ol>
                                                                    <li>मा. आयुक्त साो. यांचा जावक क्र. वविशम/वृक्षप्राधि/1511/2021-22 दि. 16/03/2022 रोजीचा आदेश.</li>
                                                                    <li>विकासक यांचा विहित नमुन्यातील आवक क्र.<?php echo $data['application_number']; ?> दि. <?php echo $data['application_date']; ?> रोजीचा प्राप्त अर्ज.</li>
                                                                    <li>वास्तुविशारद <?php echo $data['architech_name']; ?>  यांचे दि. <?php echo $data['date']; ?> रोजीचे पत्र.</li>
                                                                    <li>दि. <?php echo $data['town_planning_cc_date']; ?> रोजीची नगररचना विभागाची सी.सी. कॉपी.</li>
                                                                    <li>दि. 11/04/2025 रोजीचे वास्तुविशारदाचे वृक्षप्राधिकरण विभागाचा सी.सी. दाखला न घेतलेबाबतचे पत्र. <?php echo $data['cc_not_taken_remark']; ?></li>
                                                                    <li>गुगल ईमेज.</li>
                                                                    <li>वृक्षस्थितीदर्शक नकाशा.</li>
                                                                    <li>जागेचे फोटोग्राफ.</li>
                                                                    <li>दि. <?php echo $data['date']; ?>रोजीचे प्रतित्रापत्र.</li>
                                                                    <li>दि. <?php echo $inspection['inspection_date']; ?> रोजीचा पंचनामा.</li>
                                                                    <li>प्रशासकीय ठराव क्र. 02 दि. 01/04/2025.</li>
                                                                </ol>
                                                            </div>
                                                            <div class="section">
                                                                <p>उपरोक्त संदर्भ क्र.2 मध्ये नमुद केलेल्या अर्जाच्या अनुषंगाने <?php echo $data['village_and_survey_number']; ?> या जमिनीवर <?php echo $data['building_address_details']; ?>च्या मोकळ्या जागेवर लावलेल्या वृक्ष लागवडीची पाहणी दि. <?php echo $inspection['inspection_date']; ?> रोजी करण्यात आलेली असून याबाबत वृक्षप्राधिकरण विभागाकडून स्थळ पंचनामा करणेत आलेला आहे. सदर <?php echo $data['village_and_survey_number']; ?> च्या भुखंडाचे एकूण क्षेत्रफळ  <?php echo $data['plot_area_in_sq_mtr']; ?>  चौ.मी. आहे. महाराष्ट्र (नागरी क्षेत्रे) झाडांचे संरक्षण व जतन अधिनियम 1975 मधील तरतुदीनुसार वृक्षप्राधिकरण विभागाने भुखंडाच्या विकासाकरीता वृक्ष लागवड, जतन व संवर्धनाबाबत देण्यात आलेल्या अभिप्रायाप्रमाणे 1 वृक्ष प्रती 100 चौ.मी. हया दराने एकूण <?php echo $data['number_of_trees_to_be_planted']; ?>वृक्ष लागवड करणे आवश्यक आहे.</p>
                                                                <p>वृक्षप्राधिकरण विभागाने <?php echo $inspection['inspection_date']; ?> रोजी जागेवर केलेल्या पंचनाम्यानुसार भुखंडावर <?php echo $data['name_of_trees_to_be_planted']; ?> आणि <?php echo $data['number_of_trees_to_be_planted']; ?> वृक्ष असून ना-हरकत दाखला देणेत येत आहे.</p>
                                                                <p>महाराष्ट्र (नागरी क्षेत्रे), झाडांचे जतन व संरक्षण अधिनियम 1975 चे कलम 11 अन्वये तसेच संदर्भ क्र.09 नुसार वरील तक्त्यात नमुद लागवड केलेल्या झाडांचे देखभाल व संगोपनाची जबाबदारी विकासकाची राहील, व सदर वृक्ष वाढीबाबतचा सहामाही अहवाल जी.ओ.टँगीग फोटोसहित सात वर्षापर्यंत वृक्षप्राधिकरण विभागास सादर करावयाचा असून सदर इमारत यापुढे सोसायटी किंवा अधिकृत प्रतिनिधी यांस हस्तांतरीत करताना सदर वृक्षांची यादी संबंधितास द्यावी, व सर्व वृक्ष जोपसण्याची समज देणेत यावी. विकासकाने विहित नमुन्यात दिलेले प्रपत्र व सादर केलेल्या प्रत市政府ानुसार कार्यवाही न केल्यास महाराष्ट्र (नागरी क्षेत्रे) झाडांचे जतन व संरक्षण अधिनियम 1975 नुसार कारवाई केली जाईल.</p>
                                                                <p>सदर जमिनीच्या वैधतेची जबाबदारी संबंधित जागामालक तसेच विकासक / वास्तुविशारद यांची असून नगररचना विभागाने जमिनीबाबत इतर सर्व सक्षम प्राधिकरणाचे अभिप्राय तपासून ओ.सी. बाबत पुढील योग्य ती कार्यवाही करावयाची आहे.</p>
                                                                <p>सदरचा ना-हरकत दाखला हा महाराष्ट्र (नागरी क्षेत्रे) झाडांचे संरक्षण व जतन अधिनियम 1975 चे तरतुदीनुसार प्रतित्राय व स्थळपाहणी अहवालाच्या अधिन राहून केवळ वृक्ष लागवडीसाठी देणेत आलेले आहे.</p>
                                                            </div>
                                                            <div class="sign">
                                                                <p>(समीर भूमकर)<br>
                                                                    उपआयुक्त तथा वृक्ष अधिकारी<br>
                                                                    वसई-विरार शहर महानगरपालिका</p>
                                                                </div>
                                                                <div class="section">
                                                                    <p class="bold">प्रत:</p>
                                                                    <ol>
                                                                        <li><?php echo $data['architech_name']; ?>, वास्तुविशारद.</lo>
                                                                        <li><?php echo $data['builder_name']; ?>, विकासक.</li>
                                                                    </ol>
                                                                </div>
                                                            </div>
                                                            <div style="text-align: center; margin-top: 40px;">
                                                                <button onclick="window.print()" style="
                                                                    padding: 12px 24px;
                                                                    font-size: 16px;
                                                                    font-weight: bold;
                                                                    background-color: #28a745;
                                                                    color: white;
                                                                    border: none;
                                                                    border-radius: 6px;
                                                                    cursor: pointer;
                                                                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                                                    transition: background-color 0.3s ease;
                                                                    " 
                                                                    onmouseover="this.style.backgroundColor='#218838'" 
                                                                    onmouseout="this.style.backgroundColor='#28a745'">
                                                                    Print
                                                                </button>
                                                            </div>
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
