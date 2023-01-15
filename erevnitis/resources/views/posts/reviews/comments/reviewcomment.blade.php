@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center justify-content-between">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Comment') }}
                    </div>

                    <div class="card-body">
                        <form action ="{{ route('comment.update', [$posts, $reviews]) }}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="comment">
                                    Comment
                                </label>
                                <div class="col-md-7">

                                <textarea
                                    id="comment"
                                    type="text"
                                    class="form-control
                                       @error('comment') is-invalid @enderror"
                                    name="comment">
                            </textarea>

                                    @error('comment')
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
                                        {{ __('Comment') }}
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
