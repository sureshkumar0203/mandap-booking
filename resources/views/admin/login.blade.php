@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
  <div class="logo">
     <!--  <br><img src="{{ asset('public/images/logo.png') }}" alt="logo" /><br> -->
      <strong>Admin</strong>Panel
  </div>
  
    <div class="box">
      <div class="content">
        <h3 class="form-title" style="margin:0;">Sign In to your Account</h3>
        
        <span style="color:#F00;display:block;height:30px; padding-top:8px; font-size:11px;">
           @if(Session::has('invalid')) Invalid Username / Password. @endif	
        </span>
       {{ Form::open(array('url' => 'admin-login', 'role' => 'form', 'class' =>'form-vertical login-form', 'autocomplete' => 'off')) }}  
       
       <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                {!! Form::email('email', null, array('id' => 'email','required', 'class'=>'form-control','placeholder'=>'Username*')) !!}
            </div>
        </div>               
        <div class="form-group">
            <div class="input-icon">
              <i class="fa fa-key"></i>
               {!! Form::password('password',  array('id' => 'password','required', 'class'=>'form-control', 'placeholder' => 'Password*')) !!}
            </div>
        </div>           
        <div class="form-actions">
            <a href="{{ URL::to('administrator/forgot-psw-admin') }}">Forgot Password?</a>
            {{ Form::submit('Sign In', array('class' => 'btn submit btn btn-primary pull-right')) }}
        </div>
       {{ Form::close() }}
      </div>
    </div>
@stop