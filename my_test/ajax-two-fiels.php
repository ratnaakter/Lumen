<?php

    if($_POST)
    {
        $token = $_SESSION['token'];
        $userCode = $_POST['UserCode']; //$_SESS
        $ValentaineContestId = $_POST['id'];
        $timeStamp = date('Y-m-d H:i:s');

        if(!empty($userCode) && !empty($ValentaineContestId)){
            $Parameters="'".$userCode."','".$ValentaineContestId."','".$timeStamp."'";
            $likes =SQL_SP($Entity="SetValentineContentLikes", $Parameters, $SingleRow=true);
            if($likes['Status'] == 'Error'){
                $response = ['Status' => 'Error', 'msg' => 'You have already liked this picture'];
            } else {
                $response = ['Status' => 'Success','TotalLikes' => $likes['TotalLikes'], 'msg' => 'You have like this
                 picture'];
            }
        } else {
            $response = ['Status' => 'Error', 'msg' => 'Invalid parameters'];
        }
    } else {
        $response = ['Status' => 'Error', 'msg' => 'Invalid request'];
    }

    die(json_encode($response));
?>

// end of ajaxlikecount page

//start of ajax delete
<?php
if($_POST)
{
    $userCode = $_POST['UserCode'];
    $ValentaineContestId = $_POST['id'];
    $timeStamp = date('Y-m-d H:i:s');

    if(!empty($userCode) && !empty($ValentaineContestId)){
        $Parameters="'".$userCode."','".$ValentaineContestId."'";
        $likes =SQL_SP($Entity="SPDeleteValentineContent", $Parameters, $SingleRow=true);
        if($likes['Status'] == 'Error'){
            $response = ['Status' => 'Error', 'msg' => 'No content found'];
        } else {
            $response = ['Status' => 'Success', 'msg' => $likes];
        }
    } else {
        $response = ['Status' => 'Error', 'msg' => 'Invalid parameters'];
    }
} else {
    $response = ['Status' => 'Error', 'msg' => 'Invalid request'];
}

echo json_encode($response);
?>
