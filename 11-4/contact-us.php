<?php
include ('common/header1.php');

function GetMSISDN() // Find out the MSISDN Number of GrameenPhone Mobile
{
    $sMsisdnNo =null;  //http://www.msisdn.org/
    try
    {
        $sMsisdn =null;

        // $sMsisdn =$_SERVER['HTTP_X_UP_CALLING_LINE_ID']; //Request.ServerVariables.Get("HTTP_X_UP_CALLING_LINE_ID");

        if(!empty($_SERVER['HTTP_MSISDN'])){
            if ($sMsisdn==null)
            {
                // sMsisdn = Request.ServerVariables["HTTP_MSISDN"];
                $sMsisdn =$_SERVER['HTTP_MSISDN'];
                $check=1;
            } // for GP

            if ($sMsisdn==null)
            {
                //sMsisdn = Request.ServerVariables.Get("HTTP_MSISDN");
                $check=2;
                echo $check;
                $sMsisdn =$_SERVER['HTTP_MSISDN'];
            }

            if ($sMsisdn==null)
            { //sMsisdn = Request.Headers["MSISDN"];
                $check=3;
                echo $check;
                $sMsisdn =$_SERVER['MSISDN'];
            }

            if ($sMsisdn==null)
            { //sMsisdn = Request.Headers.Get("MSISDN");
                $check=4;
                echo $check;
                $sMsisdn =$_SERVER['MSISDN'];
            }

            if ($sMsisdn==null)
            {
                //sMsisdn = Request.ServerVariables.Get("X-MSISDN");
                $check=5;
                echo $check;
                $sMsisdn =$_SERVER['X-MSISDN'];
            }

            if ($sMsisdn==null)
            { //sMsisdn = Request.ServerVariables.Get("User-Identity-Forward-msisdn");
                $check=6;
                echo $check;
                $sMsisdn =$_SERVER['User-Identity-Forward-msisdn'];
            }

            if ($sMsisdn==null)
            {
                $check=7;
                echo $check;

                //sMsisdn = Request.ServerVariables.Get("HTTP_X_FH_MSISDN");
                $sMsisdn =$_SERVER['HTTP_X_FH_MSISDN'];
            }

            if ($sMsisdn==null)
            { // sMsisdn = Request.ServerVariables.Get("HTTP_X_MSISDN");

                $check=8;
                echo $check;

                $sMsisdn =$_SERVER['HTTP_X_MSISDN'];
            }

            if ($sMsisdn==null)
            { //sMsisdn = Request.ServerVariables["http_msisdn"];
                $check=9;
                echo $check;

                $sMsisdn =$_SERVER['http_msisdn'];

            }

            if ($sMsisdn==null)
            {
                $check=10;
                echo $check;
                $sMsisdn =$_SERVER['http_msisdn'];
                // sMsisdn = Request.ServerVariables.Get("http_msisdn");
            }

            if ($sMsisdn==null)
            {
                $check=11;
                echo $check;
                $sMsisdn =$_SERVER['msisdn'];

                //sMsisdn = Request.Headers["msisdn"];
            }

            if ($sMsisdn==null)
            { //sMsisdn = Request.Headers.Get("msisdn");
                $check=12;
                echo $check;
                $sMsisdn =$_SERVER['msisdn'];
            }

            if ($sMsisdn==null)
            {
                $check=13;
                echo $check;
                $sMsisdn =$_SERVER['HTTP_X_HTS_CLID'];
                //sMsisdn = Request.ServerVariables["HTTP_X_HTS_CLID"];
            }

            if ($sMsisdn==null)
            {
                $check=14;
                echo $check;

                $sMsisdn =$_SERVER['X-WAP-Network-Client-MSISDN'];
                //sMsisdn = Request.Headers["X-WAP-Network-Client-MSISDN"];
            } // for Airtel


            if (strlen($sMsisdn) > 13)
            {
                for ($iCount = 1; $iCount < strlen($sMsisdn); $iCount += 2)
                {
                    $sMsisdnNo .= $sMsisdn[$iCount];
                }
            }
            else
            {
                //echo $sMsisdn;
                $sMsisdnNo = $sMsisdn;
            }
        }
    }
    catch (Exception $ex)
    {
        $sMsisdnNo = "Error - ".$e->getMessage();
    }
    //sMsisdnNo = "8801756094037";

    return $sMsisdnNo;
    //  return $check;
}

//call GetMSISDN() when need to get the mobile no
$mobileNo = GetMSISDN();
//echo $mobileNo;exit;

/*==============GET data from mssql databse tbl_Subscriber=============*/

$sql = "SELECT MSISDN,SubscriberId,SubscriptionType FROM  tbl_Subscriber where MSISDN=$mobileNo and RegStatus=1";
$stmt =  $connectionInfo->prepare("$sql");
$stmt->execute();
$data = [] ;
while ($row = $stmt->fetch()) {
    $data[] = $row  ;
    // print_r($row);
}
//echo '<pre>';
//print_r($data[0]);

$subcs_id = isset($data[0]['SubscriberId'])?$data[0]['SubscriberId']:'';
$subcs_type = isset($data[0]['SubscriptionType'])?$data[0]['SubscriptionType']:'';


//echo $subcs_id  ;
//exit;
unset($connectionInfo);
unset($stmt);

//exit;

/*=================SOAP API call in php==================*/
/*$params = array(
    'cache_wsdl' => WSDL_CACHE_NONE,
);
$clients = new SoapClient("http://wap.shabox.mobi/KasperskyApi/KSSLABAPI.asmx?wsdl", $params);

if($subcs_id!='')
{
    //print_r(['SubscriberId'=>$subcs_id]);
    //exit;
    $deactivate_user = $clients->SoftDeactivateUser(['subscriptionId'=>"$subcs_id",'MSISDN'=>$mobileNo, 'SubscriptionType'=>$subcs_type]);
}*/
//print_r($deactivate_user ) ;exit;
?>
<script xmlns="http://www.w3.org/1999/html">
    $('#contact').addClass('active');
</script>

<div class="container">
    <div class="row">
        <div class="span6">
            <h2 style="background:#006151;color: #ffffff;font-weight: bold">My Account</h2>
           <?php if($subcs_id!='')
            {
           ?>
            <h4 class="pull-top">You have subscribed kaspersky <strong><?php echo $subcs_type;?> Pack </strong>
                service</h4>
            <p>If you want to unsubscribe from the service then click the unsubscribe button.</p>

            <div class="btn-toolbar">
                <input type="submit" value="Unsubscribe" class="btn btn-kespersky btn-large" data-loading-text="Loading..." onclick="unsubscribeUser()">
                <span class="msgsend" style="font-size:14px;font-weight:bold;display:none">&nbsp;&nbsp;&nbsp;On Process....</span>
            </div>
           <?php }
           else{
               echo 'You have not subscribe kaspersky service. If you want to subscribe kaspersky service then
               click the link <a href="http://wap.shabox.mobi/Kaspersky" style="color: #0066FF">
               http://wap.shabox.mobi/Kaspersky</a>';
           }
           ?>

            <div>&nbsp;</div>
            <hr />
            	<h4>The exclusive others <strong>Packages</strong> are also here.</h4>
            <div class="btn-toolbar">
              <!--  <button type="button" class="btn btn-kespersky btn-large" data-toggle="modal" data-target="#myModal">Pack Upgrade</button>-->
                <a href="http://wap.shabox.mobi/Kaspersky/" class="btn btn-kespersky btn-large">Pack Upgrade</a>
            </div>
            <div>&nbsp;</div>
            <hr />
            <h2 style="background:#006151;color: #ffffff;font-weight: bold">Terms and Conditions:</h2>
            <h4>Why Kaspersky?</h4>
            <p>The best protection and most comprehensive solution is vital to guard against the latest Internet threats. Learn more about the award-winning technologies and products from Kaspersky Lab, protecting consumers.</p>
            <h4>What is Kaspersky address?</h4>
            <p>The portal addresses<a href="http://wap.shabox.mobi/Kaspersky" style="color: #0066FF"> http://wap.shabox.mobi/Kaspersky</a></p>
            <h4>How can users join the service?</h4>
            <p>User can join by visiting <a href="http://wap.shabox.mobi/Kaspersky" style="color: #0066FF"> http://wap.shabox.mobi/Kaspersky</a></p>
            <h4>How to activate the service?</h4>
            <p>Activation Procedure: Type START SUB to 21234 or <a href="http://wap.shabox.mobi/Kaspersky" style="color: #0066FF"> http://wap.shabox.mobi/Kaspersky</a></p>
            <h4>How to deactivate the service?</h4>
            <p>Service can be deactivated anytime by sending deactivation SMS. Deactivation procedure: Type STOP UNSUB to 21234</p>
            <h4>How much is the charge to Kaspersky?</h4>
            <p>Subscription charging info:</p>
               <p> Daily Subscription package: TK3 (+VAT+SD+SC) with auto-renewal</p>
               <p>Weekly Subscription package: TK20 (+VAT+SD+SC) with auto-renewal.</p>
               <p>Monthly Subscription package: TK80 (+VAT+SD+SC) with auto-renewal.</p>

            <h4>Which device is supported to Kaspersky?</h4>
            <p>Only Android device is supported</p>
            <h4>Is this support any iOS or Feature Phone?</h4>
            <p>NO</p>
            <h4>Which Browser is supported to Kaspersky download?</h4>
            <p>Which Browser is supported to Kaspersky download?</p>
            <h4>What is Kaspersky Portal Modality?</h4>
            <p>	This is daily, weekly, monthly subscription based auto-renewal service.
                <p>•Subscription Charge :</p>
            <p> Daily Subscription charge: TK3 (+VAT+SD+SC) with auto-renewal</p>
            <p>Weekly Subscription charge: TK20 (+VAT+SD+SC) with auto-renewal.</p>
            <p>Monthly Subscription charge: TK80 (+VAT+SD+SC) with auto-renewal.</p>
            <h4>User can buy same time multiple packages?</h4>
            <p>No</p>
            <h4>What is the helpline/hotline number for all Operators?</h4>
            <p>8801814426426</p>
            <h4>What is the time to get the helpline support?</h4>
            <p>8:00 AM – 7:00 PM</p>
            <h4>Is this site providing any email support?</h4>
            <p>Yes</p>
            <h4>what is the support email address?</h4>
            <p>Support email: <a href="#" style="color: #0066FF">
                    support@vumobile.biz</a></p>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('.toggle label').click(function(){
            $(this).children('span').addClass('input-checked');
            $(this).parent('.toggle').siblings('.toggle').children('label').children('span').removeClass('input-checked');
        });



    });

    function unsubscribeUser(){
        
        $.get( "deactivate_user.php", { subscriptionId: '<?php echo $subcs_id;?>', MSISDN: '<?php echo $mobileNo;?>', SubscriptionType: '<?php echo $subcs_type;?>' } ).done(function( data ) {
            alert( 'Successfully unsubscribe from kaspersky service' );
            location.reload();
        });        
    }
</script>
<script src="js/plugins.js"></script>
<!-- Page Scripts -->
<script src="js/views/view.contact.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-60266758-1', 'auto');
    ga('send', 'pageview');

</script>
