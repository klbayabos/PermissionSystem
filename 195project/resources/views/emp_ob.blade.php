@extends('layouts.app')

@section('content')
<html>
<head>
    <title>View OB</title>
	<style>
		table{
			border: 1px solid #dddddd;
			border-collapse:collapse;
			width:700px;
			table-layout: fixed;
		}
		.container{
			max-width:700px;
		}
		td, th{
			border-bottom: 1px solid #dddddd;
			text-align:center;
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
				text-align:left;
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
	</style>
</head>
<body>
	<!--*emp_ob.blades.php*-->
	
	<!-- Pop up message after submitting your ot request -->
	<?php
		if (session('emp_ob_msg')){
			echo"<br><div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				".session('emp_ob_msg')."
				</div>";
		}
	?>
	
	<center>
	<h2 style="margin-top:20px;">OB Requests</h2>
	
	@if($obs != null)
		<h3>{{\Auth::user()->name}}</h3>
		<br>
			<div class="container" style="padding:0;">
				<table>
					<tr><th style="text-align:center;">OB Time</th><th style="text-align:center;">Team</th><th style="text-align:center;">Date Submitted</th><th style="text-align:center;">Status</th></tr>
					@foreach( $obs as $obs )
						<tr class="{{ $obs->status }}"><td>{{ date("m/d/Y", strtotime($obs->starting_date)) }} - {{ date("m/d/Y", strtotime($obs->end_date)) }}</td><td>{{ $obs->team }}</td><td>6/5/16</td><td>{{ $obs->status }}<br><a href="/obdetails/{{ $obs->request_id }}">View Details</a> | <a href="/delete_ob/{{ $obs->request_id }}" Onclick="return confirm('Are you sure you want to delete this request?')"> Delete</a></td></tr>
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