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
</style>
</head>
<body id="app-layout">
	<div class="header" style="width:100%;height:100px;background-color:#7B1113;font-family:Arial;color:white;font-size:35px;white-space: nowrap;overflow:hidden;">
		<!-- UP LOGO -->
		<img src="images/uplogo.png" alt="Mountain View" style="width:100px;height:99px;">
		WELCOME TO THE OT/OB PERMISSION SYSTEM
	</div>
	@if (Auth::check())
		<!-- navbar -->
		<div style="display:inline-block;background-color:gray;color:white;height:30px;width:100%;overflow:auto;">
			<span style="display: inline-block;vertical-align:middle;line-height:30px;width:100%">
			Navigation:
			<a href="{{ url('/overtime') }}">View Overtime Requests</a> | 
			<a href="{{ url('/officialbusiness') }}">View Official Business Requests</a> | 
			<a href="{{ url('/ob_request') }}">Make Official Business Request</a> | 
			<a href="{{ url('/ot_request') }}"> Make Overtime Request</a> | 
			<a href="{{ url('/aplist') }}"> For Approval</a> | 
			<a href="{{ url('/acc') }}"> Manage Account</a> | 
			</span>
		</div>
	@endif
	
	

    @yield('content')
	
	<!-- CALENDAR -->
	
	<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/jquery/1/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/momentjs/latest/moment.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css') }}">
	
	<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css') }}">
    
	
	<!-- JavaScripts --
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

	-->
	
</body>
</html>
