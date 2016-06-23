@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>For Approval</title>
		<!-- Latest compiled and minified CSS -->
		<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		
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
		*approval_list.blade.php*
		<center>
		<br><br><h1>View Requests</h1><hr>
		<br><br><br>
		<div class="container">
			<h4>OT Requests<hr></h4>
			<table>
				<tr><th style="text-align: center;">Name</th><th style="text-align: center;">OT Date</th><th style="text-align: center;">OT Hours</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
				<tr><td>Taylor Swift</td><td>June 16-17</td><td>2</td><td>June 16</td><td>Pending<br><a href="{{ url('/ot_apdetails') }}">View Details</a></td></tr>
				<tr><td>Hayley Williams</td><td>Dec 11-13</td><td>1</td><td>Dec 11</td><td>Pending<br><a href="{{ url('/ot_apdetails') }}">View Details</a></td></tr>
				<tr><td>Sooyoung</td><td>Dec 27</td><td>3</td><td>Dec 13</td><td>Pending<br><a href="{{ url('/ot_apdetails') }}">View Details</a></td></tr>
			</table>
			<br><br>
		</div>
		<div class="container">
			<h4>OB Requests<hr></h4>
			<table>
				<tr><th style="text-align: center;">Name</th><th style="text-align: center;">OB Date</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
				<tr><td>Taylor Swift</td><td>June 16-17</td><td>June 16</td><td>Pending<br><a href="{{ url('/ob_apdetails') }}">View Details</a></td></tr>
				<tr><td>Hayley Williams</td><td>Dec 11-13</td><td>Dec 11</td><td>Pending<br><a href="{{ url('/ob_apdetails') }}">View Details</a></td></tr>
				<tr><td>Sooyoung</td><td>Dec 27</td><td>Dec 13</td><td>Pending<br><a href="{{ url('/ob_apdetails') }}">View Details</a></td></tr>
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
