@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>OBForm</title>
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
				width:500px;
				height:200px;
			}
			.calendar{
				padding:0 !important;
			}
        </style>
    </head>
    <body>
		<!-- *obform.blade.php* -->

		<center>
		<table>
		<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Official Business Request Form</h1><td></tr>
		<tr><td class="left">Name:</td> <td class="right"> {{ $user->name }} </td></tr>
		
		<form role = "form" id="obreq" method = "POST" action="{{ url('/getOBrequest') }}">
		{!! csrf_field() !!}			
			<tr><td class="left" valign="top">Team: </td><td class="right">{{ $user->team }}</td></tr>
			<tr><td class="left" valign="top">Date & Time of OB: </td>
			<td class="right">
				<input type="text" name="fromdate" class="fromdate" style="display:none">
				<input type="text" name="todate" class="todate" style="display:none">
				<input type="text" name="fromtime" class="fromtime" style="display:none">
				<input type="text" name="totime" class="totime" style="display:none">
				<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
					<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
					<span></span> <b class="caret"></b>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						var screensize=$( window ).width();
						if(screensize<=500){
							$('#purpose').width(screensize-150);
						}
						else{
							$('#purpose').width("300px");
						}
						function cb(start, end) {
							if(screensize>652){
								$('#reportrange span').html(start.format('MMMM Do YYYY') + ' - ' + end.format('MMMM Do YYYY') + ', ' + start.format('h:mm:ss a') + ' - ' + end.format('h:mm:ss a'));
								$(".fromdate").val(start.format('YYYY-MM-DD'));
								$(".todate").val(end.format('YYYY-MM-DD'));
								$(".fromtime").val(start.format('H:mm'));
								$(".totime").val(end.format('H:mm'));
							}
						}
						cb(moment(), moment());

						$('#reportrange').daterangepicker({
							"timePicker": true,
							"timePickerIncrement": 15,
							"minDate": moment().startOf('day'),
							"opens": "right"
						}, cb);
						
				});
				$( window ).resize(function() {
					var screensize=$( window ).width();
					if(screensize<=500){
						$('#purpose').width(screensize-150);
					}
					else{
						$('#purpose').width("300px");
					}
				});
				</script>
			</td></tr>
			<tr><td colspan=2 valign="top"><h3>Itenerary</h3><td></tr>
			<tr><td class="left" valign="top">To:  </td><td class="right"><input type="text" name="to" required > </td></tr>
			<tr><td class="left" valign="top">From:  </td><td class="right"><input type="text" name="from" required > </td></tr>
			<tr><td class="left" valign="top">Purpose/s:  </td><td class="right"><textarea required id="purpose" name="purpose" cols=50 rows=7 fixed></textarea></td></tr>
			<tr><td class="left"></td><td class="right"><a Onclick="return confirm('Are you sure you want to submit this request?')"> <input class='button' type='submit'> </a></td></tr>
		</form>
		
		</table>
		</center>
    </body>
</html>
@endsection