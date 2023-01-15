@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search Result</div>
                    <div class="card-body">
                        <div class = "text-center">
                            <h3><br>Search about {{ $query_name }}</h3>
                        </div>
                        @if(is_null($posts))
                            <div class = "text-center">
                                <h3>No post found!!</h3>
                            </div>
                        @else
                        @foreach($posts as $new)
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card" style="width: 35rem; height: 35rem;">
                                            <div class = "card-body">
                                                <div class="card-header">{{ $new->pcaption }}</div>
                                                <img class="card-img"
                                                     src=" {{ asset('images/1.jpeg') }}"
                                                     alt="image of paper"
                                                     style="width: 100%; height: 50%">
                                                <h5 class="card-title">
                                                    <br><b>Author: </b>
                                                    {{ $new->author}}</h5>
                                                <h5>
                                                    <b>Uploaded: </b></h5>
                                                <a href="/storage/{{ $new -> posts }}"
                                                   class="btn btn-primary">read</a>
                                                <a href="{{ route('posts.reviews', $new->id) }}"
                                                   class="btn btn-outline-success">reviews</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        @endif
                        @if(is_null($user))
                            <div class = "text-center">
                                <h3>No profile found!!</h3>
                            </div>
                        @else
                        <div>profiles</div>
                        @foreach($user as $new)
                                <div>
                                    <a href="{{ route('profile.show', $new->id) }}">{{ $new->name }}</a>
                                </div>
                        @endforeach
                            @endif
                    </div>
                    <div class="card-footer"> <a href="{{ url()->previous() }}">Get Back</a></div>
                </div>
            </div>
        </div>
    </div>


@endsection
