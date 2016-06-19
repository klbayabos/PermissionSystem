@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }
			
            body {
                margin: 0;
                font-weight: 100;
                font-family: 'Lato';
            }
			
			/* Login Form text*/
			
			h1{
				color: #fe1a00;	
				padding-bottom: 40px;
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
			}
			
			#content form input[type="text"], #content form input[type="password"] {
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				-ms-border-radius: 3px;
				-o-border-radius: 3px;
				border-radius: 3px;
				-webkit-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
				-moz-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
				-ms-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
				-o-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
				box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
				-webkit-transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-ms-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				transition: all 0.5s ease;
				background: #eae7e7 url(http://cssdeck.com/uploads/media/items/8/8bcLQqF.png) no-repeat;
				border: 1px solid #c8c8c8;
				color: #777;
				font: 13px Helvetica, Arial, sans-serif;
				margin: 0 0 10px;
				padding: 15px 10px 15px 40px;
				width: 80%;
			}
			
			#email { 
				background-position: 10px 10px !important;
			}
			#password { 
				background-position: 10px -53px !important 
			}
			
			/* Login button */
			
			#content form input[type="submit"] {				
				-moz-box-shadow:inset 0px 1px 0px 0px #f29c93;
				-webkit-box-shadow:inset 0px 1px 0px 0px #f29c93;
				box-shadow:inset 0px 1px 0px 0px #f29c93;
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #fe1a00), color-stop(1, #ce0100));
				background:-moz-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
				background:-webkit-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
				background:-o-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
				background:-ms-linear-gradient(top, #fe1a00 5%, #ce0100 100%);
				background:linear-gradient(to bottom, #fe1a00 5%, #ce0100 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100',GradientType=0);
				background-color:#fe1a00;
				-moz-border-radius:6px;
				-webkit-border-radius:6px;
				border-radius:6px;
				border:1px solid #d83526;
				cursor:pointer;
				float: center;
				color:#ffffff;
				font-family:Arial;
				font-size:15px;
				font-weight:bold;
				padding:6px 24px;
				text-decoration:none;
				text-shadow:0px 1px 0px #b23e35;
				margin-top: 20px;
			}
			
        </style>
    </head>
    <body>
	
        <div class="container">
			<section id="content">
				<br><br>
				<div class="box">
					<form method="POST" action="{{ url('/login') }}">
						<h1>Login Form</h1>
						<div class="fields">
							<input type="text" placeholder="Email" required="" id="email" /><br>
							<input type="password" placeholder="Password" required="" id="password" />
						</div>
						<div>
							<input type="submit" value="Log in" />
						</div>
					</form><!-- form -->
				</div>
			</section><!-- content -->
			
		</div><!-- container -->
		
    </body>
</html>
@endsection