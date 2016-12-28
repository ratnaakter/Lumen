<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContentLoadController extends Controller
{
    //"Exec Sp_FullvideoContents_videobox 'A5D68929-8921-4ECD-8151-E36A3871EB95'"

    public function moreVideo(Request $request)
    {
        //var_dump(implode($request->all()));die;
        $con=\DB::connection("sqlsrv");
        if($request->content_type=="সেলিব্রেটি")
            {
               $type = array("বলিউড মাসালা", "হলিউড মাসালা","ডালিউড মাসালা","মুভি রিভিউ");
                //var_dump($type);die();
                $data_Bw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "1AAD9870-F51B-4588-93D4-CA9EF52531D2",6');

                $data_Dw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "CA89C0EE-52B6-4BBD-8D24-27868A12D62C",6');

                $data_Hw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "8EC80D7A-D793-4364-BE3E-CF3BE2C73873",6');

                $data_Mv=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "5D7287AD-7F66-4B92-B936-BC58FF781591",6');

               return view('related_videos.more_video_menu')
              ->with('data_Bw',$data_Bw)
              ->with('data_Dw',$data_Dw)
              ->with('data_Hw',$data_Hw)
              ->with('data_Mv',$data_Mv)
              ->with('type',$type)
              ->with('cat',"সেলিব্রেটি");

            }
            elseif ($request->content_type=="মুভি")
            {
                # code...
              $data_Ban=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "540DEE2F-CF0F-437E-B80D-B9DA84C62405",6');

              $data_Hn=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "64D4219F-B9A1-4040-B039-06B1620FF1DE",6'); 
                //var_dump($data_Ban);die;
              $type = array("বাংলা", "হিন্দি");
                //var_dump($type);die();
               return view('related_videos.more_video_menu_2')
              ->with('data_Ban',$data_Ban)
              ->with('data_Hn',$data_Hn)
              ->with('type',$type)
              ->with('cat',"মুভি");
            }
            elseif ($request->content_type=="ভিডিও")
            {
                # code...
                $data_BanM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "3699F024-2394-42EF-9366-BB601129DEDA",6');

                $data_EnM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "D4B01EA7-76BB-44B0-8E31-760780C74084",6');
                $data_CinG=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "583247FC-58AD-4191-AF2F-498FA3926DEC",6');
                $type = array("বাংলা মিউজিক", "ইংলিশ মিউজিক","সিনেমার গান");
                //var_dump($data_BanM);die();
               return view('related_videos.more_video_menu_3')
              ->with('data_BanM',$data_BanM)
              ->with('data_EnM',$data_EnM)
              ->with('data_CinG',$data_CinG)
              ->with('type',$type)
               ->with('cat',"ভিডিও");
            }
            elseif ($request->content_type=="টিভি")
            {
                # code...6747ADC1-7CE8-47D6-B555-2D1469FA9A28
               $data_Natok=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "B80FFE37-787E-42FD-AFCB-E9338A497923",6');

               $data_teli=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "5B4773DE-55DE-41DC-801D-0089C025B04A",6');

               //$data_MusicSh=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "A28FE8DD-4382-4E09-9D39-6CA2F91237EC",6');

              // $data_Fashion=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "07E15943-C4D4-447D-857A-0F348FDDE286",6');

              // $data_Crime=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "969B7A4B-07EA-4B60-A4FC-5BB6099B754B",6');

               //$data_Enter=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "AF3AB0FC-7A82-4115-B680-008D03361263",6');

              //$type = array("নাটক", "টেলিফিল্মস","মিউজিক্যাল শো","ফ্যাশন শো","ক্রাইম শো","এন্টারটেইনমেন্ট শো");
              $type = array("নাটক", "টেলিফিল্মস");
                //var_dump($type);die();
               return view('related_videos.more_video_menu_4')
              ->with('data_Natok',$data_Natok)
              ->with('data_teli',$data_teli)
             // ->with('data_MusicSh',$data_MusicSh)
              //->with('data_Fashion',$data_Fashion)
              //->with('data_Crime',$data_Crime)
             // ->with('data_Enter',$data_Enter)
              ->with('type',$type)
               ->with('cat',"টিভি");
            }
            elseif ($request->content_type=="ফিটনেস")
            {
                # code...
                $data_BwF=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "1B97D26D-0664-4AB0-8B85-580A82B1AA24",6');
                //$data_DwF=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "F30E4420-EA4E-444C-A78F-5452B72EB86E",6');
	
                //$type = array("বলিউড ফিটনেস ভিডিও","ডালিউড ফিটনেস ভিডিও");
                $type = array("বলিউড ফিটনেস ভিডিও");
                //var_dump($type);die();
               return view('related_videos.more_video_menu_5')
              ->with('data_BwF',$data_BwF)
              //->with('data_DwF',$data_DwF)
              ->with('type',$type)
               ->with('cat',"ফিটনেস");
            }
            elseif ($request->content_type=="কমেডি")
            {
                # code...
                $data_BnC=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "394C8AB4-5C72-4927-8A2A-2805263EE7F9",6');
                $data_HiC=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "7C546F48-3FAE-42E8-9921-293D14B7D675",6');
                $type = array("বাংলা", "হিন্দি");
                //var_dump($type);die();
               return view('related_videos.more_video_menu_6')
              ->with('data_BnC',$data_BnC)
               ->with('data_HiC',$data_HiC)
              ->with('type',$type)
               ->with('cat',"কমেডি");
            }
            elseif ($request->content_type=="প্রিমিয়াম")
            {
                # code...
                $data_BnMu=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "0A8B78D3-FB8F-4288-AF79-674E0D195266",6');

                $data_BnN=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "91994980-F977-4EB4-AED6-72041FBE82AF",6');
                $data_BnT=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "D1BA45D1-CF85-44B7-BF55-50C412886DC0",6');

                $data_BnM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "209D67DE-75F7-448A-993A-4C41BA559AF6",6');

                $data_BnMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "4D40FB19-2545-41DC-BB56-249270F1CE35",6');
                $data_HwMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "BA23E9CD-61F1-4A8A-8160-2723269FE58C",6');
                //$type = array("বাংলা মিউজিক ভিডিও","বাংলা নাটক","বাংলা টেলিফিল্মস","বাংলা মুভি","বলিউড সেলিব্রেটি মাসালা","হলিউড সেলিব্রেটি মাসালা");
                //$type = array("বাংলা মিউজিক ভিডিও","বাংলা নাটক","বাংলা টেলিফিল্মস","বাংলা মুভি","বলিউড সেলিব্রেটি মাসালা","হলিউড সেলিব্রেটি মাসালা");
                $type = array("বাংলা মিউজিক ভিডিও","বাংলা নাটক","বাংলা টেলিফিল্মস","বাংলা মুভি","বলিউড সেলিব্রেটি মাসালা");
                //var_dump($type);die();
               return view('related_videos.more_video_menu_7')
              ->with('data_BnMu',$data_BnMu)
               ->with('data_BnN',$data_BnN)
                ->with('data_BnT',$data_BnT)
                 ->with('data_BnM',$data_BnM)
                  ->with('data_BnMas',$data_BnMas)
                   //->with('data_HwMas',$data_HwMas)
              ->with('type',$type)
               ->with('cat',"প্রিমিয়াম");
            }
            elseif ($request->content_type=="ফেভারিট")
            {
				if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){
                $data=$con->select('SET NOCOUNT ON;Exec Sp_getFavVideo_daruntv "'.$_POST['msisdn'].'"'); 
                }else{
                  $data=null;
                }

           //   $data=$con->select('SET NOCOUNT ON;Exec Sp_getContentsByCategoryID_daruntv "2B1985EC-F390-49AF-96D4-853273B03344"'); 
             // var_dump("Hello");die;
			
               $type = array("ফেভারিট");
               return view('related_videos.favourite_view')
               ->with('data',$data)
               ->with('type',$type)
               ->with('cat',"ফেভারিট");
                # code...
               }
            else if($request->content_type=="মাস্ট ওয়াচ")
            {
                // লাইব্রেরি
              $must_watch=$con->select('SET NOCOUNT ON;Exec Sp_MustWatch_daruntv 10 ');

                /*$remains = $con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv_Total "2B1985EC-F390-49AF-96D4-853273B03344"');
                echo 'now: '.count($must_watch);
                echo 'Total'.$remains[0]->Total;
                dd($remains);*/

              $type = array("মাস্ট ওয়াচ");

               return view('more_related_videos.more_video_click')
              ->with('data',$must_watch)
              ->with('type',$type)
              ->with('content_sub',$request->content_type)
               ->with('cat',"মাস্ট ওয়াচ");
            }
            else
            {
                $data=$con->select('SET NOCOUNT ON;Exec Sp_getContentsByCategoryID_daruntv "2B1985EC-F390-49AF-96D4-853273B03344"');
                $type = array("লাইব্রেরি");
                //var_dump($type);die();
               return view('related_videos.more_video_menu')
              ->with('data',$data)
              ->with('type',$type)
               ->with('cat',"লাইব্রেরি");

            }

 // full movies
		   //var_dump($data);die();

		    // return view('more_video')
		    //   ->with('data',$data);
    }


//     public function loadContent(Request $request){

//             // var_dump(implode($request->all()));die;

//            $con=\DB::connection("sqlsrv");

//            // $data=$con->select('SET NOCOUNT ON; Exec Sp_Fullvideo_Daruntv "E8E4F496-9CA9-4B35-BADD-9B6470BE2F74"');

//            $data=$con->select('SET NOCOUNT ON;Exec Sp_Fullvideo_Daruntv');
//             if($request->content_type=="সেলিব্রেটি"){

//                 $type = array("বলিউড মাসালা", "হলিউড মাসালা","ডালিউড মাসালা","মুভি রিভিউ");
//                 //var_dump($type);die();
//               return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//               ->with('cat',"সেলিব্রেটি");

//             }elseif ($request->content_type=="মুভি") {
//                 # code...
//               $type = array("বাংলা", "হিন্দি");
//                 //var_dump($type);die();
//                return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//               ->with('cat',"মুভি");
//             }elseif ($request->content_type=="ভিডিও") {
//                 # code...
//               $type = array("বাংলা মিউজিক ", "ইংলিশ মিউজিক","সিনেমার গান");
//                 //var_dump($type);die();
//                return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//                ->with('cat',"মিউজিক ভিডিও");
//             }elseif ($request->content_type=="টিভি") {
//                 # code...
//               $type = array("্নাটক", "টেলিফ্লিম","্মুসিকাল শো","ফেশিওন শো","ইন্টারটেইন্মেন্ট শো 
//                         ");
//                 //var_dump($type);die();
//                return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//                ->with('cat',"টিভি শো");
//             }elseif ($request->content_type=="ফিটনেস") {
//                 # code...
//               $type = array("বলিউড ফিটনেস ভিডিও","ডালিউড ফিটনেস ভিডিও");
//                 //var_dump($type);die();
//                return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//                ->with('cat',"ফিটনেস");
//             }elseif ($request->content_type=="কমেডি") {
//                 # code...
//                $type = array("বাংলা", "হিন্দি");
//                 //var_dump($type);die();
//                return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//                ->with('cat',"কমেডি");
//             }elseif ($request->content_type=="প্রিমিয়াম") {
//                 # code...
//                $type = array("বাংলা মিউজিক ভিডিও","বাংলা ্নাটক","বাংলা টেলিফ্লিম","বাংলা মুভি","বলিউড সেলিব্রেটি মাসালা","হলিউড সেলিব্রেটি মাসালা");
//                 //var_dump($type);die();
//               return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//                ->with('cat',"প্রিমিয়াম");
//             }elseif ($request->content_type=="ফেভারিট") {
//               $type = array("ফেভারিট");
//              return view('more_video_click')
//                 ->with('data',$data)
//                ->with('type',$type)
//                ->with('cat',"ফেভারিট");
//                 # code...
//             }else{
//                 // লাইব্রেরি

//             $type = array("লাইব্রেরি");
//                 //var_dump($type);die();
//                return view('more_video_click')
//               ->with('data',$data)
//               ->with('type',$type)
//                ->with('cat',"লাইব্রেরি");
//             }
// }

    public function loadContent(Request $request)
    {

        // var_dump(implode($request->all()));die;

           $con=\DB::connection("sqlsrv");

            if($request->content_type=="সেলিব্রেটি"){
         
               $type = array("বলিউড মাসালা", "হলিউড মাসালা","ডালিউড মাসালা","মুভি রিভিউ");
                //var_dump($type);die();

              $data_Bw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "1AAD9870-F51B-4588-93D4-CA9EF52531D2",10'); 

              $data_Dw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "CA89C0EE-52B6-4BBD-8D24-27868A12D62C",10'); 

              //$data_Hw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "8EC80D7A-D793-4364-BE3E-CF3BE2C73873",10');
               $data_Hw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "8EC80D7A-D793-4364-BE3E-CF3BE2C73873", 10');
              $data_Mv=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "5D7287AD-7F66-4B92-B936-BC58FF781591",10');
               
               return view('more_related_videos.more_video_click')
              ->with('data_Bw',$data_Bw)
              ->with('data_Dw',$data_Dw)
              ->with('data_Hw',$data_Hw)
              ->with('data_Mv',$data_Mv)
              ->with('type',$type)
			  ->with('content_sub',$request->content_sub)
              ->with('cat',"সেলিব্রেটি");

            }elseif ($request->content_type=="মুভি") {
                # code...
              $data_Ban=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "540DEE2F-CF0F-437E-B80D-B9DA84C62405",10'); 

              $data_En=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "64D4219F-B9A1-4040-B039-06B1620FF1DE",10'); 

                $type = array("বাংলা", "হিন্দি");
                //var_dump($type);die();
               return view('more_related_videos.more_video_click_2')
              ->with('data_Ban',$data_Ban)
              ->with('data_En',$data_En)
              ->with('type',$type)
			  ->with('content_sub',$request->content_sub)
              ->with('cat',"মুভি");
            }elseif ($request->content_type=="ভিডিও") {
                # code...
               $data_BanM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "3699F024-2394-42EF-9366-BB601129DEDA",10'); 

              $data_EnM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "D4B01EA7-76BB-44B0-8E31-760780C74084",10');

                $data_CinG=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "583247FC-58AD-4191-AF2F-498FA3926DEC",10');

                $type = array("বাংলা মিউজিক", "ইংলিশ মিউজিক","সিনেমার গান");
               // var_dump($data_BanM);die();
               return view('more_related_videos.more_video_click_3')
              ->with('data_BanM',$data_BanM)
              ->with('data_EnM',$data_EnM)
              ->with('data_CinG',$data_CinG)
              ->with('type',$type)
			  ->with('content_sub',$request->content_sub)
               ->with('cat',"ভিডিও"); //done
            }elseif ($request->content_type=="টিভি") {
                # code...6747ADC1-7CE8-47D6-B555-2D1469FA9A28
                $data_Natok=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "B80FFE37-787E-42FD-AFCB-E9338A497923",10'); 

              $data_teli=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "5B4773DE-55DE-41DC-801D-0089C025B04A",10'); 
              $data_MusicSh=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "A28FE8DD-4382-4E09-9D39-6CA2F91237EC",10'); 

               $data_Fashion=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "07E15943-C4D4-447D-857A-0F348FDDE286",10'); 

              $data_Crime=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "969B7A4B-07EA-4B60-A4FC-5BB6099B754B",10'); 
              $data_Enter=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "AF3AB0FC-7A82-4115-B680-008D03361263",10'); 

              $type = array("নাটক", "টেলিফিল্মস","মিউজিক্যাল শো","ফ্যাশন শো","ক্রাইম শো","এন্টারটেইনমেন্ট শো");
                //var_dump($type);die();
               return view('more_related_videos.more_video_click_4')
              ->with('data_Natok',$data_Natok)
              ->with('data_teli',$data_teli)
              ->with('data_MusicSh',$data_MusicSh)
              ->with('data_Fashion',$data_Fashion)
              ->with('data_Crime',$data_Crime)
              ->with('data_Enter',$data_Enter)
              ->with('type',$type)
			  ->with('content_sub',$request->content_sub)
               ->with('cat',"টিভি");
            }elseif ($request->content_type=="ফিটনেস") {
                # code...
               $data_BwF=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "1B97D26D-0664-4AB0-8B85-580A82B1AA24",10'); 
               $data_DwF=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "F30E4420-EA4E-444C-A78F-5452B72EB86E",10'); 

               $type = array("বলিউড ফিটনেস ভিডিও","ডালিউড ফিটনেস ভিডিও");
                //var_dump($type);die();
               return view('more_related_videos.more_video_click_5')
              ->with('data_BwF',$data_BwF)
              ->with('data_DwF',$data_DwF)
              ->with('type',$type)
			         ->with('content_sub',$request->content_sub)
               ->with('cat',"ফিটনেস");
            }elseif ($request->content_type=="কমেডি") {
                # code...
              $data_BnC=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "394C8AB4-5C72-4927-8A2A-2805263EE7F9",10'); 

               $data_HiC=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "7C546F48-3FAE-42E8-9921-293D14B7D675",10'); 
              $type = array("বাংলা", "হিন্দি");              
                
               return view('more_related_videos.more_video_click_6')
              ->with('data_BnC',$data_BnC)
               ->with('data_HiC',$data_HiC)
              ->with('types',$type)
			         ->with('content_sub',$request->content_sub)
               ->with('cat',"কমেডি");
            }elseif ($request->content_type=="প্রিমিয়াম") {
                # code...

              $data_BnMu=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "0A8B78D3-FB8F-4288-AF79-674E0D195266",10'); 

              $data_BnN=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "91994980-F977-4EB4-AED6-72041FBE82AF",10'); 
              $data_BnT=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "D1BA45D1-CF85-44B7-BF55-50C412886DC0",10'); 

               $data_BnM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "209D67DE-75F7-448A-993A-4C41BA559AF6",10'); 

              $data_BnMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "4D40FB19-2545-41DC-BB56-249270F1CE35",10'); 
              $data_HwMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "BA23E9CD-61F1-4A8A-8160-2723269FE58C",10'); 
              
                $type = array("বাংলা মিউজিক ভিডিও","বাংলা নাটক","বাংলা টেলিফিল্মস","বাংলা মুভি","বলিউড সেলিব্রেটি মাসালা","হলিউড সেলিব্রেটি মাসালা");
                //var_dump($type);die();
               return view('more_related_videos.more_video_click_7')
              ->with('data_BnMu',$data_BnMu)
               ->with('data_BnN',$data_BnN)
                ->with('data_BnT',$data_BnT)
                 ->with('data_BnM',$data_BnM)
                  ->with('data_BnMas',$data_BnMas)
                   ->with('data_HwMas',$data_HwMas)
              ->with('type',$type)
			  ->with('content_sub',$request->content_sub)
               ->with('cat',"প্রিমিয়াম");
            }elseif ($request->content_type=="ফেভারিট") {
              
              if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){
              $data=$con->select('SET NOCOUNT ON;Exec Sp_getFavVideo_daruntv "'.$_POST['msisdn'].'"'); 
                }else{
                  $data=null;
                }

           //   $data=$con->select('SET NOCOUNT ON;Exec Sp_getContentsByCategoryID_daruntv "2B1985EC-F390-49AF-96D4-853273B03344"'); 
             // var_dump("Hello");die;
               $type = array("ফেভারিট");
             return view('more_related_videos.favourite_view_click')
              ->with('data',$data)
               ->with('type',$type)
			   ->with('content_sub',$request->content_sub)
               ->with('cat',"ফেভারিট");
                # code...
            }else if($request->content_type=="মাস্ট ওয়াচ"){
                // লাইব্রেরি

          
              $data=$con->select('SET NOCOUNT ON;Exec Sp_getContentsByCategoryID_daruntv "2B1985EC-F390-49AF-96D4-853273B03344"');

                /*$remains = $con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv_Total "2B1985EC-F390-49AF-96D4-853273B03344"');
                echo 'now: '.count($must_watch);
                echo 'Total'.$remains[0]->Total;
                dd($remains);*/

              $type = array("মাস্ট ওয়াচ");
                //var_dump($type);die();
               //return view('related_videos.more_video_menu')
               return view('more_related_videos.more_video_click')
              ->with('data',$data)
              ->with('type',$type)
              ->with('content_sub',$request->content_sub)
               ->with('cat',"মাস্ট ওয়াচ");
            }else{
                  $data=$con->select('SET NOCOUNT ON;Exec Sp_getContentsByCategoryID_daruntv "2B1985EC-F390-49AF-96D4-853273B03344"'); 
              $type = array("লাইব্রেরি");
                //var_dump($type);die();
               return view('more_related_videos.more_video_click')
              ->with('data',$data)
              ->with('type',$type)
              ->with('content_sub',$request->content_sub)
              ->with('cat',"লাইব্রেরি");

            }

 // full movies
       //var_dump($data);die();

        // return view('more_video')
        //   ->with('data',$data);
    }
	
		public function ajaxMore(Request $request){
         $con=\DB::connection("sqlsrv");
         $id=$request->status;


      //var_dump($id+'hello dear');die;
         if($id=="বলিউড মাসালা"){
          $data_Bw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "1AAD9870-F51B-4588-93D4-CA9EF52531D2",'.$request->track_page2.''); 

          $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
          foreach($data_Bw as $listing_content){
            if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
        $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

        return $x;

      }else if($id=="হলিউড মাসালা"){
        //$data_Dw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "CA89C0EE-52B6-4BBD-8D24-27868A12D62C",'.$request->track_page2.'');
        $data_Dw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "8EC80D7A-D793-4364-BE3E-CF3BE2C73873",'.$request->track_page2.'');

         $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
        foreach($data_Dw as $listing_content){
            if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
       $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

      return $x;

    }else if($id=="ডালিউড মাসালা"){
     //$data_Hw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "8EC80D7A-D793-4364-BE3E-CF3BE2C73873",'.$request->track_page2.'');
     $data_Hw=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "CA89C0EE-52B6-4BBD-8D24-27868A12D62C",'.$request->track_page2.'');

     $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
     foreach($data_Hw as $listing_content){
        if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
    $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

  return $x;

}else if($id=="মুভি রিভিউ"){
 $data_Mv=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "5D7287AD-7F66-4B92-B936-BC58FF781591",'.$request->track_page2.'');

$x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_Mv as $listing_content){
    if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
        $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;

}else if($id=="বাংলা"){
 $data_Ban=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "540DEE2F-CF0F-437E-B80D-B9DA84C62405",'.$request->track_page2.''); 

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_Ban as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
         $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;

}else if($id=="হিন্দি"){


  $data_Hn=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "64D4219F-B9A1-4040-B039-06B1620FF1DE",'.$request->track_page2.''); 

$x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_Hn as $listing_content){
     if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
       $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;

}else if($id=="বাংলা মিউজিক"){

 $data_BanM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "3699F024-2394-42EF-9366-BB601129DEDA",'.$request->track_page2.'');

$x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_BanM as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
           $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}else if($id=="ইংলিশ মিউজিক"){
  $data_EnM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "583247FC-58AD-4191-AF2F-498FA3926DEC",'.$request->track_page2.''); 

  $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
   foreach($data_EnM as $listing_content){
   if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
          $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}else if($id=="সিনেমার গান"){

  $data_CinG=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "D4B01EA7-76BB-44B0-8E31-760780C74084",'.$request->track_page2.'');

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_CinG as $listing_content){
    if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
       $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}elseif ($id=="নাটক") {
 $data_Natok=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "969B7A4B-07EA-4B60-A4FC-5BB6099B754B",'.$request->track_page2.''); 
 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_Natok as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
        $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
          # code...
}elseif ($id=="টেলিফিল্মস") {

  $data_teli=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "AF3AB0FC-7A82-4115-B680-008D03361263",'.$request->track_page2.''); 

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_teli as $listing_content){
   if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
          $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
          # code...
}elseif ($id=="মিউজিক্যাল শো") {
  $data_MusicSh=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "07E15943-C4D4-447D-857A-0F348FDDE286",'.$request->track_page2.''); 
 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_MusicSh as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
         $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
          # code...
}elseif ($id=="ফ্যাশন শো") {
 $data_Fashion=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "A28FE8DD-4382-4E09-9D39-6CA2F91237EC",'.$request->track_page2.''); 
$x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_Fashion as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
           $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
            if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
       
        }
        $x.='</table>';

return $x;
          # code...
}elseif ($id=="ক্রাইম শো") {
          # code...
$data_Crime=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "969B7A4B-07EA-4B60-A4FC-5BB6099B754B",6');
 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_Crime as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
        $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
}elseif ($id=="এন্টারটেইনমেন্ট শো") {
  $data_Enter=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "5B4773DE-55DE-41DC-801D-0089C025B04A",'.$request->track_page2.''); 

  $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_Enter as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
         $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                         <span class="slide-title">'.$listing_content->ContentTile.'</span>
										   </div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
          # code...
}elseif ($id=="বলিউড ফিটনেস ভিডিও") {
          # code...
  $data_BwF=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "1B97D26D-0664-4AB0-8B85-580A82B1AA24",'.$request->track_page2.''); 
 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_BwF as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
          $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
}elseif ($id=="ডালিউড ফিটনেস ভিডিও") {
          # code...
  $data_DwF=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "F30E4420-EA4E-444C-A78F-5452B72EB86E",'.$request->track_page2.''); 

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_DwF as $listing_content){
   if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
           $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                          <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}elseif ($id=="বাংলা-কমেডি") {
          # code...
 $data_BnC=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "394C8AB4-5C72-4927-8A2A-2805263EE7F9",'.$request->track_page2.''); 

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_BnC as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
           $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
											<span class="slide-title">'.$listing_content->ContentTile.'</span>
										   </div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}elseif ($id=="হিন্দি-কমেডি") {
          # code...
  $data_HiC=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "7C546F48-3FAE-42E8-9921-293D14B7D675",'.$request->track_page2.''); 

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_HiC as $listing_content){
   if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
           $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}elseif ($id=="বাংলা মিউজিক ভিডিও") {
          # code...
  //$data_BnMu=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "209D67DE-75F7-448A-993A-4C41BA559AF6",'.$request->track_page2.'');
  $data_BnMu=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "0A8B78D3-FB8F-4288-AF79-674E0D195266",'.$request->track_page2.'');
 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_BnMu as $listing_content){
    if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
        $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
											<span class="slide-title">'.$listing_content->ContentTile.'</span>
										   </div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}elseif ($id=="বাংলা নাটক") {
          # code...
 //$data_BnN=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "0A8B78D3-FB8F-4288-AF79-674E0D195266",'.$request->track_page2.'');
 $data_BnN=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "91994980-F977-4EB4-AED6-72041FBE82AF",'.$request->track_page2.'');

$x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_BnN as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
            $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}elseif ($id=="বাংলা টেলিফিল্মস") {
          # code...
  $data_BnT=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "91994980-F977-4EB4-AED6-72041FBE82AF",'.$request->track_page2.''); 

  $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_BnT as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
          $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
}elseif ($id=="বাংলা মুভি") {
          # code...
  $data_BnM=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "D1BA45D1-CF85-44B7-BF55-50C412886DC0",'.$request->track_page2.''); 

  $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_BnM as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
            $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
}elseif ($id=="বলিউড সেলিব্রেটি মাসালা") {
          # code...
  $data_BnMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "4D40FB19-2545-41DC-BB56-249270F1CE35",'.$request->track_page2.''); 

  $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_BnMas as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
           $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                           <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';

return $x;
}elseif($id=="হলিউড সেলিব্রেটি মাসালা"){
 $data_HwMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "BA23E9CD-61F1-4A8A-8160-2723269FE58C",'.$request->track_page2.''); 

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 foreach($data_HwMas as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
             $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
}elseif($id=="ফেভারিট"){


          if(isset($_POST['msisdn']) && $_POST['msisdn']!=''){
                $data_fav=$con->select('SET NOCOUNT ON;Exec Sp_getFavVideo_daruntv "'.$_POST['msisdn'].'"'); 
                }else{
                  $data=null;
                }


  //$data_fav=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "BA23E9CD-61F1-4A8A-8160-2723269FE58C",'.$request->track_page2.''); 

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
 $inc=1;
 $i = 0;
  foreach($data_fav as $listing_content){
    $i++;
  if(($i % 2) == 0){
              $x.='<tr>';
            }
            $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="{{url($listing_content->path)}}" oncontextmenu="return false"><img src="{{ asset($listing_content->imageUrl) }}" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($i% 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
}
 // ratna: added must watch section in aro video ajax call from line 1011 to 1029. this is new code.
 elseif($id=="মাস্ট ওয়াচ"){
     $data_HwMas=$con->select("SET NOCOUNT ON;Exec Sp_MustWatch_daruntv $request->track_page2");

     $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
     foreach($data_HwMas as $listing_content){
         if(($listing_content->RN % 2) == 0){
             $x.='<tr>';
         }
         $x.='<td style="width: 49%"><div class="preview" style="width:98%">
                                     <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                    <span class="slide-title">'.$listing_content->ContentTile.'</span>
                                    </div></td>';
         if(($listing_content->RN % 2) == 1){
             $x.='</tr>';
         }
     }
     $x.='</table>';
     return $x;
 }

else{

  //$data_HwMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsBySubcategoryID_daruntv "BA23E9CD-61F1-4A8A-8160-2723269FE58C",'.$request->track_page2.'');
  $data_HwMas=$con->select('SET NOCOUNT ON;Exec Sp_getContentsByCategoryID_daruntv "2B1985EC-F390-49AF-96D4-853273B03344",'.$request->track_page2.'');

 $x='<table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">';
  foreach($data_HwMas as $listing_content){
  if(($listing_content->RN % 2) == 0){
              $x.='<tr>';
            }
           $x.='<td><div class="preview" style="width:100%">       
                                             <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="'.$listing_content->path.'" oncontextmenu="return false"><img src="'.$listing_content->imageUrl.'" alt="" style="border-width:0px;"></a>
                                            <span class="slide-title">'.$listing_content->ContentTile.'</span>
											</div></td>';
          if(($listing_content->RN % 2) == 1){
            $x.='</tr>';
          }
        }
        $x.='</table>';
return $x;
}




}
}
