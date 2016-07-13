@extends('layouts.app')

@section('content')
<html>
<head>
    <title>View ON</title>
	<style>
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
				width:90%;
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
			tr#approved td{
				background-color:#eee;
			}
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
	
	@if($ons != null)
		<h3>{{\Auth::user()->name}}</h3>
		<br>
			<div class="container" style="padding:0;">
				<table>
					<tr><th style="text-align:center;">Overnight Date</th><th style="text-align:center;">Overnight Hours</th><th style="text-align:center;">Date Submitted</th><th style="text-align:center;">Status</th></tr>
					@foreach($ons as $ons)
						<tr class="{{ $ons->status }}"><td>{{ date("m/d/Y", strtotime($ons->starting_date)) }} - {{ date("m/d/Y", strtotime($ons->end_date)) }}</td><td>{{ date('h:i A', strtotime($ons->starting_time)) }} - {{ date('h:i A', strtotime($ons->end_time)) }}</td><td>{{ date("m/d/Y", strtotime($ons->created_at)) }}</td><td>{{ $ons->status }}<br><a href="/ondetails/{{ $ons->request_id }}">View Details </a> | <a href="/delete_on/{{ $ons->request_id }}" Onclick="return confirm('Are you sure you want to delete this request?')"> Delete</a></td></tr>
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
