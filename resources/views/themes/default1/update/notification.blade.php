
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-refresh"></i>
        <span class="label label-danger" id="count">{!! $notification->count() !!}</span>
    </a>
    <ul class="dropdown-menu" style="width:500px">
        
        <li class="header">You have {!! $notification->count() !!} update(s).</li>

        <ul class="menu list-unstyled">
            @if($notification->count()>0)
            @foreach($notification as $notify)
            @if($notify->value)

            <li>&nbsp;&nbsp;&nbsp;{!! ucfirst($notify->value) !!}</li>
            <li class="clearfix"></li>
            @endif
            @endforeach
            @endif

        </ul>
        <!--<li class="footer no-border"><div class="col-md-5"></div><div class="col-md-2">
                <img src="{{asset("lb-faveo/media/images/gifloader.gif")}}" style="display: none;" id="notification-loader">
            </div><div class="col-md-5"></div></li>
        <li class="footer"><a href="{{ url('notifications-list')}}">View all</a>
        </li>-->

    </ul>
</li>

