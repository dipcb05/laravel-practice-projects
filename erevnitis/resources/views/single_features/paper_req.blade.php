@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center justify-content-between">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('paper request') }}
                    </div>

                    <div class="card-body">
                        <form action ="{{ route('req.save', [$user]) }}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="name">
                                    name
                                </label>
                                <div class="col-md-7">

                                <input
                                    id="name"
                                    type="text"
                                    class="form-control
                                       @error('name') is-invalid @enderror"
                                    name="name">

                                    @error('name')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="author">
                                    authors
                                </label>
                                <div class="col-md-7">

                                    <input
                                        id="author"
                                        type="text"
                                        class="form-control
                                       @error('author') is-invalid @enderror"
                                        name="author">

                                    @error('author')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="publisher">
                                    publisher
                                </label>
                                <div class="col-md-7">

                                    <input
                                        id="publisher"
                                        type="text"
                                        class="form-control
                                       @error('publisher') is-invalid @enderror"
                                        name="publisher">

                                    @error('publisher')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="year">
                                    year
                                </label>
                                <div class="col-md-7">
                                    <input
                                        id="year"
                                        type="text"
                                        class="form-control
                                       @error('year') is-invalid @enderror"
                                        name="year">

                                    @error('year')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4  offset-md-4">

                                    <button type="submit"
                                            class="btn btn-primary">
                                        {{ __('submit') }}
                                    </button>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
