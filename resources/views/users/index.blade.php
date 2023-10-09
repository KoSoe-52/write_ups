@extends('layouts.master')
@section("title","User Lists")
@section('content')
<div class="bg-secondary rounded h-100 p-4">
	<h6 class="mb-4 mt-4">User Lists</h6>
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
		
	</script>
@endsection