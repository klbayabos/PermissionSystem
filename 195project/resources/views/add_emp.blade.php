@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Add User</title>
		<link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
		<script type="text/javascript" src="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
		
		<!-- do not delete: for pop up stuff -->
		<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
			
		<style>
			html{
				overflow-y: scroll;
			}
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

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
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
		<!-- Pop up message when there's a duplicate email -->
		<?php
			if (session('add_emp_msg')){
				echo"<br><div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('add_emp_msg')."
					</div>";
			}
		?>
		<center>
			<table>
			<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Add Employee</h1><td></tr>
			
			<form role = "form" id="addemp" method = "POST" action="{{ url('/new_emp') }}">
			{!! csrf_field() !!}			
				<tr><td class="left">Name:</td> <td class="right"> <input type="text" name="emp_name" required> </td></tr>
				<tr><td class="left">Email:</td> <td class="right"> <input type="text" name="emp_email" placeholder="email@up.edu.ph" required> </td></tr>
				
				<tr><td class="left" valign="top">Type: </td>
					<td class="right">
						<!-- dropdown for type -->
						<select id="type" name="emp_type">
							@foreach ($type as $type)
								<option value='{{ $type->type_id }}'>{{ $type->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr><td class="left" valign="top">Team: </td>
					<td class="right">
						<!-- dropdown for team -->
						<select id="teamname" name="emp_team">
							@foreach ($team as $team)
								<option value='{{ $team->team_id }}'>{{ $team->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr><td class="left"></td><td class="right"><input class="button" type="submit" value="Submit" Onclick="return confirm('Are you sure you want to add this account?')" /></td></tr>
			</form>
			
			</table>
		</center>
    </body>
</html>
@endsection