<?php
function rupiah($angka)
{
    $hasil_rupiah = 'Rp ' . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
@extends('layouts.app')

@section('content')
    <!-- Header-->
    <header class="bg-light py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-black">
                <h1 class="display-4 fw-bolder">History</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $h)
                            <tr>
                                <td>{{ $h->product_name }}</td>
                                <td>{{ rupiah($h->price) }}</td>
                                <td>{{ $h->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/theme.js') }}"></script>
    </body>

    </html>
@endsection
