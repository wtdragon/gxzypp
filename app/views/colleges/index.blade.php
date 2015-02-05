@extends('master')

@section('header')
  @if(isset($colleges))
    <a href="{{URL::to('/')}}">返回到业务显示页面</a>
  @endif
  <h2>
  	@foreach ($colleges as $college)
 @if(isset($colleges)) {{$college->coid}} @endif
         @endforeach
    @if(Auth::check())
      <a href="{{URL::to('colleges/create')}}" 
         class="btn btn-primary pull-right">
        添加新业务分配
      </a>
    @endif
  </h2>
@stop

@section('content')
  @foreach($colleges as $college)
      <a href="{{URL::to('colleges/'.$college->coid)}}">
        <h1> {{{$college->name}}} </h1>
      </a>
  @endforeach
@stop
