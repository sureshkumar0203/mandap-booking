<section class="top-bar dhomev">
  <div class="container">
    <div class="pull-left left-infos contact-infos">
      <ul class="list-inline">
        <li><a href="#"><i class="fa fa-phone"></i> {{ $admin_det[0]->mobile_no }}</a></li>
        <li><a href="#"><i class="fa fa-map-marker"></i> {{ $admin_det[0]->address }}</a></li>
        <li><a href="#"><i class="fa fa-envelope"></i> {{ $admin_det[0]->alt_email }}</a></li>
      </ul>
    </div>
  
    <div class="pull-right right-infos link-list">
      <ul class="list-inline">
        <li><a href="{{ $admin_det[0]->facebook_url }}" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
        <li><a href="{{ $admin_det[0]->twitter_url }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
        <li><a href="{{ $admin_det[0]->linkedin_url }}" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
      </ul>
    </div>
  </div>
</section>



<nav class="navbar navbar-default  _fixed-header _light-header stricky" id="main-navigation-wrapper">
  <div class="container">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false">
       <span class="sr-only">Toggle navigation</span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       </button>
       <a href="{{ url('/') }}" class="navbar-brand"><img alt="Awesome Image" src="{{ asset('public/images/logo.png') }}" class="sticky-logo"></a>
    </div>
    
    <div class="collapse navbar-collapse" id="main-navigation">
       <ul class="nav navbar-nav ">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('about-us') }}">About Us</a></li>
          <li><a href="{{ url('services') }}">Services</a></li>
          <li><a href="{{ url('gallery') }}">Gallery</a></li>
          <li><a href="{{ url('virtual-tour') }}">Virtual Tour</a></li>
          <li><a href="{{ url('booking') }}">Booking</a></li>
          <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
       </ul>
    </div>
  </div>
</nav>