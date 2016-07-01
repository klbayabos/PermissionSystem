@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Manage Account</title>
		<script src="{{ URL::asset('js/js1/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('js/js1/bootstrap.js') }}"></script>
		
		<!-- do not delete: for pop up stuff -->
		<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
			
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
            }
            .title {
                font-size: 96px;
            }	
			table{
				table-layout: fixed;
				border: 1px solid #dddddd;
				border-collapse:collapse;
				width:1000px;
				margin-bottom: 30px;
				min-width:600px;
			}
			td, th{
				border-bottom: 1px solid #dddddd;
				text-align:center;
			}
			th{
				background-color:#dddddd;
			}
			
			/* Search box */
			
			.search {
				padding:5px 5px;
				background:rgba(50, 50, 50, 0.2);
				border:0px solid #dbdbdb;
			}
			.searchbutton {
				position:relative;
				padding:1px 5px;
				left:-8px;
				border:2px solid #207cca;
				background-color:#207cca;
				color:#fafafa;
				margin: 8px;	
			}
			.searchbutton:hover, .button2:hover {
				background-color:#fafafa;
				color:#207cca;
			}
			::-webkit-input-placeholder {
				font-size: 12px;
			}
			.wrapper{
				overflow:auto;
			}
			.button2 {
				border:2px solid #207cca;
				background-color:#207cca;
				color:#fafafa;
			}
			h4{
				text-align: center;
			}
			#parent {
				display: flex;
			}
			.wrapper {
				width: 80%;
				padding-left: 5%; 
				padding-right: 5%; 
			}
			.sidelist {
				flex: 1;
			}
        </style>
    </head>
    <body>
		
		<!-- Pop up message after successfully editing info of user or deleting a user -->
		<?php
			if (session('manage_acc_msg')){
				echo"<br><div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('manage_acc_msg')."
					</div>";
			}
		?>
	
		
		
		<h2 style="margin-top:20px; text-align: center;">Manage Account</h2><br><br><br>
		
		<!-- Search box ($num_acc > 1 && $num_acc != 'null') || $num_acc == 'null')-->
		@if($num_acc == 1 && $num_acc != 'null')
			<h4> No results found .. </h4>	
		@else
			@if($num_acc > 1 && $num_acc != 'null')
				<h4> Search results .. </h4>
			@endif
		
		<div id="parent">
		
			<div class="sidelist">
				{{-- nav nav-list--}}
				<ul class="nav nav-pills nav-stacked">
					
					<form role = "form" id="searchform" method = "POST" action="{{ url('/search') }}">
					{!! csrf_field() !!}		
						<li><input class="search" type="text" placeholder="Search name, email, type or team..." name="searchword" size="25" required></li>
						<center><li><input class="searchbutton" type="submit" value="Search"></li></center>
					</form>
					<li class="nav-divider"></li>
					<li class="nav-header">Add Users</li>
						<li><a href="/add_emp"> Add Employee </a></li>
						<li class="nav-divider"></li>
					<li class="nav-header">Configure Type</li>
						<li><a href="/add_type"> Add New Type </a></li>
						<li><a href="#"> Delete a Type </a></li>
						<li class="nav-divider"></li>
					<li class="nav-header">Configure Team </li>
						<li><a href="/add_team"> Add New Team </a></li>
						<li><a href="#"> Delete a Team </a></li>
						<li class="nav-divider"></li>
				</ul>
			</div>
			<div class="wrapper">
			
				<table>
					<tr><th><center><h4>List of Employee/s</h4></center></th><td></td>
						<td><a href="/add_type"><input class="button2" type="submit" value="+ Add New Type"></a></td>
						<td><a href="/add_team"><input class="button2" type="submit" value="+ Add New Team"></a></td>
						<td><a href="/add_emp"><input class="button2" type="submit" value="+ Add Employee"></a></td>
					</tr>
					<tr><th style="text-align:center;">Name</th><th style="text-align:center;">Email</th>
					<th style="text-align:center;">Type</th>
					<th style="text-align:center;">Team</th>
					<th style="text-align:center;">Action</th>
					</tr>
					@foreach ($accounts as $accounts)
						<tr>
							<td>{{ $accounts->name }}</td>
							<td>{{ $accounts->email }}</td>
							<td>{{ $accounts->type }}</td>
							<td>{{ $accounts->team }}</td>
							<td><a href="/change/{{ $accounts->id }}"> Modify </a> | <a href="/delete_user/{{ $accounts->id }}" Onclick="return confirm('Are you sure you want to delete this user?')"> Delete user </a></td>
						</tr>
					@endforeach
				</table>
			@endif
			</div>
		
		</div><!-- id="parent" -->
		<script>
			$( document ).ready(function() {
				var width=$( window ).width();
				$(".wrapper").width(width);
				if(width<1000){
					$(".wrapper table").width(width);
				}
				else{
					$(".wrapper table").width("1000px");
				}
			});
			$( window ).resize(function() {
				var width=$( window ).width();
				$(".wrapper").width(width);
				if(width<1000){
					$("table").width("100%");
				}
				else{
					$("table").width("1000px");
				}
			});
		</script>
    </body>
</html>
@endsection