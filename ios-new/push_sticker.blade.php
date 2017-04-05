<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 3 Responsive Layout Example</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css', config('adplay.https'))}}" />
    <script src="{{asset('assets/js/jquery.js', config('adplay.https'))}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js', config('adplay.https'))}}"></script>
</head>
<body>
<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="{{asset('assets/images/apple.jpeg')}}" height="60" width="60" alt="Porto Admin" />
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
              {{--  <li class="active"><a href="#">Apple Push Notification Service</a></li>--}}
                <h3 style="color: #ffffff">Apple Push Notification Service</h3>
            </ul>
        </div>
    </div>
</nav>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div class="container">
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
    <div class="jumbotron">
        <!-- {!! Form::open(['route'=>'sticker.search','method'=>'get']) !!} -->
        <div class="col-md-12">
            <div class="col-md-4" >
            </div>
            <div class="col-md-5" >
                <input class="form-control input-sm" name="ContentTitle" value="{{Input::get('ContentTitle')}}" placeholder="">
            </div>
            <div class="col-md-3" >
                {{Form::submit('Search', array('class'=>'btn btn-sm btn-danger'))}}
                <button type="button" class="btn btn-default">Reset</button>
            </div>
        </div>
        <!-- {!! Form::close() !!} -->

        <div>&nbsp;</div>
        <div>&nbsp;</div>
        {!! Form::open(['route'=>'push.stickersend','method'=>'post']) !!}
        <div class="col-md-12">
            <div class="col-md-3" >
                <label>Notification Message:</label>
            </div>
            <div class="col-md-6" >
                <textarea  class="form-control" placeholder="Message..." name="message"></textarea>
            </div>
            <div class="col-md-2" >
                <button type="button" class="btn btn-success">Send Sticker</button>
            </div>
            </div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>

        <div style="width: 50%;margin-left: 25%">
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th></th>
                <th>Title</th>
                <th>Sticker</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $values)

            @php
              $allData = "http://202.164.213.242/CMS/GraphicsPreview/Stickers//".$values->->PreviewURL."-_TTTTT_-".$values->GraphicsCode."-_TTTTT_-".$values->ContentTitle."-_TTTTT_-".$values->ContentType."-_TTTTT_-".$values->PhysicalFileName."-_TTTTT_-".$values->ChargeType;
            @endphp
            <tr>
                <td><input id="allNotifiactionData" name="radio" type="allNotifiactionData" class="custom-control-input" value = "{{ $allData }}"></td>
                <td>{{$values->ContentTitle}}</td>
              <td><img style='width:120px' src="http://202.164.213.242/CMS/GraphicsPreview/Stickers/{{$values->PreviewUrl}}" /></td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{Form::close()}}

        <center>
        {!! str_replace('/?', '?', $data->appends(Input::all())->render()) !!}
        </center>

        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-sm-12">
            <footer>
                <p>� Copyright 2017 VU Mobile</p>
            </footer>
        </div>
    </div>
</div>

</body>
</html>
