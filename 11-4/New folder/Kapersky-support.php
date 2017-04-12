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
    catch (Exception $e)
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

/*$result = array();
$sp= $connectionInfo->prepare("SELECT MSISDN,SubscriberId,SubscriptionType FROM  tbl_Subscriber");
$sp->execute();
$result = $sp->fetchall(PDO::FETCH_OBJ);
print_r($result);exit;*/

$sql = "SELECT MSISDN,SubscriberId,SubscriptionType FROM  tbl_Subscriber where MSISDN='$mobileNo' and RegStatus=1";
//print_r($sql);exit;
$stmt =  $connectionInfo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchall(PDO::FETCH_OBJ);
//echo '<pre>'; print_r($result );exit;
//$data = [] ;echo '<pre>';
//print_r($result[0]);exit;

$subcs_id = isset($result[0]->SubscriberId)?$result[0]->SubscriberId:'';
$subcs_type = isset($result[0]->SubscriptionType)?$result[0]->SubscriptionType:'';

//echo $subcs_type;exit;

unset($stmt);

//exit;

/*==============GET data from mssql databse tbl_KSK_Subscriber=============*/

$sql2 = "SELECT MSISDN,SubscriberId,SubscriptionType FROM  tbl_KSK_Subscriber where MSISDN=$mobileNo and RegStatus=1";
//print_r($sql2);exit;
$stmt_ksk =  $connectionInfo->prepare("$sql2");
$stmt_ksk->execute();
$data_ksk = [] ;
while ($row = $stmt_ksk->fetch()) {
    $data_ksk[] = $row  ;
    // print_r($row);
}
//echo '<pre>';
//print_r($data_ksk[0]);exit;

$subcs_ksk_id = isset($data_ksk[0]['SubscriberId'])?$data_ksk[0]['SubscriberId']:'';
$subcs_ksk_type = isset($data_ksk[0]['SubscriptionType'])?$data_ksk[0]['SubscriptionType']:'';


//echo $subcs_id  ;
//exit;
unset($connectionInfo);
unset($stmt_ksk);


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
<style>
    .deactivateUserMsg{
        color: #FFF;
        padding: 5px 0px;
        background: #006151;
        text-indent: 5px;
        font-weight: bold;
        display: none;
    }
</style>
<script xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    $('#contact').addClass('active');
</script>

<div class="container">
    <div class="row">
        <div class="span6">
            <h2 style="background:#006151;color: #ffffff;font-weight: bold">My Account</h2>
            <?php
            if($subcs_id!='') {
                ?>
                <p class = 'deactivateUserMsg' id="deactivateUserMsgId">You have successfully unsubscribe from the
                    kaspersky service.</p>
                <div id = "deactivateUserId">
                    <h4 class="pull-top">You have subscribed kaspersky <strong><?php echo $subcs_type;?> Pack </strong>
                        service</h4>
                    <p>If you want to unsubscribe from the service then click the unsubscribe button.</p>

                    <div class="btn-toolbar">
                        <input type="submit" value="Unsubscribe" class="btn btn-kespersky btn-large" data-loading-text="Loading..." onclick="unsubscribeUser()">
                        <span class="msgsend" style="font-size:14px;font-weight:bold;display:none">&nbsp;&nbsp;&nbsp;On Process....</span>
                    </div>
                </div>
                <hr />
                <?php
            }

            if(!empty($subcs_ksk_id)){
                ?>
                <!-- <h4>The exclusive others <strong>Packages</strong> are also here.</h4>-->
                <p class = 'deactivateUserMsg' id="deactivateKSKUserMsg">You have successfully unsubscribe from the
                    kaspersky service.</p>
                <div class="btn-toolbar" id = 'deactivateKSKUserId'>
                    <input type="submit"
                           value="unsubscribe-safekids"
                           class="btn btn-kespersky btn-large"
                           data-loading-text="Loading..."
                           onclick="unsubscribeSafekit()">

                </div>
            <?php } ?>

            <hr />
            <div>&nbsp;</div>
            <h2 style="background:#006151;color: #ffffff;font-weight: bold; margin-top: 5px;">Terms and Conditions:</h2>
            <h4>Why Kaspersky?</h4>
            <p>Kaspersky is the best and most comprehensive solution in the market today to protect your mobile devices against the latest internet threats. In addition to other features, Kaspersky Mobile Internet Security blocks malware & dangerous apps, filters unwanted calls & texts and provides Web Protection before they can harm your device or can cause financial or other private data theft. Kaspersky’s remote tools can help prevent personal data falling into the wrong hands if the mobile device is stolen or goes missing. In case of theft, subscribers can use the Kaspersky portal or SMS commands to remotely turn on an alarm on the device, lock, and locate it, wipe information from it, or even take a picture of the person currently using the device.</p>
            <h4>How can users subscribe to the service?</h4>
            <p>Users can subscribe to the service by visiting <a href="http://wap.shabox.mobi/Kaspersky" style="color: #0066FF"> http://wap.shabox.mobi/Kaspersky</a></p>

            <h4>How to deactivate the service?</h4>
            <p>Users can deactivate the service by following methods:</p>
            <p>By sending SMS:</p>
            <p>type UNSUB KASP and send SMS to 21213.</p>
            <p>type STOP ALL and send SMS to 6888.</p>
            <p>From the Kaspersky app, using the in-app un-subscription option.</p>
            <p>Through Hotline: 01814426426</p>
            <h4>How much is the charge to Kaspersky?</h4>
            <p> Daily Subscription package: TK3 (+VAT+SD+SC) with auto-renewal</p>
            <p>Weekly Subscription package: TK20 (+VAT+SD+SC) with auto-renewal.</p>
            <p>Monthly Subscription package: TK80 (+VAT+SD+SC) with auto-renewal.</p>
            <h4>Which device is supported to Kaspersky?</h4>
            <p>Only Android device is supported</p>
            <h4>Is this support any iOS or Feature Phone?</h4>
            <p>No. iOS or Feature phones are not supported.</p>
            <h4>Which Browser is supported to Kaspersky download?</h4>
            <p>All browsers are supported, but user will get best experience with Chrome browser.</p>
            <h4>Can a user buy multiple packages at the same time?</h4>
            <p>No, same user cannot buy/subscribe to multiple packages at the same time.</p>
            <h4>What is the Kaspersky helpline/hotline number?</h4>
            <p>Kaspersky Hotline: 8801814426426, available 8:00am to 7:00pm.</p>
            <h4>What is the Kaspersky Email support?</h4>
            <p>Kaspersky Support Email:  <a href="#" style="color: #0066FF">
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
           // alert(subscriptionId)
            if(data == 1){
                $('#deactivateUserId').html("");
                $('#deactivateUserMsgId').show();
            }
        });
    }

    function unsubscribeSafekit(){
        $.get( "deactivate_ksk_user.php", { subscriptionId: '<?php echo $subcs_ksk_id;?>', MSISDN: '<?php echo $mobileNo;?>', SubscriptionType: '<?php echo $subcs_ksk_type;?>' } ).done(function( data ) {
            console.log(data);
            //alert( 'Successfully unsubscribe from kaspersky service' );
            if(data == 1){
                $('#deactivateKSKUserId').html("");
                $('#deactivateKSKUserMsg').show();
            }
            //location.reload();
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