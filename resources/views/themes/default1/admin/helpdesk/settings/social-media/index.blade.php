@extends('themes.default1.admin.layout.admin')
<link href="{{asset("lb-Faveo/css/Faveo-css.css")}}" rel="stylesheet" type="text/css" />
@section('Settings')
active
@stop

@section('settings-bar')
active
@stop

@section('social-login')
class="active"
@stop

@section('HeadInclude')
@stop
<!-- header -->
@section('PageHeader')
<h2></h2>
@stop
<!-- /header -->
<!-- breadcrumbs -->
@section('breadcrumbs')
<ol class="breadcrumb">

</ol>
@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Social Media</h3>
    </div>

    <div class="box-body table-responsive">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- check whether success or not -->
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
            <i class="fa  fa-check-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!!Session::get('success')!!}
        </div>
        @endif
        <!-- failure message -->
        @if(Session::has('fails'))
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <b>{!! Lang::get('lang.alert') !!}!</b>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!!Session::get('fails')!!}
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Provider</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Facebook</td>
                            <td>
                                @if($social->checkActive('facebook')===true)
                                <span style="color: #15c315">Active</span>
                                @else 
                                <span style="color: red">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('social/media/facebook')}}" class="btn btn-primary">Settings</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Google</td>
                            <td>
                                @if($social->checkActive('google')===true)
                                <span style="color: #15c315">Active</span>
                                @else 
                                <span style="color: red">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('social/media/google')}}" class="btn btn-primary">Settings</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Github</td>
                            <td>
                                @if($social->checkActive('github')===true)
                                <span style="color: #15c315">Active</span>
                                @else 
                                <span style="color: red">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('social/media/github')}}" class="btn btn-primary">Settings</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Twitter</td>
                            <td>
                                @if($social->checkActive('twitter')===true)
                                <span style="color: #15c315">Active</span>
                                @else 
                                <span style="color: red">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('social/media/twitter')}}" class="btn btn-primary">Settings</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Linkedin</td>
                            <td>
                                @if($social->checkActive('linkedin')===true)
                                <span style="color: #15c315">Active</span>
                                @else 
                                <span style="color: red">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('social/media/linkedin')}}" class="btn btn-primary">Settings</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Bitbucket</td>
                            <td>
                                @if($social->checkActive('bitbucket')===true)
                                <span style="color: #15c315">Active</span>
                                @else 
                                <span style="color: red">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('social/media/bitbucket')}}" class="btn btn-primary">Settings</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>
@stop
