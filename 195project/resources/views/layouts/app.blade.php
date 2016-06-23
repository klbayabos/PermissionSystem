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
.uplogo{
	width:100px;
	height:99px;
}
.left{
	text-align:right;
	padding:20px;
}
.header{
	width:100%;
	height:100px;
	background-color:#7B1113;
	font-family:Arial;
	color:white;
	font-size:35px;
	white-space:nowrap;
	overflow:hidden;
	position:absolute; 
}
.welcome{
	font-family:Times New Roman;
}
ul.topnav {
	list-style-type: none;
    margin: 0;
    margin-top: 100px;
    padding: 0;
    overflow: hidden;
    background-color: #333;
	width:100%;
}
ul.topnav li {float: left;}
ul.topnav li a {
    display: inline-block;
    text-align: center;
	vertical-align:middle;
	line-height:30px;
    padding: 0px 10px 0px 10px;
    text-decoration: none;
    transition: 0.3s;
}
ul.topnav li a:hover {background-color: #111;}
ul.topnav li.icon {display: none;}
@media screen and (max-width:421px) {
	span.welcome{
		font-size:12px;
	}
}
@media screen and (max-width:895px) and (min-width:421px){
	span.welcome{
		font-size:18px;
	}
}
@media screen and (max-width:895px){
	img.uplogo{
		z-index:1;
		position:absolute;
		left: 50%;
		margin-right: -50%;
		transform: translate(-50%, 0%);
	}
	div.header{
		height:100px;
		white-space:normal;
		z-index:0;
		position:absolute;
		white-space:normal;
	}
	span.welcome{
		line-height:100px;
		z-index:2;
		position:absolute;
		left: 50%;
		margin-right: -50%;
		transform: translate(-50%, 0%);
	}
}
@media screen and (max-width:1036px) {
	ul.topnav li:not(:first-child) {display: none;}
	ul.topnav li.icon {
		float: right;
		display: inline-block;
	}
}
@media screen and (max-width:1036px) {
	ul.topnav.responsive {position: relative;}
	ul.topnav.responsive li.icon {
		position: absolute;
		right: 0;
		top: 0;
	}
	ul.topnav.responsive li {
		float: none;
		display: inline;
	}
	ul.topnav.responsive li a {
		display: block;
		text-align: left;
	}
}
</style>
</head>
<body id="app-layout">
	<div class="header">
		<!-- UP LOGO -->
		<img class="uplogo" src="images/uplogo.png" alt="Mountain View">
		<span class="welcome">WELCOME TO THE OT/OB PERMISSION SYSTEM</span>
	@if (Auth::check())			<!-- checks if the user is logged in -->	
		<!-- navbar -->
		<span style="position:absolute;font-size:15px;bottom:0px;right:0px;"> <a href="{{ url('/logout') }}">[Logout]</a></span></div>
			<!--<span style="display: inline-block;vertical-align:middle;line-height:30px;width:100%">-->
			<ul class="topnav">
				<li><a href="{{ url('/overtime') }}">View Overtime Requests</a> </li>
				<li><a href="{{ url('/officialbusiness') }}">View Official Business Requests</a> </li>
				<li><a href="{{ url('/ob_request') }}">File Official Business Request</a> </li>
				<li><a href="{{ url('/ot_request') }}"> File Overtime Request</a> </li>
				<li><a href="{{ url('/aplist') }}"> For Approval</a> </li>
				<li><a href="{{ url('/acc') }}"> Manage Account</a> </li>
				<li class="icon">
					<a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
				</li>
			</ul>
			<script>
				
				function myFunction() {
					document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
				}
			</script>
			<!--</span>-->
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
