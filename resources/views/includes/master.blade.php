<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>@yield('title')</title>
	  <meta name="keywords" content="@yield('keywords')">
	  <meta name="description" content="@yield('description')">

      <!-- reponsive meta -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- Bootstrap -->
      <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('public/css/font-awesome.min.css') }}" rel="stylesheet">

      <!-- strock gap icons -->
      <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}">
      <!-- owl-carousel-->
      <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.css') }}">

      <!-- Main Css  -->
      <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">

      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/images/favicon-16x16.png') }}">
      <script src="{{ asset('public/js/jquery.min.js') }}"></script>
      


   </head>
<body>
@include('includes.header')   		
  
  @yield('content')
  
@include('includes.footer')


<script>
$(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});
</script>

<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.fancybox.pack.js') }}"></script> 
<script src="{{ asset('public/js/custom.js') }}"></script>
<script src="{{ asset('public/js/custom-validation.js') }}"></script> 



<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?5vXa5QwuV7PCxqrkkiAY0EW3xmdZpYPg";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->


</body>
</html>