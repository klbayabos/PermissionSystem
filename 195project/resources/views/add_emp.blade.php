@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Add User</title>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/jquery/1/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/momentjs/latest/moment.min.js') }}"></script>
		
		<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css') }}">
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js') }}"></script>
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
			.navigation{
				display: inline-block;
				width:100%;
				background-color:#c9c9c9;
				height:30px;
			}
			span{
				display: inline-block;
				vertical-align: middle;
				line-height:30px;
			}
			textarea {
				width:300px;
				height:200px;
			}
        </style>
    </head>
    <body>
		<center>
			<table>
			<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Add Employee</h1><td></tr>
			
			<form role = "form" id="otreq" method = "POST" action="{{ url('/new_emp') }}">
			{!! csrf_field() !!}			
				<tr><td class="left">Name:</td> <td class="right"> <input type="text" name="emp_name" required> </td></tr>
				<tr><td class="left">Email:</td> <td class="right"> <input type="text" name="emp_email" placeholder="@up.edu.ph" required> </td></tr>
				<tr><td class="left" valign="top">Team: </td>
					<td class="right">
						<!-- dropdown for team -->
						<select id="teamname" name="emp_team">
							<option value="Admin">Admin</option>
							<option value="Change Management">Change Management</option>
							<option value="Content Development">Content Development</option>
							<option value="EIS">EIS</option>
							<option value="FMIS">FMIS</option>
							<option value="HRIS">HRIS</option>
							<option value="IS">IS</option>
							<option value="ITO/Helpdesk">ITO/Helpdesk</option>
							<option value="QA">QA</option>
							<option value="SAIS">SAIS</option>
							<option value="SAIS OU">SAIS OU</option>
						</select>
					</td>
				</tr>
				<tr><td class="left" valign="top">Type: </td>
					<td class="right">
						<!-- dropdown for type -->
						<select id="type" name="emp_type">
							<option value="officer in charge">Officer in charge</option>
							<option value="admin">Admin</option>
							<option value="approver">Approver</option>
							<option value="supervisor">Supervisor</option>
							<option value="hr">HR</option>
							<option value="employee">Employee</option>
						</select>
					</td>
				</tr>
				
				<tr><td class="left"></td><td class="right"><input type="submit" value="Submit" /></td></tr>
			</form>
			
			</table>
		</center>
    </body>
</html>
@endsection