@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>Overnight Approval Details</title>
		<!-- get dates -->
		<?php
			function date_range($first, $last, $step = '+1 day', $output_format = 'F j Y' ) {
				$dates = array();
				$current = strtotime($first);
				$last = strtotime($last);
				while( $current <= $last ) {
					$dates[] = date($output_format, $current);
					$current = strtotime($step, $current);
				}
				return $dates;
			}
		?>
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
			.container{
				word-wrap:break-word;
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
			textarea{
				width:475px;
				resize:none;
			}
        </style>
    </head>
    <body>
		<center>
		<br><br><br>
		
		<form role = "form" id="checkbox" method = "POST" action="{{ url('/request_act') }}">
		{!! csrf_field() !!}
		
		<div id="container" style="margin:0;border:1px #DDDDDD solid;padding:15px;max-width:900px;">
			<h3>Overnight Request Details</h3><br>
			<div class="container" style="text-align:left">
				<b>Date Submitted:</b> {{ date("F j Y, h:i A", strtotime($on->created_at)) }}<br>
				@if(date("F j Y", strtotime($on->starting_date)) != date("F j Y", strtotime($on->end_date)))
					<b>Date Requested:</b> {{ date("F j Y", strtotime($on->starting_date)) }} - {{ date("F j Y", strtotime($on->end_date)) }} 
						@if ((Auth::user()->type_id == 1 || Auth::user()->isOIC == "yes") && (!isset($head)))
						<div class="col-lg-8" style="float:left; margin-left: 130px;">
							<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Pick dates <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<?php 
									$array = date_range(date("F j Y", strtotime($on->starting_date)), date("F j Y", strtotime($on->end_date)), "+1 day", "F j Y");	
									foreach( $array as $array) {
										echo "<li><a href='#' class='small' data-value='option1' tabIndex='-1'><input checked value='$array' name='selected[]' type='checkbox'/>&nbsp; $array </a></li>";
									} 
								?>
							</ul>
						</div><br><br>
						@endif
				@else
					<b>Date Requested:</b> {{ date("F j Y", strtotime($on->starting_date)) }}
				@endif
				<br>
				<b>Time Requested:</b> {{ date('h:i A', strtotime($on->starting_time)) }} - {{ date('h:i A', strtotime($on->end_time)) }}<br>
				<b>Reason/s:</b><p style="text-indent:70px;"> {{ $on->request_purpose }}</p>
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
				<b>Request Status:</b> {{ $on->status }}<br>
				@if(isset($head->approved_dates))
					<b>Approved Dates:</b> {{ $head->approved_dates }}
				@endif
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
			@endif
				<p class="commentfield">
					<input type="hidden" value="{{ $request_id }}" name="request_id">
					<input type="hidden" value="ON" name="type">
					@if (!isset($endorser) && !isset($head))
					<label> Comment/s: </label><br>
					<textarea id="textarea" name="comment1" rows=7></textarea><br><br>
					<button class='button' value="endorse" name="action">Endorse</button>
					<button class='button' value="endorse_deny" name="action">Deny</button>
					@endif
					@if (isset($endorser) && !isset($head) && (Auth::user()->type_id == 1 || Auth::user()->isOIC == 'yes'))
					<label> Comment/s: </label><br>
					<textarea id="textarea" name="comment2" rows=7></textarea><br><br>
					<button class='button' value="approve" name="action">Approve</button>
					<button class='button' value="head_deny" name="action">Deny</button>
					@endif
				</p>
			</div>
		</div>
		</form>	
		</center>
		<br><br><br><br>
		<script>
			var options = [];

			$( '.dropdown-menu a' ).on( 'click', function( event ) {

			   var $target = $( event.currentTarget ),
				   val = $target.attr( 'data-value' ),
				   $inp = $target.find( 'input' ),
				   idx;

			   if ( ( idx = options.indexOf( val ) ) > -1 ) {
				  options.splice( idx, 1 );
				  setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
			   } else {
				  options.push( val );
				  setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
			   }

			   $( event.target ).blur();
				  
			   console.log( options );
			   return false;
			});
			$( document ).ready(function() {
				var width=$( window ).width();
				$("#container").width(width-20);
				var width=$( "#container" ).width();
				$(".container").width(width-20);
				$(".container1").width(width-20);
				if($( window ).width()<475){
					$( ".commentfield" ).width($(".commentfield").parent().width());
					$( "#textarea" ).width($("#textarea").parent().width()-20);
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
					$( "#textarea" ).width($("#textarea").parent().width()-20);
				}
			});
		</script>
    </body>
</html>
@endsection
