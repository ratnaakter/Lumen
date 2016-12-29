<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use SoapClient;

class LikeViewController extends Controller
{
    //

    public function index(){
        // var_dump($this->handsetProfile($_SERVER['HTTP_USER_AGENT']));die;

        //  var_dump($this->charging10());die;
        // // $request = \Request::create('http://wap.shabox.mobi/HSProfiling_WS/Service.asmx', 'GET');
        //  var_dump($request);die;

    }

    public function ViewContent(Request $requests){

        $x=$this->handsetProfile($_SERVER['HTTP_USER_AGENT']);

        // var_dump($x);die;

        $con=\DB::connection("sqlsrv");
        $con2=\DB::connection("sqlsrv5");


        //echo $requests->like_view;

        //var_dump($_POST['msisdn']);die;

        if($requests->like_view==1){
            //var_dump("die");die;
            // sp_ViewCount
            if(isset($_POST['msisdn']) && $_POST['msisdn']!='' &&
                substr($_POST['msisdn'], 0, 5)=='88018'){
                $check_exist=$con->select('SET NOCOUNT ON;EXEC spDarunTvIsSubscribed "'.$_POST['msisdn'].'"');
                if(sizeof($check_exist)==1){
                    //var_dump("expression");die;
                    //========================================================================
                    //=====================check stop view count for 2 and 10 tk==============
                    //========================================================================
                    if(
                        trim($requests->cat_code)=='209D67DE-75F7-448A-993A-4C41BA559AF6' ||
                        trim($requests->cat_code)=='0A8B78D3-FB8F-4288-AF79-674E0D195266' ||
                        trim($requests->cat_code)=='91994980-F977-4EB4-AED6-72041FBE82AF'||
                        trim($requests->cat_code)=='D1BA45D1-CF85-44B7-BF55-50C412886DC0' ||
                        trim($requests->cat_code)=='4D40FB19-2545-41DC-BB56-249270F1CE35' ||
                        trim($requests->cat_code)=='BA23E9CD-61F1-4A8A-8160-2723269FE58C'

                    )
                    {
                        $charge=$this->charging2($_POST['msisdn']);
                        if(strpos($charge->ChargeMSISDNResult,"<?xml version")!==false) {// if success
                            //var_dump($this->charging10($_POST['msisdn']));die;
                            // echo ($requests->content_title);exit;

                       //=================check stop view count for charging 2 taka for hd video===============

                            // Ratna: Now sContentType data can be access in here which comes from ajax on video click.
                            //$sContentType = $requests->sContentType;
                            $save_hd_premium_watch_log = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",2,"HD Premium","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');
                        }

                    }
                    elseif (
                        trim($requests->cat_code)=='540DEE2F-CF0F-437E-B80D-B9DA84C62405' ||
                        trim($requests->cat_code)=='64D4219F-B9A1-4040-B039-06B1620FF1DE'

                    )
                    //=================check stop view count for charging 10 taka for movie===============
                    {
                        $charge=$this->charging10($_POST['msisdn']);
                        //var_dump($x->ChargeMSISDNResult);die;
                        //var_dump(strpos($x->ChargeMSISDNResult,"<?xml") !==false);die;
                        if(strpos($charge->ChargeMSISDNResult,"<?xml version") !==false){
                            //var_dump("sfs");die;
                            $url = $requests->Url();
                            $uri = $requests->path();
                            if($uri=='/'){
                                $uri=' ';
                            }
                            // var_dump($x->Manufacturer);die;
                            $save_movie_watch_log = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",10,"Movie","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');
                             //var_dump($this->charging10($_POST['msisdn']));die;
                        }

                    }
                    else{
                        $check_access=$con->select('SET NOCOUNT ON;Exec sp_ViewCount "'.$_POST['msisdn'].'"');
                    }

                   //=========================end check stop view count============================

                    //===============================================================================
                    // ==================Send Msg to user on 5th video click
                    //================================================================================

                    $send_msg=$con->select('SET NOCOUNT ON;Exec Sp_Send_SMS "'.$_POST['msisdn'].'"');
                    //echo($send_msg);exit;
                    //var_dump($send_msg);die;
                    foreach ($send_msg as $key ) {
                        $msg_check=$key->RetValue;
                    }
                    //print_r($send_msg);exit;
                    if($msg_check==5){
                        $send_message=$con2->statement("EXEC Robi_SDP.dbo.spSend_SingleFreeSMS_By_serviceId_SDP_6000 ".$_POST['msisdn'].", 'Dear subscriber you assumed your daily free limits. You will be charge TK2(+VAT, SD and SC) for next five views except Movie and HD Video. Help: 8801814426426'");

                        $save_free5_watch_log = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",0,"Free","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');

                        $check_access1=$con->select('SET NOCOUNT ON;Exec sp_Update_tbl_ViewCount "'.$_POST['msisdn'].'"');


                    }


                    //echo($send_message);exit;
                    //===============================================================================
                    // ==========use in condition for view count insert
                    //================================================================================
                    $check_return=null;
                    foreach ($check_access as $key ) {
                        # code...
                        //var_dump($key->RetValue);die;
                        // Checking acces return value
                        $check_return=$key->RetValue;
                    }
                    //echo $check_return;die;
                    //=============================================================================
                    //=============Charging for 10 Taka for Movie cutting
                    //==============================================================================
                    if(trim($requests->cat_code)=='540DEE2F-CF0F-437E-B80D-B9DA84C62405' ||
                        trim($requests->cat_code)=='64D4219F-B9A1-4040-B039-06B1620FF1DE'){
                        //$this->charging10($_POST['msisdn']);
                        $charge=$this->charging10($_POST['msisdn']);
                        //var_dump($x->ChargeMSISDNResult);die;
                        //var_dump(strpos($x->ChargeMSISDNResult,"<?xml") !==false);die;
                        if(strpos($charge->ChargeMSISDNResult,"<?xml version") !==false){
                            //var_dump("sfs");die;
                            $url = $requests->Url();
                            $uri = $requests->path();
                            if($uri=='/'){
                                $uri=' ';
                            }
                            // var_dump($x->Manufacturer);die;
                            $save_movie_watch_log = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",10,"Movie","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');

                            //var_dump($this->charging10($_POST['msisdn']));die;
                        }else{
                            echo ($x->ChargeMSISDNResult);die;
                            //return back()->withInput();
                        }

                        //========================================================================
                        // ==========Charging for 2 Taka every HD watch
                        //========================================================================
                    }elseif(trim($requests->cat_code)=='209D67DE-75F7-448A-993A-4C41BA559AF6' ||
                        trim($requests->cat_code)=='0A8B78D3-FB8F-4288-AF79-674E0D195266' ||
                        trim($requests->cat_code)=='91994980-F977-4EB4-AED6-72041FBE82AF'||
                        trim($requests->cat_code)=='D1BA45D1-CF85-44B7-BF55-50C412886DC0' ||
                        trim($requests->cat_code)=='4D40FB19-2545-41DC-BB56-249270F1CE35' ||
                        trim($requests->cat_code)=='BA23E9CD-61F1-4A8A-8160-2723269FE58C'){
                        //$this->charging2($_POST['msisdn']);
                        $charge=$this->charging2($_POST['msisdn']);
                        if(strpos($charge->ChargeMSISDNResult,"<?xml version")!==false){// if success
                            //var_dump($this->charging10($_POST['msisdn']));die;
                            // echo ($requests->content_title);exit;
                            //==========================================================================
                            //==================Extra 2 taka charging two see new video(Renew)
                            //==========================================================================
                            $save_hd_premium_watch_log = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",2,"HD Premium","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');

                        }
                    }else{
                        //==========================================================================
                        //==================if 5 times watched than no more insert
                        //==========================================================================
                        if($check_return !=null){
                            if($check_return != -1){
                                //var_dump($this->charging10($_POST['msisdn']));die;
                                $save_free5_watch_log = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",0,"Free","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');

                            }
                        }

                    }
                    //end

                    /*$check_return=null;

                    foreach ($check_access as $key ) {
                        # code...
                        //var_dump($key->RetValue);die;
                        // Checking acces return value
                        $check_return=$key->RetValue;

                    }*/

                    //echo $check_return;die;

                    if($check_return !=null){

                        if($check_return == -1){
                            //====================================================================
                            //===========popup for not allowed watch is greater than 5
                            //====================================================================
                            //var_dump("Die");die;
                            if(trim($requests->cat_code)=='540DEE2F-CF0F-437E-B80D-B9DA84C62405' ||
                                trim($requests->cat_code)=='64D4219F-B9A1-4040-B039-06B1620FF1DE'||
                                trim($requests->cat_code)=='209D67DE-75F7-448A-993A-4C41BA559AF6' ||
                                trim($requests->cat_code)=='0A8B78D3-FB8F-4288-AF79-674E0D195266' ||
                                trim($requests->cat_code)=='91994980-F977-4EB4-AED6-72041FBE82AF'||
                                trim($requests->cat_code)=='D1BA45D1-CF85-44B7-BF55-50C412886DC0' ||
                                trim($requests->cat_code)=='4D40FB19-2545-41DC-BB56-249270F1CE35' ||
                                trim($requests->cat_code)=='BA23E9CD-61F1-4A8A-8160-2723269FE58C'){
                                echo "no_count";
                            }else{
                                // $send_message=$con2->statement("EXEC Robi_SDP.dbo.spSend_SingleFreeSMS_By_serviceId_SDP_6000 ".$_POST['msisdn'].", 'Dear subscriber you assumed your daily free limits. You will be charge TK2(+VAT, SD and SC) for next five views except Movie and HD Video. Help: 8801814426426'");

                                // this portion will redirect user to home page as bcz he already show 5 videos. set a data in session to show agree modal in home page after redirecting from watch video pages.
                                $requests->session()->flash('viewAgreeButtonStatus', '-1');
                                echo '-1';
                            }

                        }else if ($check_return == 1){

                            // have access to watch this video if agree then data will insert in like_view=4 block

                            if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){
                                if(trim($requests->cat_code)=='540DEE2F-CF0F-437E-B80D-B9DA84C62405' ||
                                    trim($requests->cat_code)=='64D4219F-B9A1-4040-B039-06B1620FF1DE'||
                                    trim($requests->cat_code)=='209D67DE-75F7-448A-993A-4C41BA559AF6' ||
                                    trim($requests->cat_code)=='0A8B78D3-FB8F-4288-AF79-674E0D195266' ||
                                    trim($requests->cat_code)=='91994980-F977-4EB4-AED6-72041FBE82AF'||
                                    trim($requests->cat_code)=='D1BA45D1-CF85-44B7-BF55-50C412886DC0' ||
                                    trim($requests->cat_code)=='4D40FB19-2545-41DC-BB56-249270F1CE35' ||
                                    trim($requests->cat_code)=='BA23E9CD-61F1-4A8A-8160-2723269FE58C'){
                                    echo "no_count";
                                }else{
                                    echo 'have access';
                                    $hd_premium_video=$con->statement('Exec sp_UpdateLikeCountByContentCodeDarun "'.trim($requests->code_content).'","'.$requests->like_view.'","'.$_POST['msisdn'].'"');
                                }

                            }

                        }else if ($check_return == 0){

                            echo 'fresh start watch';

                            // newly count start after video watch exist 5 times update the value

                            echo 'new agree access';
                        }else{

                            echo 'new user watch';
                            //returning 3 for fresh watching of new commer

                            if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){

                                if(trim($requests->cat_code)=='540DEE2F-CF0F-437E-B80D-B9DA84C62405' ||
                                    trim($requests->cat_code)=='64D4219F-B9A1-4040-B039-06B1620FF1DE'||
                                    trim($requests->cat_code)=='209D67DE-75F7-448A-993A-4C41BA559AF6' ||
                                    trim($requests->cat_code)=='0A8B78D3-FB8F-4288-AF79-674E0D195266' ||
                                    trim($requests->cat_code)=='91994980-F977-4EB4-AED6-72041FBE82AF'||
                                    trim($requests->cat_code)=='D1BA45D1-CF85-44B7-BF55-50C412886DC0' ||
                                    trim($requests->cat_code)=='4D40FB19-2545-41DC-BB56-249270F1CE35' ||
                                    trim($requests->cat_code)=='BA23E9CD-61F1-4A8A-8160-2723269FE58C'){

                                    echo "no_count";

                                }else{

                                    $hd_premium_video=$con->statement('Exec sp_UpdateLikeCountByContentCodeDarun "'.trim($requests->code_content).'","'.$requests->like_view.'","'.$_POST['msisdn'].'"');
                                }
                            }
                            // }


                        }


                    } // end check return
                }else{
                    echo "not_access";
                }

            }else{
                //return back()->withInput();
                echo "not_access";
            }



            // End dekhun if
        }else if($requests->like_view==2){ // like count

            if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){
                $hd_premium_video=$con->statement('Exec sp_UpdateLikeCountByContentCodeDarun "'.trim($requests->code_content).'","'.$requests->like_view.'","'.$_POST['msisdn'].'"');
            }else{

            }

        }else if($requests->like_view==3){ //favourite count
            if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){
                $hd_premium_video=$con->statement('Exec sp_UpdateLikeCountByContentCodeDarun "'.trim($requests->code_content).'","'.$requests->like_view.'","'.$_POST['msisdn'].'"');
            }else{

            }
            //var_dump(\Session::get('msisdn'));die;
        }elseif($requests->like_view==4){  // Agree to watch again

            // echo 4;
            $check_access=$con->select('SET NOCOUNT ON;Exec sp_ViewCount "'.$_POST['msisdn'].'"');
            $check_return=null;
            foreach ($check_access as $key ) {
                # code...
                //var_dump($key->RetValue);die;
                // Checking acces return value
                $check_return=$key->RetValue;
            }
            //var_dump($check_return);die;
            if($check_return==-1){
                //    echo "ok";
                if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){
                    $charge=$this->charging2($_POST['msisdn']);
                    if(strpos($charge->ChargeMSISDNResult,"<?xml version")!==false){

                        // $watch_log=$con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "'.$requests->code_content.'","'.$requests->content_title.'","'.$_POST['msisdn'].'",1');
                        //=================Renew log
                        $watch_log=$con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "'.$requests->code_content.'","'.$requests->content_title.'","'.$_POST['msisdn'].'",1,"Renew","'.$x->OS.'","'.$x->Manufacturer.'","'.$x->Model.'","'.$x->Dimension.'","HS-Specification","ROBI","Category-id","Portal-Full","Portal-SHort"');
                        //=================On going Renew log
                        $watch_log2=$con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "'.$requests->code_content.'","'.$requests->content_title.'","'.$_POST['msisdn'].'",0,"type","'.$x->OS.'","'.$x->Manufacturer.'","'.$x->Model.'","'.$x->Dimension.'","HS-Specification","ROBI","Category-id","Portal-Full","Portal-SHort"');

                        /*$watch_log = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",1,"Renew","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');

                        $watch_log2 = $con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "' . $requests->code_content . '","' . $requests->content_title . '","' . $_POST['msisdn'] . '",0,"Free","'.$requests->sContentType.'","'.'Uprofile'.'","'.$x->Manufacturer.'","' . $x->Model . '","' . $x->Dimension . '","'.$x->OS.'","ROBI","'.$requests->cat_code.'","DarunPortal","x"');*/

                        /*=====================Renew msg send==============*/
                        $send_message=$con2->statement('EXEC Robi_SDP.dbo.spSend_SingleFreeSMS_By_serviceId_SDP_6000 "'.$_POST['msisdn'].'", "You have successfully charged Tk 2.44 for next 5 videos. To cancel SMS STOP DARUN to 6000 , Help: 8801814426426"');

                        $update_view_count=$con->select('SET NOCOUNT ON;Exec sp_ViewCount "'.$_POST['msisdn'].'",1');
                        $change_Msg_Staus=$con->select('SET NOCOUNT ON;Exec sp_Update_tbl_ViewCount_Unsent "'.$_POST['msisdn'].'"');

                        $hd_premium_video=$con->statement('Exec sp_UpdateLikeCountByContentCodeDarun "'.trim($requests->code_content).'",1,"'.$_POST['msisdn'].'"');

                    }

                    //echo 'ok';
                    //  echo "ok";

                }else{
                    echo 'not ok'.$check_return;
                }
            }
        }else{
            echo '2';
        }

    }

    /**
     * Ratna: 20-12-2016
     * New function to reset the user view count after click on agree button.
     * This function is used only when click on agree button from layout page through ajax.
     * @param Request $requests
     */
    public function NewSubscriptionOnAgree(Request $requests)
    {
      /*  $x=$this->handsetProfile($_SERVER['HTTP_USER_AGENT']);
        $con=\DB::connection("sqlsrv");
        $con2=\DB::connection("sqlsrv5");

        if ($requests->session()->has('viewAgreeButtonStatus')) {
            $requests->session()->forget('viewAgreeButtonStatus');
        }

        $send_message=$con2->statement('EXEC Robi_SDP.dbo.spSend_SingleFreeSMS_By_serviceId_SDP_6000 "'.$_POST['msisdn'].'", "You have successfully charged Tk 2.44 for next 5 videos. To cancel SMS STOP DARUN to 6000 , Help: 8801814426426"');

        $update_view_count=$con->select('SET NOCOUNT ON;Exec sp_ViewCount "'.$_POST['msisdn'].'",1');
        $change_Msg_Staus=$con->select('SET NOCOUNT ON;Exec sp_Update_tbl_ViewCount_Unsent "'.$_POST['msisdn'].'"');
        echo 'OK';*/

        $x=$this->handsetProfile($_SERVER['HTTP_USER_AGENT']);
        $con=\DB::connection("sqlsrv");
        $con2=\DB::connection("sqlsrv5");

        if ($requests->session()->has('viewAgreeButtonStatus')) {
            $requests->session()->forget('viewAgreeButtonStatus');
        }

        $check_access=$con->select('SET NOCOUNT ON;Exec sp_ViewCount "'.$_POST['msisdn'].'"');

        $check_return=null;

        foreach ($check_access as $key ) {
            $check_return=$key->RetValue;
        }

        if($check_return==-1){

            if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){

                $charge=$this->charging2($_POST['msisdn']);

                if(strpos($charge->ChargeMSISDNResult,"<?xml version")!==false){

                    $watch_log=$con->statement('SET NOCOUNT ON;Exec sp_SetUserViewHistory "Renew","Renew","'.$_POST['msisdn'].'",1,"Renew","Renew","Renew","Renew","Renew","HS-Specification","ROBI","Category-id","Portal-Full","Portal-SHort"');

                    $send_message=$con2->statement('EXEC Robi_SDP.dbo.spSend_SingleFreeSMS_By_serviceId_SDP_6000 "'.$_POST['msisdn'].'", "You have successfully charged Tk 2.44 for next 5 videos. To cancel SMS STOP DARUN to 6000 , Help: 8801814426426"');

                    $update_view_count=$con->select('SET NOCOUNT ON;Exec sp_ViewCount "'.$_POST['msisdn'].'",1');
                    $change_Msg_Staus=$con->select('SET NOCOUNT ON;Exec sp_Update_tbl_ViewCount_Unsent "'.$_POST['msisdn'].'"');

                    $hd_premium_video=$con->statement('Exec sp_UpdateLikeCountByContentCodeDarun "'.trim($requests->code_content).'", 1, "'.$_POST['msisdn'].'"');

                    echo 'OK';
                }
            } else {
                echo 'not ok'.$check_return;
            }
        }
    }


    //     public function handsetProfile($user_agent) {
    //     # SOAP API call 
    //     # $clients = new SoapClient("http://hsapi.ap-southeast-1.elasticbeanstalk.com/service.asmx?WSDL");
    //     #
    //     # http://wap.shabox.mobi/HSProfiling_WS/Service.asmx
    //     $params = array(
    //         'cache_wsdl' => WSDL_CACHE_NONE
    //     );
    //     $clients = new SoapClient("http://wap.shabox.mobi/HSProfiling_WS/Service.asmx?WSDL", $params);

    //     //var_dump($clients);die;
    //     # Handset profiling
    //     $hs = $clients->HansetDetection(array('UserAgent' => $user_agent));

    //     return $hs->HansetDetectionResult; // Handset profile data 
    //     // $this->handset = $hs->HansetDetectionResult; // Object Array 
    // }


    public function charging10($msisdn) {

        $params = array(
            'cache_wsdl' => WSDL_CACHE_NONE
        );
        $clients = new SoapClient("http://192.168.10.5/SDP_CGW/SDPCGW.asmx?WSDL", $params);
        # Handset profiling
        $hs = $clients->ChargeMSISDN(array('MSISDN' => $msisdn,'ChargingKey' => 'RP10','PortalCode_Port_VU' => 'Darun'));//'8801814652539','RP10','Darun','dfdf','dfdf'

        return $hs; // Handset profile data 
        // $this->handset = $hs->HansetDetectionResult; // Object Array 
    }


    public function charging2($msisdn) {

        $params = array(
            'cache_wsdl' => WSDL_CACHE_NONE
        );
        $clients = new SoapClient("http://192.168.10.5/SDP_CGW/SDPCGW.asmx?WSDL", $params);
        # Handset profiling
        $hs = $clients->ChargeMSISDN(array('MSISDN' => $msisdn,'ChargingKey' => 'RSUB1','PortalCode_Port_VU' => 'Darun'));//'8801814652539','RP10','Darun','dfdf','dfdf'

        return $hs; // Handset profile data 
        // $this->handset = $hs->HansetDetectionResult; // Object Array 
    }


    public function handsetProfile($user_agent) {
        # SOAP API call 
        # $clients = new SoapClient("http://hsapi.ap-southeast-1.elasticbeanstalk.com/service.asmx?WSDL");
        #
        # http://wap.shabox.mobi/HSProfiling_WS/Service.asmx
        $params = array(
            'cache_wsdl' => WSDL_CACHE_NONE
        );
        $clients = new SoapClient("http://wap.shabox.mobi/HSProfiling_WS/Service.asmx?WSDL", $params);

        //var_dump($clients);die;
        # Handset profiling
        $hs = $clients->HansetDetection(array('UserAgent' => $user_agent));

        return $hs->HansetDetectionResult; // Handset profile data 
        // $this->handset = $hs->HansetDetectionResult; // Object Array 
    }
}
         
    

    
