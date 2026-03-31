<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("application_form/add");
$can_edit = ACL::is_allowed("application_form/edit");
$can_view = ACL::is_allowed("application_form/view");
$can_delete = ACL::is_allowed("application_form/delete");
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
                    <h4 class="record-title">View  Application Form</h4>
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
                        <?php $jei=new OrdersController();
                        $db=$jei->GetModel();
                        if($data['flag_accept']=="1"){
                        }else{
                        echo "Error Code : 403 Not Accepeted";
                        exit();
                        }
                        $rec_id=$data['id'];
                        ?>
                        <style>
                            p{
                            font-size:20px;
                            color:black;
                            }
                            b{
                            font-size:30px;
                            color:black;
                            }
                            #pad{
                            padding-left:10%;
                            padding-right:10%;
                            }
                        </style>
                        <div style="100%">
                            <img src='/qr.php?d=<?php echo SITE_ADDR ?>application_form/cert_view/<?php echo $data['id'] ?>' style="float:right " width=100px>
                                <?php if($data['application_type']=="FULL TREE CUT")
                                { ?>
                                <br>
                                    <Center><u><b>वृक्षतोड परवाना</b></u></Center>
                                    <br>
                                        <br>
                                            <div id='pad'> 
                                                <p class="text-right">जा.क्र./सानप/वृक्ष/<?php echo $data['id']; ?></p>
                                                <p class="text-right">सातारा नगरपरिषद, सातारा</p>
                                                <p class="text-right">दिनांक - <?php echo date("d-m-Y",strtotime($data['approval_date']));  ?></p>
                                                <p>
                                                    प्रति,
                                                    <br>
                                                        <?php echo $data['applicant_name'] ?>
                                                        <br>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            तुमचे दि. <?php echo date("d-m-Y",strtotime($data['timestamp'])); ?>     चे अर्जावरुन कळविणेत येते की, महाराष्ट्र (नागरी क्षेत्र) झाडांचे संरक्षण व जतन अधिनियम 1975 चे कलम 8(2) अन्वये तुमचे मालकीचे सातारा शहर, सातारा –Peth पेठ     सि.स.नं. <?php  echo $data['city_survey_number'] ?>    या मिळकतीमधील     <?php echo $data['no_of_trees']; ?>      झाड/ झाडे तोडण्यास तुमचे अर्जावरुन खालील शर्तीस अधीन राहून परवाना देणेत येत आहे.  त्याबाबतच्या शर्ती खालीलप्रमाणे -
                                                            <br> 1)  सदरची परवानगी प्राप्त झालेपासून 15 दिवसांपर्यत सदरचे झाड/झाडे तोडण्यात येवू नये/नयेत.
                                                                <br> 2)  वृक्षतोड परवाना दिल्यानंतर झाड/ झाडे तोडलेपासून 30 दिवसांचे आत तुमचे हद्दीत पाडण्यात येणाऱ्या 
                                                                    वृक्षांच्या अंदाजित वयाइतक्या संख्येएवढे  नवीन <?php echo $data['no_of_trees']*2 ?> झाडे लावली पाहिजेत. 
                                                                    <br> 3)  नवीन झाड/ झाडे लावलेनंतर त्याच्या स्थितीविषयीचा तीन वर्षाच्या कालावधीसाठीचा सचित्र    
                                                                        अहवाल दर सहा महिन्यांतून एकदा वृक्ष विभागास सादर करावा. अशा अहवालाने वृक्ष अधिका-   
                                                                        याचे यथायोग्य समाधान झालेवरच आपण भरलेली अनामत रक्कम आपणांस परत केली जाईल
                                                                        <br> 4)  वृक्षतोड करत असताना वृक्ष तोडीमध्ये विजेच्या तारा येत असल्यास महाराष्ट्र वीज मंडळाकडून    
                                                                            वीजप्रवाह बंद केलेनंतर वृक्षतोड करावी.  वृक्षतोड करीत असताना जिवित हानी, आजूबाजूचे इमारतीची      
                                                                            नुकसानी तसेच विजेच्या तारांची नुकसानी झालेस सर्व जबाबदारी वृक्षतोड परवाना धारकाची राहील.
                                                                            <br> 5)  वृक्ष तोडलेनंतर वाहतूक परवाना महाराष्ट्र वन विभागाकडून घेणेचे अटीवर सदरचा परवाना देणेत येत  
                                                                                आहे.
                                                                                <br> 6)  सागवान वृक्ष व चंदन वृक्ष तोडलेनंतर वाहतूक करणेसाठी महाराष्ट्र वन विभाग सातारा यांचा परवाना  
                                                                                    घेणेची जबाबदारी वृक्षतोड परवाना घेणा-यावर राहील.
                                                                                    <br> 7)  वृक्ष विभागाचे कर्मचारी यांचे पर्यवेक्षणाखाली काम करावे.
                                                                                        8) परवान्यात नमूद केलेल्या वृक्षांपेक्षा जास्त वृक्ष तोड करू नये.
                                                                                        <br>
                                                                                            9) वृक्ष अनामत रु. <?php echo $data['amount'] ?>  पावती नं.  <?php echo $data['flag_payment'] ?>  दि.  <?php echo date("d-m-Y",strtotime($data['approval_date'])); ?> ने जमा व वृत्त पत्र प्रसिद्धीकरण दि. <?php echo date("d-m-Y",strtotime($data['approval_date'])); ?>  पावती नं. <?php echo $data['flag_payment'] ?>.
                                                                                            <br><br>
                                                                                                टीप- यातील अथवा महाराष्ट्र (नागरी क्षेत्र)  झाडांचे संरक्षण व जतन अधिनियम 1975 मधील कोणत्याही     
                                                                                                तरतुदींचा भंग केलेस आपणावर सदर अधिनियमामधील तरतुदींनुसार कारवाई करणेत येईल 
                                                                                                याची नोंद घ्यावी.
                                                                                                <br>
                                                                                                    <br>
                                                                                                        <br>
                                                                                                            <br>
                                                                                                            </p>
                                                                                                            <p class="text-right">(विभागप्रमुख) <br>
                                                                                                                (वृक्ष विभाग)                                                    <br>
                                                                                                                    सातारा नगरपरिषद, सातारा
                                                                                                                </p>
                                                                                                            </div>
                                                                                                            <?php }else{
                                                                                                            if(USER_ROLE!=2){
                                                                                                            ?>
                                                                                                            <Center><p>वृक्ष प्राधिकरण विभाग  </p></Center>
                                                                                                            <Center><b>कार्यालयीन टिपणी </b></Center>
                                                                                                            <div id="pad">
                                                                                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                                    विषय - वृक्षाचा भार कमी करणेबाबत.
                                                                                                                </p>
                                                                                                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                                    संदर्भ - दि <?php echo date("d-m-Y",strtotime($data['timestamp'])); ?> रोजीचा अर्जदाराचा अर्ज
                                                                                                                </p>
                                                                                                                <br>
                                                                                                                    <p>सातारा नगरपरिषद हददीमधील पेठ  <?php echo $data['peth'] ?> 
                                                                                                                        सि.स.नं. <?php echo $data['city_survey_number']; ?>
                                                                                                                        या मिळकतीमधील श्री./सौ.
                                                                                                                        <?php echo $data['applicant_name'] ?>
                                                                                                                        यांचे मालकीचे असणारे
                                                                                                                        <?php
                                                                                                                        $db->where("rec_id",$rec_id);
                                                                                                                        $dat=$db->get("photo_of_tree",9999,"*");
                                                                                                                        foreach($dat as $d){
                                                                                                                        echo $d['name_of_tree'].",";
                                                                                                                        }                                                                  ?>
                                                                                                                        चे वृक्ष एकूण नग 
                                                                                                                        <?php echo $data['no_of_trees'] ?>
                                                                                                                        हे अति उंच वाढलेले असून त्यांची उंची
                                                                                                                        <?php 
                                                                                                                        $db->where("rec_id",$rec_id);
                                                                                                                        $dat=$db->get("photo_of_inspection",9999,"*");
                                                                                                                        foreach($dat as $d){
                                                                                                                        echo $d['height'].",";
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                        एवढी व त्याचा घेर
                                                                                                                        <?php foreach($dat as $d){
                                                                                                                        echo $d['width'].",";
                                                                                                                        } ?>   एवढा आहे.  तरी सदर वृक्षाच्या फांदया अस्तव्यस्त वाढलेल्या आहेत.  त्याचा भार कमी करणे आवश्यक आहे.  कारण जादा भार असलेने सदर वृक्ष केव्हाही उन्मळून पडण्याची शक्यता आहे.
                                                                                                                        <br>
                                                                                                                            तरी सदरच्या वृक्षाच्या फांदया जमिनीपासून 
                                                                                                                            उंचीवर कट केल्यास तसेच त्याच्या लांब असलेल्या फांदया कमी केल्यास सदरचे झाड पडण्याची शक्यता कमी होणार आहे.  तरी त्यांना सदर वृक्षाचा भार व फांदया त्यांचे मार्फत छाटणेसाठी त्यांना मान्यता देणेस आपले निर्णयास्तव सादर.
                                                                                                                            <br>
                                                                                                                                <br>
                                                                                                                                    <br>
                                                                                                                                        (नंदकुमार कांबळे) 
                                                                                                                                        <br>
                                                                                                                                            लिपिक
                                                                                                                                            <br>
                                                                                                                                                <br>
                                                                                                                                                    <br>
                                                                                                                                                        (सुधीर चव्हाण)
                                                                                                                                                        <br>
                                                                                                                                                            क. अभियंता
                                                                                                                                                            <br><br>
                                                                                                                                                                <p class="text-right">
                                                                                                                                                                    (वृक्ष विभाग )                                                                                                       <br>
                                                                                                                                                                        सातारा नगरपरिषद, सातारा
                                                                                                                                                                    </p>
                                                                                                                                                                    <?php
                                                                                                                                                                    ?>
                                                                                                                                                                </p>
                                                                                                                                                            </div>
                                                                                                                                                            <div style="page-break-before: always;">
                                                                                                                                                                <?php }
                                                                                                                                                                ?>
                                                                                                                                                                <br>
                                                                                                                                                                    <br>
                                                                                                                                                                        <br>
                                                                                                                                                                            <br>
                                                                                                                                                                                <Center><b>वृक्षभार कमी  करणेचा परवाना</b></Center>
                                                                                                                                                                                <div id='pad'>
                                                                                                                                                                                    <p class="text-right">जा.क्र./सानप/वृक्ष/<?php echo $data['id']; ?></p>
                                                                                                                                                                                    <p class="text-right">सातारा नगरपरिषद, सातारा</p>
                                                                                                                                                                                    <p class="text-right">दिनांक - <?php echo date("d-m-Y",strtotime($data['approval_date']));  ?></p>
                                                                                                                                                                                    <br>
                                                                                                                                                                                        <br>
                                                                                                                                                                                            <br>
                                                                                                                                                                                                <p>
                                                                                                                                                                                                    प्रति,
                                                                                                                                                                                                    <br>
                                                                                                                                                                                                        <?php echo $data['applicant_name'] ?>
                                                                                                                                                                                                        <br>
                                                                                                                                                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;विषय - वृक्षाचा भार कमी करणेबाबत.
                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;संदर्भ - आपला दिनांक <?php date("d-m-Y",strtotime($data['timestamp'])) ?> चा अर्ज
                                                                                                                                                                                                                <br>
                                                                                                                                                                                                                    <br>
                                                                                                                                                                                                                        <br>
                                                                                                                                                                                                                            वरील संदर्भिय पत्रान्वये आपण पेठ  <?php  echo $data['peth'] ?>  सि.स.नं <?php echo $data['city_survey_number'] ?>
                                                                                                                                                                                                                            श्री./सौ  <?php echo $data['property_owner_name'] ?> यांचे मिळकतीमधील असणारे वृक्ष धोकादायक असून त्याचा भार व उंची कमी करणेबाबत (फांदया छाटणे) इकडील कार्यालयास  कळविले आहे.
                                                                                                                                                                                                                            सदर पत्राच्या अनुषगांने पेठ <?php  echo $data['peth'] ?> सि.स.नं <?php echo $data['city_survey_number'] ?> या मिळकतीमधील वृक्षांची समक्ष पाहाणी करून  त्याचा पंचनामा करणेत आलेला आहे.
                                                                                                                                                                                                                            तरी सदर पंचनाम्यात नमुद केलेले वृक्ष 
                                                                                                                                                                                                                            <?php 
                                                                                                                                                                                                                            $db->where("rec_id",$rec_id);
                                                                                                                                                                                                                            $dat=$db->get("photo_of_tree",9999,"*");
                                                                                                                                                                                                                            foreach($dat as $d){
                                                                                                                                                                                                                            echo $d['name_of_tree'].",";
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                            ?>
                                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;आपण आपले स्तरावर जमिनीपासून भार <?php ?> व उंची कमी करून घ्यावी. सदरचे वृक्ष हे पूर्ण तोडावयाचे नाहीत. तसेच ज्या वृक्षाचा भार आपण कमी करणार आहात तो वृक्ष मृत होणार नाही याची दक्षता घ्यावी. अन्यथा आपणांवर महाराष्ट्र (नागरी क्षेत्र) झाडांचे संरक्षण व जतन अधिनियम १९७५ मधील कलम २१ मधील तरतुदीनुसार कारवाई करणेत येईल, याची नोंद घ्यावी. 
                                                                                                                                                                                                                            </p>
                                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                                <br>
                                                                                                                                                                                                                                    <br>
                                                                                                                                                                                                                                        <p class="text-right">
                                                                                                                                                                                                                                            (वृक्ष विभाग )    
                                                                                                                                                                                                                                            <br>
                                                                                                                                                                                                                                                सातारा नगरपरिषद, सातारा
                                                                                                                                                                                                                                            </p>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                        <?php
                                                                                                                                                                                                                                    }?></div>  
                                                                                                                                                                                                                                    <script>
                                                                                                                                                                                                                                        $(document).load(function() {
                                                                                                                                                                                                                                        window.print();
                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                    </script>
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                        </section>
