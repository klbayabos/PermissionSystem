@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>OT Approval Details</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		
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
				width:60%;
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
			.formfield * {
				vertical-align: middle;
			}
        </style>
    </head>
    <body>
		*ot_approval_details.blade.php*
		<center>
		<br><br><br>
		<div class="container" style="border:1px #DDDDDD solid;padding:10px;max-width:900px;">
			<h3>Overtime Request Details</h3><br>
			<div class="container" style="text-align:left">
				Date Submitted: 6/5/66, 6:66 pm<br>
				Date Requested: 6/6/66-6/66/66<br>
				Overtime Hours: 1000<br>
				Reason/s: <br>
				Team Leader: Jon Aruta<br>
				Request Status: Pending
			</div>
			<br>
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
			<p class="formfield">
				<label> Comment/s: </label>
				<textarea name="comment" cols="50" rows="3"></textarea>
			</p>
			<input type="submit" value="Approve">
			<input type="submit" value="Deny">
			
			
			
		</div>
			
		</center>
		<br><br><br><br>	
				
    </body>
</html>
@endsection
