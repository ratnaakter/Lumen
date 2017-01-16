
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