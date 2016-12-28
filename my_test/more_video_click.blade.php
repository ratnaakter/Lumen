{{--Ratna: remove this condition from all page. this condition occur error if no mobile no found. if mob no found then it
works fine--}}
{{--@if($_POST['show_msisdn']==true)--}}
    @extends("layout")
@section("content")
    <div class="mainbody">
        <!--  <div class="Catname">
        শর্ট ক্লিপ্স
        </div>
        -->
        @php($m=0)
        @foreach($type as $type)
            @if($type==$content_sub)
                <div class="section">
                    <div class="BanglaVideo" id="start">
                        <div class="vdtitle">
                            {{trim($type)}}
                        </div>
                    </div>
                    <div data-value="{{$type}}" id="check{{$m}}" class="more_check" style="visibility: hidden;">
                    </div>
                    <div class="demo-append"  data-value="{{$type}}" id="demo-append{{$m}}">
                        @if($type=='বলিউড মাসালা')
                            @php($i=0)
                            <table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                @foreach($data_Bw as $listing_content)
                                    @if(($listing_content->RN % 2) == 0)
                                        <tr>
                                            @endif
                                            <td><div class="preview" style="width:100%">
                                                    <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="{{url($listing_content->path)}}" oncontextmenu="return false"><img src="{{ asset($listing_content->imageUrl) }}" alt="" style="border-width:0px;"></a>
                                                    <span class="slide-title">{{$listing_content->ContentTile}}</span>
                                                </div></td>
                                            @if(($listing_content->RN % 2) == 1)
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        @endif
                        @if($type=='হলিউড মাসালা')
                            <table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                @foreach($data_Hw as $listing_content)
                                    @if(($listing_content->RN % 2) == 0)
                                        <tr>
                                            @endif
                                            <td><div class="preview" style="width:100%">
                                                    <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="{{url($listing_content->path)}}" oncontextmenu="return false"><img src="{{ asset($listing_content->imageUrl) }}" alt="" style="border-width:0px;"></a>
                                                    <span class="slide-title">{{$listing_content->ContentTile}}</span>
                                                </div></td>
                                            @if(($listing_content->RN % 2) == 1)
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        @endif
                        @if($type=='মুভি রিভিউ')
                            <table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                @foreach($data_Mv as $listing_content)
                                    @if(($listing_content->RN % 2) == 0)
                                        <tr>
                                            @endif
                                            <td><div class="preview" style="width:100%">
                                                    <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="{{url($listing_content->path)}}" oncontextmenu="return false"><img src="{{ asset($listing_content->imageUrl) }}" alt="" style="border-width:0px;"></a>
                                                    <span class="slide-title">{{$listing_content->ContentTile}}</span>
                                                </div></td>
                                            @if(($listing_content->RN % 2) == 1)
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        @endif
                        @if($type=='ডালিউড মাসালা')
                            <table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                @foreach($data_Dw as $listing_content)
                                    @if(($listing_content->RN % 2) == 0)
                                        <tr>
                                            @endif
                                            <td><div class="preview" style="width:100%">
                                                    <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="{{url($listing_content->path)}}" oncontextmenu="return false"><img src="{{ asset($listing_content->imageUrl) }}" alt="" style="border-width:0px;"></a>
                                                    <span class="slide-title">{{$listing_content->ContentTile}}</span>
                                                </div></td>
                                            @if(($listing_content->RN % 2) == 1)
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        @endif

                        @if($type=='মাস্ট ওয়াচ')
                            <table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                @foreach($data as $listing_content)
                                    @if(($listing_content->RN % 2) == 0)
                                        <tr>
                                            @endif
                                            <td style="width: 49%"><div class="preview" style="width:98%">
                                                    <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="{{url($listing_content->path)}}" oncontextmenu="return false"><img src="{{ asset($listing_content->imageUrl) }}" alt="" style="border-width:0px;"></a>
                                                    <span class="slide-title">{{$listing_content->ContentTile}}</span>
                                                </div></td>
                                            @if(($listing_content->RN % 2) == 1)
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        @endif

                            {{--Ratna: Added line 37 - 50. bcz menu has a link name লাইব্রেরি. but here no data shows.--}}
                        @if($type=='লাইব্রেরি')
                            <table id="dataListRelatedvideo" cellspacing="0" border="0" style="width:100%;border-collapse:collapse;">
                                @foreach($data as $listing_content)
                                    @if(($listing_content->RN % 2) == 0)
                                        <tr>
                                            @endif
                                            <td><div class="preview" style="width:100%">
                                                    <a id="dataListRelatedvideo_ctl00_HyperLink1" class="imgResizeTest" href="{{url($listing_content->path)}}" oncontextmenu="return false"><img src="{{ asset($listing_content->imageUrl) }}" alt="" style="border-width:0px;"></a>
                                                    <span class="slide-title">{{$listing_content->ContentTile}}</span>
                                                </div></td>
                                            @if(($listing_content->RN % 2) == 1)
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        @endif


                    </div>
                </div>
                <div class="horzontalineimg aro-arrow">
                    <input type="image" name="btngossip-{{$type}}" id="btngossip"  data-id="{{$m}}" class="aro-arrow data-aro" id="id-{{$type}}" src="assets/images/aro.png" style="border-width:0px;width: 120px" />
                </div>
                @php($m++)
            @endif
        @endforeach
        <div class="horzontaline">
            <hr  />
        </div>
    </div>
    {{--@endif--}}
@endsection