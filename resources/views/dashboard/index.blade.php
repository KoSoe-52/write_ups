@extends('layouts.master')
@section("title","Dashboard")
@section('content')
<div class="col-12">
    <div class="row">
            <div class="col-sm-6 col-xl-3 mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-success"></i>
                    <div class="ms-3">
                        <p class="mb-2">Web</p>
                        <h6 class="mb-0">100</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-info"></i>
                    <div class="ms-3">
                        <p class="mb-2">Crypto</p>
                        <h6 class="mb-0">200</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-light"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pwn</p>
                        <h6 class="mb-0">20</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">RE</p>
                        <h6 class="mb-0">50</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 mb-2">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Forensic</p>
                        <h6 class="mb-0">120</h6>
                    </div>
                </div>
            </div>
           
    </div>
    <!-- Sales Chart Start -->
    <!-- <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">2</h6>
                    <a href="">Show All</a>
                </div>
                <canvas id="worldwide-sales"></canvas>
            </div>
        </div>
    </div> -->
    <!-- Sales Chart End -->
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$(".dashboard").addClass("active");
		});
	</script>
@endsection