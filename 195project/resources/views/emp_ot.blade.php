@extends('layouts.app')

@section('content')
<html>
<head>
    <title>View OT</title>
	<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
	 
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
		table{
			border: 1px solid #dddddd;
			table-layout: fixed;
			border-collapse:collapse;
			width:700px;
		}
		td, th{
			border-bottom: 1px solid #dddddd;
			text-align:center;
		}
		.container{
			max-width:700px;
		}
		th{
			background-color:#dddddd;
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
				overflow:hidden;
			}
			td:nth-of-type(1):before {
				font-weight:bold;
				content: "Date Requested: ";
			}
			td:nth-of-type(2):before {
				font-weight:bold;
				content: "Time Requested: ";
			}
			td:nth-of-type(3):before {
				font-weight:bold;
				content: "Date Submitted: ";
			}
			td:nth-of-type(4):before {
				font-weight:bold;
				content: "Status: ";
			}
		}
	</style>
</head>
<body>
	<!--*emp_ot.blade.php*-->
	
	<!-- Pop up message after successfully signing in or submitting your ot request -->
	<?php
		if (session('emp_ot_msg')){
			echo"<br><div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				".session('emp_ot_msg')."
				</div>";
		}
	?>
	
	<center>
	<h2>OT Requests</h2>
	
	@if($ots != null)
		<h3>{{\Auth::user()->name}}</h3>
		<br>
			<div class="container" style="padding:0;">
				<table>
					<tr><th style="text-align:center;">OT Date</th><th style="text-align:center;">Time Requested</th><th style="text-align:center;">Date Submitted</th><th style="text-align:center;">Status</th></tr>
					@foreach($ots as $ots)
						<tr><td>{{ date("m/d/Y", strtotime($ots->starting_date)) }} - {{ date("m/d/Y", strtotime($ots->end_date)) }}</td><td>{{ date('h:i A', strtotime($ots->starting_time)) }}- {{ date('h:i A', strtotime($ots->end_time)) }}</td><td>{{ date("m/d/Y", strtotime($ots->created_at)) }}</td><td>Pending<br><a href="/otdetails/{{ $ots->request_id }}">View Details </a> | <a href="/delete_ot/{{ $ots->request_id }}" Onclick="return confirm('Are you sure you want to delete this request?')"> Delete</a></td></tr>
					@endforeach
				</table>
			</div>
	@endif
	</center>
	<script>
	</script>
</body>
</html>
@endsection
