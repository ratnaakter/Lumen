<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; //to support input
use App\Http\Requests;
use DB;
use App\IOSToken;
use Flash;
use Illuminate\Support\Facades\View;


class StickerpushController extends Controller
{
    public function getToken(Request $request) {

        // if user open his/her app: it will check device id exist or not
        // if not save device id with token and date else update token and date
        //echo'ok';exit;
        if (isset($_GET["token"])) {

            $token = $_GET["token"];
            $deviceId = $_GET["did"];
            //print_r($queryGet);exit;
            if (IOSToken::where('device_id', '=', Input::get('did'))->exists()) {
                    DB::table('ios_token')
                        ->where('device_id', $deviceId)
                        ->update(array('date_exe' => date('Y-m-d H:i'),'token'=>$token));
                    echo "Response Token Already Exists ";
            }else{
                    $model  = new IOSToken();
                    $model->date_exe = date('Y-m-d H:i');
                    $model->token = $token;
                    $model->device_id = $deviceId;
                    $model->save();
                    echo "Response Token Saved Successfully";
                }

        }else{

           echo 'Token Not Submitted';

        }
    }

    public function pushSticker()
    {
        //$param1 = ["%%", "$camp_string", '%%', '%%', '%%', Input::get('from_date'), Input::get('to_date'), 0, 15000,
       // 1];
       // $report_data_1 = DB::connection('sqladplay')->select('EXEC spGetCampaignTargets ?,?,?,?,?,?,?,?,?,?',
       // $param1);
        //$related_content=$con->select('Exec Sp_Search_DarunTv"'.$contentname.'"');

        if(Input::get('ContentTitle'))
        {
            $param= [Input::get('ContentTitle')];
            $proc_query = DB::connection('sqlsrv')->select('EXEC spGetNewContentNew ?', $param);
        }
        else{
            $param= ['%%'];
            $proc_query = DB::connection('sqlsrv')->select('EXEC spGetNewContentNew ?', $param);
        }

        $page          = Input::get('page', 1);
        $paginate      = 20;
        $offSet              = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($proc_query, $offSet, $paginate, true);
        $data                = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, count($proc_query), $paginate, $page);
        //print_r($parsed_json);exit;
        return View('push_sticker',compact('data'));
    }


    /**
     * To send sticker with push notification
     */
     public function pushStickerSend()
     {
        // Put your device token here (without spaces):
        $deviceToken = 'fdgsdfhdrty435576';

        // Put your private key's passphrase here:
        $passphrase = '1234';

        // Put your alert message here:
        $message = Input::post('message');
        $allNotifiactionData = Input::post('allNotifiactionData'); //'http://202.164.213.242/CMS/GraphicsPreview/Stickers//Kono_Dekha_Nei_Transperant.png',
        // $graphicsCode = $_POST["GraphicsCode"]; //'274821FC-6B9D-4C7C-9170-7A6221A4DCFA'
        // $contentTitle = $_POST["ContentTitle"]; //'ভালোবাসার চশমা ২'
        // $contentType = $_POST["ContentType"]; //'ST'
        // $physicalFileName = $_POST["PhysicalFileName"]; //'Bhalobashar_Choshma_2e'
        // $chargeType = $_POST["ChargeType"]; //'Free'

        ////////////////////////////////////////////////////////////////////////////////

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp){
        	exit("Failed to connect: $err $errstr" . PHP_EOL);
        }else{
        	echo 'Connected to APNS' . PHP_EOL;
        }


        // Create the payload body
        // $body['aps'] = array(
        // 	'alert' => array(
        //         'body' => $message,
        // 		'action-loc-key' => 'Hello App',
        //     ),
        //     'badge' => 1,
        // 	'sound' => 'oven.caf',
        // 	'image_url' => 'http://202.164.213.242/CMS/GraphicsPreview/Stickers//Ki_Daho_Emne.jpg'
        // 	);

        $body['aps'] = array(
        	'alert' => $message,
        	'badge' => 1,
        	'sound' => 'default',
        	'content-available'=>'1',
        	'allNotifiactionData' => $allNotifiactionData,

        	"mediaUrl"=> "https://upload.wikimedia.org/wikipedia/mediawiki/a/a9/Example.jpg",
            "mediaType"=> "image"

        	// 'GraphicsCode' => $graphicsCode,
        	// 'ContentTitle' => $contentTitle,
        	// 'ContentType' => $contentType,
        	// 'PhysicalFileName' => $physicalFileName,
        	// 'ChargeType' => $chargeType
        	);

        // Encode the payload as JSON
        $payload = json_encode($body);

        $TokenResult = IOSToken::all()->pluck('token');

        foreach ($TokenResult as $key => $value) {
          // Build the binary notification
          $msg = chr(0) . pack('n', 32) . pack('H*', $value->token) . pack('n', strlen($payload)) . $payload;

          // Send it to the server to all device
          $result2 = fwrite($fp, $msg);//, strlen($msg)
          if (!$result)
            return redirect('push-sticker')->with('status', 'Message not delivered.');
          else
            return redirect('push-sticker')->with('status', 'Message successfully delivered.');

        }

        // Close the connection to the server
        fclose($fp);

        } else{
        	return redirect('push-sticker')->with('status', 'Please select an image.');
        }

     }


}
