@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Manage Account</title>
		<link rel="stylesheet" href="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') }}">
		<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
		
		<style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
            }
            .title {
                font-size: 96px;
            }
			.left{
				text-align:right;
				padding:20px;
			}
			.right{
				text-align:left;
				padding:20px;
			}
			.center{
				text-align:center;
			}
			table{
				table-layout: fixed;
				border: 1px solid #dddddd;
				border-collapse:collapse;
				width:60%;
				margin-bottom: 30px;
			}
			td, th{
				border-bottom: 1px solid #dddddd;
				width:25%;
				text-align:center;
			}
			th{
				background-color:#dddddd;
			}
        </style>
    </head>
    <body>
		*manage_acc.blade.php*
		<center>
		{{--
		<table>
		<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Manage Accounts</h1><td></tr>
		<form method="post">
			<tr><td class="left">Email:</td> <td class="right">
				<select class="selectpicker" name="name">
				  <option>tswift@up.edu.ph</option>
				  <option>hwilliams@up.edu.ph</option>
				  <option>csooyoung@up.edu.ph</option>
				</select>
			</td></tr>
			<tr><td class="left" valign="top">Type: </td> <td class="right">
				<select class="selectpicker" name="type">
				  <option>Employee</option>
				  <option>HR</option>
				  <option>Supervisor</option>
				  <option>Approver</option>
				  <option>Admin</option>
				</select>
			</td></tr>
			<tr><td class="left"></td><td class="right"><input type="submit"></td></tr>
		</form>
		</table>
		--}}
		<table>
			<tr><th style="text-align:center;">Name</th><th style="text-align:center;">Email</th><th style="text-align:center;">Type</th></tr>
			<tr></tr>
		</table>
		</center>
    </body>
</html>
@endsection