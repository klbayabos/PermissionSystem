@extends('layouts.app')

@section('content')
<html>
<head>
    <title>View ON</title>
	<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
	 
	<!-- do not delete: for pop up stuff -->
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
		th{
			background-color:#dddddd;
		}
		div.container{
			overflow:auto;
			padding:0;
		}
	</style>
</head>
<body>
	
	<!-- Pop up message after submitting your overnight request -->
	<?php
		if (session('emp_on_msg')){
			echo"<br><div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				".session('emp_on_msg')."
				</div>";
		}
	?>
	
	<center>
	<h2>Overnight Requests</h2>
	<br>
		<div class="container">
			<table>
				<tr><th style="text-align:center;">Overnight Date</th><th style="text-align:center;">Overnight Hours</th><th style="text-align:center;">Date Submitted</th><th style="text-align:center;">Status</th></tr>
				@foreach($ons as $ons)
					<tr><td>{{ date("m/d/Y", strtotime($ons->starting_date)) }} - {{ date("m/d/Y", strtotime($ons->end_date)) }}</td><td>{{ date('h:i A', strtotime($ons->starting_time)) }} - {{ date('h:i A', strtotime($ons->end_time)) }}</td><td>{{ date("m/d/Y", strtotime($ons->created_at)) }}</td><td>Pending<br><a href="/ondetails/{{ $ons->request_id }}">View Details </a> | <a href="/delete_on" Onclick="return confirm('Are you sure you want to delete this request?')"> Delete</a></td></tr>
				@endforeach
			</table>
		</div>
	</center>
	<script>
		$( document ).ready(function() {
			var width=$( window ).width();
			$(".container").width(width);
		});
		$( window ).resize(function() {
			var width=$( window ).width();
			$(".container").width(width);
		});
	</script>
</body>
</html>
@endsection
