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
			<div class="row">
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="title">Title <b class="text-danger">*</b> </label>
						<input type="text" id="title"  class="form-control @error('title') is-invalid @enderror" name="title" autocomplete="off">
							<span class="invalid-feedback " role="alert">
								<strong class='title'></strong>
							</span>
					</div>
				</div>
				<div class="col-12  mb-3">
					<div class="form-group">
						<label for="category_id">Category <b class="text-danger">*</b> </label>
                        <select class="form-select mb-3 @error('category_id') is-invalid @enderror" id="category_id" name="category_id" >
                                <option value="">Select</option>
                                @if(count($categories) > 0)
                                    @foreach($categories as $key=>$category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endif
                        </select>
                        <span class="invalid-feedback" role="alert">
							<strong class='category_id'></strong>
						</span>
					</div>
				</div>
                
				<div class="col-12  mb-4">
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"   id="content"></textarea>
					<span class="invalid-feedback" role="alert">
						<strong class='content'></strong>
					</span>
				</div>
				@if(Auth::user()->role_id ==1)
					<div class="col-12  mb-3">
						<div class="form-group">
							<label for="point">Point <b class="text-danger">*</b> </label>
							<input type="text" id="point" value="0"  class="form-control @error('point') is-invalid @enderror" name="point" autocomplete="off">
								<span class="invalid-feedback " role="alert">
									<strong class='point'></strong>
								</span>
						</div>
					</div>
					<div class="col-12  mb-1">
						<label>Published or Unpublished <b class="text-danger">*</b></label>
					</div>
					<div class="col-12  mb-3 row pl-3">
						<div class="form-check col-6 ml-3">
							<input class="form-check-input" type="radio" name="status" checked  id="Published" value="2">
							<label class="form-check-label" for="Published" style="cursor:pointer">
								Published
							</label>
						</div>
						<div class="form-check col-6">
							<input class="form-check-input" type="radio" name="status"   id="Unpublished" value="1">
							<label class="form-check-label" for="Unpublished" style="cursor:pointer">
								Unpublished
							</label>
						</div>
					</div>
				@endif
				<div class="col-12 col-xl-6  mt-3">
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-success mb-2"><i class="fa fa-paper-plane"></i> Create Write up</button>
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
        var editor1 = new RichTextEditor("#content", { editorResizeMode: "height" });
		$(document).ready(function(){
			$(".write-up-create").addClass("active");
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(document).on("submit","#insertForm",function(ev){
				ev.preventDefault();
				var formdata = new FormData(this);
				$.ajax({
					url:  "{{ route('write-ups.store') }}",
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
									icon :'success',
									title: response.msg,
									width: 300,
									color: '#716add',
									showCancelButton: false,
									showConfirmButton: false,
									timer:1500
								});
							setInterval(() => {
								window.location.reload();
							}, 1500);
						}else
						{
							$.each( response.data, function( key, value ) {
								console.log(key+"/"+value);
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