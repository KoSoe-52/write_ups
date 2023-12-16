@extends('layouts.master')
@section("title","Update Account")
@section('content')
<div class="col-12 col-xl-6">
	<div class="bg-secondary rounded h-100 p-4">
		<h6 class="mb-4">Update Account</h6>
		@if(session('status'))
			<div class="text-success">
				{{session('status')}}
			</div>
		@endif
		<form class="form mb-2" id="insertForm" method="POST" action="{{ route('users.update',$user->id) }}">
			@csrf
            @method('PUT')
			<div class="row">
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="username">Username (Read only field)</label>
						<input type="text" id="username" value="{{ $user->username }}"  class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off">
							<span class="invalid-feedback " role="alert">
								<strong class='username'></strong>
							</span>
					</div>
				</div>
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="password">Password  (min:5 and max:16 characters)</label>
						<input type="password"  id="password"  class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
							<span class="invalid-feedback" role="alert">
								<strong class='password'></strong>
							</span>
					</div>
				</div>
                <div class="col-12  mb-1">
                    <label>Select role <b class="text-danger">*</b></label>
                </div>
				<div class="col-12  mb-4 row pl-3">
                    <?php
                        if($user->role_id == 1)
                        {
                            $admin = "checked";
                            $user01 = " ";
                            $team = " ";
                        }else if($user->role_id == 2)
                        {
                            $admin = " ";
                            $user01 = "checked";
                            $team = "";
                        }else if($user->role_id == 3)
                        {
                            $admin = " ";
                            $user01 = " ";
                            $team = "checked";
                        }
                    ?>
                    <div class="form-check col-4">
                        <input class="form-check-input"  type="radio" name="role_id" {{$admin}}  id="role_one" value="1">
                        <label class="form-check-label" for="role_one">
                           Admin 
                        </label>
                    </div>
                    <div class="form-check col-4">
                        <input class="form-check-input"  type="radio" name="role_id" {{$user01}}   id="role_two" value="2">
                        <label class="form-check-label" for="role_two">
                           User
                        </label>
                    </div>
                    <div class="form-check col-4">
                        <input class="form-check-input"  type="radio" name="role_id" {{$team}}  id="role_three" value="3">
                        <label class="form-check-label" for="role_three">
                           Team
                        </label>
                    </div>
				</div>
                <div class="col-12  mb-1">
                    <label>Active or Inactive <b class="text-danger">*</b></label>
                </div>
                <?php
                        if($user->lock == 1)
                        {
                            $active = "checked";
                            $inactive = " ";
                        }else 
                        {
                            $active = "";
                            $inactive = "checked";
                        }
                    ?>
				<div class="col-12  mb-4 row pl-3">
                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="lock" {{$active}}  id="lock_one" value="1">
                        <label class="form-check-label" for="lock_one">
                           Active 
                        </label>
                    </div>
                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="lock" {{$inactive}} id="lock_two" value="2">
                        <label class="form-check-label" for="lock_two">
                           Inactive
                        </label>
                    </div>
				</div>
				<div class="col-12 col-xl-6  mt-3">
					<div class="form-group">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-info mb-2"><i class="fa fa-arrow-left"></i> Back</a>
						<button type="submit" class="btn btn-sm btn-success mb-2"><i class="fa fa-paper-plane"></i> Update Account</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$(".user-list").addClass("active");
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
		});
	</script>
@endsection