@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Discussion Forum</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class = "d-flex justify-content-between">
                            <div class="card">
                                <div class="card-header">New Question? let's post some quality question</div>
                                <div class="card-body">

                                    <form action ="{{ route('qus.update') }}"
                                          enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <div>Which Topic?</div>
                                            <label for="keyword"
                                                   class="col-md-1 col-form-label ">

                                            </label>

                                            <div class="col-md-7">
                                                <input id="keyword"
                                                       type="text"
                                                       class="form-control @error('pcaption') is-invalid @enderror"
                                                       name="keyword"
                                                       value="{{ old('keyword') }}"
                                                       required autocomplete="keyword"
                                                       autofocus>

                                                @error('keyword')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div>  {{ __('Your Question') }}</div>
                                            <label for="question"
                                                   class="col-md-1 col-form-label">
                                            </label>
                                            <div class = "col-md-8">
                                                <textarea
                                                    class="form-control @error('posts') is-invalid @enderror pt-2 pl-6"
                                                    rows="5" id="question"  name  = "question"
                                                    autocomplete="question">
                                                </textarea>
                                                @error('question')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4  offset-md-4">
                                                <button type="submit"
                                                        class="btn btn-primary">
                                                    {{ __('post') }}
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                            </div>
                        </div>
                        </div>


                            <br><br><br>
                        @if((is_null($posts)))
                            <div class = "text-center">
                                <h3><br>No New Posts</h3>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card" style="width: 30rem;">
                                            <div class="card-header">
                                                Subject: {{ $post -> keyword }}
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    {{ $post -> question }}</h5>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">by: {{ $post -> name }}</li>
                                                <li class="list-group-item">Uploaded at: {{ $post -> created_at }}</li>
                                            </ul>
                                            <a href = " {{ route('dis.show', [$post->id]) }}"
                                               class="btn btn-outline-info"
                                               role="button">
                                               View Discussion
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
