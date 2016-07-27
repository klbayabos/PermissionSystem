@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>ON Details</title>
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
			.hideContent {
				overflow: hidden;
				line-height: 1em;
				height: 1em;
			}
			.showContent {
				line-height: 1em;
				height: auto;
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
    <body onload="adjustComment1(); adjustComment2()">
		<center>
		<br><br><br>
		<div id="container" style="margin:0;border:1px #DDDDDD solid;padding:15px;max-width:900px;">
			<h3>Overnight Request Details</h3><br>
				<div class="container" style="text-align:left;word-wrap:break-word">
				<b>Date Submitted:</b> {{ date("F j Y, h:i A", strtotime($on->created_at)) }}<br>
				<b>Date Requested:</b> {{ date("F j Y", strtotime($on->starting_date)) }} - {{ date("F j Y", strtotime($on->end_date)) }}<br>
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
				@if(!empty($dates))
					<b>Approved Dates:</b> 
					@if(count($dates)!=1)
						<select>
						@foreach($dates as $dates)
								<option value="{{ $dates->approved_date }}">{{ date("l, F j Y", strtotime($dates->approved_date)) }}</option>
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
					@if (isset($endorser))
					<tr>
						<td>{{ $endorser->endorser }}</td>
						<td>{{ $endorser->isEndorsed }}</td>
						<td>
							<div class="content hideContent">
								<p id="comment1" value="{{ $endorser->comment }}">{{ $endorser->comment }} </p>
							</div>
							<div class="show-more" id="show_comment1" style="display:none;">
								<a href="#">Show more</a>
							</div>
						</td>
					</tr>
					@endif
					@if (isset($head))
					<tr>
						<td>{{ $head->approver }}</td>
						<td>{{ $head->isApproved }}</td>
						<td>
							<div class="content hideContent">
								<p id="comment2" value="{{ $head->comment }}">{{ $head->comment }}</p>
							</div>
							<div class="show-more" id="show_comment2" style="display:none;">
								<a href="#">Show more</a>
							</div>
						</td>
					</tr>
					@endif
				</table>
			</div>
			@endif
			<!-- delete button-->
			@if($on->status != 'Approved')
			<a href="/delete_on/{{ $on->request_id }}" Onclick="return confirm('Are you sure you want to delete this request?')"><input class="button" type="submit" value="Delete request"></a>
			@endif
		</div>
			
		</center>
		<br><br><br><br>
		<script>
			function adjustComment1(){
				var comment_len1 = document.getElementById("comment1").innerHTML;
				if(comment_len1.length >= 25 || comment_len1.length == undefined){
					document.getElementById("show_comment1").style.display = "block";
				}
			}
			function adjustComment2(){
				var comment_len2 = document.getElementById("comment2").innerHTML;
				if(comment_len2.length >= 25 || comment_len2.length == undefined){
					document.getElementById("show_comment2").style.display = "block";
				}
			}
			$( document ).ready(function() {
				var width=$( window ).width();
				$("#container").width(width-35);
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
				$("#container").width(width-35);
				var width=$( "#container" ).width();
				$(".container").width(width-20);
				$(".container1").width(width-20);
				if($( window ).width()<475){
					$( ".commentfield" ).width($(".commentfield").parent().width());
					$( ".textarea" ).width($(".textarea").parent().width()-20);
				}
			});
			$(".show-more a").on("click", function() {
				var $this = $(this);
				var $content = $this.parent().prev("div.content");
				var linkText = $this.text().toUpperCase();
				
				if(linkText === "SHOW MORE"){
					linkText = "Show less";
					$content.switchClass("hideContent", "showContent", 400);
				} else {
					linkText = "Show more";
					$content.switchClass("showContent", "hideContent", 400);
				};

				$this.text(linkText);
			});
		</script>
    </body>
</html>
@endsection
