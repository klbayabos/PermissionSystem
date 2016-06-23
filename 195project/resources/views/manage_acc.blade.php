@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Manage Account</title>
		<script src="{{ URL::asset('js/js1/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('js/js1/bootstrap.js') }}"></script>
		
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
			tr.clickableRow { cursor: pointer; } 
			
        </style>
    </head>
    <body>
		*manage_acc.blade.php*
		
		
		<!-- Pop up message after successfully changing the type of user -->
		<?php
			if (session('success_edittype')){
				echo"<br><br><div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('success_edittype')."
					</div>";
			}
		?>
		
		<center>
		<h3>Manage Account<hr></h3><br><br><br>
		
		<div class="wrapper">
		<!-- Search box ($num_acc > 1 && $num_acc != 'null') || $num_acc == 'null')-->
		<form role = "form" id="searchform" method = "POST" action="{{ url('/search') }}">
		{!! csrf_field() !!}		
			<input class="search" type="text" placeholder="Search name, email, or type..." name="searchword" size="30" required>
			<input class="button" type="submit" value="Search">
		</form>
		
		<br><br><br>
		@if($num_acc == 1 && $num_acc != 'null')
			<h4> No results found .. </h4>	
		@else
			@if($num_acc > 1 && $num_acc != 'null')
				<h4> Search results .. </h4>
			@endif
			<table>
				<tr><th><center><h4>List of Employee/s</h4></center></th></tr>
				<tr><th style="text-align:center;">Name</th><th style="text-align:center;">Email</th><th style="text-align:center;">Type</th></tr>
				@foreach ($accounts as $accounts)
					<tr>
						<td>{{ $accounts->name }}</td>
						<td>{{ $accounts->email }}</td>
						<td>{{ $accounts->type }} | <a href="/change/{{ $accounts->id }}"> Modify </a></td>
					</tr>
					
				@endforeach
			</table>
		@endif
		</div>
		</center>
    </body>
</html>
@endsection