<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div id="accordion">
                <div class="card mt-5">

                    <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light btn-block d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div>
                                    <img src="{{asset('img/go-pay.png')}}" alt="go pay" width="80" height="80" class="mr-3">
                                    Go Pay
                                </div>
                            </button>
                        </h5>
                    </div>
                    
                    <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light btn-block d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div>
                                    <img src="{{asset('img/ovo.png')}}" alt="go pay" width="80" height="80" class="mr-3">
                                    OVO
                                </div>
                            </button>
                        </h5>
                    </div>
                    
                    <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light btn-block d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div>
                                    <img src="{{asset('img/mandiri.png')}}" alt="go pay" width="80" height="80" class="mr-3">
                                    MANDIRI
                                </div>
                            </button>
                        </h5>
                    </div>
                    
                    <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light btn-block d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div>
                                    <img src="{{asset('img/bca.png')}}" alt="go pay" width="80" height="80" class="mr-3">
                                    BCA
                                </div>
                            </button>
                        </h5>
                    </div>
                    
                    <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light btn-block d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div>
                                    <img src="{{asset('img/bri.png')}}" alt="go pay" width="80" height="80" class="mr-3">
                                    BRI
                                </div>
                            </button>
                        </h5>
                    </div>
                    
                    <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-light btn-block d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div>
                                    <img src="{{asset('img/bni.png')}}" alt="go pay" width="80" height="80" class="mr-3">
                                    BNI
                                </div>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('topUp_process', $id_product)}}" method="get" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Number</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Number" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="Auth::user()->id" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Amount">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success px-3 w-25">OK</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('js/theme.js')}}"></script>
</body>

</html>
@endsection