@extends('laravel-authentication-acl::client.layouts.base-fullscreen')
@section ('title')
注册成功
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 text-center v-center">
        @if($errors->has('token'))
            <h1><i class="fa fa-bolt"></i> 令牌错</h1>
        @elseif($errors->has('email'))
            <h1><i class="fa fa-bolt"></i> 邮件错</h1>
        @else
                <h1><i class="fa fa-thumbs-up"></i> 恭喜，你已经成功注册九子高校匹配系统</h1>
                <p class="lead">你的邮件已经被确认.
                    现在你可以登录 {{link_to('/login','地址')}}</p>
        @endif
        </div>
    </div>
@stop