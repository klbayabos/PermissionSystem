@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>Approval Details</title>
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
				border-collapse:collapse;
				width:60%;
			}
			td,th{
				border: 1px solid black;
				text-align:center;
				padding: 5px;
			}
			td:hover {
				background-color: #67c2e1
			}
        </style>
    </head>
    <body>
		*approval_details.blade.php*
		<center>
		<br><br><h1>View Request Details</h1><hr>
		<br><br><br>
		<div class="container" style="border:1px #DDDDDD solid;padding:10px;max-width:900px;">
			{{--
			<table>
				<tr><td>Name</td><td>OT Date</td><td>OT Hours</td><td>Date Submitted</td><td>Status</td></tr>
				<tr><td>Taylor Swift</td><td>June 16-17</td><td>2</td><td>June 16</td><td>Pending</td></tr>
			</table>
			--}}
			<h3>Overtime Request Details</h3>
			<div class="container" style="text-align:left">
				Date Submitted: 4/5/66, 6:66 pm<br>
				Date Requested: 6/6/66-6/66/66<br>
				Overtime Hours: 1000<br>
				Request Status: Needs Approval
			</div>
			<br>
			<table>
			<tr>
				<th style="text-align:center;">User</th><th style="text-align:center;">Action</th><th style="text-align:center;">Comment/s</th>
			</tr>
			{{--
				$req_id=$_GET['request_id']
				SELECT * FROM table WHERE req_id=$req_id
			--}}
			<tr>
				<td>Jon Aruta</td><td>Submitted</td><td>aiosdj asjidio ajsidoj ajsidopjmcvx klx</td>
			</tr>
			<tr>
				<td>User 1</td><td>Endorsed</td><td>dmf asnmklzxc naxcmkn jkasd</td>
			</tr>
			<tr>
				<td>Head and Stuff</td><td>Approved</td><td>aksdo fdcxsc 6yrty bjvghk</td>
			</tr>
			</table>
			<form method="post">
				<br><br>Comment/s:<br><textarea name="purpose" cols=50 rows=7></textarea><br>
				<input type="submit" value="Approve" /><input type="submit" value="Deny" />
			</form>
		</div>
			
		</center>
			
				
    </body>
</html>
@endsection