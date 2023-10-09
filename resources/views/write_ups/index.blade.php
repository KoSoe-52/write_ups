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
                    <th scope="col">Created at</th>
				</tr>
			</thead>
			<tbody>
			@if(count($write_ups) > 0)
				@foreach($write_ups as $key=>$write_up)
					<tr>
						<th scope="row">{{ $key + 1}}</th>
						<td><a href="{{ route('write-ups.edit',$write_up->id) }}">{{$write_up->title}}</a></td>
						<td>{{$write_up->categories->name}}</td>
						<td>{{date('d-m-Y H:i',strtotime($write_up->created_at))}}</td>
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