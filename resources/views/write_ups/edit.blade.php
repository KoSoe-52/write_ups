@extends('layouts.master')
@section("title","Create Write up")
@section('content')
<div class="col-12 col-xl-12">
	<div class="bg-secondary rounded h-100 p-4">
		<h6 class="mb-4">Create Write up</h6>
		@if(session('status'))
			<div class="text-success">
				{{session('status')}}
			</div>
		@endif
		<form class="form mb-2" id="insertForm">
			@csrf
			@method('PUT')
			<div class="row">
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="title">Title <b class="text-danger">*</b> </label>
						<input type="text" id="title" value="{{ $writeUp->title }}"  class="form-control @error('title') is-invalid @enderror" name="title" autocomplete="off">
							<span class="invalid-feedback " role="alert">
								<strong class='title'></strong>
							</span>
					</div>
					<input type="hidden" id="write_up_id" value="{{$writeUp->id}}">
				</div>
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="category_id">Category <b class="text-danger">*</b> </label>
                        <select class="form-select mb-3 @error('category_id') is-invalid @enderror" name="category_id" >
							<option selected="">--Select--</option>
							@if(count($categories) > 0)
								@foreach($categories as $key=>$category)
									@if($category->id == $writeUp->category_id)
										<option value="{{$category->id}}" selected>{{$category->name}}</option>
									@else
										<option value="{{$category->id}}">{{$category->name}}</option>
									@endif
								@endforeach
							@endif
                        </select>
                        <span class="invalid-feedback" role="alert">
							<strong class='category_id'></strong>
						</span>
					</div>
				</div>
                
				<div class="col-12  mb-4">
                    <textarea class="form-control" name="content"  id="div_editor1">
                        {{$writeUp->content}}
                    </textarea>
				</div>
				@if(Auth::user()->role_id ==1)
					<div class="col-12  mb-3">
						<div class="form-group">
							<label for="point">Point <b class="text-danger">*</b> </label>
							<input type="text" id="point" value="{{ $writeUp->point }}"  class="form-control @error('point') is-invalid @enderror" name="point" autocomplete="off">
								<span class="invalid-feedback " role="alert">
									<strong class='point'></strong>
								</span>
						</div>
					</div>
					<div class="col-12  mb-1">
						<label>Published or Unpublished <b class="text-danger">*</b></label>
					</div>
					@if($writeUp->status == 1)
						@php $Unpublished = "checked" @endphp
						@php $Published = "" @endphp
					@else 
						@php $Unpublished = "" @endphp
						@php $Published = "checked" @endphp
					@endif
					<div class="col-12  mb-3 row pl-3">
						<div class="form-check col-6 ml-3">
							<input class="form-check-input" type="radio" name="status" {{$Published}}  id="Published" value="2">
							<label class="form-check-label" for="Published" style="cursor:pointer">
							Published
							</label>
						</div>
						<div class="form-check col-6">
							<input class="form-check-input" type="radio" name="status"  {{$Unpublished}} id="Unpublished" value="1">
							<label class="form-check-label" for="Unpublished" style="cursor:pointer">
							Unpublished
							</label>
						</div>
					</div>
				@endif
				<div class="col-12 col-xl-6  mt-3">
					<div class="form-group">
						<a href="{{ url()->previous() }}" class="btn btn-sm btn-info mb-2"><i class="fa fa-arrow-left"></i> Back</a>
						<button type="submit" class="btn btn-sm btn-success mb-2"><i class="fa fa-paper-plane"></i> Update and Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('script')
    <link rel="stylesheet" href="{{ asset('richtexteditor/rte_theme_default.css') }}" />
    <script type="text/javascript" src="{{ asset('richtexteditor/rte.js') }}"></script>
    <script type="text/javascript" src="{{ asset('richtexteditor/plugins/all_plugins.js') }}"></script>
	<script>
        var editor1 = new RichTextEditor("#div_editor1", { editorResizeMode: "height" });
		$(document).ready(function(){
			$(".write-up-list").addClass("active");
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(document).on("submit","#insertForm",function(ev){
				ev.preventDefault();
				//alert('hello');
				var formdata = new FormData(this);
				var write_up_id = $("#write_up_id").val();
				var url = "{{ route('write-ups.update', ":id") }}";
                          url = url.replace(':id', write_up_id);
				$.ajax({
					url:  url,
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
									timer:1500
								});
							setInterval(() => {
								//window.location.reload();
							}, 1500);
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