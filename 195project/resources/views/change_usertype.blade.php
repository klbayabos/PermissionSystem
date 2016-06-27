@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Change UserType</title>
		<script src="{{ URL::asset('js/j1/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('js/j1/bootstrap.js') }}"></script>
		
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
		<!-- *change_usertype.blade.php* -->
		<center>
		<h3>Change User Type<hr></h3><br><br><br>
		<form role = "form" id="typedrop" method = "POST" action="{{ url('/changetypeofuser') }}">
		{!! csrf_field() !!}

			
			<label> <input type = "hidden" name = "emp_id" value="{{ $chosen_user->id }}" hidden> </label> <!-- Hidden ID -->
			{{ $chosen_user->name }} :			<!-- Name -->
			
			<!-- dropdown -->
			<select id="newtype" name="new_type">
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
		<br>
		<form method="post" action="{{ url('/set_oic_time') }}">
			<input type="text" name="emp_id" value="{{$chosen_user->id}}" style="display:none">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="submit" id="invsubmit" value="Make Temporary OIC">
		</form>
		</center>
		<script>
			$( "#newtype" ).change(function() {
				if($(this).val()=="officer in charge"){
					$("#invsubmit").css("display","inline")
				}
				else{
					$("#invsubmit").css("display","none")
				}
			});
		</script>
    </body>
</html>
@endsection