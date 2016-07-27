<title>Requests</title>
<head>
</head>
<style>
	html, body {
		height: 100%;
	}
	
	body {
		margin: 0;
		font-weight: 100;
		font-family: 'Lato';
	}
	
	.container {
		text-align: center;
		vertical-align: middle;
		padding:0px;
	}
	
</style>
<br><br>
	<div class="container">
		{{$content}}<br><br>
		@if($type == 'Official Business')
			<li><a href="{{ url('/officialbusiness') }}"> Click here to login to the system </a></li>
		@elseif($type == 'Overtime')
			<li><a href="{{ url('/overtime') }}"> Click here to login to the system </a></li>
		@elseif($type == 'Overnight')
			<li><a href="{{ url('/overnight') }}">  Click here to login to the system </a></li>
		@endif
	</div><!-- container -->
	<br>