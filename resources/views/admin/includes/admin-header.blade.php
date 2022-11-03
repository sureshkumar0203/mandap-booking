<header class="header navbar navbar-fixed-top" role="banner">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a>
            </li>
        </ul>
        
        <a class="navbar-brand" href="{{ URL::to('administrator/dashboard') }}"><img src="{{ URL::asset('public/images/logo.png') }}" style="height:48px !important;" alt="logo"/> SR <strong>Valley</strong></a>
        
        <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation"> <i class="icon-reorder"></i> </a>
        
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle row-bg-toggle"> <i class="fa fa-arrows-v"></i></a></li>
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-male"></i>&nbsp;Welcome : <span class="username">{{ Session::get('admin_name') }}</span> <i class="fa fa-caret-down"></i> </a>
                
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::to('administrator/my-account') }}"><i class="fa fa-user"></i> My Account</a></li>
                    <li><a href="{{ URL::to('administrator/change-password-admin') }}"><i class="fa fa-key"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ URL::to('administrator/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>            
</header>