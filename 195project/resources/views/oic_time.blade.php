@extends('layouts.app')

@section('content')
<html>
    <head>
		<meta charset="utf-8">
        <title>OIC Time</title>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/jquery/1/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/momentjs/latest/moment.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css') }}">
		
		<link rel="stylesheet" href="{{ URL::asset('//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css') }}">
		<script type="text/javascript" src="{{ URL::asset('//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js') }}"></script>
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
				max-width:800px;
				position:relative;
				top:30px;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

			span{
				display: inline-block;
				vertical-align: middle;
				line-height:30px;
			}
        </style>
    </head>
    <body>
		<!-- *ioc_time.blade.php* -->

		<center>
		<div class="container"><br><br><br>
			<form role = "form" id="typedrop" method = "POST" action="{{ url('/acc') }}">
			{!! csrf_field() !!}
			<div id="reportrange" style="background: #fff; cursor: pointer; border: 1px solid #ccc;margin-left:auto;margin-right:auto;">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
				<span></span> <b class="caret"></b>
			</div><br><br><br>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="text" name="emp_id" value="{{ $emp_id }}" style="display:none">
			<input type="text" value="officer in charge" style="display:none" name="new_type">
			<input type="submit" value="Submit">
			</form>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				var screensize=$( window ).width();
				function cb(start, end) {
					$('#reportrange span').html(start.format('MMMM Do YYYY, h:mm:ss a') + ' - ' + end.format('MMMM Do YYYY, h:mm:ss a'));
				}
				cb(moment(), moment());

				$('#reportrange').daterangepicker({
					"timePicker": true,
					"timePickerIncrement": 15,
					"minDate": moment(),
					"opens": "center"
				}, cb);
				var screensize=$( window ).width();
			});
			$( window ).resize(function() {
				var screensize=$( window ).width();
			});
		</script>
		</center>
    </body>
</html>
@endsection