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
		white-space:nowrap;
		font-family:Times New Roman;
	}
	ul.topnav {
		list-style-type: none;
		margin: 0;
		margin-top: 100px;
		padding: 0;
		overflow: hidden;
		width:100%;
		background: rgb(38,35,35); /* Old browsers */
		background: -moz-linear-gradient(top,  rgba(38,35,35,1) 0%, rgba(63,59,59,1) 44%, rgba(10,14,10,1) 53%, rgba(10,8,9,1) 100%); /* FF3.6-15 */
		background: -webkit-linear-gradient(top,  rgba(38,35,35,1) 0%,rgba(63,59,59,1) 44%,rgba(10,14,10,1) 53%,rgba(10,8,9,1) 100%); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom,  rgba(38,35,35,1) 0%,rgba(63,59,59,1) 44%,rgba(10,14,10,1) 53%,rgba(10,8,9,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#262323', endColorstr='#0a0809',GradientType=0 ); /* IE6-9 */

	}
	ul.topnav li {
		float: left;
	}
	ul.topnav li a {
		display: inline-block;
		text-align: center;
		vertical-align:middle;
		line-height:40px;
		padding: 0px 10px 0px 10px;
		text-decoration: none;
		transition: 0.3s;
		color:white;
	}
	ul.topnav li a:hover {
		background: -moz-radial-gradient(at 50% bottom,  rgba(30,87,153,1) 0%, rgba(125,185,232,0) 70%); /* FF3.6-15 */
		background: -webkit-radial-gradient(at 50% bottom, rgba(30,87,153,1) 0%,rgba(125,185,232,0) 70%); /* Chrome10-25,Safari5.1-6 */
		background: radial-gradient(at 50% bottom, rgba(30,87,153,1) 0%,rgba(125,185,232,0) 70%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#007db9e8',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
	}
	div.header,ul.topnav{
	}
	ul.topnav li.icon {display: none;}
	@media screen and (max-width:460px) {
		span.welcome{
			font-size:11px;
		}
	}
	@media screen and (max-width:995px) and (min-width:460px){
		span.welcome{
			font-size:18px;
		}
	}
	@media screen and (max-width:995px){
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
			-webkit-text-stroke: 0.3px black;
			color: white;
			text-shadow:
				1px 1px 0 #000,
		}
	}
	.footable-detail-row table,.footable-detail-row tr,.footable-detail-row td,.footable-detail-row th{
		width:auto;
		border:0 !important;
		text-align:left !important;
		padding:3px !important;
	}
	.footable-detail-row th{
		font-weight:normal;
		background-color:white;
	}
	.button {
		border:2px solid #207cca;
		background-color:#207cca;
		color:#fafafa;
		margin-bottom: 40px;
	}
	.button:hover  {
		background-color:#fafafa;
		color:#207cca;
	}
</style>
	<script type="text/javascript" src="{{ URL::asset('js/j1/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/j1/bootstrap.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css') }}">
	<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/momentjs/latest/moment.min.js') }}"></script>
</head>
<body id="app-layout">
	<div class="header">
		<!-- UP LOGO -->
		<img class="uplogo" src="{{ URL::asset('images/uplogo.png') }}" alt="UPview">
		<span class="welcome">WELCOME TO THE UP OBOTON PERMISSION SYSTEM</span>
	@if (Auth::check())			<!-- checks if the user is logged in -->	
		<!-- navbar -->
		<span style="position:absolute;font-size:15px;bottom:4px;right:8px;padding:.1em;z-index:2"> <a style="color:white" href="{{ url('/logout') }}"> [ Logout ] </a></span></div>
			<ul class="topnav">
			{{-- @if (Auth::user()->type_id == 8 || Auth::user()->type_id == 7 || Auth::user()->type_id == 6  || Auth::user()->type_id == 3 || Auth::user()->type_id == 2 || Auth::user()->type_id == 4) --}} <!-- if employee/team leader/hr/admin/oic/approver -->
					<li><a href="{{ url('/officialbusiness') }}">View Official Business Requests</a></li>
					<li><a href="{{ url('/overtime') }}">View Overtime Requests</a></li>
					<li><a href="{{ url('/overnight') }}">View Overnight Requests</a></li>
					<li><a href="{{ url('/ob_request') }}">File Official Business Request</a></li>
					<li><a href="{{ url('/ot_request') }}"> File Overtime Request</a></li>
					<li><a href="{{ url('/on_request') }}"> File Overnight Request</a></li>
			{{-- @endif --}}
				
			{{-- @if (Auth::user()->type_id == 1 || Auth::user()->type_id == 2 || Auth::user()->type_id == 4 || Auth::user()->type_id == 5 || Auth::user()->type_id == 7) --}} <!-- if Head/OIC/approver/supervisor/team leader-->
				<li><a href="{{ url('/aplist') }}"> For Approval</a></li>
			{{-- @endif --}}
				
			{{-- @if (Auth::user()->type_id == 1 || Auth::user()->type_id == 3 || Auth::user()->type_id == 6) --}} <!-- if Head of Unit/admin/HR -->
				<li><a href="{{ url('/acc') }}"> Manage Account</a></li>
			{{-- @endif --}}
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
	<!--
		Translate to jquery
	-->
	<script>
		$( document ).ready( function(){
			var user_id="{{ Auth::user()->type_id }}";
			if(user_id == 1)
				width=240;
			else if(user_id == 3||user_id == 6||user_id == 7)
				width=1260;
			else if(user_id == 4){
				width=1235;
			}
			else if(user_id == 8){
				width=1130;
			}
			document.querySelector('style').textContent +=`@media screen and (max-width:` + width + `px){
			ul.topnav li:not(:first-child){
				display: none;
			}
			ul.topnav li.icon {
				float: right;
				display: inline-block;
			}
			ul.topnav li a:hover {
				background: -moz-radial-gradient(at left 60%, ellipse cover,  rgba(30,87,153,1) 0%, rgba(125,185,232,0) 48%);
				background: -webkit-radial-gradient(at left 60%, ellipse cover,  rgba(30,87,153,1) 0%,rgba(125,185,232,0) 48%);
				background: radial-gradient(ellipse at left 60%,  rgba(30,87,153,1) 0%,rgba(125,185,232,0) 48%);
			}
			ul.topnav{
				background: rgb(69,72,77);
				background: -moz-linear-gradient(top,  rgba(69,72,77,1) 2%, rgba(0,0,0,1) 100%);
				background: -webkit-linear-gradient(top,  rgba(69,72,77,1) 2%,rgba(0,0,0,1) 100%);
				background: linear-gradient(to bottom,  rgba(69,72,77,1) 2%,rgba(0,0,0,1) 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45484d', endColorstr='#000000',GradientType=0 );
			}
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
			}}`
		});
	</script>
	

    @yield('content')
	
	<!-- CALENDAR -->
	
	
    
	
	<!-- JavaScripts 
	
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js') }}" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js') }}" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}	-->


	
</body>
</html>
