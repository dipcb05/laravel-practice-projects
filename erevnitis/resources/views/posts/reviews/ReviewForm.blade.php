@extends('layouts.app')
@section('content')
<div class="container-fluid">
<div class="row justify-content-center justify-content-between">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Review') }}
                    </div>

                    <div class="card-body">
                        <form action ="{{ route('reviews.update', $post->id) }}"
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
                                    class="form-control
                                       @error('summary') is-invalid @enderror"
                                    name="summary">
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
                                    name="sub">
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
                                           name="link">
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

                                                                <button type="button"
                                                                        class="btn btn-primary"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal">
                                                                    Save

                                                                </button>
                                                                <div class="modal fade"
                                                                     id="exampleModal"
                                                                     tabindex="-1"
                                                                     role="dialog"
                                                                     aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog"
                                                                         role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    Review Submission
                                                                                </h5>
                                                                                <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                            <span aria-hidden="true">
                                                                                &times;
                                                                            </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you Confirm to process?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">
                                                                                    Close
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary">
                                                                                    Save changes
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="button"
                                                                        class="btn btn-danger"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal1">
                                                                    Cancel
                                                                </button>
                                                                <div class="modal fade"
                                                                     id="exampleModal1"
                                                                     tabindex="-1"
                                                                     role="dialog"
                                                                     aria-labelledby="exampleModalLabel1"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog"
                                                                         role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel1">
                                                                                    Get back to Profile
                                                                                </h5>
                                                                                <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                            <span aria-hidden="true">
                                                                                &times;
                                                                            </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you sure to get back? form will be reset
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">
                                                                                    Close
                                                                                </button>
                                                                                <a class="btn btn-danger"
                                                                                   href="{{ route('profile.show', Auth::id()) }}"
                                                                                   role="button">
                                                                                    Confirm
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                        </form>
                    </div>
            </div>
</div>
</div>
</div>
@endsection
