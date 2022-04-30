@push('script')
<script>
    let urlPath;
    let loadFile = function(event) {
        let output = document.getElementById('img-banner');
        let container = document.getElementById('container-img-banner');
        urlPath = URL.createObjectURL(event.target.files[0]);
        output.src = urlPath;
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
        container.classList.remove('d-none');
        container.classList.add('d-block');
    };

    let reset = function(event) {
        const output = document.getElementById('img-banner');
        const container = document.getElementById('container-img-banner');
        output.src = '';
        container.classList.remove('d-block');
        container.classList.add('d-none');
        document.getElementById('btn-img-upload').value = "";
    }
</script>
@endpush

@extends('layouts.admin')
@section('title', 'Update Product')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Update Product') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger border-left-danger" role="alert">
    <ul class="pl-4 my-2">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('product.update.process', $data->id) }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="form-group">
                        <label class="" for="btn-img-upload">{{ __('Existing Product Image') }}</label>
                        <img src="{{asset('storage/' . $data->photo)}}" class="w-100">
                    </div>
                    <div class="form-group">
                        <label class="" for="btn-img-upload">{{ __('Product Image') }}</label>
                        <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" id="btn-img-upload" onchange="loadFile(event)">
                        @error('foto')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group d-none" id="container-img-banner">
                        <img src="" class="w-100" id="img-banner">
                        <a class="btn btn-secondary mt-3" onclick="reset(event)" id="btn-reset">Reset</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-body">

                    <div class="pl-lg-4">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">{{ __('Product Title') }}<span class="small text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control" name="title" value="{{ $data->title }}" placeholder="Example : Red Rice...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">{{ __('Product Category') }}<span class="small text-danger">*</span></label>
                                    <select class="form-control" id="category" name="category">
                                        @foreach($category as $ct)
                                        <option value="{{$ct->id}}" {{$data->id_category === $ct->id ? 'selected' : ''}}>{{$ct->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">{{ __('Product Description') }}<span class="small text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $data->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Contents -->

        <div class="row">
            <div class="col-lg-12 order-lg-1">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <h2 class="text-center">Contents</h2>
                            <hr>
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="energy">{{ __('Energy') }}</label>
                                            <input type="number" id="energy" class="form-control" name="energy"
                                                value="{{ ($data->energy) ? $data->energy : '0' }}" placeholder="Energy amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="protein">{{ __('Protein') }}</label>
                                            <input type="number" id="protein" class="form-control" name="protein"
                                                value="{{ ($data->protein) ? $data->protein : '0' }}" placeholder="Protein amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="fat">{{ __('Fat') }}</label>
                                            <input type="number" id="fat" class="form-control" name="fat"
                                                value="{{ ($data->fat) ? $data->fat : '0' }}" placeholder="Fat amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="carbohydrate">{{ __('Carbohydrate') }}</label>
                                            <input type="number" id="carbohydrate" class="form-control" name="carbohydrate"
                                                value="{{ ($data->carbohydrate) ? $data->carbohydrate : '0' }}" placeholder="Carbohydrate amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="calorie">{{ __('Calorie') }}</label>
                                            <input type="number" id="calorie" class="form-control" name="calorie"
                                                value="{{ ($data->calorie) ? $data->calorie : '0' }}" placeholder="Calorie amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="fiber">{{ __('Fiber') }}</label>
                                            <input type="number" id="fiber" class="form-control" name="fiber"
                                                value="{{ ($data->fiber) ? $data->fiber : '0' }}" placeholder="Fiber amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sodium">{{ __('Sodium') }}</label>
                                            <input type="number" id="sodium" class="form-control" name="sodium"
                                                value="{{ ($data->sodium) ? $data->sodium : '0' }}" placeholder="Sodium amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sugar">{{ __('Sugar') }}</label>
                                            <input type="number" id="sugar" class="form-control" name="sugar"
                                                value="{{ ($data->sugar) ? $data->sugar : '0' }}" placeholder="Sugar amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_a">{{ __('Vitamin A') }}</label>
                                            <input type="number" id="vitamin_a" class="form-control" name="vitamin_a"
                                                value="{{ ($data->vitamin_a) ? $data->vitamin_a : '0' }}" placeholder="Vitamin A amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_c">{{ __('Vitamin C') }}</label>
                                            <input type="number" id="vitamin_c" class="form-control" name="vitamin_c"
                                                value="{{ ($data->vitamin_c) ? $data->vitamin_c : '0' }}" placeholder="Vitamin C amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_d">{{ __('Vitamin D') }}</label>
                                            <input type="number" id="vitamin_d" class="form-control" name="vitamin_d"
                                                value="{{ ($data->vitamin_d) ? $data->vitamin_d : '0' }}" placeholder="Vitamin D amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_e">{{ __('Vitamin E') }}</label>
                                            <input type="number" id="vitamin_e" class="form-control" name="vitamin_e"
                                                value="{{ ($data->vitamin_e) ? $data->vitamin_e : '0' }}" placeholder="Vitamin E amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_k">{{ __('Vitamin K') }}</label>
                                            <input type="number" id="vitamin_k" class="form-control" name="vitamin_k"
                                                value="{{ ($data->vitamin_k) ? $data->vitamin_k : '0' }}" placeholder="Vitamin K amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="calcium">{{ __('Calcium') }}</label>
                                            <input type="number" id="calcium" class="form-control" name="calcium"
                                                value="{{ ($data->calcium) ? $data->calcium : '0' }}" placeholder="Calcium amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="magnesium">{{ __('Magnesium') }}</label>
                                            <input type="number" id="magnesium" class="form-control" name="magnesium"
                                                value="{{ ($data->magnesium) ? $data->magnesium : '0' }}" placeholder="Magnesium amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="zinc">{{ __('Zinc') }}</label>
                                            <input type="number" id="zinc" class="form-control" name="zinc"
                                                value="{{ ($data->zinc) ? $data->zinc : '0' }}" placeholder="Zinc amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="water">{{ __('Water') }}</label>
                                            <input type="number" id="water" class="form-control" name="water"
                                                value="{{ ($data->water) ? $data->water : '0' }}" placeholder="Water amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="mineral">{{ __('Mineral') }}</label>
                                            <input type="number" id="mineral" class="form-control" name="mineral"
                                                value="{{ ($data->mineral) ? $data->mineral : '0' }}" placeholder="Mineral amount (in mg)...">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Recipe -->

    <div class="row">
        <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-body">

                    <div class="pl-lg-4">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-control-label" for="titlerecipe">{{ __('Recipe Title') }}<span class="small text-danger">*</span></label>
                                        <input type="text" id="titlerecipe" class="form-control" name="titlerecipe" value="{{ $data_recipe->title }}" placeholder="Title recipe...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-control-label" for="linkvideo">{{ __('Video Link') }}<span class="small text-danger">*</span></label>
                                        <input type="text" id="linkvideo" class="form-control" name="linkvideo" value="{{ $data_recipe->link_video }}" placeholder="Youtube embed link..">
                                        <small>Example : https://www.youtube.com/embed/Sv-AR70ZgdE</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="descriptionrecipe">{{ __('Recipe Description') }}<span class="small text-danger">*</span></label>
                                    <textarea class="form-control" id="descriptionrecipe" name="descriptionrecipe" rows="3">{{ $data_recipe->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col text-center">
                                <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</form>

@endsection
