@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Delete Team</title>
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
		<center>
		<h3>Deleting a Team</h3>
		<table>
		<form role = "form" id="teamdrop" method = "POST" action="{{ url('/delete_team') }}">
		{!! csrf_field() !!}
		<!-- NOTE: ALL FIELDS ARE PREFILLED -->	
			<tr><td class="left" valign="top">Team:</td>
				<td class="right"> 
				<!-- dropdown for team -->
				<?php
					echo "<select id='teamname' name='selected_team'>";
					foreach ($team as $team){
							echo "<option value='$team->name'>$team->name</option>";
					}
					echo "</select>";
				?>
			</td></tr>
			
			<tr><td class="left" valign="top"></td>
				<td class="right"> <a Onclick="return confirm('Are you sure you want to delete this team?')"> <input class="button" type="submit" value="Delete"> </a>
			</td></tr>
		</form>
		</table>
		</center>
		
    </body>
</html>
@endsection