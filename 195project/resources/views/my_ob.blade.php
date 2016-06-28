@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>OB Details</title>
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
			div.container1{
				overflow:auto;
				padding:0;
			}
        </style>
    </head>
    <body>
		<!--*my_ob.blade.php*-->
		<center>
		<br><br><br>
			<div id="container" style="margin:0;border:1px #DDDDDD solid;padding:0px;max-width:900px;">
				<h3>Official Business Request Details</h3><br>
				<div class="container" style="text-align:left">
					Date Submitted: 6/5/66, 6:66 pm<br>
					Date and Time of Official Business: 6/6/66, 6:66 am - 6/66/66, 6:66 pm <br>
					Itenerary/Destination<br>
					From: UPD <br>
					To: Laguna <br>
					Purpose/s: Conference <br>
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
				<!-- delete button-->
				<a href="/delete_ob" Onclick="return confirm('Are you sure you want to delete this request?')"><input type="submit" value="Delete request"></a>
				
			</div>
		</center>
		<br><br><br><br>
		<script>
			$( document ).ready(function() {
				var width=$( window ).width();
				$("#container").width(width);
				var width=$( "#container" ).width();
				$(".container1").width(width);
			});
			$( window ).resize(function() {
				var width=$( window ).width();
				$("#container").width(width);
				var width=$( "#container" ).width();
				$(".container1").width(width);
			});
		</script>
    </body>
</html>
@endsection
