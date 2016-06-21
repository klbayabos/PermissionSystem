@extends('layouts.app')

@section('content')
<html>
    <head>
		<meta charset="utf-8">
        <title>OTForm</title>
		<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css') }}">
		<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('multidatepicker/jquery-ui.multidatespicker.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('js/jquery-bootstrap-datepicker.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/jquery-bootstrap-datepicker.css') }}">
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
			.header{
				width:100%;
				height:100px;
				background-color:#7B1113;
			}
			.navigation{
				display: inline-block;
				width:100%;
				background-color:#c9c9c9;
				height:30px;
			}
			span{
				display: inline-block;
				vertical-align: middle;
				line-height:30px;
			}
			textarea {
			   resize: none;
			}
        </style>
    </head>
    <body>
		*otform.blade.php*
		<center>
		<table>
		<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Overtime Request Form</h1><td></tr>
		<tr><td class="left">Name:</td> <td class="right">*-- insert code for accessing name --* </td></tr>
		<form method="post">
			<tr><td class="left" valign="top">Team: </td><td class="right"><input type="text" name="team" ></td></tr>
			<tr><td class="left" valign="top">Date & Time of OT: </td>
				<td class="right">
					<div id="datepicker" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; width: 100%">
					<span></span></b>
				</div>
				</td></tr>
				<script>
					$(function() {
						$('.ui-datepicker-current-day').removeClass('ui-datepicker-current-day');
						$( "#datepicker" ).multiDatesPicker({
						});
					});
				</script>
			<tr><td class="left" valign="top">Reason/s:  </td><td class="right"><textarea name="purpose" cols=50 rows=7></textarea></td></tr>
			<tr><td class="left"></td><td class="right"><input type="submit" value="Submit" /></td></tr>
		</form>
		</table>
		</center>
    </body>
</html>
@endsection