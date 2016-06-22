@extends('layouts.app')

@section('content')
<html>
<head>
    <title>View OT</title>
	<!-- Include Required Prerequisites -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css" />
	 
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
			width:60%;
		}
		td, th{
			border-bottom: 1px solid #dddddd;
			width:25%;
			text-align:center;
		}
		th{
			background-color:#dddddd;
		}
		.container{
			margin-left:auto;
			margin-right:auto;
			width:60%;
		}
		
	
	</style>
</head>
<body>
	*emp_view.blade.php*
	<div class="container">
	<h2>OT Requests</h2>
	<center>
		<table>
			<tr><th style="text-align:center;">OT Date</th><th style="text-align:center;">OT Hours</th><th style="text-align:center;">Date Submitted</th><th style="text-align:center;">Status</th></tr>
			<tr><td>11/12/16</td><td>2</td><td>06/24/16</td><td>Pending<br><a href="{{ url('/otdetails') }}">View Details</a></td></tr>
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
	</center>
	</div>
</body>
</html>
@endsection
