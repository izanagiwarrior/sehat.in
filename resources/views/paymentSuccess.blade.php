<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
@extends('layouts.app')

@section('content')
<!-- Header-->
<header class="bg-light py-5">
    <div class="container px-4 px-lg-0 my-0">
    </div>
</header>

<!-- Recipe Product-->
<section class="page-section" id="details">
    <div class="container px-4 px-lg-5 ">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="detail text-left">
                <h2>Payment Success !!</h2>
                <hr>
                <div class="text-center">
                    <h3>Location</h3>
                    <img src="{{asset('img/otw.jpg')}}" alt="go pay" width="400" height="400" class="mr-3">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recipe Product-->
<section class="page-section" id="details">
    <div class="container px-4 px-lg-5 ">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="detail text-left">
                <h2>Recipe : {{$recipe->title}}</h2>
                <hr>
                <div class="text-center">
                    <iframe width="560" height="315" src="{{$recipe->link_video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <p style="font-size: 20px;">{{$recipe->description}}</p>
            </div>
        </div>
    </div>
</section>

<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">More Products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($data as $dt)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{asset('storage/' . $dt->photo)}}" alt="..." height="200px" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$dt->title}}</h5>
                            <!-- Product price-->
                            <!-- {{$dt->price}} -->
                            {{$dt->price}}
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-warning mt-auto" href="{{route('detailProduk', $dt->id)}}">Detail</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('js/theme.js')}}"></script>
</body>

</html>
@endsection