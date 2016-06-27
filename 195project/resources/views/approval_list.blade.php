@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>For Approval</title>
		<!-- Latest compiled and minified CSS -->
		<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
		
		<!-- do not delete: for pop up stuff -->
		<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
        <style>
           
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				display: table;
				font-weight: 100;
				<!-- font-family: 'Lato';-->
			}
			.container{
				overflow:auto;
				padding:0;
			}
			
			/* horizontal line */
					
			hr { 
				display: block;
				margin-top: 0.2em;
				margin-bottom: 0.2em;
				margin-left: auto;
				margin-right: auto;
				border-style: inset;
				border-width: 1px;
			}
			
			/* table */
			
			table{
				table-layout: fixed;
				border: 1px solid #dddddd;
				letter-spacing: 1px;
				width:700px;
			}
			td, th{
				text-align: center;
				padding: 5px;
				border-bottom: 1px solid #dddddd;
			}
			th{
				background-color:#dddddd;
			}
			h4{
				text-align: left !important;
			}			
        </style>
    </head>
    <body>
	<!-- *approval_list.blade.php* -->
	
		<!-- Pop up message when ot/ob request has been approved/denied -->
		<?php
			if (session('approval_list_msg')){
				echo"<br><div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('approval_list_msg')."
					</div>";
			}
		?>
		
		<center>
		<h2 style="margin-top:20px;">View Requests</h1>
		<br><br><br>
		<div class="container">
			<h4>OT Requests</h4>
			
			<!-- Sorting -->
			<p style="text-align: left; padding-bottom:5px;"><label> <a href="/otrequest_sortname">Sort by name </a></label> | <label> <a href="/otrequest_sortteam"> Sort by team  </a></label></p>
			
			<table>
				<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">OT Date</th><th style="text-align: center;">OT Hours</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
				<tr><td>Taylor Swift</td><td>FMIS</td><td>June 16-17</td><td>2</td><td>June 16</td><td>Pending<br><a href="{{ url('/ot_apdetails') }}">View Details</a></td></tr>
				<tr><td>Hayley Williams</td><td>EIS</td><td>Dec 11-13</td><td>1</td><td>Dec 11</td><td>Pending<br><a href="{{ url('/ot_apdetails') }}">View Details</a></td></tr>
				<tr><td>Sooyoung</td><td>SAIS</td><td>Dec 27</td><td>3</td><td>Dec 13</td><td>Pending<br><a href="{{ url('/ot_apdetails') }}">View Details</a></td></tr>
			</table>
			<br><br>
		</div>
		
		<div class="container">
			<h4>OB Requests</h4>
			
			
			<!-- Sorting -->
			<p style="text-align: left; padding-bottom:5px;"><label> <a href="/obrequest_sortname">Sort by name </a></label> | <label> <a href="/obrequest_sortteam"> Sort by team  </a></label></p>
			
			<table>
				<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">OB Date</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
				<tr><td>Taylor Swift</td><td>ITO/Helpdesk</td><td>June 16-17</td><td>June 16</td><td>Pending<br><a href="{{ url('/ob_apdetails') }}">View Details</a></td></tr>
				<tr><td>Hayley Williams</td><td>SAIS OU</td><td>Dec 11-13</td><td>Dec 11</td><td>Pending<br><a href="{{ url('/ob_apdetails') }}">View Details</a></td></tr>
				<tr><td>Sooyoung</td><td>QA</td><td>Dec 27</td><td>Dec 13</td><td>Pending<br><a href="{{ url('/ob_apdetails') }}">View Details</a></td></tr>
			</table>
			<br><br><br><br>
		</div>
		</center>
		
		<script>
			$( document ).ready(function() {
				var width=$( window ).width();
				$(".container").width(width-50);
			});
			$( window ).resize(function() {
				var width=$( window ).width();
				$(".container").width(width-50);
			});
		</script>
		
    </body>
</html>
@endsection
