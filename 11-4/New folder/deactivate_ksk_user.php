<?php
/*====================SOAP Api call in php===================*/
$subcs_id = $_REQUEST['subscriptionId'];
$mobileNo = $_REQUEST['MSISDN'];
$subcs_type = $_REQUEST['SubscriptionType'];

$params = array(
    'cache_wsdl' => WSDL_CACHE_NONE,
);
$clients = new SoapClient("http://wap.shabox.mobi/KasperskyApi/KSSLABAPI.asmx?wsdl", $params);

if($subcs_id!='')
{
    $deactivate_user = $clients->SoftDeactivateUserKSK(['subscriptionId'=>"$subcs_id",'MSISDN'=>$mobileNo,
    'SubscriptionType'=>$subcs_type]);
    //$status = new SimpleXMLElement($deactivate_user);
    echo 1;
} else {
    echo 0;
}
// print_r($deactivate_user ) ;exit;

?>