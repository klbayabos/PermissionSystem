@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>Stats</title>
		<script type="text/javascript" src="{{ URL::asset('bower_components/Chart.js/dist/Chart.bundle.js') }}"></script>
        <style>
			#chart{
				width:1000px;
			}
			canvas{
				height: auto !important;
				margin-bottom:50px;
			}
			.button{
				width:100px;
			}
        </style>
    </head>
    <body>
		<br>
		<center>
			@if(isset($team))
				<h3><b>Team: </b>{{ $team->name }}</h3>
			@elseif(isset($user))
				<h3><b>User: </b>{{ $user->name }}</h3><br>
			@else
				<h1>Overall Request Frequency:</h1><br><br>
			@endif
			<br>
			<form role = "form" method="POST" action="{{ url('/stats')}}" style="display:inline">
			{!! csrf_field() !!}
			@if(isset($team))
				<input type="hidden" name="team" value="{{ $team->team_id }}">
			@elseif(isset($user))
				<input type="hidden" name="user" value="{{ $user->id }}">
			@endif
				<h4 id="year">Year: <select id="years" name="year" onchange="this.form.submit()">
					<?php
						for($a=$min;$a<=$max;$a++){
							echo '<option value='.$a;
							if($a==$year)
								echo " selected ";
							echo ">".$a."</option>";
						}
					?>
							</select>
					@if(isset($teams))
						Team: <select id="teams" name="team" onchange="this.form.submit()">
						@foreach($teams as $teamlist)
							@if(isset($team)&&$team->team_id==$teamlist->team_id)
								<option value="{{$teamlist->team_id}}" selected>{{$teamlist->name}}</option>
							@else
								<option value="{{$teamlist->team_id}}">{{$teamlist->name}}</option>
							@endif
						@endforeach
						</select>
					@endif
				</h4>
			</form>
			<button class="button" onclick="del();init1()">Weekly</button>
			<button class="button" onclick="del();init()">Monthly</button>
			<button class="button" onclick="del();init2()">Quarterly</button>
			<button class="button" onclick="del();init3()">Yearly</button>
			<div id="chart">
				<canvas id="myChart" height=100 width=200></canvas>
			</div>
		</center>
		<script>
			Chart.defaults.global.legend.display = false;
			var ctx = document.getElementById("myChart");
			init();
			function init(){
				var element = document.getElementById("year");
				element.style.visibility='visible' ;
				myChart = new Chart(ctx, {
					responsive: true,
					maintainAspectRatio: false,
					type: 'bar',
					data: {
						labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
						datasets: [{
							label: 'Frequency of Requests',
							data: [{{ implode(',',$monthly) }}],
							backgroundColor: 'rgba(255, 99, 132, 0.2)',
							borderColor: 'rgba(255,99,132,1)',
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								},
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Frequency'
								}
							}],
							xAxes: [{
								ticks: {
									
								},
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Month'
								}
							}]
						}
					}
				});
			}
			function init1(){
				var element = document.getElementById("year");
				element.style.visibility='visible' ;
				myChart = new Chart(ctx, {
					responsive: true,
					maintainAspectRatio: false,
					type: 'bar',
					data: {
						labels: [1
							<?php
								for ($i = 2; $i <= 52; $i++) {
									echo ','.$i;
								}
							?>
						],
						datasets: [{
							label: 'Frequency of Requests',
							data: [{{ implode(',',$weekly) }}],
							backgroundColor: 'rgba(255, 99, 132, 0.2)',
							borderColor: 'rgba(255,99,132,1)',
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								},
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Frequency'
								}
							}],
							xAxes: [{
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Week'
								}
							}]
						}
					}
				});
			}
			function init2(){
				var element = document.getElementById("year");
				element.style.visibility='visible' ;
				myChart = new Chart(ctx, {
					responsive: true,
					maintainAspectRatio: false,
					type: 'bar',
					data: {
						labels: ["q1","q2","q3","q4"],
						datasets: [{
							label: 'Frequency of Requests',
							data: [{{ implode(',',$quarterly) }}],
							backgroundColor: 'rgba(255, 99, 132, 0.2)',
							borderColor: 'rgba(255,99,132,1)',
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							
							yAxes: [{
								ticks: {
									beginAtZero:true
								},
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Frequency'
								}
							}],
							xAxes: [{
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Quarter'
								}
							}]
						}
					}
				});
			}
			function init3(){
				var element = document.getElementById("year");
				element.style.visibility='hidden' ;
				myChart = new Chart(ctx, {
					responsive: true,
					maintainAspectRatio: false,
					type: 'bar',
					data: {
						labels: [{{ $min }},
							<?php
								for($a=$min+1;$a<=$max;$a++){
									echo $a;
								}
							?>
						],
						datasets: [{
							label: 'Frequency of Requests',
							data: [{{ implode(',',$yearly) }}],
							backgroundColor: 'rgba(255, 99, 132, 0.2)',
							borderColor: 'rgba(255,99,132,1)',
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							
							yAxes: [{
								ticks: {
									beginAtZero:true
								},
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Frequency'
								}
							}],
							xAxes: [{
								scaleLabel: {
									fontSize:20,
									display: true,
									labelString: 'Year'
								}
							}]
						}
					}
				});
			}
			function del(){
				myChart.destroy();
			}
			$( document ).ready( function(){
				var screensize = $( window ).width();
				if(screensize<=1050){
					$('#chart').width(screensize-50);
				}
				else{
					$('#chart').width(1000);
				}
			});
			$( window ).resize( function(){
				var screensize = $( window ).width();
				if(screensize<=1050){
					$('#chart').width(screensize-50);
				}
				else{
					$('#chart').width(1000);
				}
			});
		</script>
    </body>
</html>
@endsection
