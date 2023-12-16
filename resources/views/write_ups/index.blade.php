@extends('layouts.master')
@section("title","Write Up Lists")
@section('content')
<div class="bg-secondary rounded h-100 p-4">
	<form class="form">
		<div class="row">
			<div class="col-md-6 col-xl-3">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" id="title" class="form-control"
						placeholder="Enter title" value="{{ request()->title }}" name="title" autocomplete="off">
				</div>
			</div>

			<div class="col-md-6 col-xl-3">
				<div class="form-group">
					<label for="category_id">Category</label>
					<select class="form-select mb-3" id="category_id" name="category_id">
						<option></option>
						@if(count($categories) > 0 )
							@foreach($categories as $key=>$category)
								@if($category->id == request()->category_id)
									<option value="{{$category->id}}" selected>{{$category->name}}</option>
								@else
									<option value="{{$category->id}}">{{$category->name}}</option>
								@endif
							@endforeach
						@endif
					</select>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<div class="form-group">
					<label for="search">Search</label><br/>
					<button type="submit" class="btn btn-sm btn-success" id="search"><i class="fa fa-search"></i> Search</button>
					<!-- <button type="reset" class="btn btn-light-secondary me-1 mb-1"></button> -->
				</div>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-sm-12 col-md-6  col-lg-6">
			<h6 class="mb-4 mt-1">Write up Lists</h6>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Category</th>
					<th scope="col">Add User</th>
					<th scope="col">Point</th>
					<th scope="col">Private / Public</th>
                    <th scope="col">Created at</th>
					<th scope="col"> </th>
				</tr>
			</thead>
			<tbody>
			@if(count($write_ups) > 0)
				@foreach($write_ups as $key=>$write_up)
					<tr>
						<th scope="row">{{ $key + 1}}</th>
						<td>{{$write_up->title}}</td>
						<td>{{$write_up->categories->name}}</td>
						<td>{{$write_up->users->username}}</td>
						<td>{{$write_up->point}}</td>
						<td>
							@if($write_up->status == 1)
								<span class="badge bg-danger">Private</span>
							@else
								<span class="badge bg-success">Public</span>
							@endif
						</td>
						<td>{{date('d-m-Y H:i',strtotime($write_up->created_at))}} </td>
						<td>
							@if(Auth::check())
								@if((Auth::user()->role_id == 1 || Auth::user()->id == $write_up->user_id) || ((Auth::user()->role_id == 2 && Auth::user()->role_id == 3) || $write_up->status == 2))
									<a href="{{ route('write-ups.show',$write_up->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</a>
								@endif
							@elseif($write_up->status == 2)
								<a href="{{ route('write-ups.show',$write_up->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</a>
							@endif
							@if(Auth::check())
								@if((Auth::user()->role_id == 1 || Auth::user()->id == $write_up->user_id))
									<a href="{{ route('write-ups.edit',$write_up->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
								@endif
							@endif
							@if(Auth::check())
								@if((Auth::user()->role_id == 1 || Auth::user()->id == $write_up->user_id))
									<button class="btn btn-sm btn-danger delete-btn" data-id="{{ $write_up->id }}"><i class="fa fa-times"></i> Delete</button>
								@endif
							@endif
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7" style="text-align:center">No data available ...</td>
				</tr>
			@endif
			</tbody>
		</table>
		<div class="row mt-3">
        	<div class="col-xl-8">{{ $write_ups->links() }} </span></div>
        	<div class="col-xl-4" style="text-align:right">Total ( {{$write_ups->total() }} ) number of rows</div>
    	</div><br/>
	</div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$(".write-up-list").addClass("active");
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
						var url = "{{ route('write-ups.destroy', ":id") }}";
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
											title: error,
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