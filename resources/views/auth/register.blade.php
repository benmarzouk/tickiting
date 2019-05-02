@extends('themes.default1.client.layout.logclient')


@section('home')
    class = "active"
@stop

@section('HeadInclude')
<link href="{{asset("lb-faveo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet" type="text/css" />
           <link href="{{asset("lb-faveo/css/widgetbox.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("lb-faveo/plugins/iCheck/flat/blue.css")}}" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        {{-- <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> --}}
        <link href="{{asset("lb-faveo/css/jquerysctipttop.css")}}" rel="stylesheet" type="text/css">
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
@stop

@section('breadcrumb')
    <div class="site-hero clearfix">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="text">{!! Lang::get('lang.you_are_here') !!}: </li>
            <li><a href="{!! URL::route('/') !!}">{!! Lang::get('lang.home') !!}</a></li>
        </ol>
    </div>
@stop
@section('content')
@if(Session::has('status'))
<div class="alert alert-success alert-dismissable">
    <i class="fa  fa-check-circle"> </i> <b> {!! Lang::get('lang.success') !!} </b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{Session::get('status')}}
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <b>{!! Lang::get('lang.alert') !!} !</b>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif
<div id="content" class="site-content col-md-12">
    <div id="corewidgetbox">
        <div class="widgetrow text-center">
        @if(Auth::user())
        @else
            <span onclick="javascript: window.location.href='{{url('auth/login')}}';">
                <a href="{{url('auth/login')}}"  style="background-image:url({{ URL::asset('lb-faveo/media/images/register.png') }})">
                    <span class="widgetitemtitle">{!! Lang::get('lang.login') !!}</span>
                </a>
            </span>
        @endif
        <?php $system = App\Model\helpdesk\Settings\System::where('id', '=', '1')->first();            
        ?>
        @if($system != null) 
            @if($system->status) 
                @if($system->status == 1)
                    <span onclick="javascript: window.location.href='{!! URL::route('form') !!}';">
                        <a href="{!! URL::route('form') !!}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/submitticket.png') }})">
                            <span class="widgetitemtitle">{!! Lang::get('lang.submit_a_ticket') !!}</span>
                        </a>
                    </span>
                @endif
            @endif
        @endif
            <span onclick="javascript: window.location.href='{{url('mytickets')}}';">
                <a href="{{url('mytickets')}}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/news.png') }})">
                    <span class="widgetitemtitle">{!! Lang::get('lang.my_tickets') !!}</span>
                </a>
            </span>
            <span onclick="javascript: window.location.href='{{url('/knowledgebase')}}';">
                <a href="{{url('/knowledgebase')}}" class="widgetrowitem defaultwidget" style="background-image:url({{ URL::asset('lb-faveo/media/images/knowledgebase.png') }})">
                    <span class="widgetitemtitle">{!! Lang::get('lang.knowledge_base') !!}</span>
                </a>
            </span>
        </div>
    </div>

     <div class="login-box" style=" width: 500px;"  valign = "center">
 <div class="form-border">
     
                <div align="center">
                 <h4 style="background-color: #0084b4;"> <a href="http://www.faveohelpdesk.com" class="logo"><img src="{{ asset('lb-faveo/media/images/logo.png')}}" width="100px;"></a>
                 </h4>
                  
                </div>
               
                <div>
 <h3 class="box-title" align="center">{{Lang::get('lang.registration')}}</h3>
                  
                </div>   
                <div>
<placeholder="Let’s set up your account in just a couple of steps.">
                  
                </div>       
    <!-- form open -->
{!!  Form::open(['action'=>'Auth\AuthController@postRegister', 'method'=>'post']) !!}

<!-- fullname -->
<div class="form-group has-feedback {{ $errors->has('full_name') ? 'has-error' : '' }}">
            
 {!! Form::text('full_name',null,['placeholder'=>Lang::get('lang.full_name'),'class' => 'form-control']) !!}
 <span class="glyphicon glyphicon-user form-control-feedback"></span>

</div>
<!-- Email -->
@if (($email_mandatory->status == 1 || $email_mandatory->status == '1'))
<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::text('email',null,['placeholder'=>Lang::get('lang.email'),'class' => 'form-control']) !!}
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
@elseif (($settings->status == 0 || $settings->status == '0') && ($email_mandatory->status == 0 || $email_mandatory->status == '0'))
<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::text('email',null,['placeholder'=>Lang::get('lang.email'),'class' => 'form-control']) !!}
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
@else
    {!! Form::hidden('email', null) !!}
@endif
@if($settings->status == '1' || $settings->status == 1)
<div class='row'>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
        {!! Form::text('code',null,['placeholder'=>91,'class' => 'form-control']) !!}
        </div>    
    </div>
    <div class="col-md-9">
        <div class="form-group has-feedback {{ $errors->has('mobile') ? 'has-error' : '' }}">
        {!! Form::text('mobile',null,['placeholder'=>Lang::get('lang.mobile'),'class' => 'form-control']) !!}
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        </div>
    </div>
</div>
@else
    {!! Form::hidden('mobile', null) !!}
    {!! Form::hidden('code', null) !!}

@endif
<!-- Password -->
<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
           
    {!! Form::password('password',['placeholder'=>Lang::get('lang.password'),'class' => 'form-control']) !!}
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

</div>
<!-- Confirm password -->
<div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
           
    {!! Form::password('password_confirmation',['placeholder'=>Lang::get('lang.retype_password'),'class' => 'form-control']) !!}
    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

</div>
   

  

    <div >
        <button type="submit" class="btn btn-primary btn-block btn-flat">{!! Lang::get('lang.register') !!}</button>
    </div>

        <div>
        <div class="checkbox icheck" align="center">
            <label>
               Already got an account? <a href="{{url('auth/login')}}" class="text-center">{!! Lang::get('lang.login') !!}</a>                
            </label>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('themes.default1.client.layout.social-login')
            </div>
        </div>
    </div><!-- /.col --> </div>
</div>
</div>
{!! Form::close()!!}  

@stop
