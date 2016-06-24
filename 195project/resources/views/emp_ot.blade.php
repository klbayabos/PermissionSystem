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
	*emp_ot.blade.php*
	
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
	<br>
		<div class="container">
			<table>
				<tr><th style="text-align:center;">OT Date</th><th style="text-align:center;">OT Hours</th><th style="text-align:center;">Date Submitted</th><th style="text-align:center;">Status</th></tr>
				<tr><td>11/12/16</td><td>2</td><td>06/24/16</td><td>Pending<br><a href="{{ url('/otdetails') }}">View Details </a> | <a href="/delete_ot" Onclick="return confirm('Are you sure you want to delete this request?')"> Delete</a></td></tr>
				{{--
				@foreach ($ot as $ots)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->name }}</td>
					</tr>
				@endforeach
				--}}
			</table>
		</div">
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
