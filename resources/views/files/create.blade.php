@extends('layouts.master')
@section("title","Upload PDF File")
@section('content')
<div class="col-12 col-xl-6">
	<div class="bg-secondary rounded h-100 p-4">
		<h6 class="mb-4">Upload PDF File</h6>
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
						<label for="pdf_file">PDF File <b class="text-danger">*</b></label>
						<input type="file"  id="pdf_file"  class="form-control @error('pdf_file') is-invalid @enderror" name="pdf_file" autocomplete="off">
							<span class="invalid-feedback" role="alert">
								<strong class='pdf_file'></strong>
							</span>
					</div>
				</div>
				<div class="col-12 col-xl-6  mt-3">
					<div class="form-group">
						<button type="submit" class="btn btn-sm btn-success mb-2"><i class="fa fa-paper-plane"></i> Upload PDF</button>
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
			$(".file-index").addClass("active");
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(document).on("submit","#insertForm",function(ev){
				ev.preventDefault();
				var formdata = new FormData(this);
				$.ajax({
					url:  "{{ route('files.store') }}",
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
									timer:1000
								});
                            setInterval(() => {
								window.location.href= "{{ route('files.index') }}";
                            }, 1000);
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