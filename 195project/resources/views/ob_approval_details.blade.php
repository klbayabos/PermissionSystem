@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>OB Approval Details</title>
		<!-- Latest compiled and minified CSS -->
		<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') }}"></script>
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
                <!-- font-family: 'Lato';-->
            }
			
			.center{
				text-align:center;
			}
			
			.header{
				width:100%;
				height:100px;
				background-color:#7B1113;
			}
			
			span{
				display: inline-block;
				vertical-align: middle;
				line-height:30px;
			}
			textarea {
			   resize: none;
			}
			
				
			/* horizontal line */
					
			hr { 
				display: block;
				margin-top: 0.2em;
				margin-bottom: 0.2em;
				margin-left: auto;
				margin-right: auto;
				border-style: inset;
				border-width: 1px;
			}
			
			/* table */
			
			table{
				table-layout: fixed;
				border: 1px solid #dddddd;
				border-collapse:collapse;
				width:500px;
				margin-bottom: 30px;
			}
			td,th{
				border-bottom: 1px solid #dddddd;
				text-align:center;
				padding: 5px;
			}
			th{
				background-color:#dddddd;
			}
			.commentfield * {
				vertical-align: middle;
			}
			div.container1{
				overflow:auto;
				padding:0;
			}
        </style>
    </head>
    <body>
		<!--*ot_approval_details.blade.php*-->
		<center>
		<br><br><br>
		<div id="container" style="margin:0;border:1px #DDDDDD solid;padding:0px;max-width:900px;">
			<h3>Official Business Request Details</h3><br>
			<div class="container" style="text-align:left">
				Date Submitted: {{ date("F j Y", strtotime($ob->created_at)) }}<br>
				Date Requested: {{ date("F j Y", strtotime($ob->starting_date)) }} - {{ date("F j Y", strtotime($ob->end_date)) }}<br>
				Time Requested: {{ date('h:i A', strtotime($ob->starting_time)) }} - {{ date('h:i A', strtotime($ob->end_time)) }}<br>
				Itenerary/Destination<br>
				From: {{ $ob->from }} <br>
				To: {{ $ob->to }} <br>
				Purpose: {{ $ob->request_purpose }}<br>
				Team Leader: 
				@if (isset($tl))
					{{ $tl->name }}<br>
				@else
					n/a<br>
				@endif
				Supervisor: 
				@if (isset($sv))
					{{ $sv->name }} <br>
				@else
					n/a<br>
				@endif
				Request Status: {{ $ob->state }}
			</div>
			<br>
			<div class="container1">
				<table>
				<tr>
					<th style="text-align:center;">User</th><th style="text-align:center;">Action</th><th style="text-align:center;">Comment/s</th>
				</tr>
				<tr>
					<td>{{  $ob->name  }}</td><td>{{ $ob->state }}</td><td>n/a</td>
				</tr>
				<tr>
					<td>Team Leader</td><td>Endorsed</td><td>okay</td>
				</tr>
				<tr>
					<td>Head of Unit</td><td>Pending</td><td>asdfghjkl</td>
				</tr>
				</table>
			</div>
			<input class='button' type='submit' name='action' value='Approve'>
			<input class='button' type='submit' name='action' value='Deny'>
		</div>
		</center>
		<br><br><br><br>
		<script>
			$( document ).ready(function() {
				var width=$( window ).width();
				$("#container").width(width-20);
				var width=$( "#container" ).width();
				$(".container1").width(width-20);
				if($( window ).width()<475){
					$( ".commentfield" ).width($(".commentfield").parent().width());
					$( ".textarea" ).width($(".textarea").parent().width()-20);
				}
			});
			$( window ).resize(function() {
				var width=$( window ).width();
				$("#container").width(width-20);
				var width=$( "#container" ).width();
				$(".container1").width(width-20);
				if($( window ).width()<475){
					$( ".commentfield" ).width($(".commentfield").parent().width());
					$( ".textarea" ).width($(".textarea").parent().width()-20);
				}
			});
		</script>
    </body>
</html>
@endsection
