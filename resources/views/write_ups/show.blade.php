@extends('layouts.master')
@section("title","View writeup")
@section('content')
<div class="bg-secondary rounded h-100 p-4">
	<div class="row">
		<div class="col-lg-6">
			<p class="mb-2 mt-4">{{$writeUp->title}} 
                <span class="badge bg-dark text-success">{{$writeUp->categories->name}}</span>
                
                <span class="badge bg-dark text-success">Point  {{$writeUp->point}}</span>
            </p>
		</div>
        <div class="col-lg-6" style="float:right;text-align:right">
            <p class="mb-2 mt-4">{{ date('d-m-Y H:i',strtotime($writeUp->created_at)) }} Add by <span class="badge bg-dark text-success">{{$writeUp->users->username}}</span></p>
        </div>
	</div>
	<div class="table-responsive">
        <div>
            <?php 
				$dom = new DomDocument();
				$dom->loadHTML($writeUp->content);
				$customTags = $dom->getElementsByTagName('a');
				// Iterate through each customtag and replace it with an iframe
				if(count($customTags)> 0 )
				{
					foreach($customTags as $customTag) {
						$src = $customTag->getAttribute('href');
						// Create a new iframe element
						$iframe = $dom->createElement('iframe');
						$iframe->setAttribute('src', $src);
						$iframe->setAttribute("class","col-12");
						$iframe->setAttribute("height",800);
						// Replace the customtag with the iframe
						$customTag->parentNode->replaceChild($iframe, $customTag);
					}
					// Get the modified HTML
					$modifiedHtml = $dom->saveHTML();
					// Output the modified HTML
					echo html_entity_decode($modifiedHtml);
				}else
				{
					echo html_entity_decode($writeUp->content);
				}
				
			?>	
        </div>
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