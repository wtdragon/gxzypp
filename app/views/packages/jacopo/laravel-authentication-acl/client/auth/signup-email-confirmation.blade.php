@extends('laravel-authentication-acl::client.layouts.base-fullscreen')
@section ('title')
注册成功，需激活邮件帐号
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 text-center v-center">

        <h1><i class="fa fa-download"></i> 邮件激活</h1>
        <p class="lead">您的帐户已创建,您在使用之前，需要确认电子邮件地址<br/>
            我们向您发送确认邮件，请检查您的收件箱</p>
    </div>
</div>
@stop