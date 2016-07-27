@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Delete Type</title>
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
        </style>
    </head>
    <body>
		<center><br>
		<h1>Deleting a Type</h1><br>
		<table>
		<form role = "form" id="typedrop" method = "POST" action="{{ url('/delete_type') }}">
		{!! csrf_field() !!}
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
