<div id="sidebar" class="sidebar-fixed">
	<div id="sidebar-content">
      <ul id="nav">
        <li class="current">
            <a href="javascript:void(0);"> <i class="fa fa-text-width"></i> CMS </a>
            <ul class="sub-menu">
              <li><a href="{{ URL::to('administrator/manage-contents') }}" style="margin-left:3px;"> <i class="fa fa-file-text"></i> Manage Contents </a></li>
              
               <li><a href="{{ URL::to('administrator/manage-banners') }}" style="margin-left:3px;"> <i class="fa fa-picture-o"></i> Manage Banners </a></li>
               
               <li><a href="{{ URL::to('administrator/manage-newsletter') }}" style="margin-left:3px;"> <i class="fa fa-picture-o"></i> Manage Newsletter </a></li>
               
               <li><a href="{{ URL::to('administrator/manage-testimonials') }}" style="margin-left:3px;"> <i class="fa fa-picture-o"></i> Manage Testimonials </a></li>
               
               <li><a href="{{ URL::to('administrator/manage-gallery') }}" style="margin-left:3px;"> <i class="fa fa-picture-o"></i> Manage Gallery </a></li>

            </ul>
        </li>
        
       <li class="current">
          <a href="javascript:void(0);"> <i class="fa fa-product-hunt"></i>Mandap Settings</a>
          <ul class="sub-menu">
          
          <li><a href="{{ URL::to('administrator/manage-mandaps') }}" style="margin-left:3px;"> <i class="fa fa-list-alt"></i> Manage Mandaps </a></li>
          <li><a href="{{ URL::to('administrator/payment-setting') }}" style="margin-left:3px;"> <i class="fa fa-money"></i>&nbsp;Payment Settings </a></li>
          
            <li><a href="{{ URL::to('administrator/manage-service-category') }}" style="margin-left:3px;"> <i class="fa fa-list-alt"></i> Manage Service Category </a></li>
            <li><a href="{{ URL::to('administrator/manage-service-sub-category') }}" style="margin-left:3px;"> <i class="fa fa-list-alt"></i> Manage Service Sub Category </a></li>
          </ul>
       </li>
        
       <li class="current">
          <a href="javascript:void(0);"> <i class="fa fa-product-hunt"></i> Customer Management </a>
          <ul class="sub-menu">
            <li><a href="manage-bookings" style="margin-left:3px;"> <i class="fa fa-list-alt"></i> Manage Bookings </a></li>
          </ul>
       </li>
        
        <li class="current">
          <a href="javascript:void(0);"> <i class="fa fa-cog"></i> Settings  </a>
          <ul class="sub-menu">
              <li><a href="{{ URL::to('administrator/my-account') }}"> <i class="fa fa-user"></i>&nbsp;My Accounts </a></li>
              <li><a href="{{ URL::to('administrator/change-password-admin') }}"><i class="fa fa-key"></i>Change Password </a></li>
               <li><a href="{{ URL::to('administrator/manage-seo') }}"> <i class="fa fa-search"></i>&nbsp;Manage Seo </a></li>
               
              <li><a href="{{ URL::to('administrator/logout') }}"> <i class="fa fa-sign-out"></i> Logout </a></li>
          </ul>
        </li>
        
      </ul>
    </div>
    <div id="divider" class="resizeable"></div>
</div>