@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Delete Type</title>
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
		<center>
		<h3>Deleting a Team</h3>
		<table>
		<form role = "form" id="typedrop" method = "POST" action="{{ url('/delete_type') }}">
		{!! csrf_field() !!}
		<!-- NOTE: ALL FIELDS ARE PREFILLED -->	
			<tr><td class="left" valign="top">Type:</td>
				<td class="right"> 
				<!-- dropdown for type -->
				<?php
					echo "<select id='typename' name='selected_type'>";
					foreach ($type as $type){
							echo "<option value='$type->name'>$type->name</option>";
					}
					echo "</select>";
				?>
			</td></tr>
			
			<tr><td class="left" valign="top"></td>
				<td class="right"> <a Onclick="return confirm('Are you sure you want to delete this type?')"> <input class="button" type="submit" value="Delete"> </a>
			</td></tr>
		</form>
		</table>
		</center>
		
    </body>
</html>
@endsection