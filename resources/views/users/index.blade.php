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
                    <th scope="col">Created at</th>
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
						<td>{{date('d-m-Y H:i',strtotime($user->created_at))}}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5" style="text-align:center">There is no record</td>
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
		});
	</script>
@endsection