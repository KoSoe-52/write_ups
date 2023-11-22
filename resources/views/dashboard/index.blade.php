@extends('layouts.master')
@section("title","Dashboard")
@section('content')
<div class="col-12">
    <div class="row">
            @if(count($categories) > 0)
                @foreach($categories as $key=>$category)
                    @php $cat[] = $category->name @endphp
                    @php $tot[] = $category->total @endphp
                    <div class="col-sm-6 col-xl-3 mb-2">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <!-- <i class="fa fa-th me-2 fa-3x text-success"></i> -->
                            <img src='{{ asset("storage/$category->image") }}' style="width:40px;height:40px;border-radius:5px;">
                            <div class="ms-3">
                                <p class="mb-2">{{$category->name}}</p>
                                <h5 class="mb-0 text-success" style="text-align:right;font-weight:bold;">{{$category->total}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif  
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <!-- <h6 class="mb-4">Single Bar Chart</h6> -->
                <canvas id="bar-chart" ></canvas>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <!-- <h6 class="mb-4">Doughnut Chart</h6> -->
                <canvas id="doughnut-chart" style="height:88%;max-height:88%;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$(".dashboard").addClass("active");
		});
         // Single Bar Chart
    var ctx4 = $("#bar-chart").get(0).getContext("2d");
    var myChart4 = new Chart(ctx4, {
        type: "bar",
        data: {
            labels: @json($cat), //["Italy", "France", "Spain", "USA", "Argentina"],
            datasets: [{
                backgroundColor: @json($colors)  ,//["green","green","green","green","green"],
                data: @json($tot)
            }]
        },
        options: {
            responsive: true
        }
    });
    // Doughnut Chart
    var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
    var myChart6 = new Chart(ctx6, {
        type: "doughnut",
        data: {
            labels: @json($cat),
            datasets: [{
                backgroundColor: @json($colors),//["green","green","green","green","green"],
                data: @json($tot)
            }]
        },
        options: {
            responsive: true
        }
    });
	</script>
@endsection