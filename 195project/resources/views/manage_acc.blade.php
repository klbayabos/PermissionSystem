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
				padding:8px 15px;
				background:rgba(50, 50, 50, 0.2);
				border:0px solid #dbdbdb;
			}
			.button {
				position:relative;
				padding:6px 15px;
				left:-8px;
				border:2px solid #207cca;
				background-color:#207cca;
				color:#fafafa;
			}
			.button:hover  {
				background-color:#fafafa;
				color:#207cca;
			}
			.wrapper{
				overflow:auto;
			}
			.button2 {
				border:2px solid #207cca;
				background-color:#207cca;
				color:#fafafa;
			}
			.button2:hover  {
				background-color:#fafafa;
				color:#207cca;
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
	
		
		
		<center>
		<h2 style="margin-top:20px;">Manage Account</h2><br><br><br>
		
		<form role = "form" id="searchform" method = "POST" action="{{ url('/search') }}">
		{!! csrf_field() !!}		
			<input class="search" type="text" placeholder="Search name, email, type or team..." name="searchword" size="30" required>
			<input class="button" type="submit" value="Search">
		</form>
		<!-- Search box ($num_acc > 1 && $num_acc != 'null') || $num_acc == 'null')-->
		@if($num_acc == 1 && $num_acc != 'null')
			<h4> No results found .. </h4>	
		@else
			@if($num_acc > 1 && $num_acc != 'null')
				<h4> Search results .. </h4><br>
				<a href="/acc"><input class="button2" type="submit" value="< Return to Employees List"></a><br>
			@endif
		<br><br><br>
		<div class="wrapper">
		
			<table>
				<tr><th><center><h4>List of Employee/s</h4></center></th><td></td><td></td><td></td>
					<td>
						<div class="dropdown">
							<button class="button2" type="button" data-toggle="dropdown">+ Click for more options</button>
								<ul class="dropdown-menu" id="oplist">
									<li><a href="/add_emp">Add New Employee</a></li>
									<li class="divider"></li>
									<li><a href="/add_type">Add New Type</a></li>
									<li><a href="/del_type">Delete a Type</a></li>
									<li class="divider"></li>
									<li><a href="/add_team">Add New Team</a></li>
									<li><a href="/del_team">Delete a Team</a></li>
								</ul>
						</div>
					</td>
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
		</center>
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