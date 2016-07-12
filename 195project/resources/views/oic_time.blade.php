@extends('layouts.app')

@section('content')
<html>
    <head>
		<meta charset="utf-8">
        <title>OIC Time</title>
		<link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
		<script type="text/javascript" src="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
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
		<br><br><br>
		<center><h2><b> Set as Officer in Charge </b></h2></center><br>
		<h4><b>Name: </b>{{ $user->name }}</h4>
		<h4><b>Type: </b>{{ $user->type }}</h4>
		<h4><b>Team: </b>{{ $user->team }}</h4>
		<h4><b>Set TimeFrame: </b></h4>
		<center>
		<div class="container">
			<form role = "form" id="typedrop" method = "POST" action="{{ url('/submitoic') }}">
			{!! csrf_field() !!}
			<div id="reportrange" style="background: #fff; cursor: pointer; border: 1px solid #ccc;margin-left:auto;margin-right:auto;">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
				<span></span> <b class="caret"></b>
			</div><br><br><br>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="datetime" name="fromdate" class="fromdate" style="display:none">
			<input type="datetime" name="todate" class="todate" style="display:none">
			<input type="text" name="id" value="{{ $user->id }}" style="display:none">
			<input type="text" value="officer in charge" style="display:none" name="new_type">
			<input class="button" type="submit" value="Submit">
			</form>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				var screensize=$( window ).width();
				var offset=$('#reportrange').offset();
				$('h4').offset({ left:offset.left });
				if(screensize<=770){
					$( '#reportrange').width(screensize-30);
				}
				function cb(start, end) {
					$('#reportrange span').html(start.format('MMMM Do YYYY, h:mm:ss a') + ' - ' + end.format('MMMM Do YYYY, h:mm:ss a'));
						$(".fromdate").val(start.format('YYYY-MM-DD H:mm'));
						$(".todate").val(end.format('YYYY-MM-DD H:mm'));
				}
				cb(moment(), moment());

				$('#reportrange').daterangepicker({
					"timePicker": true,
					"timePickerIncrement": 15,
					"minDate": moment().startOf('day'),
					"opens": "center"
				}, cb);
			});
			$( window ).resize(function() {
				var screensize=$( window ).width();
				var offset=$('#reportrange').offset();
				$('h4').offset({ left:offset.left });
				if(screensize<=770){
					$( '#reportrange').width(screensize-30);
				}
			});
		</script>
		</center>
    </body>
</html>
@endsection