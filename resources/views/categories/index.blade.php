@extends('layouts.master')
@section("title","Category Lists")
@section('content')
<div class="bg-secondary rounded h-100 p-4">
	<div class="row">
		<div class="col-sm-12 col-md-6  col-lg-6">
			<h6 class="mb-4 mt-4">Category Lists</h6>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-6">
			<a href="{{ route('categories.create') }}" class="btn btn-sm btn-info"  style="float:right;"><i class="fa fa-plus"></i> Create Category</a>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col" style="width:60px;max-width:60px">Image</th>
					<th scope="col">Name</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
			@if(count($categories) > 0)
				@foreach($categories as $key=>$data)
					<tr>
						<th scope="row">{{ $key + 1}}</th>
						<td><img src='{{ asset("storage/$data->image") }}' style="width:50px;height:50px"></td>
						<td>{{$data->name}}</td>
						<td>
                            <a href="{{ route('categories.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" data-id="{{$data->id}}" class="btn btn-sm btn-danger delete-btn"><i class="fa fa-times"></i> Delete</a>
                        </td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="4" style="text-align:center">No data available...</td>
				</tr>
			@endif
			</tbody>
		</table>
		{{$categories->links()}}
	</div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$(".category-list").addClass("active");
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
						var url = "{{ route('categories.destroy', ":id") }}";
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
											title: "Category နှင့် write up ထည့်သွင်းထားသည်",
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