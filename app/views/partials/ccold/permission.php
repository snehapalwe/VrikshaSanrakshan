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
    <div  class="text-center">
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
                                        <title>वृक्षप्राधिकरण अभिप्राय पत्र</title>
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
                                            max-width: 90%;
                                            margin: 50px;
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
                                            justify-content: space-between;
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
                                            position: relative; /* instead of absolute */
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            page-break-after: avoid;
                                            /*margin: 0;*/
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
                                            <div class="header-row">
                                                <!-- Left: Address -->
                                                <div class="header-left">
                                                    <h2>मुख्य कार्यालय, कल्याण डोंबिवली</h2> 
                                                    <h3>ता. कल्याण डोंबिवली  पिन- 421301.</h3>
                                                </div>
                                                <!-- Center: Logo -->
                                                <div class="header-center">
                                                    <img src="<?php echo SITE_ADDR ?>assets/images/logo.png" alt="Logo" class="header-logo">
                                                    </div>
                                                    <!-- Right: Contact Info -->
                                                    <div class="header-right">
                                                        <p><strong>दूरध्वनी :</strong> </p>
                                                        <p><strong>फॅक्स :</strong> </p>
                                                        <p><strong>ई - मेल :</strong> </p>
                                                        <br>
                                                            <p><strong>जावक :</strong> KDMC /</p>
                                                            <p><strong>दिनांक :</strong> <?php echo $data['date']; ?> </p>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <p>प्रति, <br>मा.उपसंचालक, <br>नगररचना विभाग, <br>कल्याण डोंबिवली महानगरपालिका </p>
                                                            <p><strong>विषय:</strong> महाराष्ट्र (नागरी क्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 मधील प्रकरण 8 मधील कलम 19 मधील तरतुदीनुसार जमिनीच्या विकासासाठीचा (C.C.बाबत) वृक्ष अधिकारी यांचा अभिप्राय देणेबाबत. (_____)</p>
                                                            <p><strong>संदर्भ:</strong></p>
                                                            <ol>
                                                                <li>मा. आयुक्त सो. यांचा जा.क्र. वविशम/वृक्षप्राधि/ दि. रोजीचा आदेश.</li>
                                                                <li>विकासक यांचा विहीत नमुन्यातील <?php echo $data['cc_application_id']; ?> दि. <?php echo $data['date']; ?> रोजीचा प्राप्त अर्ज.</li>
                                                                <li>वास्तुविशारद - <?php echo $data['architech_name']; ?> यांचे पत्र.</li>
                                                                <li>सातबारा प्रती / मालमत्ता पत्रक.</li>
                                                                <li>वृक्षस्थितीदर्शक नकाशा.</li>
                                                                <li>गुगल इमेज.</li>
                                                                <li>भूखंडाचे / झाडाचे फोटोग्राफ.</li>
                                                                <li>दि. <?php echo $data['date']; ?> रोजीचे प्रतिज्ञापत्र.</li>
                                                                <li>दि. <?php echo $data['date']; ?> रोजीचा स्थल पाहणी अहवाल.</li>
                                                                <li>प्रशासकीय ठराव क्र.2 दि.01/04/2025.</li>
                                                                <li>दि.___/___/2025 रोजीची कार्यालयीन मंजूर टिपणी.</li>
                                                            </ol>
                                                            <p>उपरोक्त नमुद संदर्भ क्र.2 च्या अनुषंगाने गांव <?php echo $data['address_of_plot']; ?> या जमिनीवर <?php echo $data['type_of_residence']; ?> इमारतीचे बांधकाम करावयाचे असून या भूखंडाचे एकूण क्षेत्रफळ <?php echo $data['plot_area_in_sq_mtr']; ?> चौ.मी. आहे, असे वास्तुविशारद, <?php echo $data['architech_name']; ?> व विकासक, <?php echo $data['builder_name']; ?> यांनी कळविलेले आहे. विकासक यांनी संदर्भ क्र.2 नुसार वृक्षप्राधिकरण विभागाचे अभिप्राय मागितले असून त्यान्वये वृक्षप्राधिकरण विभागाने दि. <?php echo $inspection['inspection_date']; ?> रोजी जागेवर केलेल्या स्थल पाहणी अहवाला नुसार सदर इमारतीच्या बांधकाम करावयाच्या भुखंडावर वृक्ष अस्तित्वात आहेत.</p>
                                                            <p>वास्तुविशारद, मे. मेघा अर्बनस्केप व विकासक, मे. शिवसाई बिल्डर्स एन्ड डेव्हलपर्स तर्फे प्रोपायटर श्री. प्रदिप ब. नाईक यांनी सादर केलेल्या अर्जानुसार भुखंडाचे एकूण क्षेत्रफळ <?php echo $data['plot_area_in_sq_mtr']; ?> चौ.मी. असून संदर्भ क्र. 1 च्या आदेशान्वये महाराष्ट्र (नागरीक्षेत्रे) झाडांचे संरक्षण व जतन अधिनियम, 1975 व महाराष्ट्र (नागरीक्षेत्रे) वृक्ष संरक्षण व संवर्धन नियम, 2009 मधील अनुसुची 1, कलम 7(एच) नुसार सदर भुखंडावर 1 वृक्ष प्रती 100 चौ.मी. प्रमाणे वृक्षलागवड करणे आवश्यक असून विकासकास खालील तक्त्यात नमुद 16 वृक्ष प्रजातींपैकी भुखंडावर एकूण ______ वृक्षांची लागवड करुन सदर वृक्षांचे योग्यतेसंगोपन व संवर्धन करणे बंधनकारक राहील.</p>
                                                            <p>तरी विकासकाने पुढील नमुद प्रजातीपैकी किमान 2.5 फुट x 2.5 फुट x 2.5 फुट खड्डाखणून 2.0 मीटर उंचीच्या एकूण  ______ झाडांची लागवड करुन त्यांची जोपासना करणे आवश्यक राहील.</p>
                                                            <table>
                                                                <tr>
                                                                    <th>अ.क्र.</th>
                                                                    <th>वृक्षप्रजातीचे नाव</th>
                                                                    <th>अ.क्र.</th>
                                                                    <th>वृक्षप्रजातीचे नाव</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>नीम</td>
                                                                    <td>9</td>
                                                                    <td>बहावा</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>कांचन</td>
                                                                    <td>10</td>
                                                                    <td>जंगली बदाम</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>कुसूम</td>
                                                                    <td>11</td>
                                                                    <td>सिताफळ</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>रिठा</td>
                                                                    <td>12</td>
                                                                    <td>जांभूळ</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>स्पॅथोडिया</td>
                                                                    <td>13</td>
                                                                    <td>आवळा</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6</td>
                                                                    <td>पेल्टाफोरम</td>
                                                                    <td>14</td>
                                                                    <td>सिल्वर ओक</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7</td>
                                                                    <td>खाया</td>
                                                                    <td>15</td>
                                                                    <td>बकुळ</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8</td>
                                                                    <td>कॅशिया</td>
                                                                    <td>16</td>
                                                                    <td>करंज</td>
                                                                </tr>
                                                            </table>
                                                            <p>तसेच भुखंडावर अस्तित्वात असलेले 150 वृक्ष अथवा त्यातील काही वृक्ष जर मंजूर नकाशानुसार विकासकामात बाधित होणार असतील तर बाधित होणारे वृक्ष काढणेकरीता वृक्षप्राधिकरण विभागाची लेखी परवानगी घेणे विकासकास बंधनकारक राहील.</p>
                                                            <p>सदरचा अभिप्राय हा महाराष्ट्र (नागरी क्षेत्रे) झाडांचे संरक्षण व जतन अधिनियम, 1975 चे तरतुदीनुसार केवळ वृक्ष लागवड, जतन व संवर्धनासाठी पंचनामा व प्रतLPADDINGनाच्या अधिन राहून देणेत येत आहे. बांधकाम प्रारंभ प्रमाणपत्रासाठी (C.C.) आवश्यक व बंधनकारक असलेल्या तांत्रिक बाबी नगररचना विभागाने तपासून कृपया पुढील आवश्यक कार्यवाही आपल्या स्तरावर होणेस विनंती आहे.</p>
                                                            <p><?php echo $data['tippni_data']; ?></p>
                                                            <p>सदरची सुरक्षा अनामत ठेव रक्कम अंतिम भोगवटा प्रमाणपत्र (O.C.) निर्गमित झाल्यानंतर लागवड केलेल्या झाडांच्या संगोपनाचा सहामाही अहवाल पुढील 07 वर्षांपर्यंत (14 अहवाल) सादर केल्यानंतरच परतावा करण्यात येईल.</p>
                                                            <div class="signature">
                                                                <p>(Authority Name)<br>उपआयुक्त तथा वृक्षअधिकारी<br>कल्याण डोंबिवली महानगरपालिका
</p>
                                                                </div>
                                                                <p><strong>प्रत:</strong></p>
                                                                <ol>
                                                                    <li><?php echo $data['architech_name']; ?>. वास्तुविशारद</li>
                                                                    <li><?php echo $data['builder_name']; ?>. विकासक</li>
                                                                </ol>
                                                                <p><strong>टिप:</strong> विकासक, <?php echo $data['builder_name']; ?> यांनी वरील प्रमाणे लागवड केलेल्या वृक्षांची सहामाही अहवाल जिओ.टँगीग फोटोसह सात वर्ष वाढ होईपर्यंत वृक्षप्राधिकरण विभागास सादर करावयाचा आहे, याची नोंद घ्यावी.</p>
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
