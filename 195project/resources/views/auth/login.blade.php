@extends('layouts.app')

@section('content')
<title>Login</title>
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
	}

	#content {
		text-align: center;
		display: inline-block;
	}
	
	.box{	
		color: #000; 
		border-style: groove;		
		padding-top: 20px !important;
		padding-bottom: 50px !important;
		padding-left: 60px !important;
		padding-right: 60px !important;
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
		font-size:80%;
		padding-top:10px;
	}
	
</style>
<br><br>
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