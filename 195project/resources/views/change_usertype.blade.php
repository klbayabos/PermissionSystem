@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Change UserType</title>
		<link rel="stylesheet" href="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') }}">
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
			
			
        </style>
    </head>
    <body>
		*manage_acc.blade.php*
		<center>
		<h3>Change Type<hr></h3><br><br><br>
		<p> ---NOT YET DONE </p><br><br>
		<form role = "form" id="typedrop" method = "POST" action="{{ url('/changetypeofuser') }}">
		{!! csrf_field() !!}

			
			{{ $chosen_user->name }} : 
			
			<!-- dropdown -->
			<select name="new_type">
				<option value="admin">admin</option>
				<option value="approver">approver</option>
				<option value="supervisor">supervisor</option>
				<option value="hr">hr</option>
				<option value="employee">employee</option>
			</select>
			
			<br><br>
			<input type="submit" value="Submit">
			
		</form>	
		
		
		
		</center>
    </body>
</html>
@endsection