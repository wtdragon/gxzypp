@extends('master')
@section('hdsrc')
<link href={{ URL::asset('images/css/sb-admin-2.css') }} rel="stylesheet">
<link href={{ URL::asset('images/css/timeline.css') }} rel="stylesheet">
<script type="text/javascript" src={{ URL::asset('images/metisMenu/dist/metisMenu.js') }}></script>

@stop
	
@section('header')
@stop
@section('content') 
        <div class="col-md-2 navbar-default sidebar slidbar_bg" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                     
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                          <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
@stop
@section('bootor')
@stop