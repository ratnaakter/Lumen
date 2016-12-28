<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta name="viewport" content="width=device-width, height=device-height, user-scalable=yes" />
    <meta name="csrf-token" content="{{ Session::token()}}">
    <title>Darun Show</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/Css/bootstrap.min.css')}}" />
    <link href="{{asset('assets/StyleSheet/video-js.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/Css/StyleSheet.css')}}" rel="stylesheet" />
    {{-- Ratna: Add swipper.css file in header--}}
    <link href="{{asset('assets/Css/swiper.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/Css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/Css/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
    <!-- Latest compiled and minified JavaScript -->
    <style type="text/css">
        /*bdoy{
            display:none;
        }*/
        .join-user{
            padding:8px;
            border:1px solid blue;
        }
        /*.content-area {
            position: relative;
            width: 960px;
            margin: 0 auto;
        }
        .carousel-indicators li {
            border-radius: 50%;
            height: 20px;
            width: 20px;
        }
        .carousel-indicators .active {
            height: 25px;
            width: 25px;

        }*/

    </style>
</head>
<body>
<!-- back modal -->
<div class="modalf modal" id="myModal3" role="dialog" style="margin: 18px; position: fixed; z-index: 9999999;display:none">
    <div class="modal-dialog modal-sm">
        <button type="button" class="close" data-dismiss="modal"><img src="{{asset('assets/images/close-button.png')}}" width="10%"></button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{asset('assets/images/Picture8.jpg')}}" class="img-responsive">
                <div style="margin-left: auto; margin-right: auto; text-align: center; background-color: white;">
                    <span id="ctl00_cphMian_lblNumber" class="StrongText" style="background-color:White;font-size:Large;font-weight:bold;text-align:center"></span>
                </div>
                <!-- <input name="start" id="start"  data-dismiss="modal" class="img-responsive start-user" src="images/Picture9.jpg" style="border-width:0px;" type="image"> -->
                <input name="ctl00$cphMian$addButton" id="addButton" data-dismiss="modal" class="img-responsive " src="{{asset('assets/images/Picture9.jpg')}}" style="border-width:0px;" type="image">
                <img src="{{asset('assets/images/Picture10.jpg')}}" class="img-responsive">
                <input name="ctl00$cphMian$addButton" id="ctl00_cphMian_addButton" class="img-responsive cancle-confirm" src="{{asset('assets/images/Picture11.jpg')}}" style="border-width:0px;" type="image">
            </div>
        </div>
    </div>
</div>

<!--===============================dekhun again modal=================================-->
<div class="modala modal" id="myModalAgree" role="dialog" style="margin: 18px; position: fixed; z-index: 9999999;display: none;">
    <div class="modal-dialog modal-sm">
        <button type="button" class="close disagree" data-dismiss="modal"><img src="{{asset('assets/images/close-button.png')}}" width="10%"></button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{asset('assets/images/agree_1.jpg')}}"  class="img-responsive">
                <img src="{{asset('assets/images/agree_2.jpg')}}"  class="agree img-responsive" style="cursor: pointer;">
            </div>
        </div>
    </div>
</div>

@if(isset($_POST['not_allow']) && $_POST['not_allow']==true)
    <script type="text/javascript">
        window.location ='{{url("restriction")}}';//here double curly bracket
    </script>
    @endif

    @if(isset($_POST['msisdn']) && $_POST['msisdn']!='')
    {{-- $a=Request::url();--}}
    {{--@if(Request::url() === '/darun-tv/more-video')
    @endif--}}

         {{--=====First time used condi--}}
        {{--@if($_POST['show_msisdn']!=true)
        @include('modals.subscription',['msisdn' =>$_POST['msisdn']])--}}
        {{--end=======--}}

         {{--=====new my condi now--}}
        @if(Request::url() === url('view-video') || Request::url() === url('/'))
            {{--{{  dd(Request::url()) }}--}}
            @include('modals.final_confirmation')
        @else
        @endif
       {{--====end--}}
    @else
        {{-- Ratna: Add a logic to show aro video if user use wifi. but in home page first it will show fire jan modal.
        then if a user goes to view-video pages then it will redirect to home with fire jan modal. this block will
        works only if mobile no not found. --}}
        {{-- $a=Request::url();--}}
        @if(Request::url() === url('view-video') || Request::url() === url('/'))
            {{--{{  dd(Request::url()) }}--}}
            @include('modals.back_modal')
        @endif

    @endif

            <!--  confirm modal-->
    <!-- header start here -->
    <div class="Wrap" id="Wrapid" style="display:block">
        <div class="header">
            <div class="headerlog" >
                <img src="{{asset('assets/images/222.jpg')}}" class="headerimg" style="width:100%;"/>
                <img src="{{asset('assets/images/search.png')}}"  class="searchicone" style="width:10%;position:absolute;right:7px;top:15px" />
            </div>
            <div class="manu">
                <div id='cssmenu'  style="display:none">
                    <ul style="border-top:#5e071b solid 1px;">
                        <li class='active'><a href="{{url('/')}}"><span><i><img src="{{asset('assets/images/home.png')}}" class="" style="width:30px;height:25px;" /></i>হোম</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=সেলিব্রেটি')}}"><span><i><img src="{{asset('assets/images/celebrity.png')}}" class="" style="width:30px;height:25px;" /> </i>সেলিব্রেটি</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=ভিডিও')}}"><span><i><img src="{{asset('assets/images/music-video.png')}}" class="" style="width:30px;height:25px;" /> </i>মিউজিক ভিডিও</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=মুভি')}}"><span><i><img src="{{asset('assets/images/movie.png')}}" class="" style="width:30px;height:25px;" /> </i>মুভি</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=টিভি')}}"><span><i><img src="{{asset('assets/images/comedy.png')}}" class="" style="width:30px;height:25px;" /> </i>টিভি শো</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=ফিটনেস')}}"><span><i><img src="{{asset('assets/images/fitness.png')}}" class="" style="width:30px;height:25px;" /> </i>ফিটনেস</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=কমেডি')}}"><span><i><img src="{{asset('assets/images/comedy.png')}}" class="" style="width:30px;height:25px;" /> </i>কমেডি</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=প্রিমিয়াম')}}"><span><i><img src="{{asset('assets/images/premium-video.png')}}" class="" style="width:30px;height:25px;" /> </i>প্রিমিয়াম ভিডিও</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=ফেভারিট')}}"><span><i><img src="{{asset('assets/images/favourite.png')}}" class="" style="width:30px;height:25px;" /> </i>ফেভারিট</span></a></li>
                        <li class='active'><a href="{{url('/more-video?content_type=লাইব্রেরি')}}"><span><i><img src="{{asset('assets/images/library.png')}}" class="" style="width:30px;height:25px;" /> </i>লাইব্রেরি</span></a></li>
                    </ul>
                </div>
            </div>
            <form type="post" action="{{url('search-item')}}">
                <div class="input-group" style="display:none">
                    <input name="HeaderControltxtserach" type="text" id="HeaderControl_txtserach" class="form-control" />
        <span class="input-group-btn">
          <input type="submit" name="HeaderControl$btnsearch" value="Search" id="HeaderControl_btnsearch" class="btn btn-danger " />
        </span>
                </div>
            </form>
        </div>
        <div style="visibility: hidden" class="msisdn"></div>
        <div>
            @yield('content')
        </div>
        <!--====================main body ends here===============================-->
        <div style="clear:both"></div>
        <div class="horzontaline">
            <hr />
        </div>

        <!--==============================================================================
        ===================================Footer start here
        ================================================================================-->
        <div class="link">
            <table style="width:100%;height:auto">
                <tr>
                    <td style="width: 50%; text-align: center;">
                        @if(isset($_POST['show_home']) && $_POST['show_home']!="/")
                            <a class="btn footer_btn" href="{{url('/')}}"><i class="fa fa-home"></i> হোম</a>
                        @endif
                        <a class="btn footer_btn" href="{{url('service/service_info')}}"><i class="fa fa-info"></i> সার্ভিস তথ্য</a>
                        <a  class="btn footer_btn" href="{{url('service/help')}}"><i class="fa fa-male"></i> সাহায্য</a>
                        <a  class="btn footer_btn" href="{{url('service/user-info')}}"><i class="fa fa-user-circle-o"></i> গ্রাহক তথ্য</a>
                        @if(isset($_POST['show_msisdn']) && $_POST['show_msisdn']==true)
                            <a class="btn footer_btn" style="" href="{{url('service/unscscribe')}}"><i class="fa fa-window-close-o" aria-hidden="true"></i> বাতিল</a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="foter">
            <p>
                © 2016. All Rights Reserved.
            </p>
        </div>
    </div>
    <!-- <div>
    <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="8D0E13E6" />
    <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdAAOX97V1tmrDiBrVHcaBQ3miGGTNOa60wWpA8Z6Y1ru1ZlYhAItkp9sM7s4KRAO2RJFr1ITmdXTCYRkJxGkEhy6NFoAeopwf2OBCJ3TRlazv5A==" />
    </div> -->
    <div style="width: 100%; background: #000; display:none;" id="load">
        <div class="loadvideo">
            <center><img src="Animation/Video-Box.gif" width="50%"></center>
        </div>
    </div>
    <div style="width: 100%; height: auto; background: rgb(0, 0, 0) none repeat scroll 0% 0%; display: none;" id="load">
        <div class="loadvideo" id="loadvideogif">
            <!--<center><img src="Animation/Video-Box.gif" width="50%"></center> -->
        </div>
    </div>
    <script src="{{asset('assets/Js/jquery.js')}}"></script>
    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="{{asset('assets/Js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">


        /*var mySwiper = new Swiper('.swiper-container',
         {
         slidesPerView: 'auto',
         initialSlide: 0,
         loop: false,
         loopedSlides: 20
         });
         */
        //jQuery(document).ready(function () {
        //    function close_accordion_section() {
        //        jQuery('.accordion .accordion-section-title').removeClass('active');
        //        jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
        //    }
        //    jQuery('.accordion-section-title').click(function (e) {
        //        // Grab current anchor value
        //        var currentAttrValue = jQuery(this).attr('href');

        //        if (jQuery(e.target).is('.active')) {
        //            close_accordion_section();
        //        } else {
        //            close_accordion_section();

        //            // Add active class to section title
        //            jQuery(this).addClass('active');
        //            // Open up the hidden content panel
        //            jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
        //        }

        //        e.preventDefault();
        //    });
        //});
        (function ($) {
            $(document).ready(function () {
                $(document).ready(function () {
                    $('#cssmenu > ul > li ul').each(function (index, e) {
                        var count = $(e).find('li').length;
                        var content = '<span class=\"cnt\">' + count + '</span>';
                        $(e).closest('li').children('a').append(content);
                    });
                    $('#cssmenu ul ul li:odd').addClass('odd');
                    $('#cssmenu ul ul li:even').addClass('even');
                    $('#cssmenu > ul > li > a').click(function () {
                        $('#cssmenu li').removeClass('active');
                        $(this).closest('li').addClass('active');
                        var checkElement = $(this).next();
                        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                            $(this).closest('li').removeClass('active');
                            checkElement.slideUp('normal');
                        }
                        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                            $('#cssmenu ul ul:visible').slideUp('normal');
                            checkElement.slideDown('normal');
                        }
                        if ($(this).closest('li').find('ul').children().length == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    });
                });
            });
        })(jQuery);
        var navU = navigator.userAgent;
        //=================Android Mobile
        var isAndroidMobile = navU.indexOf('Android') > -1 && navU.indexOf('Mozilla/5.0') > -1 && navU.indexOf('AppleWebKit') > -1;

        //==================Apple webkit
        var regExAppleWebKit = new RegExp(/AppleWebKit\/([\d.]+)/);
        var resultAppleWebKitRegEx = regExAppleWebKit.exec(navU);
        var appleWebKitVersion = (resultAppleWebKitRegEx === null ? null : parseFloat(regExAppleWebKit.exec(navU)[1]));

        //==============Chrome
        var regExChrome = new RegExp(/Chrome\/([\d.]+)/);
        var resultChromeRegEx = regExChrome.exec(navU);
        var chromeVersion = (resultChromeRegEx === null ? null : parseFloat(regExChrome.exec(navU)[1]));

        //================Native Android Browser
        var isAndroidBrowser = isAndroidMobile && (appleWebKitVersion !== null && appleWebKitVersion < 537) || (chromeVersion !== null && chromeVersion < 37);
        if (isAndroidBrowser) {
//alert("abc");
            $(document).ready(function () {
                $("#cssmenu").css("margin-top", "0px");
            });
        }
    </script>

    <script>
       /*======================Searchbox hide when clik on menu========================*/
	   
        $(document).ready(function () {
            var value = 0;
            $("#cssmenu").hide();
            $(".searchicone").click(function () {
                value = 1;
                if (value == "1") {
                    $(".input-group").toggle();
                }
                else {
                    $("#cssmenu").animate({
                        width: "toggle"
                    });
                }
            });
            if (value == "0") {
                $(".headerimg").click(function () {
                    $("#cssmenu").animate({
                        width: "toggle"
                    });
                });
            }
			
//===========================search========================================
            $('.HeaderControl_btnsearch').click(function(){
                var  track_value=$('#HeaderControl_txtserach').val()
                console.log(track_value);
                $.ajax({
                    url: 'search-item',
                    type: 'GET',
                    data:  {status: track_value},
                    success: function (data) {
                        //$('#dataListRelatedvideo').html(data);
                        $("#Wrapid").html(data);
                    }
                });
                console.log("hello");
            });
//=====================================================================================
//===============================video view count(Dakhun)=============================================
//=====================================================================================
            $('.count_dekhun').click(function(){
                var code_content=$(".content_code").html();
                var cat_code=$(".cat_code").html();
                var con_title=$(".con_title").html();
                var sContentType = $(".sContentType").html().trim();   // get data from video_view $scontent value and store in sCotnentType var which i pass in ajax to LikeVeiwController along with cat_code, like_view etc.
                $.ajax({
                    url: 'view-count',
                    type: 'GET',
                    cache : false,
                    data:  {code_content: code_content,
                        cat_code:cat_code,
                        content_title:con_title,
                        like_view: 1,
                        sContentType: sContentType  // assign sContentType in data to send through ajax. In LikeViewController it can be get by using $requests->sContentType :)
                    },
                    success: function (data) {
                        if($.trim(data)=='-1'){
                            $('video').trigger('pause');
                            //window.location.reload();
                            window.location = '{{ url("/") }}'; // Ratna: if -1 found redirect to home
                            //$("#myModalAgree").modal('show');
                        }
                        if($.trim(data)=='not_access'){
                            window.setTimeout(function(){ } ,300);
                            location.reload();
                        }
                    }
                });
            });

//********************* Agree Button show on home page and set new environment starts *********************//
            var viewAgreeButtonStatus = '';
            viewAgreeButtonStatus = '{{ session::get('viewAgreeButtonStatus') }}';
//            console.log('viewAgreeButtonStatus: '+ viewAgreeButtonStatus);
            if(viewAgreeButtonStatus == '-1'){
                $("#myModalAgree").modal('show');
            }

            $('.agree').click(function(){
                $("#myModalAgree").modal('hide');
                $.ajax({
                    url: 'view-count-agrohi',
                    type: 'GET',
                    cache : false,
                    success: function (data) {
//                        console.log(data);
                    }
                });
            });
//********************* Agree Button show on home page and set new environment ends*********************//

//===============================Not agree to watch more than 5========================
            $('.disagree').click(function(){
                window.location.reload();
            });
//===================================================================================
//===========================Agree to watch more======================================
            /*$('.agree').click(function(){
             $("#myModalAgree").modal('hide');

             //$('video').trigger('play');
             var code_content=$(".content_code").html();
             var cat_code=$(".cat_code").html();
             var con_title=$(".con_title").html();
             //var sContentType = $(".sContentType").html().trim();   // if necessary then add this line

             $.ajax({
             url: 'view-count-agrohi',
             type: 'GET',
             cache : false,
             data:  {code_content: code_content,
             cat_code:cat_code,
             content_title:con_title,
             like_view: 4,
             // sContentType: sContentType  // if necessary then add this line
             },
             success: function (data) {
             console.log(data);
             if($.trim(data) == 'ok'){
             //$('video').trigger('pause');
             window.location = '{{ url("/") }}';
             //$("#myModalAgree").modal('show');
             }
             }

             });

             });*/

// ********************************************previous workable agree button functionality
//            $('.agree').click(function(){
//                $("#myModalAgree").modal('hide');
//                $('video').trigger('play');
//                var code_content=$(".content_code").html();
//                var con_title=$(".con_title").html();
//
//                $.ajax({
//                    url: 'view-count',
//                    type: 'GET',
//                    cache : false,
//                    data:  {code_content: code_content,
//                        content_title:con_title,
//                        like_view: 4
//                    },
//
//                    success: function (data) {
//                        // console.log(data);
//                        // if(data=='-1'){
//                        //   $('video').trigger('pause');
//                        //    //window.location.reload();
//                        //  $("#myModalAgree").modal('show');
//                        // }
//                    }
//                });
//            });

//================================Like count======================================
            $('.like-count').click(function(){
                var code_content=$(".content_code").html();
                $('.like-count').attr('src', 'assets/images/like-green.png');
                $.ajax({
                    url: 'view-count',
                    type: 'GET',
                    cache : false,
                    data:  {code_content: code_content,
                        like_view: 2
                    },
                    success: function (data) {
                        //console.log(data);
                    }
                });

            });
//=============================Favourit-count=====================================
            $('.favourit-count').click(function(){
                var code_content=$(".content_code").html();
                $('.favourit-count').attr('src', 'assets/images/fav-green.png');
                $.ajax({
                    url: 'view-count',
                    type: 'GET',
                    cache : false,
                    data:  {code_content: code_content,
                        like_view: 3
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
    <script src="{{asset('assets/StyleSheet/video.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#clsspan").click(function () {
                $('.vjs-big-play-button').click();
                $('.video2').css("display", "block");
                $('.video1').css("display", "none");
            });
        });
        function jsplay()
        {
            $(document).ready(function () {
            });
        }
        function fun(){
            var marquee = document.getElementById ("marquee2");
            console.log(marquee.width);
            //marquee.stop ();
            //console.log("hello");
        }
        //var myVar2 = setTimeout(fun,1560);
        //fun();

    </script>
    {{--<script src="{{asset('assets/Js/slick.js')}}" type="text/javascript" charset="utf-8"></script>--}}
    <script src="{{asset('assets/Js/swiper.js')}}"></script>
    <script src="{{asset('assets/Js/hammer.min.js')}}"></script>
   {{-- <script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.3/jquery.mobile.min.js"></script>--}}

    <script type="text/javascript">
        $(window).load(function() {
            $(function () {
                $('body').show();
            }); // end ready


       /*========================For swiper small slider=============*/
       var mySwiper = new Swiper('.swiper-container',
       {
       slidesPerView: 'auto',
       initialSlide: 0,
       loop: false,
       loopedSlides: 20
       });

     /*/!*===========for big slider swipe using tch in mobile device=========*!/

            $(document).ready(function() {
                $(".carousel-inner").swiperight(function() {
                    $(this).parent().carousel('prev');
                });
                $(".carousel-inner").swipeleft(function() {
                    $(this).parent().carousel('next');
                });
            });*/


            $(document).ready(function () {
                $('#myCarousel')
                        .hammer()
                        .on('swipeleft',
                        function () {
                            $('#myCarousel').carousel('next');
                        });
                $('#myCarousel')
                        .hammer()
                        .on('swiperight',
                        function () {
                            $('#myCarousel').carousel('prev');
                        });
            });


        /*    $('.swiper-slide a img').width($(window).width())*/

        });
    </script>
    <!-- Visual Studio Browser Link -->
    <script type="application/json" id="__browserLink_initializationData">
// {"appName":"Firefox","requestId":"5d81a71fd23144429c7ddb4e217991b2"}
</script>
    <!-- <script type="text/javascript" src="http://localhost:57035/65cb8b58972e40feb57bf64417c8294c/browserLink" async="async"></script> -->
    <!-- End Browser Link -->

    <script>
        var track_page = 4; //track user click as page number, righ now page number 1
        //load_contents(track_page); //load content
        var path=$('.imgResizeTest').text();
        $("#load_more_button").click(function (e) { //user clicks on button
            track_page= track_page+4; //page number increment everytime user clicks load button
            //load_contents(track_page); //load content
            // console.log(track_page);
            load_contents(track_page);
        });
        function load_contents(track_page,path){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: path,
                type: 'GET',
                data:  {status: track_page},
                success: function (data) {
                    //$("#relatedgroup").load();
                    $('#dataListRelatedvideo').html(data);
                    //location.reload(true);
                    //console.log(data);
                    //$('.relatedgroup').append(data);
                }
            });
        }
        // Ratna: Here remove some unused code like slick slider and its associated function which is not used now.
        // if any problem occurs then get the resource from darunctv_copy  folder from htdocs
        var track_page2 = 10;
        $(".data-aro").click(function (e) { //user clicks on button
            //console.log($('.vdtitle').html());
            track_page2 =track_page2+2;
            var x=$(this).data("id");
            //var x=$('.demo-append').html();
            //console.log(x);
            var y=$('#check'+x).data("value");
            console.log(y);

            $.ajax({
                url: '{{url("more-video-load")}}',
                type: 'GET',
                data:  {status: y, track_page2:track_page2},
                success: function (data) {
                    //$('.aro-arrow').hide();
                    $('#demo-append'+x).html(data);
                    //console.log(data);
                }
            });
        });
    </script>

    <script type="text/javascript">
        console.log( $(location).attr('pathname'))
    </script>

    <script type="text/javascript">

        /*======================First time load subscription modal(==Nibondhon==)===================*/

        var msisdn= $(".msisdn").text();
        $('.join-user').click(function(){
            //alert('ok');
            $("#myModal").modal("hide");
            $.ajax({
                url: '{{url("user-confirm-subscription")}}',
                type: 'GET',
                data:  {msisdn: msisdn},
                success: function (data) {
                    $('.join-user').attr('disabled', true);//to stop multiple insert and disable button
                    $("#myModal3").modal("show");
                    //$("#relatedgroup").load();
                    //$('#dataListRelatedvideo').html(data);
                    // location.reload(true);
                    //   console.log(data);
                    //$('.relatedgroup').append(data);
                }
            });
        });


        /*======================Batil/Cancel subscription modal===================*/
        $('.cancle-confirm').click(function(){
            //console.log("hello");
            $.ajax({
                url: '{{url("user-cancle-subscription")}}',
                type: 'GET',
                data:  {msisdn: msisdn},
                success: function (data) {
                    //start_my_script();
                    document.location.href="{{url('user_unscribe_button')}}";
                    $("#myModal3").modal("hide");
                }
            });
        });
    </script>
    <script>

        $(document).ready(function(){
            $(".modal-for").modal();
            $(".cancle-subscribe").on('click',function(){
                start_my_script();
            });
            // $(".cancle-confirm").on('click',function(){
            //    start_my_script();
            //    $('#myModal3').modal('hide');
            // });
        });
        function start_my_script(){
            setInterval(function(){
                // console.log("hello world");
                //window.location.reload();
            },5000);
            window.location.reload();
            document.location.href="{{url('/')}}";
        }
        //==============================================================================
        //===============================fire jaan======================================
        $('.fire-jaan').click(function(){
            $('#myModal2').modal('hide');
            start_my_script();
            //$('#myModal').modal('show');
            //window.location.reload();
        });
        $('.start-user').click(function(){
            //console.log('hello');
            $('.modal').modal().hide();
            $('.modalf').modal('hide');
            //$('#myModal').modal('show');
            // window.location.reload();
        });

    </script>
</body>
</html>
