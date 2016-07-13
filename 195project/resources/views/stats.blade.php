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
				max-width: 800px;
				height: auto !important;
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
			<div id="chart">
				<canvas id="myChart" height=150></canvas>
			</div>
		</center>
		<script>
			var ctx = document.getElementById("myChart");
			var myChart = init();
			function init(){
				return new Chart(ctx, {
					responsive: true,
					maintainAspectRatio: false,
					type: 'bar',
					data: {
						labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
						datasets: [{
							label: 'Frequency of Requests',
							data: [12, 19, 3, 5, 2, 3],
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
		</script>
    </body>
</html>
@endsection
