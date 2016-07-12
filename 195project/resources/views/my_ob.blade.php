@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>OB Details</title>
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
			div.container1{
				overflow:auto;
				padding:0;
			}
			@media screen and (max-width:570px){
				.container{
					font-size:12px;
				}
				tr:nth-child(odd) {background: #DDD}
				tr:nth-child(even) {background: #FFF}
				th{
					display:none;
				}
				td{
					display:block;
					border: none;
				}
				table{
					width:100%;
					border: none;
					margin-bottom:0;
				}
				div.container1{
					width:90%;
					border: 1px solid #ddd;
					border-radius:10px;
					overflow:hidden;
					margin-bottom:10px;
				}
				td:nth-of-type(1):before {
					font-weight:bold;
					content: "User: ";
				}
				td:nth-of-type(2):before {
					font-weight:bold;
					content: "Action: ";
				}
				td:nth-of-type(3):before {
					font-weight:bold;
					content: "Comment/s: ";
				}
			}
        </style>
    </head>
    <body>
		<!--*my_ob.blade.php*-->
		<center>
		<br><br><br>
			<div id="container" style="margin:0;border:1px #DDDDDD solid;padding:15px;max-width:900px;">
				<h3>Official Business Request Details</h3><br>
				<div class="container" style="text-align:left;word-wrap:break-word">
					<b>Date Submitted:</b> {{ date("F j Y, h:i A", strtotime($ob->created_at)) }}<br>
					<b>Date Requested:</b> {{ date("F j Y", strtotime($ob->starting_date)) }} - {{ date("F j Y", strtotime($ob->end_date)) }}<br>
					<b>Time Requested:</b> {{ date('h:i A', strtotime($ob->starting_time)) }} - {{ date('h:i A', strtotime($ob->end_time)) }}<br>
					<b>Itenerary/Destination</b><br>
					<b>From:</b> {{ $ob->from }}</b> <br>
					<b>To:</b> {{ $ob->to }}</b> <br>
					<b>Purpose:</b><p style="text-indent:70px;"> {{ $ob->request_purpose }}</p>
					<b>Team Leader:</b> 
					@if (isset($tl))
						{{ $tl->name }}<br>
					@else
						n/a<br>
					@endif
					<b>Supervisor:</b> 
					@if (isset($sv))
						{{ $sv->name }} <br>
					@else
						n/a<br>
					@endif
					<b>Request Status:</b> {{ $ob->status }}
				</div>
				<br>
				@if (isset($endorser) || isset($head))
				<div class="container1">
					<table>
						<tr>
							<th style="text-align:center;">User</th><th style="text-align:center;">Action</th><th style="text-align:center;">Comment/s</th>
						</tr>
							@if (isset($endorser))
							<tr>
								<td>{{ $endorser->endorser }}</td>
								<td>{{ $endorser->isEndorsed }}</td>
								<td>{{ $endorser->comment }}</td>
							</tr>
							@endif
							@if (isset($head))
							<tr>
								<td> Head of Unit </td>
								<td>{{ $head->isApproved }}</td>
								<td>{{ $head->comment }}</td>
							</tr>
							@endif
					</table>
				</div>
				@endif
				<!-- delete button-->
				<a href="/delete_ob/{{ $ob->request_id }}" Onclick="return confirm('Are you sure you want to delete this request?')"><input class="button" type="submit" value="Delete request"></a>
				
			</div>
		</center>
		<br><br><br><br>
		<script>
			$( document ).ready(function() {
				var width=$( window ).width();
				$("#container").width(width-20);
				var width=$( "#container" ).width();
				$(".container").width(width-20);
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
				$(".container").width(width-20);
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
