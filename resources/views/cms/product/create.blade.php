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
@section('title', 'Create Product')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Product') }}</h1>

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

    <form method="POST" action="{{ route('product.create.process') }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-lg-4 order-lg-2">

                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="form-group">
                            <label class="" for="btn-img-upload">{{ __('Product Image') }}</label>
                            <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror"
                                id="btn-img-upload" required onchange="loadFile(event)">
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
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
                                            <label class="form-control-label" for="name">{{ __('Product Title') }}<span
                                                    class="small text-danger">*</span></label>
                                            <input type="text" id="title" class="form-control" name="title"
                                                value="{{ old('title') }}" placeholder="Example : Red Rice...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">{{ __('Product Category') }}<span
                                                class="small text-danger">*</span></label>
                                        <select class="form-control" id="category" name="category">
                                            @foreach ($category as $ct)
                                                <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">{{ __('Product Description') }}<span
                                                class="small text-danger">*</span></label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
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
                                            <input type="text" id="energy" class="form-control" name="energy"
                                                value="{{ old('energy') }}" placeholder="Energy amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="protein">{{ __('Protein') }}</label>
                                            <input type="text" id="protein" class="form-control" name="protein"
                                                value="{{ old('protein') }}" placeholder="Protein amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="fat">{{ __('Fat') }}</label>
                                            <input type="text" id="fat" class="form-control" name="fat"
                                                value="{{ old('fat') }}" placeholder="Fat amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="carbohydrate">{{ __('Carbohydrate') }}</label>
                                            <input type="text" id="carbohydrate" class="form-control" name="carbohydrate"
                                                value="{{ old('carbohydrate') }}" placeholder="Carbohydrate amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="calorie">{{ __('Calorie') }}</label>
                                            <input type="text" id="calorie" class="form-control" name="calorie"
                                                value="{{ old('calorie') }}" placeholder="Calorie amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="fiber">{{ __('Fiber') }}</label>
                                            <input type="text" id="fiber" class="form-control" name="fiber"
                                                value="{{ old('fiber') }}" placeholder="Fiber amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sodium">{{ __('Sodium') }}</label>
                                            <input type="text" id="sodium" class="form-control" name="sodium"
                                                value="{{ old('sodium') }}" placeholder="Sodium amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sugar">{{ __('Sugar') }}</label>
                                            <input type="text" id="sugar" class="form-control" name="sugar"
                                                value="{{ old('sugar') }}" placeholder="Sugar amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_a">{{ __('Vitamin A') }}</label>
                                            <input type="text" id="vitamin_a" class="form-control" name="vitamin_a"
                                                value="{{ old('vitamin_a') }}" placeholder="Vitamin A amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_c">{{ __('Vitamin C') }}</label>
                                            <input type="text" id="vitamin_c" class="form-control" name="vitamin_c"
                                                value="{{ old('vitamin_c') }}" placeholder="Vitamin C amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_d">{{ __('Vitamin D') }}</label>
                                            <input type="text" id="vitamin_d" class="form-control" name="vitamin_d"
                                                value="{{ old('vitamin_d') }}" placeholder="Vitamin D amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_e">{{ __('Vitamin E') }}</label>
                                            <input type="text" id="vitamin_e" class="form-control" name="vitamin_e"
                                                value="{{ old('vitamin_e') }}" placeholder="Vitamin E amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="vitamin_k">{{ __('Vitamin K') }}</label>
                                            <input type="text" id="vitamin_k" class="form-control" name="vitamin_k"
                                                value="{{ old('vitamin_k') }}" placeholder="Vitamin K amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="calcium">{{ __('Calcium') }}</label>
                                            <input type="text" id="calcium" class="form-control" name="calcium"
                                                value="{{ old('calcium') }}" placeholder="Calcium amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="magnesium">{{ __('Magnesium') }}</label>
                                            <input type="text" id="magnesium" class="form-control" name="magnesium"
                                                value="{{ old('magnesium') }}" placeholder="Magnesium amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="zinc">{{ __('Zinc') }}</label>
                                            <input type="text" id="zinc" class="form-control" name="zinc"
                                                value="{{ old('zinc') }}" placeholder="Zinc amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="water">{{ __('Water') }}</label>
                                            <input type="text" id="water" class="form-control" name="water"
                                                value="{{ old('water') }}" placeholder="Water amount (with units)">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="mineral">{{ __('Mineral') }}</label>
                                            <input type="text" id="mineral" class="form-control" name="mineral"
                                                value="{{ old('mineral') }}" placeholder="Mineral amount (with units)">
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
                            <h2 class="text-center">Recipe</h2>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="titlerecipe">{{ __('Recipe Title') }}<span
                                                    class="small text-danger">*</span></label>
                                            <input type="text" id="titlerecipe" class="form-control" name="titlerecipe"
                                                value="{{ old('titlerecipe') }}" placeholder="Title recipe...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label" for="linkvideo">{{ __('Video Link') }}<span
                                                    class="small text-danger">*</span></label>
                                            <input type="text" id="linkvideo" class="form-control" name="linkvideo"
                                                value="{{ old('linkvideo') }}" placeholder="Youtube embed link..">
                                            <small>Example : https://www.youtube.com/embed/Sv-AR70ZgdE</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            for="descriptionrecipe">{{ __('Recipe Description') }}<span
                                                class="small text-danger">*</span></label>
                                        <textarea class="form-control" id="descriptionrecipe" name="descriptionrecipe"
                                            rows="3">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
                                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </form>

@endsection
