<?php

if(isset($_POST['token']) && !empty($_POST['token']))
{
    $photo = $_FILES['selfie'];
    $usercode = trim($_SESSION["UserCode"]);
    $timestamp = date('Y-m-d H:i:s');

    if(!empty($photo) && $usercode != "")
    {
        $image_url = ImageResize("selfie", "./upload/valentine_contest/", "320", "240");
        $Parameters="'".$usercode."', '".$image_url."', 'Valentine Contest', '".$timestamp."'";
        $Rows = SQL_SP($Entity="SetValentineContest", $Parameters, $SingleRow=true);

        $msg = "";
        if($Rows['Status'] == 'Error'){
            $msg = '<div style="background: #5b9bd5; color: #FFF; text-align: center;padding: 2px 5px;border-radius: 2px;">You
already submitted your selfie. You can remove your existing one and submit another one</div>';    // this message will show if image
// found.
        }

    }

}

$MSISDN=$GetRow["MSISDN"];
if($_GET['log']==1) {
    $catagory="";
    $ContentName="";
    $MSISDN=$GetRow["MSISDN"];
    $Parameters="'".$MSISDN."', '".$catagory."','".$ContentName."'";
    $DataInsertActivity = SQL_SP($Entity = "DataInsertActivity", $Parameters, $SingleRow = true);

}

if($_REQUEST["aid"]!="")
{
    $avatarID="aid=".$_REQUEST["aid"];
}

$bannerTopImage = $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/valentine-banner.jpg';
$uploadBtn = $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/upload-picture-button.jpg';
$Echo.='
    <script>
        $(document).ready(function() {
            $(".upload").change(function(e) {
                e.preventDefault();
                var file_data = $(".upload").prop("files")[0];
                var allowed_format = ["image/png", "image/jpg", "image/jpeg"];

                if(file_data.name != "") {
                    if($.inArray(file_data.type, allowed_format) != "-1") {
                        $(".valentaine_form").submit();
                    } else {
                        alert("Invalid file format");
                    }
                } else {
                    alert("Please select an image");
                }
            });

            $("#deleteSelfiePicture").click(function(e){
                e.preventDefault();
                var id = $(this).data("item");

                $.ajax({
                    url: "ajax.deletecontent?mco=t",
                    type: "POST",
                    data: {id : id, UserCode : "' . $_SESSION["UserCode"] . '"},
                    dataType: "json",
                    success: function(data){
                        //console.log(data);
                    }
                });
                window.location = "'.ApplicationURL($Theme = $_REQUEST["Theme"], $Script =
        "valentine_contest").'";
            });
        });
    </script>
	<div id="content">

	    '. $msg .'
        <div id="successMessage" style="display:none;border: 1px red solid; width: 100%;height: 30px;"> It
                worked </div>
	    <div class="selfieUploadSection">
	        <form action="'.ApplicationURL($Theme=$_REQUEST["Theme"],$Script="valentine_contest").'" method="post" class="valentaine_form" enctype="multipart/form-data">
	            <input type="hidden" name = "token" value = "'.md5(rand(1414, 9999)).'" />
	            <div class="fileUploadBtn btnV btnV-primary">
                    <!--<span ><img
                    src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/upload-picture-button.jpg" alt=""></span>-->
                    <span>Upload Picture</span>
                    <input type="file" class="upload" name = "selfie"/>
                </div>
	        </form>
	     </div>
';
// get top likes selfies
if(isset($_REQUEST['more']) && $_REQUEST['more'] > 0){
    $limit = $_REQUEST['more'] + 4;
    $offset = 0;
    $moreItem = $_REQUEST['more'] + 4;
} else {
    $limit = 4;
    $offset = 0;
    $moreItem = $limit+4;
}
$token = rand(10000, 99999);
$_SESSION['token'] = $token;
$userSelfie = SQL_SP($Entity = "SPTopLikeValentineContentUser", "'".$_SESSION['UserCode']."'", $SingleRow = true);
$uData = array_filter($userSelfie);

//echo $uData;
//exit;

if(!empty($uData)) {
    if (trim($uData["Photo"]) == "" && !file_exists($Application["BaseURL"] . '/upload/photo/' . $uData["Photo"])) {
        $profilePicOn = $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/profile_pic.png';
    } else {
        $profilePicOn = $Application["BaseURL"] . '/upload/photo/' . $uData["Photo"];
    }

    $Echo .= '
            <div class="vc-wrapper">
                <div class="likesMsgId'.$uData["Id"].'" style="display: none;margin:2px auto;width: 100%; height:
                25px;
                border-radius:2px;line-height: 25px;background: #cdcdcd;color: #000;float:left;"></div>
                <div class="vc-imageheader">
                    <ul>
                        <li><img src="' . $profilePicOn . '" alt="Profile"></li>
                        <li class="titleHeadName" style="line-height:32px"><strong>' . $title . '
                        ' . $uData["FullName"] . '</strong> Uploaded a
                        selfie picture</li>
                        <li><img
                        src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/delete-selfie.png"  width="25px" height="25px" id ="deleteSelfiePicture" data-item = "'.$uData['Id'].'"></li>
                    </ul>
                </div>
                <div class="vc-selfie boxshadow">
                    <img src="' . $Application["BaseURL"] . '/upload/valentine_contest/' . $uData["Photo_Path"] . '" alt="">
                </div>
               <div class="vc-like">
                    <ul>
                        <li>
                            <div style="flaot:right"><img src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/heart.jpg"></div>
                        </li>
                        <li><span id="TotalLikeId'.$uData["Id"].'">' . $userSelfie["TotalLike"] . '</span></li>
                        <li>
                            <img class = "selfie-like" data-UserCode = "'.$uData["UserCode"].'" data-item =
                            "' . $uData["Id"] . '#'.$uData["UserCode"].'" data-token =
                            "' . $_SESSION['token'] . '"  src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/like.jpg" >
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        ';
}

$Parameters_get = "'".$offset."', '".$limit."'";
$GetTopSelfies = SQL_SP($Entity = "GetSPTopLikeValentineContent", $Parameters_get, $SingleRow = false);
//echo $GetTopSelfies;
//exit;
foreach($GetTopSelfies as $selfie)
{
    if($selfie["UserCode"] != $_SESSION['UserCode']) {
        if (trim($selfie["Photo"]) == "" && !file_exists($Application["BaseURL"] . '/upload/photo/' . $selfie["Photo"])) {
            $profilePic = $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/profile_pic.png';
        } else {
            $profilePic = $Application["BaseURL"] . '/upload/photo/' . $selfie["Photo"];
        }
        //echo $selfie["UserCode"];exit;
        $Echo .= '
             <div class="vc-wrapper">
                <div class="likesMsgId'.$selfie["Id"].'" style="display: none;margin:2px auto;width: 100%; height: 25px;
                 border-radius:2px;line-height: 25px;background: #cdcdcd;color: #000;float:left;"></div>
                <div class="vc-imageheader">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%" height="30px">
                        <tr>
                            <td width="15%" align="center">
                                <img src="' . $profilePic . '" alt="Profile"
                                style="width:30px;height: 30px;border-radius:50%;">
                            </td>
                            <td width="85%" align="left"><strong>' . $title . ' ' . $selfie["FullName"] . '</strong>
                            Uploaded a selfie picture</td>
                        </tr>
                    </table>

                </div>
                <div class="vc-selfie boxshadow">
                    <img src="' . $Application["BaseURL"] . '/upload/valentine_contest/' . $selfie["Photo_Path"] . '" alt="">
                </div>
               <div class="vc-like">
                    <ul>
                        <li>
                            <div style="flaot:right"><img src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/heart.jpg"></div>
                        </li>
                        <li><span id="TotalLikeId'.$selfie["Id"].'">' . $selfie["TotalLike"] . '</span></li>
                        <li>
                            <!--<img class = "selfie-like" data-item = "' . $selfie["Id"] . '" data-token =
                            "' . $_SESSION['token'] . '"
                             src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/like.jpg" >-->
                       <img class = "selfie-like" data-UserCode = "' . $selfie["UserCode"] . '"
                        data-item = "' . $selfie["Id"] . '#'.$selfie["UserCode"].'" data-token = "' . $_SESSION['token'] . '"
                        src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/like.jpg" >
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        ';
    }
}

$Echo.='
    <div class="vc_tc">
        <a href="' . ApplicationURL($Theme = $_REQUEST["Theme"], $Script = "valentine_contest_term_condition") .'" class="tc">Terms and Conditions</a>
        <a href="' . ApplicationURL($Theme = $_REQUEST["Theme"], $Script = "valentine_contest", "more=$moreItem")
    .'"
        class="tc_more">See More >></a>
    </div>
';

$Echo.='
	</div>

	<script>
	$(document).ready(function(){
	    $(".selfie-like").click(function(e){
                e.preventDefault();
                var token = $(this).data("token");
                var id = $(this).data("item");
                var userCode = $(this).data("UserCode");
                var thisContent = $(".selfie-like");    // assign class selfie-like to a variable

                var fields = id.split("#");

                var _contentId = fields[0];
                var _userCode = fields[1];


                $.ajax({
                    url: "ajax.likecount?mco=t",
                    type: "POST",
                    data: {id : _contentId, token : token, UserCode : _userCode},
                    dataType: "json",
                    success: function(data){

                        if(data.Status == "Success"){
                            $("#TotalLikeId"+_contentId).html(data.TotalLikes);
                            $(".likesMsgId"+_contentId).html(data.msg).show();
                            setTimeout(function() {
                                $(".likesMsgId"+_contentId).fadeOut("fast");
                            }, 5000);
                        } else {
                            $(".likesMsgId"+_contentId).html(data.msg).show();
                            setTimeout(function() {
                                $(".likesMsgId"+_contentId).fadeOut("fast");
                            }, 5000);
                        }
                    }
                });

            });

	});
	</script>
';

?>


