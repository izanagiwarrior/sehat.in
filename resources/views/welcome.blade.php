@extends('layouts.app')

@section('content')

<!-- Favicon -->
<link href="{{ asset('img/logo.png') }}" rel="icon" type="image/png">

<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <h1>Sehat.in</h1>
        <p>Penuhi kebutuhan konsumtif dan kesehatan mu !!</p>
        <a class="btn btn-warning btn-xl text-uppercase rounded" href="{{route('katalog')}}">See Catalog</a>
    </div>
</header>
<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Lastest Product</h2>

        </div>
        <div class="row">
            @foreach($product as $pt)
            <div class="col-lg-4 col-sm-6 mb-4">
                <!-- Portfolio item 1-->
                <div class="portfolio-item">
                    <a class="portfolio-link show-data" href="">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" width="100%" src="{{asset('storage/'. $pt->photo)}}" alt="..." />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">{{$pt->title}}</div>
                        <div class="portfolio-caption-subheading text-muted">{{$pt->description}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="container text-center">
            <a class="btn btn-warning btn-xl text-uppercase rounded" href="{{route('katalog')}}">See Catalog</a>
        </div>
    </div>
</section>
@endsection