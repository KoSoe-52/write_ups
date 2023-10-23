@extends('layouts.master')
@section("title","Edit Category")
@section('content')
<div class="col-12 col-xl-6">
	<div class="bg-secondary rounded h-100 p-4">
		<h6 class="mb-4">Edit Category</h6>
		@if(session('success'))
			<div class="text-success">
				{{session('success')}}
			</div>
		@endif
		<form class="form mb-2" id="insertForm" method="POST" action="{{ route('categories.update',$category->id) }}" enctype="multipart/form-data">
			@csrf
            @method('put')
			<div class="row">
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="name">Category <b class="text-danger">*</b> </label>
						<input type="text" id="name"  value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off">
							<span class="invalid-feedback " role="alert">
								<strong class='name'></strong>
							</span>
					</div>
				</div>
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="image">Category Logo </label>
						<input type="file"  id="image"  class="form-control @error('image') is-invalid @enderror" name="image" autocomplete="off">
							<span class="invalid-feedback" role="alert">
								<strong class='image'></strong>
							</span>
					</div>
				</div>
				<div class="col-12 col-xl-6  mt-3">
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-success mb-2"><i class="fa fa-paper-plane"></i> Update Category</button>
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
			$(".category-list").addClass("active");
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});
	</script>
@endsection