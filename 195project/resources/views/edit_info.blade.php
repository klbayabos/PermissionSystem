@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Modify Info</title>
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
			
        </style>
    </head>
    <body>
		<!-- Pop up message when there's a duplicate email -->
		<?php
			if (session('edit_info_msg')){
				echo"<br><br><div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('edit_info_msg')."
					</div>";
			}
		?>
		<center>
		<h3>Edit Information</h3>
		
		<table>
		<form role = "form" id="typedrop" method = "POST" action="{{ url('/edit_emp') }}">
		{!! csrf_field() !!}
		<!-- NOTE: ALL FIELDS ARE PREFILLED -->	
			<label> <input type = "hidden" name = "emp_id" value="{{ $chosen_user->id }}" hidden> </label> <!-- Hidden ID -->
			<tr><td class="left" valign="top">Name: </td><td class="right"> <input required type = "text" name = "new_name" value="{{ $chosen_user->name }}"></td></tr>
			<tr><td class="left" valign="top">Email: </td><td class="right"> <input required type = "text" name = "new_email" value="{{ $chosen_user->email }}"></td></tr>
			
			<tr><td class="left" valign="top">Type:</td>
				<td class="right">
				<!-- dropdown for type -->
				<?php
					echo "<select id='newtype' name='new_type'>";
					$type_choices = ["officer in charge", "admin", "approver", "supervisor", "hr", "employee"];
					foreach ($type_choices as $type_choices){
						if ($chosen_user->type == $type_choices){
							echo "<option value='$type_choices' selected> $type_choices </option>";
						}
						else{
							echo "<option value='$type_choices'>$type_choices</option>";
						}
					}
					echo "</select>";
				?>
			</td></tr>
			<tr><td class="left" valign="top">Team:</td>
				<td class="right"> 
				<!-- dropdown for team -->
				<?php
					echo "<select id='teamname' name='new_team'>";
					$team_choices = ["Admin", "Change Management", "Content Development", "EIS", "FMIS", "HRIS", "IS", "ITO/Helpdesk", "QA", "SAIS", "SAIS OU"];
					foreach ($team_choices as $team_choices){
						if ($chosen_user->team == $team_choices){
							echo "<option value='$team_choices' selected> $team_choices </option>";
						}
						else{
							echo "<option value='$team_choices'>$team_choices</option>";
						}
					}
					echo "</select>";
				?>
			</td></tr>
			
			<tr><td class="left" valign="top"></td>
				<td class="right"> <input class="button" type="submit" value="Submit">
			</td></tr>
		</form>
		</table>
		</center>
		
    </body>
</html>
@endsection