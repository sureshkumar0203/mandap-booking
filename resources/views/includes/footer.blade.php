<footer>
  <section class="clearfix footer-wrapper">
    <section class="container clearfix footer-pad">
       <div class="col-lg-6 col-md-6">
          <div class="sec-header-two">
             <h2>Testimonials</h2>
          </div>
          
          <div class="testimonials-wrapper">
             <div class="testimonial-sliders-two">
                @foreach($tm_det as $tm_dtls)
                <div class="item">
                   <div class="test-cont">
                      <p>{{ $tm_dtls->tm_det }}</p>
                   </div>
                   
                   <div class="test-bot">
                      <div class="tst-img"><img src="{{ asset('public/testimonial-photo/thumb/'.$tm_dtls->tm_photo) }}" alt="" class="img-responsive"></div>
                      <div class="client_name">
                         <h5>{{ $tm_dtls->tm_user_name }}</h5>
                      </div>
                   </div>
                </div>
                @endforeach
             </div>
          </div>
       </div>
       
       <div class="widget widget-links col-md-2 col-sm-6">
          <h4 class="widget_title">Quick Links</h4>
          <div class="widget-contact-list">
             <ul>
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
       
       <div class="widget get-in-touch col-md-4 col-sm-6">
          <h4 class="widget_title">Get In Touch</h4>
          <div class="widget-contact-list">
             <ul>
                <li>
                   <i class="fa fa-map-marker"></i>
                   <div class="fleft location_address">
                      <b>SR Valley</b><br>{{ $admin_det[0]->address }}  
                   </div>
                </li>
                
                <li>
                   <i class="fa fa-phone"></i>
                   <div class="fleft contact_no">
                      <a href="tel:{{ $admin_det[0]->mobile_no }}">{{ $admin_det[0]->mobile_no }}</a>  /  <a href="tel:{{ $admin_det[0]->contact_no }}">{{ $admin_det[0]->contact_no }}</a>
                   </div>
                </li>
                
                <li>
                   <i class="fa fa-envelope-o"></i>
                   <div class="fleft contact_mail">
                      <a href="mailto:{{ $admin_det[0]->alt_email }}">{{ $admin_det[0]->alt_email }}</a>
                   </div>
                </li>
                
                <li><a href="{{ $admin_det[0]->facebook_url }}" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                <li><a href="{{ $admin_det[0]->twitter_url }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="{{ $admin_det[0]->linkedin_url }}" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
             </ul>
          </div>
       </div>
       
    </section>
  </section>
  
  <section class="container clearfix footer-b-pad">
    <div class="footer-copy">
       <div class="pull-left fo-txt">
          <p>Copyright © SR Valley {{ date("Y") }}. All rights reserved. </p>
       </div>
       <div class="pull-right fo-txt">
          <p>Designed by: <a href="https://www.bletechnolabs.com/" target="_blank">BLET</a></p>
       </div>
    </div>
  </section>
</footer>