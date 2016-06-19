@extends('layouts.app')

@section('content')
<html>
<head>
	<style>
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
	<div class="container">
	<h2>OT Requests</h2>
	<center>
		<table>
			<tr><td>OT Date</td><td>OT Hours</td><td>Date Submitted</td><td>Status</td></tr>
			{{--
				select from ot database
			--}}
		</table>
	</center>
	</div>
</body>
</html>
@endsection
