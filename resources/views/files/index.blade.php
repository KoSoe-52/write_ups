@extends('layouts.master')
@section("title","File Lists")
@section('content')
<div class="bg-secondary rounded h-100 p-4">
	<div class="row">
		<div class="col-sm-12 col-md-6  col-lg-6">
			<h6 class="mb-4 mt-4">File Lists</h6>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-6">
			<a href="{{ route('files.create') }}" class="btn btn-sm btn-info"  style="float:right;"><i class="fa fa-plus"></i> Upload File</a>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Path</th>
                    <th scope="col">Created at</th>
				</tr>
			</thead>
			<tbody>
			@if(count($files) > 0)
				@foreach($files as $key=>$data)
					<tr>
						<th scope="row">{{ $key + 1}}</th>
						<td>{{ url('') }}/storage/{{$data->name}}</td>
						<td>{{date('d-m-Y H:i',strtotime($data->created_at))}}</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5" style="text-align:center">No data available...</td>
				</tr>
			@endif
			</tbody>
		</table>
		{{$files->links()}}
	</div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$(".file-index").addClass("active");
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});
	</script>
@endsection