@extends('layouts.app')

@section('content')
<html>
    <head>
        <title>Manage Account</title>
		<link rel="stylesheet/css" href="{{ URL::asset('footable-bootstrap.latest/css/footable.bootstrap.css') }}">
		<script type="text/javascript" src="{{ URL::asset('footable-bootstrap.latest/js/footable.js') }}"></script>
			
		<style>
			a{
				white-space:nowrap;
			}
            .title {
                font-size: 96px;
            }	
			table{
				table-layout: fixed;
				border: 1px solid #dddddd;
				border-collapse:collapse;
				width:100%;
				margin-bottom: 30px;
			}
			td, th{
				border-bottom: 1px solid #dddddd;
				text-align:center;
			}
			th{
				background-color:#dddddd;
			}
			/* Search box */
			.submitLink {
				background-color: transparent;
				color: #337ab7;
				text-decoration: none;
				border: none;
				cursor: pointer;
			}
			.submitLink:hover{
				color: #23527c;
				text-decoration:underline;
			}
			.submitLink:focus {
				outline: none;
			}
			.search {
				padding:8px 15px;
				background:rgba(50, 50, 50, 0.2);
				border:0px solid #dbdbdb;
			}
			.button {
				position:relative;
				padding:6px 15px;
				left:-8px;
				border:2px solid #207cca;
				background-color:#207cca;
				color:#fafafa;
			}
			.button:hover  {
				background-color:#fafafa;
				color:#207cca;
			}
			.button2 {
				border:2px solid #207cca;
				background-color:#207cca;
				color:#fafafa;
			}
			.button2:hover  {
				background-color:#fafafa;
				color:#207cca;
			}
			@media screen and (max-width:500px){
				td,th{
					font-size:12px;
				}
				tr:hover {
					background: #dddddd;
					cursor: pointer;
				}
			}  
			@media screen and (max-width:560px){
				.footable-detail-row>td>table>tbody>tr:nth-of-type(1)>td:before{
					content: "Email: ";
				}
				.footable-detail-row>td>table>tbody>tr:nth-of-type(2)>td:before{
					content: "Type: ";
				}
				.footable-detail-row>td>table>tbody>tr:nth-of-type(3)>td:before{
					content: "Team: ";
				}
				tr:hover {
					background: #dddddd;
					cursor: pointer;
				}
			}
			@media screen and (max-width:700px) and (min-width:560px){
				.footable-detail-row>td>table>tbody>tr:nth-of-type(1)>td:before{
					content: "Type: ";
				}
				.footable-detail-row>td>table>tbody>tr:nth-of-type(2)>td:before{
					content: "Team: ";
				}
				tr:hover {
					background: #dddddd;
					cursor: pointer;
				}
			}
			@media screen and (max-width:1000px) and (min-width:700px){
				.footable-detail-row>td>table>tbody>tr:nth-of-type(1)>td:before{
					content: "Team: ";
				}
				tr:hover {
					background: #dddddd;
					cursor: pointer;
				}
			}
        </style>
    </head>
    <body>
		
		<!-- Pop up message after successfully editing info of user or deleting a user -->
		<?php
			if (session('manage_acc_msg')){
				echo"<br><div class='alert alert-success'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					".session('manage_acc_msg')."
					</div>";
			}
		?>
	
		<center>
		<br><h2 style="margin-top:20px;">Manage Account</h2><br><br><br>
		
		<form role = "form" id="searchform" method = "GET" action="{{ url('/search') }}">
		{!! csrf_field() !!}		
			<input class="search" type="text" placeholder="Search OICs, name, email, type or team..." name="searchword" size="34" required>
			<input class="button" type="submit" value="Search">
		</form>
		<!-- Search box ($num_acc > 1 && $num_acc != 'null') || $num_acc == 'null')-->
		@if($num_acc == 1 && $num_acc != 'null')
			<h4> No results found .. </h4>	
		@else
			@if($num_acc > 1 && $num_acc != 'null')
				<h4> Search results .. </h4><br>
				<a href="/acc"><input class="button2" type="submit" value="< Return to Employees List"></a><br>
			@endif
		<br><br><br>
			<table style="width:90%" class="footable table" data-filter="#filter">
				<thead>
					<tr>
						<th><center><h4>List of Employee/s</h4></center></th>
						<td data-breakpoints="hide"></td>
						<td data-breakpoints="hide hide1"></td>
						<td data-breakpoints="hide hide1 hide2"></td>
						<td data-type="html">
							<div class="dropdown">
								<button class="button2" type="button" data-toggle="dropdown">+ Click for more options</button>
									<ul class="dropdown-menu" id="oplist">
										<li><a href="/add_emp">Add New Employee</a></li>
										<li class="divider"></li>
										<li><a href="/add_type">Add New Type</a></li>
										<li><a href="/del_type">Delete a Type</a></li>
										<li class="divider"></li>
										<li><a href="/add_team">Add New Team</a></li>
										<li><a href="/del_team">Delete a Team</a></li>
									</ul>
							</div>
						</td>
					</tr>
				</thead>
				<tr>
					<th style="text-align:center;">Name</th>
					<th style="text-align:center;">Email</th>
					<th style="text-align:center;">Type</th>
					<th style="text-align:center;">Team</th>
					<th style="text-align:center;">Action</th>
				</tr>
				@foreach ($accounts as $account)
					<tr>
						<td>{{ $account->name }}</td>
						<td>{{ $account->email }}</td>
						<td>
							@if($account->isOIC=='yes')
								Officer In Charge
							@else
								{{ $account->type }}
							@endif
						</td>
						<td>{{ $account->team }}</td>
						@if($account->tag == 'enabled')
							<td>
								@if($account->isOIC != 'yes' && Auth::user()->type_id == 1 && $account->type_id !=1)
									 <a href="/makeoic/{{ $account->id }}">Set as OIC</a> 
								@elseif($account->isOIC == 'yes' && Auth::user()->type_id == 1)
									<?php
										if(date("F j Y", strtotime($account->OIC_starting_date)) == date("F j Y", strtotime($account->OIC_starting_date))){
											$var = "Officer in Charge for: " . date("F j Y", strtotime($account->OIC_starting_date)) . ".";
										}
										else{
											$var = "Officer in Charge for: " . date("F j Y", strtotime($account->OIC_starting_date)) . " - " . date("F j Y", strtotime($account->OIC_end_date)) . ".";
										}
									?>
									Assigned as Officer in Charge<br> <a href="" Onclick="return alert('<?php echo $var;?>')">Click to view date/s </a> 
								@endif
								@if(Auth::user()->type_id != 1)
									<a href="/change/{{ $account->id }}">  Modify</a>  | <form role = "form" method="POST" action="{{ url('/stats')}}" style="display:inline">{!! csrf_field() !!}<input type="hidden" name="user" value="{{ $account->id }}"><input type="submit" class="submitLink" value="View Stats"></form>
									|<a href="/delete_user/{{ $account->id }}" Onclick="return confirm('Are you sure you want to disable this user?')"> Disable user</a> 
								@endif
							</td>
						@else
							<td> User is disabled | <a href="/enable_user/{{ $account->id }}" Onclick="return confirm('Are you sure you want to activate this account?')"> Activate user </a></td>
						@endif
					</tr>
				@endforeach
			</table>
			<?php
			// config
			$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
			?>
			@if ($accounts->lastPage() > 1)
				<ul class="pagination">
					<li class="{{ ($accounts->currentPage() == 1) ? ' disabled' : '' }}">
						<a href="{{ $accounts->appends(['searchword' => Input::get('searchword')])->url(1) }}">First</a>
					 </li>
					@for ($i = 1; $i <= $accounts->lastPage(); $i++)
						<?php
						$half_total_links = floor($link_limit / 2);
						$from = $accounts->currentPage() - $half_total_links;
						$to = $accounts->currentPage() + $half_total_links;
						if ($accounts->currentPage() < $half_total_links) {
						   $to += $half_total_links - $accounts->currentPage();
						}
						if ($accounts->lastPage() - $accounts->currentPage() < $half_total_links) {
							$from -= $half_total_links - ($accounts->lastPage() - $accounts->currentPage()) - 1;
						}
						?>
						@if ($from < $i && $i < $to)
							<li class="{{ ($accounts->currentPage() == $i) ? ' active' : '' }}">
								<a href="{{ $accounts->appends(['searchword' => Input::get('searchword')])->url($i) }}">{{ $i }}</a>
							</li>
						@endif
					@endfor
					<li class="{{ ($accounts->currentPage() == $accounts->lastPage()) ? ' disabled' : '' }}">
						<a href="{{ $accounts->url($accounts->appends(['searchword' => Input::get('searchword')])->lastPage()) }}">Last</a>
					</li>
				</ul>
			@endif
		@endif
		</center>
		<script type="text/javascript">
			jQuery(function($) {
				$('.footable').footable({
					calculateWidthOverride: function() {
						return {width: $(window).width()}; 
					},
					breakpoints: {
						hide: 400,
						hide1: 560,
						hide2: 700,
						hide3: 1000
					}
				});
			});
		</script>
    </body>
</html>
@endsection