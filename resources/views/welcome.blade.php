<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML Div Layout</title>
    <style type="text/css">
        body{
            font: 12px verdana, sans-serif; 
            margin: 0px;
        }
        .header{
            padding: 10px 0;
            background-color: #679BB7; 
        }
        .header h1{
            font-size: 18px; 
            margin: 10px;
        }
        .container{
            width: 80%;
            margin: 0 auto; /* Align container DIV horizontally center */
            background-color: #f0f0f0; 
        }
        .sidebar{
            float: left; 
            width: 20%; 
            min-height: 170px;
            background-color: #bbd2df;
        }
        .sidebar .nav{
            padding: 10px;
        }
        .nav ul{
            list-style: none; 
            padding: 0px; 
            margin: 0px;
        }
        .nav ul li{
            margin-bottom: 5px;
        }
        .nav ul li a{
            color: #3d677e;
        }
        .nav ul li a:hover{
            text-decoration: none;
        }
        .content{
            float: left;
            width: 80%;
            min-height: 170px;
        }
        .content .section{
            padding: 10px;
        }
        .content h2{
            font-size: 16px; 
            margin: 0px;
        }
        .clearfix{
            clear: both;
        }
        .footer{
            background-color: #679BB7; 
            padding: 10px 0;
        }
        .footer p{
            text-align: center; 
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tutorial Republic</h1>
        </div>
        <div class="wrapper">
            <div class="sidebar">
                <div class="nav">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="section">
                    <h2>Welcome to our site</h2>
                    <p>Here you will learn to create websites...</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="footer">
            <p>copyright &copy; tutorialrepublic.com</p>
        </div>
    </div>
</body>
</html>                                		