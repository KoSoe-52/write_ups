@extends('layouts.master')
@section("title","User Lists")
@section('content')
<div class="bg-secondary rounded h-100 p-4">
	<div class="row">
		<div class="col-sm-12 col-md-6  col-lg-6">
			<h6 class="mb-4 mt-4">Write up Lists</h6>
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
								@if((Auth::user()->role_id == 1 || Auth::user()->role_id == $write_up->user_id) || ((Auth::user()->role_id == 2 && Auth::user()->role_id == 3) || $write_up->status == 2))
									<a href="{{ route('write-ups.show',$write_up->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</a>
								@endif
							@elseif($write_up->status == 2)
								<a href="{{ route('write-ups.show',$write_up->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> View</a>
							@endif
							@if(Auth::check())
								@if((Auth::user()->role_id == 1 || Auth::user()->role_id == $write_up->user_id))
									<a href="{{ route('write-ups.edit',$write_up->id) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
								@endif
							@endif
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5" style="text-align:center">There is no record</td>
				</tr>
			@endif
			</tbody>
		</table>
		{{$write_ups->links()}}
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
		});
	</script>
@endsection