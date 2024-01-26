@extends('layouts.master')
@section("title","Create Account")
@section('content')
<div class="col-12 col-xl-6">
	<div class="bg-secondary rounded h-100 p-4">
		<h6 class="mb-4">Create Account</h6>
		@if(session('status'))
			<div class="text-success">
				{{session('status')}}
			</div>
		@endif
		<form class="form mb-2" id="insertForm">
			@csrf
			<div class="row">
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="username">Username <b class="text-danger">*</b> (min:5 and max:16 characters)</label>
						<input type="text" id="username"  class="form-control @error('username') is-invalid @enderror" name="username" autocomplete="off">
							<span class="invalid-feedback " role="alert">
								<strong class='username'></strong>
							</span>
					</div>
				</div>
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="password">Password <b class="text-danger">*</b> (min:5 and max:16 characters)</label>
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
                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="role_id" checked  id="role_one" value="1">
                        <label class="form-check-label" for="role_one">
                           Admin
                        </label>
                    </div>
                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="role_id"  id="role_two" value="2">
                        <label class="form-check-label" for="role_two">
                           User
                        </label>
                    </div>
                    <div class="form-check col-4">
                        <input class="form-check-input" type="radio" name="role_id"  id="role_three" value="3">
                        <label class="form-check-label" for="role_three">
                           Team
                        </label>
                    </div>
				</div>
				<div class="col-12 col-xl-6  mt-3">
					<div class="form-group">
						<a href="{{ url()->previous() }}" class="btn btn-sm btn-info mb-2"><i class="fa fa-arrow-left"></i> Back</a>
						<button type="submit" class="btn btn-sm btn-success mb-2"><i class="fa fa-paper-plane"></i> Create Account</button>
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
			$(document).on("submit","#insertForm",function(ev){
				ev.preventDefault();
				var formdata = new FormData(this);
				$.ajax({
					url:  "{{ route('users.store') }}",
					type: "POST",
					data:  formdata,
					cache:false,
					contentType:false,
					processData:false,
					success: function(response) {
						console.log(JSON.stringify(response))
						if(response.status === true)
						{
							Swal.fire({
									title: response.msg,
									width: 300,
									color: '#716add',
									showCancelButton: false,
									showConfirmButton: false,
									timer:1000
								});
							window.location.reload();
						}else
						{
							$.each( response.data, function( key, value ) {
								//console.log(key+"/"+value);
								$("."+key).text(value);
								$("#"+key).addClass("is-invalid");
							});
						}
					},error: function (request, status, error) {
						console.log(error);
                        Swal.fire({
								title: error,
								width: 300,
								color: '#716add',
								showCancelButton: false,
								showConfirmButton: false
							});
                    }
				});
			});
		});
	</script>
@endsection