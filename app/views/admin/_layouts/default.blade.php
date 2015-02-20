@extends('master')
@section('header')
@stop
@section('content')
  <div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="{{ URL::route('admin.pages.index') }}">Learn Laravel 4</a>

      @include('admin._partials.navigation')
      
    </div>
  </div>
@stop
@section('bootor')
@stop