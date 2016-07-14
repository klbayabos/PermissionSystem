@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>Stats</title>
		<script type="text/javascript" src="{{ URL::asset('bower_components/Chart.js/dist/Chart.bundle.js') }}"></script>
        <style>
			#chart{
				width:70%;
				height:200px;
			}
			canvas{
				max-width: 1000px;
				height: auto !important;
			}
			.button{
				width:100px;
				margin-left:20px;
			}
        </style>
    </head>
    <body>
		<br><br><br><br>
		<center>
			@if(isset($team))
				<h3><b>Team: </b>{{ $team->name }}</h3>
			@elseif(isset($user))
				<h3><b>User: </b>{{ $user->name }}</h3>
			@else
				<h3><b>Overall Request Frequency:</b></h3>
			@endif
			<button class="button" onclick="del();init1()">Weekly</button>
			<button class="button" onclick="del();init()">Monthly</button>
			<button class="button" onclick="del();init2()">Quarterly</button>
			<button class="button">Yearly</button>
			<div id="chart">
				<canvas id="myChart" height=150></canvas>
			</div>
		</center>
		<script>
			var ctx = document.getElementById("myChart");
			init();
			function init(){
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
								}
							}]
						}
					}
				});
			}
			function init1(){
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
								}
							}]
						}
					}
				});
			}
			function init2(){
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
								}
							}]
						}
					}
				});
			}
			function del(){
				myChart.destroy();
			}
		</script>
    </body>
</html>
@endsection
