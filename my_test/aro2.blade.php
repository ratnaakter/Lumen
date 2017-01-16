<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="MoreNewGame.aspx.cs" Inherits="HC.UI.Pages.MoreNewGame" %>
<%@ Register Src="../UserControls/Header.ascx" TagName="Header" TagPrefix="uc1" %>
<%@ Register Src="../UserControls/SubFooter.ascx" TagName="SubFooter" TagPrefix="uc5" %>
<%@ Register Src="../UserControls/Footer.ascx" TagName="Footer" TagPrefix="uc6" %>
<%@ Register Src="../UserControls/MoreTopGames.ascx" TagName="MoreTopGames" TagPrefix="uc2" %>
<%@ Register Src="../UserControls/OtherLinks.ascx" TagName="OtherLinks" TagPrefix="uc2" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>Robi Play: More Top Games</title>
    <meta name="viewport" content="width=device-width, height=device-height, user-scalable=yes" />
    <link href="../StyleSheet/StyleSheet.css" rel="stylesheet" type="text/css" />

    <style>
        .preview
        {
            background: #fcfdff none repeat scroll 0 0;
            border: 5px solid white;
            border-radius: 2px;
            float: left;
            height: auto;
            margin: 2px;
            padding: 1px 2px;
            width: 47%;
        }

        .slide-title{
            display: block;
            max-width: 170px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: rgba(0,0,0,0.9);
            font-size: 12px;
            line-height: 14px;
            padding-top: 3px;
            font-family: 'Source Sans Pro';
        }
    </style>
</head>
<body>
    <form id="frmMoreTopGames" runat="server">
        <table cellpadding="0" cellspacing="0" class="TABLE">
            <tr>
                <td align="left" valign="top">
                    <uc1:Header ID="HeaderControl" runat="server" />
                </td>
            </tr>
        </table>

        <div class="preview" style="width:98%; margin-top: 10px; margin-bottom: 10px;">
            <div style="width: 49%; border: 4px #fff solid; float: left;">
                <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="" oncontextmenu="return false">
                    <img src="../Images/Ui_img/Cricket_Fever.jpg" style="width: 100%;">
                </a>
                <span class="slide-title"></span>
            </div>
            <div style="width: 49%; border: 4px #fff solid; float: left;">
                <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="" oncontextmenu="return false">
                    <img src="../Images/Ui_img/Chess.jpg" style="width: 100%;">
                </a>
                <span class="slide-title"></span>
            </div>
            <div style="width: 49%; border: 4px #fff solid; float: left;">
                <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="" oncontextmenu="return false">
                    <img src="../Images/Ui_img/Cricket_Fever.jpg" style="width: 100%;">
                </a>
                <span class="slide-title"></span>
            </div>
            <div style="width: 49%; border: 4px #fff solid; float: left;">
                <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="" oncontextmenu="return false">
                    <img src="../Images/Ui_img/Chess.jpg" style="width: 100%;">
                </a>
                <span class="slide-title"></span>
            </div>
            <div style="width: 49%; border: 4px #fff solid; float: left;">
                <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="" oncontextmenu="return false">
                    <img src="../Images/Ui_img/Cricket_Fever.jpg" style="width: 100%;">
                </a>
                <span class="slide-title"></span>
            </div>
            <div style="width: 49%; border: 4px #fff solid; float: left;">
                <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="" oncontextmenu="return false">
                    <img src="../Images/Ui_img/Chess.jpg" style="width: 100%;">
                </a>
                <span class="slide-title"></span>
            </div>
        </div>  

        <table cellpadding="0" cellspacing="0" class="TABLE" style="width: 100%;">
            <tr>
                <td align="center"><button type="button" class="btn footer_btn" >More..</button></td>
            </tr>
        </table>      
    </form>
</body>
</html>

