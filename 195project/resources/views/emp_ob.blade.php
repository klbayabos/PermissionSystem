@extends('layouts.app')

@section('content')
<html>
<head>
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
			table-layout: fixed;
			border-collapse:collapse;
			width:60%;
		}
		td{
			border: 1px solid black;
			width:25%;
		}
		.container{
			margin-left:auto;
			margin-right:auto;
			width:60%;
		}
	</style>
</head>
<body>
	*emp_ob.blades.php*
	<div class="header" style="width:100%;height:100px;background-color:#7B1113;"></div>
	<?php include(app_path().'/includes/fncs.php'); ?>
	<div class="container">
	<h2>OT Requests</h2>
	<center>
		<table>
			<tr><td>OT Date</td><td>OT Hours</td><td>Date Submitted</td><td>Status</td></tr>
			<tr><td>1</td><td>OT Hours</td><td>Date Submitted</td><td>Pending<br><a href="http://localhost:8000/empviewdetails"></a></td></tr>
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
