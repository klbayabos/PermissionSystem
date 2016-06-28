@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>OBForm</title>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/jquery/1/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/momentjs/latest/moment.min.js') }}"></script>
		
		<link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
		<script type="text/javascript" src="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
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
			textarea {
				width:300px;
				height:200px;
			}
        </style>
    </head>
    <body>
		<!-- *obform.blade.php* -->
		<center>
		<table>
		<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Official Business Request Form</h1><td></tr>
		<tr><td class="left">Name:</td> <td class="right"> {{ Auth::user()->name }} </td></tr>
		
		<form role = "form" id="obreq" method = "POST" action="{{ url('/getOBrequest') }}">
		{!! csrf_field() !!}			
			<tr><td class="left" valign="top">Team: </td>
				<td class="right">
					<!-- dropdown -->
					<select id="teamname" name="team">
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
				</td></tr>
			<tr><td class="left" valign="top">Date & Time of OB: </td>
			<td class="right">
				<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
					<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
					<span></span> <b class="caret"></b>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						var screensize=$( window ).width();
						function cb(start, end) {
							if(screensize>652){
								$('#reportrange span').html(start.format('MMMM Do YYYY') + ' - ' + end.format('MMMM Do YYYY') + ', ' + start.format('h:mm:ss a') + ' - ' + end.format('h:mm:ss a'));
							}
						}
						cb(moment(), moment());

						$('#reportrange').daterangepicker({
							"timePicker": true,
							"timePickerIncrement": 15,
							"minDate": moment(),
							"opens": "right"
						}, cb);
						
						var screensize=$( window ).width();
						if(screensize<447){
							$('#purpose').width("100%");
						}
						else{
							$('#purpose').width("300px");
						}
					});
					$( window ).resize(function() {
						var screensize=$( window ).width();
						if(screensize<447){
							$('#purpose').width("100%");
						}
						else{
							$('#purpose').width("300px");
						}
					});
				</script>
			</td></tr>
			<tr><td colspan=2 valign="top"><h3>Itenerary/Destination</h3><td></tr>
			<tr><td class="left" valign="top">To:  </td><td class="right"><input type="text" name="to"> </td></tr>
			<tr><td class="left" valign="top">From:  </td><td class="right"><input type="text" name="from"> </td></tr>
			<tr><td class="left" valign="top">Purpose:  </td><td class="right"><textarea id="purpose" name="purpose" cols=50 rows=7 fixed></textarea></td></tr>
			<tr><td class="left"></td><td class="right"><input class="button" type="submit"></td></tr>
		</form>
		
		</table>
		</center>
    </body>
</html>
@endsection