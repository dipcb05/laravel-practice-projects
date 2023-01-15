@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class = "d-flex justify-content-between">
                            hello {{ Auth::user()->name }}   You are logged in!
                            <a href="{{ route('posts.create') }}">Create New Post</a>
                        </div>
                        @if((is_null($posts)))
                            <div class = "text-center">
                                <h3><br>No New Posts</h3>
                            </div>
                        @else
                            <div class = "text-center">
                                <h3><br>New Posts</h3>
                            </div>
                            @foreach($posts as $new => $post)
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card" style="width: 30rem;">
                                            <div class="card-header">
                                                published on {{ $post -> journal }}
                                            </div>
                                            @if($post-> journal == 'IEEE' || $post-> journal == 'IEEE explorer')
                                            <img src="{{ asset('images/default_paper/ieee.png') }}" class="card-img-top" alt="site_logo"
                                                 height="90px" width="30px">
                                                @elseif($post-> journal == 'springer')
                                                    <img src="{{ asset('images/default_paper/springer.jpeg') }}" class="card-img-top" alt="site_logo"
                                                         height="90px" width="30px">
                                            @else
                                                    <img src="{{ asset('images/default_paper/doc_default.png') }}" class="card-img-top" alt="site_logo"
                                                         height="90px" width="30px">
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title">title: {{ $post -> pcaption }}</h5>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Authors: {{ $post -> author }}</li>
                                                <li class="list-group-item">Topic: {{ $post -> subject }}</li>
                                                <li class="list-group-item">Uploaded at: {{ $post -> created_at }}</li>

                                                <li class="list-group-item">Uploader: <a href="{{ route('profile.show', $post->users_id) }}">{{ $post->name }}</a></li>
                                            </ul>
                                            <div class="card-body">
                                                <form action ="{{ route('rating.update', ['post', $post->id]) }}"
                                                      enctype="multipart/form-data" method="post">
                                                    @csrf
                                                <a href="{{ $post -> posts }}" class="card-link">Paper link</a>
                                                <a href="{{ route('posts.reviews', $post->id) }}"
                                                   class="btn btn-outline-success">reviews section</a>
                                                    @if((is_null($q)) || (empty($q[$new]->id)) || ($q[$new]->id != $post->id))
                                                        <button class="btn btn-secondary" type="submit">Upvote</button>
                                                    @else upvoted
                                                    @endif
                                                <a href="{{ route('discussion', [$post->id]) }}"
                                                   class="btn btn-outline-success">discuss</a>
                                                </form>
                                            </div>
                                            <div class = "card-footer">
                                                published in {{ $post -> time }}
                                            </div>
                                        </div>
                                        <div><br></div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
