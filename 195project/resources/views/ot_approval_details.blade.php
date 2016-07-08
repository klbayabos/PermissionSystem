@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>OT Approval Details</title>
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
				resize: none;
			}
        </style>
    </head>
    <body>
		<center>
		<br><br><br>
						
		<div id="container" style="margin:0;border:1px #DDDDDD solid;padding:15px;max-width:900px;">
			<h3>Overtime Request Details</h3><br>
			<div class="container" style="text-align:left">
				<b>Date Submitted:</b> {{ date("F j Y", strtotime($ot->created_at)) }}<br>
				<b>Date Requested:</b> {{ date("F j Y", strtotime($ot->starting_date)) }} - {{ date("F j Y", strtotime($ot->end_date)) }} 
					<div class="col-lg-8" style="float:right">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Pick dates <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<?php 
								$array = date_range(date("F j Y", strtotime($ot->starting_date)), date("F j Y", strtotime($ot->end_date)), "+1 day", "F j Y");	
								foreach( $array as $array) {
									echo "<li><a href='#' class='small' data-value='option1' tabIndex='-1'><input value='$array' type='checkbox'/>&nbsp; $array </a></li>";
								} 
							?>
						</ul>
					</div><br>
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
				<b>Request Status:</b> {{ $ot->state }}
			</div>
			<br>
			<div class="container1">
				<table>
				<tr>
					<th style="text-align:center;">User</th><th style="text-align:center;">Action</th><th style="text-align:center;">Comment/s</th>
				</tr>
				<tr>
					<td>{{  $ot->name  }}</td><td>{{ $ot->state }}</td><td>n/a</td>
				</tr>
				<tr>
					<td>Team Leader</td><td>Endorsed</td><td>okay</td>
				</tr>
				<tr>
					<td>Head of Unit</td><td>Pending</td><td>asdfghjkl</td>
				</tr>
				</table>
				<p class="commentfield">
 					<label> Comment/s: </label>
 					<textarea name="comment" cols="50" rows="3"></textarea>
 				</p>
			</div>
			<input class='button' type='submit' name='action' value='Approve'>
			<input class='button' type='submit' name='action' value='Deny'>
		</div>
			
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
