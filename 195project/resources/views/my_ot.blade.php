@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>OT Details</title>
        <style>
			
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
					content: "Date: ";
				}
				td:nth-of-type(2):before {
					font-weight:bold;
					content: "User: ";
				}
				td:nth-of-type(3):before {
					font-weight:bold;
					content: "Action: ";
				}
				td:nth-of-type(4):before {
					font-weight:bold;
					content: "Comment/s: ";
				}
			}
        </style>
    </head>
    <body>
		<!--*my_ot.blade.php*-->
		<center>
		<br><br><br>
		<div id="container" style="margin:0;border:1px #DDDDDD solid;padding:15px;max-width:900px;">
			<h3>Overtime Request Details</h3><br>
				<div class="container" style="text-align:left;word-wrap:break-word">
				<b>Date Submitted:</b> {{ date("F j Y, h:i A", strtotime($ot->created_at)) }}<br>
				<b>Date Requested:</b> {{ date("F j Y", strtotime($ot->starting_date)) }} - {{ date("F j Y", strtotime($ot->end_date)) }}<br>
				<b>Time Requested:</b> {{ date('h:i A', strtotime($ot->starting_time)) }} - {{ date('h:i A', strtotime($ot->end_time)) }}<br>
				<b>Reason/s:</b><p style="text-indent:70px;"> {{ $ot->request_purpose }}</p>
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
				<b>Request Status:</b> {{ $ot->status }}<br>
				@if(isset($dates))
					<b>Approved Dates:</b> 
					@if(count($dates)!=1)
						<select>
						@foreach($dates as $dates)
								<option value="{{ $dates->approved_date }}">{{ date("F j Y", strtotime($dates->approved_date)) }}</option>
						@endforeach
						</select>
					@else
						@foreach($dates as $dates)
								{{ date("F j Y", strtotime($dates->approved_date)) }}
						@endforeach
					@endif
				@endif
			</div>
			<br>
			@if (isset($endorser) || isset($head))
			<div class="container1">
				<table>
					<tr>
						<th style="text-align:center;">User</th><th style="text-align:center;">Action</th><th style="text-align:center;">Comment/s</th>
					</tr>
						<tr>
						@if (isset($endorser))
						<tr>
							<td>{{ $endorser->endorser }}</td>
							<td>{{ $endorser->isEndorsed }}</td>
							<td>{{ $endorser->comment }}</td>
						</tr>
						@endif
						@if (isset($head))
						<tr>
							<td>{{ $head->approver }}</td>
							<td>{{ $head->isApproved }}</td>
							<td>{{ $head->comment }}</td>
						</tr>
						@endif
				</table>
			</div>
			@endif
			<!-- delete button-->
			<a href="/delete_ot/{{ $ot->request_id }}" Onclick="return confirm('Are you sure you want to delete this request?')"><input class="button" type="submit" value="Delete request"></a>
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
