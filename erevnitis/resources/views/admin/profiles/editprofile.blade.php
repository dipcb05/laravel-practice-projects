@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('first time Admin login') }}
                </div>

                <div class="card-body">
                    <form action ="{{ route('admin.profile_update', $id) }}"
                          enctype="multipart/form-data"
                          method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="office_id"
                                   class="col-md-4 col-form-label text-md-right">
                                {{ __('office_id') }}
                            </label>
                            <div class="col-md-6">
                                <input id="office_id"
                                       type="text"
                                       class="form-control
                                    @error('office_id') is-invalid @enderror"
                                       name="office_id"
                                       autofocus>
                                @error('office_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="position"
                                   class="col-md-4 col-form-label text-md-right">
                                {{ __('position') }}
                            </label>
                            <div class="col-md-6">
                                <input id="position"
                                       type="text"
                                       class="form-control @error('position') is-invalid @enderror"
                                       name="position"
                                       value="{{ old('position') }}">

                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="joining_date"
                                   class="col-md-4 col-form-label text-md-right">
                                {{ __('joining_date') }}
                            </label>
                            <div class="col-md-6">
                                <input id="joining_date"
                                       type="date"
                                       class="form-control @error('bdate') is-invalid @enderror"
                                       name="joining_date">
                                @error('joining_date')
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
