<!DOCTYPE html>
<html lang="en">
<head>
<style>
	h3 {
		display: block;
		font-size: 1.17em;
		-webkit-margin-before: 1em;
		-webkit-margin-after: 1em;
		-webkit-margin-start: 0px;
		-webkit-margin-end: 0px;
		font-weight: bold;
	}
	
	.left{
		text-align:right;
		padding:20px;
	}
	
	
</style>
</head>
<body id="app-layout">
	<div class="header" style="width:100%;height:100px;background-color:#7B1113;font-family:Arial;color:white;font-size:35px;white-space:nowrap;overflow:hidden;position:absolute;">
		<!-- UP LOGO -->
		<img src="images/uplogo.png" alt="Mountain View" style="width:100px;height:99px;">
		<span>WELCOME TO THE OT/OB PERMISSION SYSTEM</span>
	@if (Auth::check())			<!-- checks if the user is logged in -->	
		<!-- navbar -->
		<span style="position:absolute;font-size:15px;bottom:8px;right:0px;padding-right:8px;"><a href="{{ url('/logout') }}">[Logout]</a></span></div>
		<div style="display:inline-block;background-color:gray;color:white;height:30px;width:100%;overflow:auto;margin-top:100px;">
			<span style="display: inline-block;vertical-align:middle;line-height:30px;width:100%">
			Navigation:
			<a href="{{ url('/overtime') }}">View Overtime Requests</a> | 
			<a href="{{ url('/officialbusiness') }}">View Official Business Requests</a> | 
			<a href="{{ url('/ob_request') }}">File Official Business Request</a> | 
			<a href="{{ url('/ot_request') }}"> File Overtime Request</a> | 
			<a href="{{ url('/aplist') }}"> For Approval</a> | 
			<a href="{{ url('/acc') }}"> Manage Account</a> | 
			
			</span>
		</div>
	@else
		</div>
	@endif
	
	

    @yield('content')
	
	<!-- CALENDAR -->
	
	<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css') }}">
	
    
	
	<!-- JavaScripts 
	
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js') }}" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js') }}" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}	-->


	
</body>
</html>
