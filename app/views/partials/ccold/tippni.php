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
                                        <title>कल्याण डोंबिवली महानगरपालिका  - वृक्षप्राधिकरण नोटीस</title>
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
                                    </head>
                                    <body>
                                        <div id="printable-section"> 
                                            <div class="container">
                                                <h1>कल्याण डोंबिवली महानगरपालिका   </h1>
                                                <p class="head_content"><strong>कार्यालयीन टिपणी क्र.<?php echo $data['cc_application_id']; ?>:</strong> </p>
                                                <p class="head_content"><strong>विभाग:</strong> वृक्षप्राधिकरण / उद्यान</p>
                                                <p class="head_content"><strong>दिनांक:</strong> <?php echo $data['date']; ?></p>
                                                <p><strong>मा. सादर,</strong></p>
                                                <h2>विषय:</h2>
                                                <p>महाराष्ट्र (नागरीक्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 मधील प्रकरण 8 मधील कलम 19 मधील तरतुदीनुसार जमीनीच्या विकासासाठीचा (C.C. बाबत) वृक्ष अधिकारी यांचा अभिप्राय देणेबाबत. (_______)</p>
                                                <h2>संदर्भ:</h2>
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
                                                </ol>
                                                <p>उपरोक्त नमुद संदर्भ क्र.2 च्या अनुषंगाने गांव <?php echo $data['address_of_plot']; ?> या जमिनीवर <?php echo $data['type_of_residence']; ?> इमारतीचे बांधकाम करावयाचे असून या भूखंडाचे एकूण क्षेत्रफळ <?php echo $data['plot_area_in_sq_mtr']; ?> चौ.मी. आहे, असे वास्तुविशारद, <?php echo $data['architech_name']; ?> व विकासक, <?php echo $data['builder_name']; ?> यांनी कळविलेले आहे. विकासक यांनी संदर्भ क्र.2 नुसार वृक्षप्राधिकरण विभागाचे अभिप्राय मागितले असून त्यान्वये वृक्षप्राधिकरण विभागाने दि. <?php echo $inspection['inspection_date']; ?> रोजी जागेवर केलेल्या स्थल पाहणी अहवाला नुसार सदर इमारतीच्या बांधकाम करावयाच्या भुखंडावर <?php echo $data['names_of_trees_be_planted']; ?> वृक्ष अस्तित्वात आहेत.</p>
                                                <p>वास्तुविशारद, <?php echo $data['architech_name']; ?> एन्ड <?php echo $data['builder_name']; ?> यांनी सादर केलेल्या अर्जानुसार भुखंडाचे एकूण क्षेत्रफळ <?php echo $data['plot_area_in_sq_mtr']; ?> चौ.मी. असून संदर्भ क्र. 1 च्या आदेशान्वये महाराष्ट्र (नागरीक्षेत्रे) झाडांचे संरक्षण व जतन अधिनियम, 1975 व महाराष्ट्र (नागरीक्षेत्रे) वृक्ष संरक्षण व संवर्धन नियम, 2009 मधील अनुसुची 1, कलम 7(एच) नुसार सदर भुखंडावर 1 वृक्ष प्रती 100 चौ.मी. प्रमाणे वृक्षलागवड करणे आवश्यक असून विकासकास खालील तक्त्यात नमुद 16 वृक्ष प्रजातींपैकी भुखंडावर एकूण <?php echo $data['trees_to_be_planted']; ?> वृक्षांची लागवड करुन सदर वृक्षांचे योग्यतेसंगोपन व संवर्धन करणे बंधनकारक राहील.</p>
                                                <p>तरी विकासकाने पुढील नमुद प्रजातीपैकी किमान 2.5 फुट x 2.5 फुट x 2.5 फुट खड्डाखणून 2.0 मीटर उंचीच्या एकूण  <?php echo $data['trees_to_be_planted']; ?> झाडांची लागवड करुन त्यांची जोपासना करणे आवश्यक राहील.</p>
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
                                                <p><?php echo $data['tippni_data']; ?></p>
                                                <p>नमुद प्रस्तावानुसार सदर ठिकाणी कोणतेही झाड तोडणे आलेले नसून संबंधीतावर महाराष्ट्र (नागरी क्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 अंतर्गत कोणताही गुन्हा अथवा कारवाई प्रलंबित नाही. वरीलप्रमाणे वृक्षलागवडीबाबत मा. वृक्षअधिकारी यांचा अभिप्राय देणेस शिफारस आहे.</p>
                                                <br>
                                                    <div class="signature">
                                                        <p>(Authority Name)<br>
                                                            प्र. उद्यान अधिक्षक (ठेका), मुख्यालय<br>
                                                            वृक्षप्राधिकरण/उद्यान विभाग</p>
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
