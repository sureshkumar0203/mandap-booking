@extends('admin.includes.master')
@section('title') {{ 'Admin Panel' }} @stop
@section('content')
  <div class="logo">
    <!-- <br><img src="{{ asset('public/images/logo.png') }}" alt="logo" /><br> -->
    <strong>Admin</strong>Panel
  </div>
  
  <div class="box">
    <div class="content">
      <h3 class="form-title" style="margin:0;">Forgot Password</h3>
      
      <div style="height:30px;">
        <span style="color:#F00;display:block;font-size:13px;">
         @if(Session::has('blank')) Please enter your email address. @endif	
        </span>
        
        <span style="color:#F00;display:block;font-size:13px;">
         @if(Session::has('invalid'))Invalid email address. @endif	
        </span>
        
        <span style="color:#060;display:block;font-size:13px;">
         @if(Session::has('success')) Your password has been send yo your email. @endif	
        </span>
        
        <span style="color:#F00;display:block;font-size:13px;">
         @if(Session::has('failed'))Mail sending failed. @endif	
        </span>
      </div>
      
      {{ Form::open(array('url' => 'admin-forgot-psw-process', 'role' => 'form', 'class' =>'form-vertical login-form', 'autocomplete' => 'off')) }}  
      
      <div class="form-group">
          <div class="input-icon">
              <i class="icon-user"></i>
              {!! Form::email('forgot_email', null, array('id' => 'forgot_email','required', 'class'=>'form-control','placeholder'=>'Please enter your email*')) !!}
          </div>
      </div>
                          
      
                         
      <div class="form-actions">
          <a href="{{ URL::to('administrator') }}">Click here to login</a>
          {{ Form::submit('Submit', array('class' => 'btn submit btn btn-primary pull-right')) }}
          <i class="icon-angle-right"></i>
      </div> 
    
     {{ Form::close() }}
    
    </div>
  </div>
  
@stop