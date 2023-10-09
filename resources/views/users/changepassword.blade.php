@extends('layouts.master')
@section("title","User Detail")
@section('content')
<div class="col-12 col-xl-6">
	<div class="bg-secondary rounded h-100 p-4">
		<h6 class="mb-4">Change Password</h6>
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
						<label for="password">Old Password <b class="text-danger">*</b> </label>
						<input type="password" id="password"  class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
							<span class="invalid-feedback " role="alert">
								<strong class='password'></strong>
							</span>
					</div>
				</div>
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="new_password">New Password <b class="text-danger">*</b></label>
						<input type="password"  id="new_password"  class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="off">
							<span class="invalid-feedback" role="alert">
								<strong class='new_password'></strong>
							</span>
					</div>
				</div>
				<div class="col-12  mb-4">
					<div class="form-group">
						<label for="confirm_password">Confirm New Password <b class="text-danger">*</b></label>
						<input type="password" name="confirm_password"  id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" autocomplete="off">
							<span class="invalid-feedback" role="alert">
								<strong class='confirm_password'></strong>
							</span>
					</div>
				</div>
				<div class="col-12 col-xl-6  mt-3">
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-success mb-2"><i class="fa fa-paper-plane"></i> Change password</button>
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
			$(".setting").addClass("active");
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(document).on("submit","#insertForm",function(ev){
				ev.preventDefault();
				var formdata = new FormData(this);
				$.ajax({
					url:  "{{ route('change.password') }}",
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