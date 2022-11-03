<div id="minimal-bootstrap-carousel" class="carousel default-home-slider slide carousel-fade shop-slider" data-ride="carousel">
   <div class="carousel-inner" role="listbox">
      @php
      $count_banner =1;
      $banner_data = DB::table('banners')->orderBy('id', 'DESC')->get();
      foreach($banner_data as $banner_det){
      @endphp  
      <div class="item @if($count_banner==1) active @endif slide-{{ $count_banner }}" style="background-image: url({{ asset('public/banners/'.$banner_det->banner_photo) }});backgroudn-position: center right;">
         <div class="carousel-caption nhs-caption nhs-caption6">
            <div class="thm-container">
               <div class="box valign-middle">
                  <div class="content text-center">
                      @if($banner_det->punch_line1!='')
                     <h2 data-animation="animated fadeInUp" class="this-title">{{ $banner_det->punch_line1 }}</h2>
                      @endif
                     @if($banner_det->punch_line2!='')
                     <p data-animation="animated fadeInDown">{{ $banner_det->punch_line2 }}</p>
                     @endif
                     <a data-animation="animated fadeInLeft" href="{{ asset('/booking') }}" class="nhs-btn3">Book now</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @php  $count_banner =$count_banner + 1;  } @endphp
   </div>
   
   
  
   <a class="left carousel-control" href="#minimal-bootstrap-carousel" role="button" data-slide="prev">
   <i class="fa fa-angle-left"></i>
   <span class="sr-only">Previous</span>
   </a>
   <a class="right carousel-control" href="#minimal-bootstrap-carousel" role="button" data-slide="next">
   <i class="fa fa-angle-right"></i>
   <span class="sr-only">Next</span>
   </a>
</div>