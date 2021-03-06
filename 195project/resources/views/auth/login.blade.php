 @extends('layouts.app')

@section('content')
<title>Login</title>
<head>

	<link rel="stylesheet" href="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') }}">
	<script src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') }}"></script>
		
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

	#content {
		text-align: center;
		display: inline-block;
	}
	
	.box{	
		color: #000; 
		border-style: groove;		
		padding-top: 20px;
		padding-bottom: 50px;
		padding-left: 60px;
		padding-right: 60px;
		width: 400px;
		margin-top:100px;
	}
	
	.heading {
		color: #7b1113	;	
		padding: 10px 15px;
		border-bottom: 1px solid transparent;
		border-top-right-radius: 3px;
		border-top-left-radius: 3px;

		border-color: #800000; /*#ff3333;*/
	}
	
	p{
		font-size:90%;
		padding-top:10px;
	}
	@media screen and (max-width:430px){
		.box{
			width:100%;
			padding:10%;
		}
	}
	
</style>
<br><br>

	<!-- Pop up message after signing in with a different domain -->
	<?php
		if (session('error_signin')){
			echo"<br><br><br><br><div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				".session('error_signin')."
				</div>";
		}
	?>
	
	<div class="container">
		<section id="content">
			<br>
			<div class="box">
			
				<div class="heading">
					<h3 class="title">@UP Mail Accounts</h3>
				</div><!-- heading -->
				
				<br><br>
					<a class="btn btn-danger" href="redirect/">Sign in with Google</a>
					<p><em>Don't forget to include "@up.edu.ph" in the Email field when you sign in.</em></p>
			
			</div>
		</section><!-- content -->
	</div><!-- container -->
	<br>
@endsection