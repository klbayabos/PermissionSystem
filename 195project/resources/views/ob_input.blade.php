<!DOCTYPE html>
<html>
    <head>
        <title>OBForm</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<!-- bower components-->
		<script type="text/javascript" src="{{ URL::asset('bower_components/moment/min/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
		<link rel="stylesheet" href="{{ URL::asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" />
		
		<!--nuget-->
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                <!-- font-family: 'Lato';-->
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
			.left{
				text-align:right;
				padding:20px;
			}
			.right{
				text-align:left;
				padding:20px;
			}
			.center{
				text-align:center;
			}
			textarea {
			   resize: none;
			}
        </style>
    </head>
    <body>
		*ob_input.blade.php*
		<div class="header" style="width:100%;height:100px;background-color:#7B1113;"></div>
		<?php include(app_path().'/includes/fncs.php'); ?>
		<center>
		<table>
		<tr><td colspan=2 valign="top" class="center" style="padding-bottom:30px;padding-top:20px"><h1>Official Business Form</h1><td></tr>
		<tr><td class="left">Name:</td> <td class="right">*-- insert code for accessing name --* </td></tr>
		<form method="post">
			<tr><td class="left" valign="top">Team: </td><td class="right"><input type="text" name="team" ></td></tr>
			<tr><td class="left" valign="top">Date & Time of OB: </td> <td class="right">
				<div class="container">
					<div class="row">
						<div class='col-sm-6'>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker1'>
									<input type='text' class="form-control" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker1').datetimepicker();
							});
						</script>
					</div>
				</div>
			</td></tr>
			<tr><td colspan=2 valign="top"><h3>Itenerary/Destination</h3><td></tr>
			<tr><td class="left" valign="top">To:  </td><td class="right"><input type="text" name="to"> </td></tr>
			<tr><td class="left" valign="top">From:  </td><td class="right"><input type="text" name="from"> </td></tr>
			<tr><td class="left" valign="top">Purpose:  </td><td class="right"><textarea name="purpose" cols=50 rows=7 fixed></textarea></td></tr>
			<tr><td class="left"></td><td class="right"><input type="submit"></td></tr>
		</form>
		</table>
		</center>
    </body>
</html>
