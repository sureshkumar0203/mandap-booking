@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop
@section('content')
<section class="row final-inner-header" style="background: url({{ asset('public/images/inner-header-contact.jpg') }}) no-repeat scroll center bottom;">
  <div class="container">
      <h2 class="this-title">Contact</h2>
  </div>
</section>

<section class="clearfix common-pad booknow">
  <div class="container">
    <div class="sec-header3">
      <h2>Send a message
        
          @if (Session::has('success'))
          <span style="color:#008000; padding-left:80px; font-size:24px;">Your message has been send successfully.</span>
          @endif
          
          @if (Session::has('blank'))
          <span style="color:#f00; padding-left:80px; font-size:24px;">Please enter all *marked controls value.</span>
          @endif
          
      
      </h2>
      <!--<h3>Pick a room that best suits your taste and budget</h3>-->
    </div> 
          
    <div class="row nasir-contact">
      <div class="col-md-7">
        <div class="book-left-content input_form">
          {{ Form::open(array('url' => 'contact-us', 'role' => 'form', 'class' =>'contact-form', 'name' => 'contact_form', 'id' => 'contact_form','files'=>false, 'autocomplete' => 'off','onsubmit' => '')) }}
            <div class="row">   
                <div class="col-lg-6 col-md-6 col-sm-12 m0 col-xs-12">
                   <span>Subject*</span>
                   {!! Form::text('subject',old('subject'), array('id' => 'subject','required','class'=>'form-control','placeholder'=>'Subject','autocomplete' => 'off')) !!}
                </div>
                 
                <div class="col-lg-6 col-md-6 col-sm-12 m0 col-xs-12">
                    <span>Nmae*</span>
                    {!! Form::text('full_name',old('full_name'), array('id' => 'full_name','required','class'=>'form-control','placeholder'=>'Name','autocomplete' => 'off')) !!}
                </div>
            </div>  
              
            <div class="row">   
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <span>Email*</span>
                {!! Form::email('user_email',old('user_email'), array('id' => 'user_email','required','class'=>'form-control','placeholder'=>'Email Address','autocomplete' => 'off')) !!}
              </div>
            </div>
              
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <span>Message*</span>
                {!! Form::textarea('your_message','',array('id' => 'your_message','required','class'=>'form-control','size' => '30x4','placeholder'=>'Message')) !!}
              </div>
            </div>
     
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  {{ Form::submit('Send Message', array('id'=>'btn_submit','class' => 'res-btn')) }}
                </div>
            </div>
          {{ Form::close() }}

        
          
         
                  
                  
        </div>
      </div>
      
      
      <div class="col-md-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3743.0332432171117!2d85.86973731429514!3d20.257456019037264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19a0c1acfdce53%3A0x65319b60200b422!2sSR+VALLEY+WEDDING+VENUE!5e0!3m2!1sen!2sin!4v1528365515543"  height="500" frameborder="0" style="border:0; width:100%;" allowfullscreen></iframe>
      </div>  
    </div>
  </div>
</section>
@stop