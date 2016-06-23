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
		*change_usertype.blade.php*
		<center>
		<h3>Change User Type<hr></h3><br><br><br>
		<form role = "form" id="typedrop" method = "POST" action="{{ url('/changetypeofuser') }}">
		{!! csrf_field() !!}

			<p>--- Hindi ko alam bat ayaw magshow ng image ng uplogo ---</p>
			
			<label> <input type = "hidden" name = "emp_id" value="{{ $chosen_user->id }}" hidden> </label> <!-- Hidden ID -->
			{{ $chosen_user->name }} :			<!-- Name -->
			
			<!-- dropdown -->
			<select name="new_type">
				<option value="officer in charge">Officer in charge</option>
				<option value="admin">Admin</option>
				<option value="approver">Approver</option>
				<option value="supervisor">Supervisor</option>
				<option value="hr">HR</option>
				<option value="employee">Employee</option>
			</select>
			
			<br><br>
			<input type="submit" value="Submit">
			
		</form>	
		</center>
    </body>
</html>
@endsection