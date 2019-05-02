@extends('themes.default1.agent.layout.agent')

@section('Users')
class="active"
@stop

@section('user-bar')
active
@stop

@section('user')
class="active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h1>{{Lang::get('lang.user_directory')}}</h1>
@stop
<!-- /header -->
<!-- breadcrumbs -->
@section('breadcrumbs')
<ol class="breadcrumb">
</ol>
@stop
<!-- /breadcrumbs -->
<!-- content -->
@section('content')
<!-- open a form -->
<div class="box box-primary">



    <div class="box-header with-border">
        <div class="row">
        <div>
            <div class="col-md-6">
                <h3 class="box-title ">{{Lang::get('lang.user')}}</h3>                
            </div>
            <div class="col-md-6">
                <div class="col-md-5">
                    <div class="box-tools" style="width: 235px">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" id="search-text" name="search" placeholder="{{Lang::get('lang.search')}}" style="height:30px">
                            <span class="fa fa-search form-control-feedback"></span>
                        </div>
                    </div><!-- /.box-tools -->
                </div>
                <div class="col-md-7">
                    <div class="pull-right">
                    <div id="labels-div" class="btn-group">
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" id="labels-button"><i class="fa fa-eye" style="color:teal;">&nbsp;</i>{{Lang::get('lang.view-option')}}<span class="caret"></span>
                        </button>
                        <ul  class="dropdown-menu role="menu">
                            <li class="active"><a href="#" class="all">{{Lang::get('lang.all-users')}}</a></li>
                            <li><a href="#" class="agents">{{Lang::get('lang.only-agents')}}</a></li>
                            <li><a href="#" class="users">{{Lang::get('lang.only-users')}}</a></li>
                            <li><a href="#" class="active-users">{{Lang::get('lang.active-users')}}</a></li>
                            <li><a href="#" class="inactive">{{Lang::get('lang.inactive-users')}}</a></li>
                            <li><a href="#" class="deleted">{{Lang::get('lang.deleted-users')}}</a></li>
                            <li><a href="#" class="banned">{{Lang::get('lang.banned-users')}}</a></li>
                        </ul>
                    </div>
                    <a href="{{url('user-export')}}" class="btn btn-default btn-sm ">Export</a>
                    <a href="{{route('user.create')}}" class="btn btn-primary btn-sm">{{Lang::get('lang.create_user')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">
        <!-- check whether success or not -->
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
            <i class="fa  fa-check-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('success')}}
        </div>
        @endif
        <!-- failure message -->
        @if(Session::has('warning'))
        <div class="alert alert-warning alert-dismissable">
            <i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b>{!! Lang::get('lang.alert') !!} !</b>            
            {{Session::get('warning')}}
        </div>
        @endif
        <!-- failure message -->
        @if(Session::has('fails'))
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <b>{!! Lang::get('lang.alert') !!} !</b>            
            {{Session::get('fails')}}
        </div>
        @endif
        {!!$table->render('vendor.Chumper.template')!!}
    </div>
</div>





{!! $table->script('vendor.Chumper.user-javascript') !!}
@stop
<!-- /content -->