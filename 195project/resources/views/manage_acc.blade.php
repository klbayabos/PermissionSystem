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
        </style>
    </head>
    <body>
		*manage_acc.blade.php*
		<center>
		<table>
		<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Manage Account</h1><td></tr>
		<form method="post">
			<tr><td class="left">Name:</td> <td class="right">
				<select class="selectpicker" name="name">
				  <option>Taylor Swift</option>
				  <option>Hayley Williams</option>
				  <option>Sooyoung</option>
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
		</center>
    </body>
</html>
@endsection