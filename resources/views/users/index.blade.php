@extends('layouts.master')
@section("title","User Lists")
@section('content')
<div class="bg-secondary rounded h-100 p-4">
	<div class="row">
		<div class="col-sm-12 col-md-6  col-lg-6">
			<h6 class="mb-4 mt-4">User Lists</h6>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-6">
			<a href="{{ route('users.create') }}" class="btn btn-sm btn-info"  style="float:right;"><i class="fa fa-plus"></i> Create Account</a>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Username</th>
					<th scope="col">Role</th>
					<th scope="col">Point</th>
					<th scope="col">Status</th>

                    <th scope="col">Created at</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
			@if(count($users) > 0)
				@foreach($users as $key=>$user)
					<tr>
						<th scope="row">{{ $key + 1}}</th>
						<td>{{$user->username}}</td>
						<td>{{$user->roles->name}}</td>
						<td>{{$user->user_point}}</td>
						<td>
							@if($user->lock == 1)
								<span class="badge bg-success">Active</span>
							@else
								<span class="badge bg-danger">Inactive</span>
							@endif
						</td>
						<td>{{date('d-m-Y H:i',strtotime($user->created_at))}}</td>
						<td>
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" data-id="{{$user->id}}" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-times"></i> Delete</a>
                        </td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="6" style="text-align:center">No data available..</td>
				</tr>
			@endif
			</tbody>
		</table>
		{{$users->links()}}
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
			$(document).on("click",".delete-btn",function(){
				var id = $(this).data("id");
				Swal.fire({
					  title: 'ပယ်ဖျက်မည်မှာသေချာလား?',
                      showCancelButton: true,
                      confirmButtonText: 'ဖျက်မည်',
				}).then((result) => {
					if (result.isConfirmed) {
						var id = $(this).data("id");
						var url = "{{ route('users.destroy', ":id") }}";
							url = url.replace(':id', id);
							$.ajax({
								url: url,
								type: "DELETE",
								data:  [],
								cache:false,
								contentType:false,
								processData:false,
								success: function(response) {
								console.log(JSON.stringify(response))
									if(response.status === true)
									{
										Swal.fire({
												title: response.msg,
												icon:'success',
												width: 300,
												color: '#716add',
												showCancelButton: false,
												showConfirmButton: false,
											});
										setInterval(() => {
											window.location.reload();
										}, 1000);
										
									}else
									{
										Swal.fire({
											title: response.msg,
											width: 300,
											color: '#716add',
											showCancelButton: false,
											showConfirmButton: false
										});
									}
								},error: function (request, status, error) {
									Swal.fire({
											title: "User သည် write up ထည့်သွင်းထားသည်",
											icon:'error',
											width: 300,
											color: '#716add',
											showCancelButton: false,
											showConfirmButton: false
										});
								}
							});
					}
				});
			});
		});
	</script>
@endsection