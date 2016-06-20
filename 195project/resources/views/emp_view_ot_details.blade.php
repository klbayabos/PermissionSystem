@extends('layouts.app')

@section('content')
<html>
<head>
	<style>
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
	<div class="container">
	<h2>OT Requests</h2>
	<center>
		<table>
			<tr><th style="text-align:center;">OT Date</th><th style="text-align:center;">OT Hours</th><th style="text-align:center;">Date Submitted</th><th style="text-align:center;">Status</th></tr>
			{{--
				select from ot database
			--}}
		</table>
	</center>
	</div>
</body>
</html>
@endsection
