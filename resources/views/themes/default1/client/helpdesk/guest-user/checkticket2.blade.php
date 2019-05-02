@extends('themes.default1.client.layout.client')
<?php $user = App\User::where('id','=',$tickets->user_id)->first();?>

@section('nav1')
class="active"
@stop

@section('My')
class="active"
@stop

@section('sidebar')
<li class="header">TICKET INFORMATION</li>
<li>
    <a href="">
    <span>TICKET ID</span> 
    </br><b>#{{$tickets->ticket_number}}</b>
    </a>
</li>
<li>
    <a href="">
    <span>USER</span> 
    </br><i class="fa fa-user"> </i> <b>{{$user->email}}</b>
    </a>
</li>
<li>
    <a href="">
    @if($tickets->assigned_to > 0)
        <span>ASSIGNED TO</span> 
        </br> <b>{{$tickets ->assigned_to}}</b>
    @else
        <span>UNASSIGNED</span> 
    @endif
    </a>
</li>
@stop


@section('content')

 <!-- Main content -->
               

                    <!-- Main content -->
                    <div class="box box-primary">
                        <div class="box-header">

                            <section class="content-header"><h3 class="box-title"><i class="fa fa-user"> </i> {{$thread->title}} </h3> ( {{$tickets->ticket_number}} )
                            </section>
                            <div class="pull-right">
                                <!-- <button type="button" class="btn btn-default"><i class="fa fa-edit" style="color:#15c315;"> </i> Edit</button> -->
                            
                                <button type="button" class="btn btn-default"><i class="fa fa-print" style="color:blue;"> </i> {!! link_to_route('ticket.print','Print',[$tickets->id]) !!}</button>
                      
                                <!-- </div> -->
                                <div class="btn-group"> 
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-exchange" style="color:teal;"> </i> 
                                        Change Status <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                    
                                        <li><a href="#" id="open"><i class="fa fa-folder-open-o" style="color:yellow;"> </i>Open</a></li>
                                    
                                        <li><a href="#" id="close"><i class="fa fa-check" style="color:#15c315;"> </i>Close</a></li>
                                    
                                        <li><a href="#" id="resolved"><i class="fa fa-check-circle-o " style="color:#15c315;"> </i> Resolved</a></li>
                                    </ul>
                                </div>
                                
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <section class="content"  id="refresh">
                                    <div class="col-md-12"> 
                                        <?php 
                                        $priority = App\Model\Ticket\Ticket_Priority::where('priority_id','=',$tickets->priority_id)->first();
                                        ?>
                                        <div class="callout callout-{!! $priority->priority_color !!}">
                                            <div class="row">
                                                <div class="col-md-3"> 
                                                <?php
                                                $sla = $tickets->sla;
                                                $SlaPlan = App\Model\Manage\Sla_plan::where('id','=',1)->first();?>
                                                    <b>SLA Plan: {{$SlaPlan->grace_period}} </b> 
                                                </div>
                                                <div class="col-md-3"> 
                                                    <b>Created Date: </b> {{date_format($tickets->created_at, 'd/m/Y H:i:s')}}
                                                </div>
                                                <div class="col-md-3"> 
                                                    <b>Due Date: </b> 
                                                    <?php 
                                                    $time = $tickets->created_at;
                                                    $time = date_create($time);
                                                    date_add($time, date_interval_create_from_date_string($SlaPlan->grace_period));
                                                    echo date_format($time, 'd/m/Y H:i:s');
                                                    ?>
                                                </div>
                                                <div class="col-md-3">
                                                <?php $response = App\Model\Ticket\Ticket_Thread::where('ticket_id','=',$tickets->id)->get();?>
                                                @foreach($response as $last)
                                                <?php $ResponseDate  = $last->created_at; ?>
                                                @endforeach
                                                    <b>Last Response: </b> {{date_format($ResponseDate, 'd/m/Y H:i:s')}} 
                                                </div>
                                            </div>
                                        </div>
                                    </div>      
                                    <div class="col-md-6"> 
                                        <table class="table table-hover">
                                            <!-- <tr><th></th><th></th></tr> -->
                                            <tr><td><b>Status:</b></td>       <?php $status = App\Model\Ticket\Ticket_Status::where('id','=',$tickets->status)->first();?><td title="{{$status->properties}}">{{$status->state}}</td></tr>
                                            <tr><td><b>Priority:</b></td>     <?php $priority = App\Model\Ticket\Ticket_Priority::where('priority_id','=',$tickets->priority_id)->first();?><td title="{{$priority->priority_desc}}">{{$priority->priority}}</td></tr>
                                            <tr><td><b>Department:</b></td>   <?php $help_topic = App\Model\Manage\Help_topic::where('id','=',$tickets->help_topic_id)->first();?><td title="{{$help_topic->topic}}">{{$help_topic->department}}</td></tr>                                            
                                            
                                        </table>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-md-6"> 
                                        <!-- <div class="callout callout-success"> -->
                                        <table class="table table-hover">
                                            <!-- <tr><th></th><th></th></tr> -->
                                            <tr><td><b>Help Topic:</b></td>     <?php $help_topic = App\Model\Manage\Help_topic::where('id','=',$tickets->help_topic_id)->first();?><td title="{{$help_topic->topic}}">{{$help_topic->topic}}</td></tr>
                                            <tr><td><b>Last Message:</b></td>   <td>{{$last->poster}}</td></tr>
                                        </table>
                                    </div>
                                    <!-- </div> -->
                                </section> 
                            </div>
                        </div>

                    </div>



                    <div class='row'>
                        <div class='col-xs-12'>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#General" data-toggle="tab" style="color:#15c315;"><i class="fa fa-reply-all"> </i> Reply</a></li>
                                    
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane active" id="General">
                                        <div id="t1">
                                            {!! Form::open(['route'=>'ticket.reply']) !!}
                                        <div class="form-group">

                                        </div>
                                            <div class="form-group">
                                                <div class="row">
                                                <input type="hidden" name="ticket_ID" value="{{$tickets->id}}">
                                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                        <div class="col-md-2">
                                                            {!! Form::label('To', 'To:') !!}
                                                        </div>
                                                        <div class="col-md-10">
                                                            {!! Form::text('To',$user->email,['class'=>'form-control','style'=>'width:55%'])!!}
                                                            {!! $errors->first('To', '<spam class="help-block text-red">:message</spam>') !!}
                                                        </div>
                                                    </div>
                                                </div>          
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                        <div class="col-md-2">
                                                            {!! Form::label('Reply Content', 'reply_content:') !!}
                                                        </div>
                                                        <div class="col-md-10">
                                                            <textarea name="reply_content"></textarea> 
                                                            {!! $errors->first('reply_content', '<spam class="help-block text-red">:message</spam>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                        <div class="col-md-2">
                                                        
                                                        </div>
                                                        <div class="col-md-10">
                                                            <button  type="submit" class="btn btn-primary"><i class="fa fa-check-square-o" style="color:blue;"> </i> Update</button>            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        {!!Form::close()!!}
                                        </div>

                                        <div id="t2" style="display:none">
                                            {!! Form::open(['route'=>'ticket.reply']) !!}
                                            <div class="form-group">
                                                <button type="submit" id="tt1" class="btn btn-default"><i class="fa fa-check-square-o" style="color:#15c315;"> </i> Update</button>
                                                <button style="display:none;" type="submit" id="tt2" class="btn btn-default"><i class="fa fa-check-square-o" style="color:blue;"> </i> Update</button>
                                                <button type="button" class="btn btn-default"><i class="fa fa-hand-o-right" style="color:orange;"> </i> {!! link_to_route('assign.ticket','Assign') !!}</button>
                                                <button type="button" id="internal" class="btn btn-default"><i class="fa fa-file-text" style="color:blue;"> </i>  Internal Notes</button>
                                                <button type="button" class="btn btn-default"><i class="fa fa-arrows-alt" style="color:red;"> </i>  Surrender</button>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                <input type="hidden" name="ticket_ID" value="{{$tickets->id}}">
                                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                        <div class="col-md-2">
                                                            <label>Subject</label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            {!! Form::text('To',$user->email,['class'=>'form-control','style'=>'width:55%'])!!}
                                                            {!! $errors->first('To', '<spam class="help-block text-red">:message</spam>') !!}
                                                        </div>
                                                    </div>
                                                </div>          
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                        <div class="col-md-2">
                                                            <label>Message</label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <textarea name="reply_content"></textarea> 
                                                            {!! $errors->first('reply_content', '<spam class="help-block text-red">:message</spam>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!!Form::close()!!}
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="Reply" >
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default"><i class="fa fa-mail-forward" style="color:#15c315;"> </i> Send</button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-th-large" style="color:teal;"> </i> Option</button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-file-text" style="color:blue;"> </i> Internal Notes</button>
                                        </div>
                                        <form>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>From</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="from" id="from" style="width:40%" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>To</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="to" id="to" style="width:55%" />
                                                    </div>
                                                </div>      
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Subject</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="from" id="from" style="width:100%" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Response</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <select class="form-control" style="width:55%" >
                                                            <option>Select a canned response</option>
                                                            <option>Original Message</option>
                                                            <option>Last Message</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Reply Content</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea id="txtEditor2"> </textarea>    
                                                    </div>
                                                </div>
                                            </div>
                                        </form>               
                                    </div>
                                </div>

                            </div>
                            <!-- row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <ul class="timeline">
                                        <!-- timeline time label -->
                                        <?php $conversations = App\Model\Ticket\Ticket_Thread::where('ticket_id','=',$tickets->id)->paginate(2);
                                        foreach ($conversations as $conversation) { 
                                        ?>
                                            <li class="time-label">
                                                    <?php 
                                                    $ConvDate1 = $conversation->created_at;
                                                    $ConvDate = explode(' ',$ConvDate1);

                                                    $date = $ConvDate[0];
                                                    $time = $ConvDate[1];
                                                    $time = substr($time, 0, -3);
                                                    if(isset($data) && $date==$data){ 
                                                    } else {
                                                        ?> <span class="bg-#15c315">
                                                        {{date_format($conversation->created_at, 'd/m/Y')}}
                                                        </span> <?php
                                                        $data = $ConvDate[0];
                                                    }
                                                    ?>
                                            </li>
                                            <li>
                                            <?php if($conversation->staff_id > 0) { ?>
                                                <i class="fa fa-group bg-yellow" title="Posted by Support Team"></i>
                                            <?php } elseif($conversation->user_id > 0) { ?>   
                                                <i class="fa fa-user bg-aqua" title="Posted by Customer"></i>
                                            <?php } else { ?>   
                                                <i class="fa fa-mail-reply-all bg-purple" title="Posted by System"></i>
                                            <?php } ?>
                                                <div class="timeline-item">
                                                    <span id="date" class="time"><i class="fa fa-clock-o"> </i> {{date_format($conversation->created_at, 'd/m/Y H:i:s')}}</span>
                                                    <h3 class="timeline-header"><a href="#">{{$conversation->poster}}</a></h3>
                                                    <div class="timeline-body">
                                                    {!! $conversation->body !!}
                                                    </div>
                                                </div>
                                            </li>
                                                    <?php  $lastid = $conversation->id ?>
                                        <?php  } ?>
                                        <li>
                                            <i class="fa fa-clock-o bg-gray"></i>
                                        </li>
                                        <ul class="pull-right">
                                            <?php echo $conversations->setPath( url('/thread/'.'1'))->render(); ?>
                                        </ul>
                                    </ul>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                    </div>
             


<script type="text/javascript">

jQuery(document).ready(function($) {
    $('#close').on('click', function (e) {
        $.ajax({
            type        :   "GET",
            url         :   "http://localhost/faveo/public/ticket/close/{{$tickets->id}}",
            success : function(response) {
                    $( "#refresh" ).load( "http://localhost/faveo/public/thread/{{$tickets->id}}   #refresh");
            }
        })
        return false;
    });

    $('#resolved').on('click', function (e) {
        $.ajax({
            type        :   "GET",
            url         :   "http://localhost/faveo/public/ticket/resolve/{{$tickets->id}}",
            success : function(response) {
                    $( "#refresh" ).load( "http://localhost/faveo/public/thread/{{$tickets->id}}  #refresh");
            }
        })
        return false;
    });

    $('#open').on('click', function (e) {
        $.ajax({
            type        :   "GET",
            url         :   "http://localhost/faveo/public/ticket/open/{{$tickets->id}}",
            success : function(response) {
                    $( "#refresh" ).load( "http://localhost/faveo/public/thread/{{$tickets->id}}   #refresh");
                $('#refresh').load('thread/2 #refresh');
            }
        })
        return false;
    });


});







</script>
@stop

                
                    
                

               