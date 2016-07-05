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
			
			.container{
				max-width:700px;
			}
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
			@media screen and (max-width:700px){
				tr:nth-child(odd) {background: #DDD}
				tr:nth-child(even) {background: #FFF}
				th{
					display:none;
				}
				td{
					display:block;
					border: none;
				}
				table{
					width:100%;
					border: none;
				}
				div.container{
					border: 1px solid #ddd;
					border-radius:10px;
					padding:0px;
					overflow:hidden;
				}
				td:nth-of-type(1):before {
					font-weight:bold;
					content: "Name: ";
				}
				td:nth-of-type(2):before {
					font-weight:bold;
					content: "Team: ";
				}
				td:nth-of-type(3):before {
					font-weight:bold;
					content: "Date Requested: ";
				}
				td:nth-of-type(4):before {
					font-weight:bold;
					content: "Date Submitted: ";
				}
				td:nth-of-type(5):before {
					font-weight:bold;
					content: "Status: ";
				}
			}
			@media screen and (max-width:400px){
				td{
					font-size:10px;
				}
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
		<h2 style="margin-top:20px;">Requests for Approval</h1>
		<br><br><br>
	
		@if($obs != null)
			<h4>Official Business Requests</h4>
			<!-- Sorting -->
			<p style="text-align: left; padding-bottom:5px;"><label> <a href="/obrequest_sortname">Sort by name </a></label> | <label> <a href="/obrequest_sortteam"> Sort by team  </a></label></p>
			<div class="container" style="padding:0;">
				<table>
					<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">OB Date</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
					@foreach($obs as $obs)
						<tr><td>{{ $obs->name }}</td><td>{{ $obs->team }}</td><td>{{ date("m/d/Y", strtotime($obs->starting_date)) }} - {{ date("m/d/Y", strtotime($obs->end_date)) }}</td><td>{{ date("m/d/Y", strtotime($obs->created_at)) }}</td><td>{{ $obs->state }}<br><a href="/ob_apdetails/{{ $obs->request_id }}">View Details</a></td></tr>
					@endforeach
				</table>
			</div>
			<br><br>
		@endif
		
		@if($ots != null)
			<h4>Overtime Requests</h4>
			<!-- Sorting -->
			<p style="text-align: left; padding-bottom:5px;"><label> <a href="/otrequest_sortname">Sort by name </a></label> | <label> <a href="/otrequest_sortteam"> Sort by team  </a></label></p>
			
			<div class="container" style="padding:0;">
				<table>
					<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">Overtime Date</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
					@foreach($ots as $ots)
						<tr><td>{{ $ots->name }}</td><td>{{ $ots->team }}</td><td>{{ date("m/d/Y", strtotime($ots->starting_date)) }} - {{ date("m/d/Y", strtotime($ots->end_date)) }}</td><td>{{ date("m/d/Y", strtotime($ots->created_at)) }}</td><td>{{ $ots->state }}<br><a href="/ot_apdetails/{{ $ots->request_id }}">View Details </a></td></tr>
					@endforeach
				</table>
			</div>
		<br><br>
		@endif
		
		@if($ons != null)
			<h4>Overnight Requests</h4>
			<!-- Sorting -->
			<p style="text-align: left; padding-bottom:5px;"><label> <a href="/onrequest_sortname">Sort by name </a></label> | <label> <a href="/onrequest_sortteam"> Sort by team  </a></label></p>
			<div class="container">
				<table>
					<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">Overnight Date</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
					@foreach($ons as $ons)
						<tr><td>{{ $ons->name }}</td><td>{{ $ons->team }}</td><td>{{ date("m/d/Y", strtotime($ons->starting_date)) }} - {{ date("m/d/Y", strtotime($ons->end_date)) }}</td><td>{{ date("m/d/Y", strtotime($ons->created_at)) }}</td><td>{{ $ons->state }}<br><a href="/on_apdetails/{{ $ons->request_id }}">View Details</a></td></tr>
					@endforeach
				</table>
			</div>
			<br><br>
		@endif
		
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
