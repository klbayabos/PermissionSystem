@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>OT Approval Details</title>
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
		<div id="container" style="border:1px #DDDDDD solid;padding:10px;max-width:900px;">
			<h3>Overtime Request Details</h3><br>
			
			<form role = "form" id="ot_approval" method = "POST" action="{{ url('/ot_approval') }}">
			{!! csrf_field() !!}
			
				<div class="container" style="text-align:left">
					Date Submitted: 6/5/66, 6:66 pm<br>
					Date Requested: 6/6/66-6/66/66<br>
					Overtime Hours: 1000<br>
					Reason/s: <br>
					Team Leader: Jon Aruta<br>
					Request Status: Pending
				</div>
				<br>
				<div class="container1">
					<table>
					<tr>
						<th style="text-align:center;">User</th><th style="text-align:center;">Action</th><th style="text-align:center;">Comment/s</th>
					</tr>
					<tr>
						<td>Jon Aruta</td><td>Submitted</td><td>okay</td>
					</tr>
					<tr>
						<td>Team Leader</td><td>Endorsed</td><td>okay</td>
					</tr>
					<tr>
						<td>Head of Unit</td><td>Pending</td><td>asdfghjkl</td>
					</tr>
					</table>
				</div>
				<p class="wtf"></p>
				<p class="commentfield">
					<label> Comment/s: </label>
					<textarea class="textarea" name="comment" cols="50" rows="3"></textarea>
				</p>
				<input type="submit" name="action" value="Approve">
				<input type="submit" name="action" value="Deny">
			</form>
			
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
					$( ".textarea" ).width($(".textarea").parent().width());
				}
			});
			$( window ).resize(function() {
				var width=$( window ).width();
				$("#container").width(width-20);
				var width=$( "#container" ).width();
				$(".container1").width(width-20);
				if($( window ).width()<475){
					$( ".commentfield" ).width($(".commentfield").parent().width());
					$( ".textarea" ).width($(".textarea").parent().width());
				}
			});
		</script>
    </body>
</html>
@endsection
