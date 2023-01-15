@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Post journal') }}
                </div>


            <div class="card-body">
        	<form action ="{{ route('posts.store') }}" enctype="multipart/form-data" method="post">
            @csrf

                            <div class="form-group row">
                            <label for="pcaption"
                                   class="col-md-1 col-form-label">
                             title
                            </label>

                            <div class="col-md-8">
                                <input id="pcaption"
                                 type="text"
                                 class="form-control @error('pcaption') is-invalid @enderror"
                                 name="pcaption"
                                 value="{{ old('pcaption') }}"
                                 required autocomplete="post caption"
                                 autofocus>

                                @error('pcaption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                <div class="form-group row">
                                    <label for="posts"
                                           class="col-md-1 col-form-label">
                                        URL</label>
                                    <div class="input-group mb-3 col-md-8">
                                        <div class = "col-md-8">
                                            <input type="text"
                                                   class="form-control @error('posts') is-invalid @enderror pt-2 pl-6"
                                                   id="posts"
                                                   name = "posts"
                                                   aria-describedby="posts"
                                                   autocomplete="posts">
                                        </div>
                                        @error('posts')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                <div class="form-group row">
                    <label for="author"
                           class="col-md-1 col-form-label ">
                        author
                    </label>

                    <div class="col-md-8">
                        <input id="author"
                               type="text"
                               class="form-control @error('author') is-invalid @enderror"
                               name="author"
                               value="{{ $user->name }} "
                               required autocomplete="author"
                               autofocus>

                        @error('author')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="subject"
                           class="col-md-1 col-form-label ">
                        subject
                    </label>

                    <div class="col-md-8">
                        <input id="subject"
                               type="text"
                               class="form-control @error('subject') is-invalid @enderror"
                               name="subject"
                               value="{{ old('subject') }}"
                               required autocomplete="subject"
                               autofocus>

                        @error('subject')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>



                <div class="form-group row">
                    <label for="journal"
                           class="col-md-1 col-form-label ">
                        Where it's published
                    </label>

                    <div class="col-md-8">
                        <input id="journal"
                               type="text"
                               class="form-control @error('journal') is-invalid @enderror"
                               name="journal"
                               required autocomplete="journal"
                               autofocus>

                        @error('journal')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="time"
                           class="col-md-1 col-form-label ">
                        when it's published
                    </label>

                    <div class="col-md-8">
                        <input id="time"
                               type="number"
                               class="form-control @error('time') is-invalid @enderror"
                               name="time"
                               required autocomplete="time"
                               autofocus>

                        @error('time')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

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
                                            post update
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
                                           href="{{ route('profile.show', \Illuminate\Support\Facades\Auth::id()) }}"
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


