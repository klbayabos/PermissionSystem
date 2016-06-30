@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Add Type</title>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/jquery/1/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/momentjs/latest/moment.min.js') }}"></script>
		
		<link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
		<script type="text/javascript" src="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
		
		<!-- do not delete: for pop up stuff -->
		<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
			
		<style>
			html{
				overflow-y: scroll;
			}
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

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
			.left{
				text-align:right;
				padding:20px;
			}
			.right{
				text-align:left;
				padding:20px;
			}
			.center{
				text-align:center;
			}
        </style>
    </head>
    <body>
		<!-- Pop up message when there's a duplicate type -->
		<?php
			if (session('add_type_msg')){
				echo"<br><div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('add_type_msg')."
					</div>";
			}
		?>
		<center>
			<table>
			<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Add New User Type</h1><td></tr>
			
			<form role = "form" id="addtype" method = "POST" action="{{ url('/new_type') }}">
			{!! csrf_field() !!}			
				<tr><td class="left">Type Name:</td> <td class="right"> <input type="text" name="added_type" required></td></tr>
				<tr><td class="left"></td><td class="right"><input class="button" type="submit" value="Submit" /></td></tr>
			</form>
			
			</table>
		</center>
    </body>
</html>
@endsection