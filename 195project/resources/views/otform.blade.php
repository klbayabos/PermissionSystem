@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>OTForm</title>
		
		<link rel="stylesheet" href="{{ URL::asset('PermissionSystem/195project/public/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
		<script type="text/javascript" src="{{ URL::asset('PermissionSystem/195project/public/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
		<style>
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
		<!-- *otform.blade.php* -->
		<center>
		<div id="cont">
			<table>
			<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Overtime Request Form</h1><td></tr>
			<tr><td class="left">Name:</td> <td class="right"> {{ $user->name }} </td></tr>
			<form role = "form" id="otreq" method = "POST" action="{{ url('/getOTrequest') }}">
			{!! csrf_field() !!}			
				<tr><td class="left" valign="top">Team: </td><td class="right">{{ $user->team }}</td></tr>
				<tr><td class="left" valign="top">Date & Time of OT: </td>
				<td class="right">
					<input type="date" name="fromdate" class="fromdate" style="display:none">
					<input type="date" name="todate" class="todate" style="display:none">
					<input type="text" name="fromtime" class="fromtime" style="display:none">
					<input type="text" name="totime" class="totime" style="display:none">
					<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
						<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
						<span id="rep" class="hidden-xs"></span><b class="caret"></b>
					</div>
				</td></tr>
				<tr><td class="left" valign="top" id="reasontext" >Reason/s:  </td><td class="right"><textarea id="purpose" name="purpose" required ></textarea></td></tr>
				<tr><td class="left"></td><td class="right"><a Onclick="return check_validity()"> <input class="button" type="submit" value="Submit" /></a></td></tr>
			</form>
			
			</table>
		</div>
		<div class='loadcontainer'>
			<div class='loader' id='loader' style='display:none;'>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--dot'></div>
				<div class='loader--text'></div>
			</div>
		</div>		
		<script type="text/javascript">
			function confirmation(){
				if (confirm('Are you sure you want to submit this request?')) {
					var myVar = setTimeout(showPage, 30);
					return true;
				}
				return false;
			}
			function check_validity() {
				if(document.getElementById("purpose").value != ""){
					return confirmation();
				}
			}
			function showPage() {
			  document.getElementById("loader").style.display = "block";
			  document.getElementById("cont").style.display = "none";
			}
			
			$(document).ready(function(){
				var screensize=$( window ).width();
					if(screensize<=500){
						$('#purpose').width(screensize-150);
					}
				function cb(start, end) {
					$('#reportrange span').html(start.format('MMMM Do YYYY') + ' - ' + end.format('MMMM Do YYYY') + ', ' + start.format('h:mm:ss a') + ' - ' + end.format('h:mm:ss a'));
					$(".fromdate").val(start.format('YYYY-MM-DD'));
					$(".todate").val(end.format('YYYY-MM-DD'));
					$(".fromtime").val(start.format('H:mm'));
					$(".totime").val(end.format('H:mm'));
				}
				cb(moment(), moment());

				$('#reportrange').daterangepicker({
					"timePicker": true,
					"timePickerIncrement": 15,
					"minDate": moment().startOf('day'),
					"opens": "right"
				}, cb);
				//var offset = $( '#reportrange ').offset();
				//$('.daterangepicker').offset({ top: offset.top+42.22});	
				
				var screensize=$( window ).width();
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
		</center>
    </body>
</html>
@endsection
