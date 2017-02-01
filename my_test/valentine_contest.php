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

            $(".selfie-like").click(function(e){
                e.preventDefault();
                var token = $(this).data("token");
                var id = $(this).data("item");

                $.ajax({
                    url: "ajax.likecount?mco=t",
                    type: "POST",
                    data: {id : id, token : token, UserCode : "' . $_SESSION["UserCode"] . '"},
                    dataType: "json",
                    success: function(data){
                      //var datas = parse.JSON(data);
                      if(data.Error){
                        $(".selfie-like").closest("vc-wrapper").find(".likesMsgId").html(data.msg);
                      } else {                                        
                        $(".selfie-like").closest("vc-wrapper").find(".likesMsgId").html(data.msg);
                        $(".selfie-like").closest("vc-like").find(".TotalLikeId").text(data.TotalLikes);
                      }
                    }
                });
                /*window.location = "'.ApplicationURL($Theme = $_REQUEST["Theme"], $Script =
        "valentine_contest").'";*/
            });

            $("#deleteSelfiePicture").click(function(e){
                e.preventDefault();
                var id = $(this).data("item");
                var UserCode = $(this).data("UserCode");

                $.ajax({
                    url: "ajax.deletecontent?mco=t",
                    type: "POST",
                    data: {id : id, UserCode : UserCode},
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
	    <img src="'.$bannerTopImage.'" style="width: 95%;margin: 4px auto; border-radius: 0px;" />

	    '. $msg .'

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

if(!empty($uData)) {
    if (trim($userSelfie["Photo"]) == "") {
        $profilePicOn = $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/profile_pic.png';
    } else {
        $profilePicOn = $Application["BaseURL"] . '/upload/photo/' . $userSelfie["Photo"];
    }

    $Echo .= '
            <div class="vc-wrapper">
                <div class ="likesMsgId" style="display:none;"></div>
                <div class="vc-imageheader">
                    <ul>
                        <li><img src="' . $profilePicOn . '" alt="Profile"></li>
                        <li class="titleHeadName" style="line-height:32px"><strong>' . $title . '
                        ' . $userSelfie["FullName"] . '</strong> Uploaded a
                        selfie picture</li>
                        <li><img
                        src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/delete-selfie.png"
                        width="25px" height="25px" id ="deleteSelfiePicture" data-item = "'.$userSelfie['Id'].'"></li>
                    </ul>
                </div>
                <div class="vc-selfie boxshadow">
                    <img src="' . $Application["BaseURL"] . '/upload/valentine_contest/' . $userSelfie["Photo_Path"] . '" alt="">
                </div>
               <div class="vc-like">
                    <ul>
                        <li>
                            <div style="flaot:right"><img src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/heart.jpg"></div>
                        </li>
                        <li><span id="TotalLikeId" class="TotalLikeId" >' . $userSelfie["TotalLike"] . '</span></li>
                        <li>
                            <img class = "selfie-like" data-item = "' . $userSelfie["Id"] . '" data-token =
                            "' . $_SESSION['token'] . '"
                             src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/like.jpg" >
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        ';
}

$Parameters_get = "'".$offset."', '".$limit."'";
$GetTopSelfies = SQL_SP($Entity = "GetSPTopLikeValentineContent", $Parameters_get, $SingleRow = false);

foreach($GetTopSelfies as $selfie)
{
    if($selfie["UserCode"] != $_SESSION['UserCode']) {
        if (trim($selfie["Photo"]) == "") {
            $profilePic = $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/profile_pic.png';
        } else {
            $profilePic = $Application["BaseURL"] . '/upload/photo/' . $selfie["Photo"];
        }
        $Echo .= '
            <div class="vc-wrapper">
                <div class ="likesMsgId" style="display:none;"></div>
                <div class="vc-imageheader">
                    <ul>
                        <li><img src="' . $profilePic . '" alt="Profile"></li>
                        <li class="titleHeadName" style="line-height:32px"><strong>' . $title . ' ' . $selfie["FullName"] . '</strong> Uploaded a selfie picture</li>
                    </ul>
                </div>
                <div class="vc-selfie boxshadow">
                    <img src="' . $Application["BaseURL"] . '/upload/valentine_contest/' . $selfie["Photo_Path"] . '" alt="">
                </div>
               <div class="vc-like">
                    <ul>
                        <li>
                            <div style="flaot:right"><img src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/heart.jpg"></div>
                        </li>
                        <li><span id="TotalLikeId" class="TotalLikeId" >' . $userSelfie["TotalLike"] . '</span></li>
                        <li>
                            <img class = "selfie-like" data-UserCode = "'.$selfie["UserCode"].'" data-item = "' . $selfie["Id"] . '" data-token = "' . $_SESSION['token'] . '" src="' . $Application["BaseURL"] . '/theme/' . $_REQUEST["Theme"] . '/image/valentine_contest/like.jpg" >
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
';

?>