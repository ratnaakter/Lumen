<?php

namespace App\Http\Middleware;

use Closure;
use SoapClient;
use DateTime;
class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // set a default value for operation which will be change in below with proper assignment of data
        //$_POST['not_allow'] = false;
        //$_POST['msisdn'] = '';

        $isMSISDN= $this->GetMSISDN();
		 $con=\DB::connection("sqlsrv");
        
        // if($isMSISDN!='' && substr($isMSISDN, 0, 5)=="88018")
        //{
          if($isMSISDN!='')
        {

           /*  if(substr($isMSISDN, 0, 5)=="88018" || substr($isMSISDN, 0, 5)=="88016"){*/
            if(substr($isMSISDN, 0, 5)=="88018"){

            $_POST['msisdn']=$isMSISDN;

           $check_exist=$con->select('SET NOCOUNT ON;EXEC spDarunTvIsSubscribed "'.$_POST['msisdn'].'"'); 

           if(sizeof($check_exist)==1){
            $_POST['show_msisdn']=true;

           // Line: 43-53; user view count check and if it is 5 after a Renew then it will set into
           // $_POST['viewAgreeButtonStatus']. it will check in VideoWatchController watchVideo method.
           $_POST['viewAgreeButtonStatus'] = 0;
           $user_data=$con->select('SET NOCOUNT ON;EXEC sp_CurrentUserViewList "'.$_POST['msisdn'].'"');
           $count_user_view = 0;
           foreach($user_data as $ut){
               if($ut->ContentTitle == 'Renew'){
                   break;
               } else {
                   $count_user_view += 1;
               }
           }
           if($count_user_view > 0){
               $_POST['viewAgreeButtonStatus'] = $count_user_view;
           }

           }else{
            $_POST['show_msisdn']=false;
           }
          // var_dump(sizeof($check_exist));die;

           } // end of msisdn check for robi
            elseif(substr($isMSISDN, 0, 5) !="88018"){
                $_POST['not_allow']=true;
                return redirect('restriction');
                //return redirect('home');
            }
          else{
             $_POST['not_allow']=true;
            }

         }else{
            $_POST['show_msisdn']=false;
            
         }


        // access log entry

        $now = new DateTime();
        //$timestamp = $now->getTimestamp(); 
        //var_dump($now->format('Y-m-d H:i:s'));die;
        try {
                $url = $request->fullUrl();
                $u=rawurldecode($url);
                //print_r($u);exit;
                $uri = $request->path();
                $_POST['show_home']=$uri;
                if($uri=='/'){
                $uri=' ';
                }
                $x=$this->handsetProfile($_SERVER['HTTP_USER_AGENT']);
                 $access_log=$con->statement('EXEC spGET_OA_ACCESS "'.trim($u).'","DarunTV","'.$isMSISDN.'","'.$x->Manufacturer.'","'.$x->Model.'","'.$x->Dimension.'","APN","DarunTV","'.$uri.'","'.$x->OS.'",0,"'.$x->UAXML.'","'.trim($u).'"');

                // Closures include ->first(), ->get(), ->pluck(), etc.
            } catch(\Illuminate\Database\QueryException $ex){ 
              //dd($ex->getMessage()); 
              // Note any method of class PDOException can be called on $ex.
            }

        //dd($_POST);
        //end

        return $next($request);


    }
    private function GetMSISDN() // Find out the MSISDN Number of GrameenPhone Mobile
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
