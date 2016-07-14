@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Modify Info</title>
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
		<!-- Pop up message when there's a duplicate email -->
		<?php
			if (session('edit_info_msg')){
				echo"<br><br><div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('edit_info_msg')."
					</div>";
			}
		?>
		<center><br><br>
		<h1>Edit Information</h1>
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
					foreach ($type as $type){
						if ($chosen_user->type_id == $type->type_id){
							echo "<option value='$type->type_id' selected> $type->name </option>";
						}
						else{
							echo "<option value='$type->type_id'> $type->name </option>";
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
					foreach ($team as $team){
						if ($chosen_user->team_id == $team->team_id){
							echo "<option value='$team->team_id' selected> $team->name </option>";
						}
						else{
							echo "<option value='$team->team_id'>$team->name</option>";
						}
					}
					echo "</select>";
				?>
			</td></tr>
			
			<tr><td class="left" valign="top"></td>
				<td class="right"> <a Onclick="return confirm('Are you sure you want to submit?')"> <input class="button" type="submit" value="Submit"></a>
			</td></tr>
		</form>
		</table>
		<a href="/acc"><input class="button2" type="submit" value="< Return to Employees List"></a><br>
		</center>
		
    </body>
</html>
@endsection