@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Edit Profile') }}
                    </div>

                    <div class="card-body">
                        <form action ="{{ route('profile.update') }}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf


                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Name') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control
                                    @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') ?? $user->name }}"
                                           autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label
                                    for="username"
                                    class="col-md-4 col-form-label text-md-right">
                                    {{ __('Username') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="username"
                                           type="text"
                                           class="form-control
                                     @error('name')
                                               is-invalid @enderror"
                                           name="username"
                                           value="{{ old('username') }}"
                                           placeholder="{{ $user->username }}"
                                           readonly>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('E-Mail Address') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="{{ $user->email }}"
                                           readonly>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="gender"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Gender') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="gender"
                                           type="gender"
                                           class="form-control @error('gender') is-invalid @enderror"
                                           name="gender"
                                           value="{{ old('gender') }}"
                                           placeholder="{{ $user->gender }}"
                                           readonly>

                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="country"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Country') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="country"
                                           type="text"
                                           class="form-control @error('country') is-invalid @enderror"
                                           name="country"
                                           value="{{ old('country') ?? $user->profile->country }}">
                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bdate"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Birthday') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="bdate"
                                           type="date"
                                           class="form-control @error('bdate') is-invalid @enderror"
                                           name="bdate"
                                           value="{{ old('bdate') ?? $user->profile->bdate }}">
                                    @error('bdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="job"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Current Job') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="job"
                                           type="text"
                                           class="form-control @error('job') is-invalid @enderror"
                                           name="job"
                                           value="{{ old('job') ?? $user->profile->job }}">
                                    @error('job')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="wdate"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Working From') }}
                                </label>
                                <div class="col-md-6">
                                    <label for="wdate">

                                    </label>
                                    <input id="wdate"
                                           type="date"
                                           class="form-control @error('wy') is-invalid @enderror"
                                           name="wdate"
                                           value="{{ old('wdate') ?? $user->profile->wdate }}">
                                    @error('wdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="website"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Website') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="website"
                                           type="text"
                                           class="form-control @error('job') is-invalid @enderror"
                                           name="website"
                                           value="{{ old('website') ?? $user->profile->website}}">
                                    @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="pic"
                                       class="col-md-4 col-form-label text-md-right">
                                    {{ __('Profile Picture') }}
                                </label>
                                <div class="col-md-6">
                                        <input id="pic"
                                               type="file"
                                               class="form-control @error('pic') is-invalid @enderror"
                                               name="pic"
                                               value="{{ old('pic') }}">
                                        @error('pic')
                                        <span class="invalid-feedback"
                                              role="alert">
                                        <strong>{{ $message  }}</strong>
                                    </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description">
                                    Introduce Yourself within 200 words
                                </label>
                                <div class="col-md-7">
                                <textarea
                                    id="description"
                                    type="text"
                                    class="form-control
                                       @error('description') is-invalid @enderror"
                                    name="description"
                                    rows = "3">
                                </textarea>

                                    @error('description')
                                    <span
                                        class="invalid-feedback" role="alert">
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
                                        Save Changes
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
                                                        Edit Profile
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
                                                        Save
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
