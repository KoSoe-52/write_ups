<?php
//return Auth::user();
	// if(Auth::check()){
	// 	if(Auth::user()->role_id == 1)
	// 	{
	// 		$underRole = "Super";
	// 	}else if(Auth::user()->role_id == 2)
	// 	{
	// 		$underRole = "Senior";
	// 	}else if(Auth::user()->role_id == 3)
	// 	{
	// 		$underRole = "Master";
	// 	}else if(Auth::user()->role_id == 4)
	// 	{
	// 		$underRole = "Agent";
	// 	}else if(Auth::user()->role_id == 5)
	// 	{
	// 		$underRole = "Player";
	// 	}
	// }
?>
<div class="sidebar pe-4 pb-3">
	<nav class="navbar bg-secondary navbar-dark">
		<a href="#" class="navbar-brand mx-4 mb-3">
			<h4 class="text-primary">Write Up</h4>
		</a>
		<div class="d-flex align-items-center ms-4 mb-4">
			<div class="position-relative">
				<img class="rounded-circle" src="{{asset('images/logo.png')}}" alt="" style="width: 40px; height: 40px;">
				<!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
			</div>
			<div class="ms-3">
				<h6 class="mb-0">User</h6>
				<span>team</span>
			</div>
		</div>
		<div class="navbar-nav w-100">
			<a href="{{ url('/dashboard') }}" class="nav-item nav-link dashboard p-0"><i class="fa fa-tachometer-alt me-2"></i> Dashboard</a>
			
			<!-- <div class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle bet-lists p-0" data-bs-toggle="dropdown"><i class="fa fa-table me-2"></i>Bet Lists</a>
				<div class="dropdown-menu bg-transparent border-0">
					<a href="#" class="dropdown-item">Crypto 2D Bets</a>
					<a href="#" class="dropdown-item">MM 2D Bets</a>
					
				</div>
			</div> -->

			<a href="{{ url('create') }}" class="nav-item nav-link close-date p-0"><i class="fa fa-times me-2"></i>Write ups List</a>
			<a href="{{ url('create') }}" class="nav-item nav-link close-date p-0"><i class="fa fa-times me-2"></i>Create Writeup</a>

			<a href="{{ route('users.index') }}" class="nav-item nav-link user-list p-0"><i class="fa fa-users me-2"></i>User List</a>
			
			<a href="{{ route('change.password.form') }}" class="nav-item nav-link setting p-0"><i class="fa fa-cog me-2"></i>Setting</a>
			<a href="{{ url('logout') }}" class="nav-item nav-link logout p-0"><i class="fa fa-power-off me-2"></i>Logout</a>
		</div>
	</nav>
</div>