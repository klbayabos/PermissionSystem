@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>For Approval</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		
        <style>
           
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				display: table;
				font-weight: 100;
				<!-- font-family: 'Lato';-->
			}
			.container{
				margin-left:auto;
				margin-right:auto;
				width:60%;
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
				width:80%;
				letter-spacing: 1px;
			}
			td{
				text-align: center;
				padding: 5px;
				border: 1px solid black;
				width:25%;
			}
			td:hover {
				background-color: gray;
			}
			h4{
				text-align: left !important;
			}
        </style>
    </head>
    <body>
		*approval_list.blade.php*
		<center>
		<br><br><h1>View Requests</h1><hr>
		<br><br><br>
		<div class="container">
			<h4>OT Requests<hr></h4>
			<table>
				<tr><td>Name</td><td>OT Date</td><td>OT Hours</td><td>Date Submitted</td><td>Status</td></tr>
				<tr><td>Taylor Swift</td><td>June 16-17</td><td>2</td><td>June 16</td><td>Pending</td></tr>
				<tr><td>Hayley Williams</td><td>Dec 11-13</td><td>1</td><td>Dec 11</td><td>Pending</td></tr>
				<tr><td>Sooyoung</td><td>Dec 27</td><td>3</td><td>Dec 13</td><td>Pending</td></tr>
			</table>
			<br><br>
			<h4>OB Requests<hr></h4>
			<table>
				<tr><td>Name</td><td>OB Date</td><td>Date Submitted</td><td>Status</td></tr>
				<tr><td>Taylor Swift</td><td>June 16-17</td><td>June 16</td><td>Pending</td></tr>
				<tr><td>Hayley Williams</td><td>Dec 11-13</td><td>Dec 11</td><td>Pending</td></tr>
				<tr><td>Sooyoung</td><td>Dec 27</td><td>Dec 13</td><td>Pending</td></tr>
			</table>
			<br><br><br><br>
		</div>
		</center>
    </body>
</html>
@endsection