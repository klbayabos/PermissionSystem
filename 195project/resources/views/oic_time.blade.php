@extends('layouts.app')

@section('content')
<html>
    <head>
		<meta charset="utf-8">
        <title>OTForm</title>
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
				width:100px;
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
		*ioc_time.blade.php*

		<center>
		<div class="container">
			<form role = "form" id="typedrop" method = "POST" action="{{ url('/changetypeofuser') }}">
			<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
				<span></span> <b class="caret"></b>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="text" name="emp_id" value="<?php echo $_POST['emp_id']; ?>" style="display:none">
			<input type="text" value="officer in charge" style="display:none" name="new_type">
			<input type="submit" value="Submit">
			</form>
			<script type="text/javascript">
				$(document).ready(function(){
					var screensize=$( window ).width();
					function cb(start, end) {
						if(screensize>652){
							$('#reportrange span').html(start.format('MMMM Do YYYY, h:mm:ss a') + ' - ' + end.format('MMMM Do YYYY, h:mm:ss a'));
						}
					}
					cb(moment(), moment());

					$('#reportrange').daterangepicker({
						"timePicker": true,
						"timePickerIncrement": 15,
						"minDate": moment(),
						"opens": "center"
					}, cb);
					
				});
				$( window ).resize(function() {
					var screensize=$( window ).width();
					if(screensize<652){
						$('#reportrange span').html("");
					}
				});
			</script>
		</div>
		
		</center>
    </body>
</html>
@endsection