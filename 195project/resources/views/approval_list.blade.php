@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>For Approval</title>
		<script type="text/javascript" src="{{ URL::asset('bower_components/bootstrap-responsive-tabs/js/responsive-tabs.js') }}"></script>
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
				padding:0;
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
				letter-spacing: 1px;
				width:700px;
			}
			#table a{
				display:block;
				text-decoration:none;
			}
			#table a:hover{
				background-color:#cccccc;
			}
			td, th{
				text-align: center;
				padding: 5px;
				border-bottom: 1px solid #dddddd;
			}
			th{
				background-color:#dddddd;
			}
			h4{
				text-align: left !important;
			}
			a.accordion-toggle {
			display: block;
				padding: 10px  15px;
			}

			div.panel-heading {
				padding: 0;
			}
			div.container div div{
				padding:0;
			}
			div td,th{
				padding:0;
			}
			@media screen and (max-width:830px){
				div td,th{
					padding:0;
					text-align:left;
					padding-left:5px;
				}
				tr:nth-child(odd) {background: #DDD}
				tr:nth-child(even) {background: #FFF}
				th{
					display:none;
				}
				td{
					display:block;
					border: none;
					font-size:13px;
				}
				table{
					width:100%;
					border: none;
				}
				div.container{
					border: 1px solid #ddd;
					border-radius:10px;
					padding:0px;
					overflow:hidden;
				}
				td:nth-of-type(1):before {
					font-weight:bold;
					content: "Name: ";
				}
				td:nth-of-type(2):before {
					font-weight:bold;
					content: "Team: ";
				}
				td:nth-of-type(3):before {
					font-weight:bold;
					content: "Dates Requested: ";
				}
				td:nth-of-type(4):before {
					font-weight:bold;
					content: "Date Submitted: ";
				}
				td:nth-of-type(5):before {
					font-weight:bold;
					content: "Status: ";
				}
				td:first-child{
					border-top:1px solid #ddd;
					padding-top:10px;
				}
				td:last-child{
					padding-bottom:10px;
				}
			}
			@media screen and (max-width:600px){
				th,td{
					font-size:12px;
				}
			}
        </style>
    </head>
    <body>
	<!-- *approval_list.blade.php* -->
	
		<!-- Pop up message when ot/ob request has been approved/denied -->
		<?php
			if (session('approval_list_msg')){
				echo"<br><div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('approval_list_msg')."
					</div>";
			}
		?>
		<center>
		<h2 style="margin-top:20px;">Requests for Approval</h2>
			<br><br><br>
			<div class="container">
				<ul class="nav nav-tabs responsive" id="myTab">
					<li class="active"><a data-toggle="tab" href="#ob">Official Business</a></li>
					<li><a data-toggle="tab" href="#ot">Overtime</a></li>
					<li><a data-toggle="tab" href="#on">Overnight</a></li>
				</ul>

				<div class="tab-content responsive">
					<div id="ob" class="tab-pane active">
						@if($obs != null)
							<h4>Official Business Requests</h4>
							<!-- Sorting -->
							<p style="text-align: left; padding-bottom:5px;"><label> <a href="/obrequest_sortname">Sort by name </a></label> | <label> <a href="/obrequest_sortteam"> Sort by team  </a></label></p>
							<table id="table">
								<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">Dates Requested</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
							@foreach($obs as $obs)
								<tr><td>{{ $obs->name }}</td><td>{{ $obs->team }}</td><td>{{ date("m/d/Y", strtotime($obs->starting_date)) }} - {{ date("m/d/Y", strtotime($obs->end_date)) }}</td><td>{{ date("m/d/Y", strtotime($obs->created_at)) }}</td><td>{{ $obs->state }}<br><a href="/ob_apdetails/{{ $obs->request_id }}">View Details</a></td></tr>
							@endforeach
							</table>
						@endif
					</div>
					<div id="ot" class="tab-pane">
						@if($ots != null)
							<h4>Overtime Requests</h4>
							<!-- Sorting -->
							<p style="text-align: left; padding-bottom:5px;"><label> <a href="/obrequest_sortname">Sort by name </a></label> | <label> <a href="/obrequest_sortteam"> Sort by team  </a></label></p>
							<table id="table">
								<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">Dates Requested</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
							@foreach($ots as $ots)
								<tr><td>{{ $ots->name }}</td><td>{{ $ots->team }}</td><td>{{ date("m/d/Y", strtotime($ots->starting_date)) }} - {{ date("m/d/Y", strtotime($ots->end_date)) }}</td><td>{{ date("m/d/Y", strtotime($ots->created_at)) }}</td><td>{{ $ots->state }}<br><a href="/ot_apdetails/{{ $ots->request_id }}">View Details </a></td></tr>
							@endforeach
							</table>
						@endif
					</div>
					<div id="on" class="tab-pane">
						@if($ons != null)
							<h4>Overnight Requests</h4>
							<!-- Sorting -->
							<p style="text-align: left; padding-bottom:5px;"><label> <a href="/obrequest_sortname">Sort by name </a></label> | <label> <a href="/obrequest_sortteam"> Sort by team  </a></label></p>
							<table id="table">
								<tr><th style="text-align: center;">Name</th><th style="text-align: center;">Team</th><th style="text-align: center;">Dates Requested</th><th style="text-align: center;">Date Submitted</th><th style="text-align: center;">Status</th></tr>
							@foreach($ons as $ons)
								<tr><td>{{ $ons->name }}</td><td>{{ $ons->team }}</td><td>{{ date("m/d/Y", strtotime($ons->starting_date)) }} - {{ date("m/d/Y", strtotime($ons->end_date)) }}</td><td>{{ date("m/d/Y", strtotime($ons->created_at)) }}</td><td>{{ $ons->state }}<br><a href="/on_apdetails/{{ $ons->request_id }}">View Details</a></td></tr>
							@endforeach
							</table>
						@endif
					</div>
				</div>
			</div>
			<br><br>
		</center>
		<script>
		$( document ).ready(function (){
			var width = $( window ).width();
			$(".container").width(width*0.9);
		});
		$( window ).resize(function (){
			var width = $( window ).width();
			$(".container").width(width*0.9);
		});
		(function($) {
			fakewaffle.responsiveTabs(['xs', 'sm']);
		})(jQuery);
		</script>
		
    </body>
</html>
@endsection
