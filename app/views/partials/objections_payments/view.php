<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("objections_payments/add");
$can_edit = ACL::is_allowed("objections_payments/edit");
$can_view = ACL::is_allowed("objections_payments/view");
$can_delete = ACL::is_allowed("objections_payments/delete");
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
                    <h4 class="record-title">View  Objections Payments</h4>
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
                        error_reporting(0);
                        $jeController = new User_infoController;
                        $db = $jeController->GetModel(); 
                        $db->where("flag_payment",$data['id']);
                        $data['idx']=$db->getOne("objections","*")['rec_id'];
                        $db->where("id",$data['idx']);
                        $data['rec_id']=$db->getOne("application_form","*")['id'];
                        //get header footer
                        // $db->where("type","Reciept");
                        // $hrec=$db->get("report_header_footer",1,'*');
                        $hrec[0]['footer']='<br><br><p style="text-align: right; "> <span style="color: rgb(51, 51, 51); font-family: " helvetica="" neue",="" helvetica,="" arial,="" sans-serif;="" font-size:="" medium;"="">Signature of Authorized Officer</span></p> ';
                            $hrec[0]['header']='<p></p>  <img style="float:left" src='.SITE_ADDR."assets/images/favicon.jpg".' width="100px"/> <div style="text-align: -webkit-center;"><font color="#333333" face="Helvetica Neue, Helvetica, Arial, sans-serif" size="3"><b>'.GLOBAL_RECIEPT_NAME.'</b><br></font></div> <div style="text-align: center;"><span style="color: rgb(51, 51, 51); font-family: " helvetica="" neue",="" helvetica,="" arial,="" sans-serif;="" font-size:="" medium;"="">Receipt Voucher</span></div>';
                                ?>
                                <style>
                                    @media print {
                                    body *, #main * { display:none; margin:0px!important;padding-top: 0px !important;}
                                    #main, #main #printarea, #main #printarea * { display:block ; }
                                    }
                                </style>
                                <div>
                                    <a href="#"  class="btn btn-danger" onclick="printDiv('printarea')"  >PRINT</a>
                                </div>
                                <div  >
                                    <div id="printarea"> 
                                        <div style='border:1px solid black<?php if(USER_ROLE==2){ echo "; display:none "; } ?>' >
                                            <span style="float:right"><img width="100px" height="100px"  src='<?php echo SITE_ADDR ?>qr.php?d=<?php echo $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";; ?>'></span>
                                                <?php echo $hrec[0]['header']; ?> 
                                                <br> <br> <p style='float:right'>Office Copy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                    <table border="1" width="100%">
                                                        <tr>
                                                            <th>Receipt No/ पावती क्र</th>
                                                            <th>Date of Receipt/ पावतीची तारीख</th>
                                                            <th>Cash Collection Center No./कॅश कलेक्शन सेंटर क्र.   </th>
                                                            <th>Counter No./काउंटर क्र.  </th>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo GLOBAL_RECIEPT_PREFIX ?>/<?php echo $data['id'] ?></td>
                                                            <td><?php echo date("d-m-Y",strtotime($data['timestamp'])); ?></td>
                                                            <td><?php echo $data['payment_cash_collection_center'] ?></td>
                                                            <td><?php echo $data['payment_counter'] ?></td>
                                                        </tr>
                                                    </table>
                                                    <br>
                                                        <table border="1" width="100%">
                                                            <tr>
                                                                <th>Received From/ कडून प्राप्त झाले</th>
                                                                <td><?php echo $data['recieved_from'] ?></td> 
                                                            </tr>
                                                            <tr>
                                                                <th>Amt (Rs)/रक्कम(रु.) </th>
                                                                <td><?php echo $data['amount'] ?></td> 
                                                            </tr>
                                                            <tr>
                                                                <th>Amt In Words/शब्दात रक्कम  </th>
                                                                <td style="text-transform:capitalize"><?php 
                                                                    function getIndianCurrency(float $number)
                                                                    {
                                                                    $decimal = round($number - ($no = floor($number)), 2) * 100;
                                                                    $hundred = null;
                                                                    $digits_length = strlen($no);
                                                                    $i = 0;
                                                                    $str = array();
                                                                    $words = array(0 => '', 1 => 'one', 2 => 'two',
                                                                    3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
                                                                    7 => 'seven', 8 => 'eight', 9 => 'nine',
                                                                    10 => 'ten', 11 => 'eleven', 12 => 'twelve',
                                                                    13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                                                                    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
                                                                    19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
                                                                    40 => 'forty', 50 => 'fifty', 60 => 'sixty',
                                                                    70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
                                                                    $digits = array('', 'hundred','thousand','lakh', 'crore');
                                                                    while( $i < $digits_length ) {
                                                                    $divider = ($i == 2) ? 10 : 100;
                                                                    $number = floor($no % $divider);
                                                                    $no = floor($no / $divider);
                                                                    $i += $divider == 10 ? 1 : 2;
                                                                    if ($number) {
                                                                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                                                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                                                    $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                                                                    } else $str[] = null;
                                                                    }
                                                                    $Rupees = implode('', array_reverse($str));
                                                                    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
                                                                    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
                                                                    }
                                                                echo getIndianCurrency($data['amount']); ?></td> 
                                                            </tr>
                                                            <tr>
                                                                <th>Function/कार्य</th>
                                                                <td style="text-transform:capitalize">Objection fee / आक्षेप शुल्क</td>
                                                            </tr>
                                                        </table>
                                                        <br>
                                                            <table border="1" width="100%">
                                                                <tr>
                                                                    <th>Mode Of Receipt/पावतीची पद्धत  </th>
                                                                    <th>Amt (Rs)/रक्कम(रु.)  </th>
                                                                    <th>Cheque No./चेक क्र.   </th>
                                                                    <th>Cheque Date/चेकची तारीख   </th>
                                                                    <th>Bank Name/बँकेचे नाव    </th>
                                                                </tr>
                                                                <tr>
                                                                    <td><?php  echo $mode; ?></td>
                                                                    <td><?php echo  $data['amount'] ?></td>
                                                                    <td><?php  echo $data['payment_chq_no'] ?></td>
                                                                    <td><?php  echo $data['payment_chq_date']==""?"":date("d-m-Y",strtotime($data['payment_chq_date'])); ?></td>
                                                                    <td><?php  echo $data['payment_bankname'] ?></td> 
                                                                </tr>
                                                            </table>
                                                            <br>
                                                                <table border="1" width="100%">
                                                                    <tr>
                                                                        <th>App. No. / अर्ज क्रमांक</th>
                                                                        <th>Date Of Bill/बिलाची तारीख     </th>
                                                                        <th>Details/तपशील  </th>
                                                                        <th>Payable Amt (Rs)/देय रक्कम (रु.)      </th>
                                                                        <th>Amt Received (Rs)/मिळालेली रक्कम (रु.)  </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>     <?php echo GLOBAL_APPLICATION_PREFIX.$data['rec_id'] ?></td>
                                                                        <td><?php echo date("d-m-Y",strtotime($data['timestamp'])); ?></td>
                                                                        <td style="text-transform:capitalize">Objection fee / आक्षेप शुल्क</td>
                                                                        <td><?php echo $data['amount'] ?></td>
                                                                        <td><?php echo $data['amount'] ?></td> 
                                                                    </tr>
                                                                    <tr>
                                                                        <th colspan="4">TOTAL / एकूण</th>
                                                                        <th colspan=""><?php echo $data['amount'] ?></th>
                                                                    </tr>
                                                                </table>
                                                                <?php echo $hrec[0]['footer']; ?> 
                                                            </div>
                                                            <?php if(USER_ROLE!=2){ ?>
                                                            <?php echo date("d-m-Y / h:i:s a",strtotime($data['timestamp'])) ?>
                                                            <hr>
                                                                <?php } ?>
                                                                <div style='border:1px solid black'>
                                                                    <span style="float:right"><img width="100px" height="100px" src='<?php echo SITE_ADDR ?>qr.php?d=<?php echo $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";; ?>'></span>
                                                                        <?php echo $hrec[0]['header']; ?> 
                                                                        <br> <br> <p style='float:right'>Customer Copy&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                                            <table border="1" width="100%">
                                                                                <tr>
                                                                                    <th>Receipt No/ पावती क्र</th>
                                                                                    <th>Date of Receipt/ पावतीची तारीख</th>
                                                                                    <th>Cash Collection Center No./कॅश कलेक्शन सेंटर क्र.   </th>
                                                                                    <th>Counter No./काउंटर क्र.  </th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?php echo GLOBAL_RECIEPT_PREFIX ?>/<?php echo $data['id'] ?></td>
                                                                                    <td><?php echo date("d-m-Y",strtotime($data['timestamp'])); ?></td>
                                                                                    <td><?php echo $data['payment_cash_collection_center'] ?></td>
                                                                                    <td><?php echo $data['payment_counter'] ?></td>
                                                                                </tr>
                                                                            </table>
                                                                            <br>
                                                                                <table border="1" width="100%">
                                                                                    <tr>
                                                                                        <th>Received From/ कडून प्राप्त झाले</th>
                                                                                        <td><?php echo $data['recieved_from'] ?></td> 
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Amt (Rs)/रक्कम(रु.) </th>
                                                                                        <td><?php echo $data['amount'] ?></td> 
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Amt In Words/शब्दात रक्कम  </th>
                                                                                        <td style="text-transform:capitalize"><?php 
                                                                                        echo getIndianCurrency($data['amount']); ?></td> 
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Function/कार्य</th>
                                                                                        <td style="text-transform:capitalize">Objection fee / आक्षेप शुल्क</td>
                                                                                    </tr>
                                                                                </table>
                                                                                <br>
                                                                                    <table border="1" width="100%">
                                                                                        <tr>
                                                                                            <th>Mode Of Receipt/पावतीची पद्धत  </th>
                                                                                            <th>Amt (Rs)/रक्कम(रु.)  </th>
                                                                                            <th>Cheque No./चेक क्र.   </th>
                                                                                            <th>Cheque Date/चेकची तारीख   </th>
                                                                                            <th>Bank Name/बँकेचे नाव    </th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><?php  echo $mode; ?></td>
                                                                                            <td><?php echo  $data['amount'] ?></td>
                                                                                            <td><?php  echo $data['payment_chq_no'] ?></td>
                                                                                            <td><?php  echo $data['payment_chq_date']==""?"":date("d-m-Y",strtotime($data['payment_chq_date'])); ?></td>
                                                                                            <td><?php  echo $data['payment_bankname'] ?></td> 
                                                                                        </tr>
                                                                                    </table>
                                                                                    <br>
                                                                                        <table border="1" width="100%">
                                                                                            <tr>
                                                                                                <th>App. No. / अर्ज क्रमांक</th>
                                                                                                <th>Date Of Bill/बिलाची तारीख     </th>
                                                                                                <th>Details/तपशील  </th>
                                                                                                <th>Payable Amt (Rs)/देय रक्कम (रु.)      </th>
                                                                                                <th>Amt Received (Rs)/मिळालेली रक्कम (रु.)  </th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>     <?php echo GLOBAL_APPLICATION_PREFIX.$data['rec_id'] ?></td>
                                                                                                <td><?php echo date("d-m-Y",strtotime($data['timestamp'])); ?></td>
                                                                                                <td style="text-transform:capitalize">Objection fee / आक्षेप शुल्क</td>
                                                                                                <td><?php echo $data['amount'] ?></td>
                                                                                                <td><?php echo $data['amount'] ?></td> 
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th colspan="4">TOTAL / एकूण</th>
                                                                                                <th colspan=""><?php echo $data['amount'] ?></th>
                                                                                            </tr>
                                                                                        </table>
                                                                                        <?php echo $hrec[0]['footer']; ?> 
                                                                                    </div>
                                                                                    <?php echo date("d-m-Y / h:i:s a",strtotime($data['timestamp'])) ?>
                                                                                </div>
                                                                            </div>
                                                                            <script>
                                                                                function printDiv(divName) {
                                                                                var printContents = document.getElementById(divName).innerHTML;
                                                                                var originalContents = document.body.innerHTML;
                                                                                document.body.innerHTML = printContents;
                                                                                document.body.removeAttribute("style");
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
