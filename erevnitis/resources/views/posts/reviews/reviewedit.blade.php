@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center justify-content-between">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Review Edit') }}
                    </div>
                    <div class="card-body">
                        <form action ="{{ route('reviews.editpost', $review->id) }}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="summary">
                                    Short  Summary
                                </label>
                                <div class="col-md-7">
                                <textarea
                                    id="summary"
                                    type="text"
                                    name="summary"
                                    class="form-control
                                       @error('summary') is-invalid @enderror"
                                    >
                                    {{ $review->summary  }}
                            </textarea>

                                    @error('summary')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="algorithms">
                                    algorithms
                                </label>
                                <div class="col-md-7">
                                <textarea
                                    id="algorithms"
                                    type="text"
                                    class="form-control
                                       @error('algorithms') is-invalid @enderror"
                                    name="algorithms"
                                    rows="4">
                                     {{ $review->algorithms }}
                            </textarea>

                                    @error('algorithms')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub">
                                    prerquisite Subjects
                                </label>
                                <div class="col-md-7">
                                    <input id="sub"
                                           type="text"
                                           class="form-control
                                       @error('sub') is-invalid @enderror"
                                           name="sub"
                                           value = "{{ $review->sub  }}">
                                    @error('sub')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link">
                                    related paper links
                                </label>
                                <div class="col-md-7">
                                    <input id="link"
                                           type="text"
                                           class="form-control
                                       @error('link') is-invalid @enderror"
                                           name="link"
                                           value="{{  $review->link  }}">
                                    @error('link')
                                    <span
                                        class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="res"
                                       class="col-md-1 col-form-label text-md-right">
                                    {{ __('Any resources(dataset/pic') }}
                                </label>
                                <div class = "col-md-8">
                                    <input id = "res"
                                           type = "file"
                                           class = "form-control-file @error('res') is-invalid @enderror pt-2 pl-6"
                                           name  = "res">
                                    @error('res')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div></div>

                            <div class="form-group row">
                                <div class="col-md-4  offset-md-4">

                                    <button type="submit"
                                            class="btn btn-primary">
                                        {{ __('submit to admin') }}
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
