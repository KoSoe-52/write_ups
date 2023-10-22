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
			<h4 class="text-success">CTF TRAINER</h4>
		</a>
		<div class="d-flex align-items-center ms-4 mb-4">
			<div class="position-relative">
				<img class="rounded-circle" src="{{asset('images/logo.png')}}" alt="" style="width: 40px; height: 40px;">
				<!-- <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div> -->
			</div>
			<div class="ms-3">
				@if(Auth::check())
				<h6 class="mb-0">{{ Auth::user()->username}}</h6>
				<span>Role  {{Auth::user()->roles->name}}</span>
				@else 
					<h6 class="mb-0">Guess</h6>
					<span></span>
				@endif
			</div>
		</div>
		<div class="navbar-nav w-100">
			<a href="{{ route('dashboard.index') }}" class="nav-item nav-link dashboard p-0"><i class="fa fa-tachometer-alt me-2"></i> Dashboard</a>
			<a href="{{ route('write-ups.index') }}" class="nav-item nav-link write-up-list p-0"><i class="fa fa-th me-2"></i>Write ups List</a>
			@if(Auth::check())
				<a href="{{ route('write-ups.create') }}" class="nav-item nav-link write-up-create p-0"><i class="fa fa-edit me-2"></i>Create Writeup</a>
			@endif
			@if(Auth::check())
				@if(Auth::user()->role_id == 1)
					<a href="{{ route('users.index') }}" class="nav-item nav-link user-list p-0"><i class="fa fa-users me-2"></i>User List</a>
				@endif
			@endif
			@if(Auth::check())
				<a href="{{ route('change.password.form') }}" class="nav-item nav-link setting p-0"><i class="fa fa-cog me-2"></i>Setting</a>
				<a href="{{ route('logout') }}" class="nav-item nav-link logout p-0"><i class="fa fa-power-off me-2"></i>Sign out</a>
			@else 
				<a href="{{ route('/login') }}" class="nav-item nav-link logout p-0"><i class="fa fa-arrow-right me-2"></i>Sign in</a>
			@endif
		</div>
	</nav>
</div>