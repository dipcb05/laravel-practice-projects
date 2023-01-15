@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-8">
        <div class="card">
            <div class = "row justify-content-center">
                <div class = "col-8 p-5">
                    <div><h1><b>{{ $posts->pcaption }}</b></h1></div>
                    <div><h4>authors: <b>{{ $posts -> author }}</b></h4></div>
                    <div><h4>uploader name: {{ $user -> name}}</i></h4></div>
                    <div><h4>uploaded time: {{ $posts->created_at }}</h4></div>
                    <div><h5>subject: {{ $posts -> subject }}</h5></div>

                    </div>
                </div>
        <div class = "row">
            <div class = "col-5 p-5">
                <div>
                    <h4><b>create review</b></h4>
                </div>
                <div>
                    <a class="btn btn-primary"
                       href="{{ route('reviews.edit', $posts->id) }}"
                       role="button">Create a review</a>
                </div>

            </div>
        </div>
        <div class = "row">
            <div class = "col-5 p-5">
                <div>
                    <h4><b>other reviews of this paper</b></h4>
                </div>
                @if(is_null($reviews))
                    <div>no one reviews yet</div>
                @else
                <div>
                    @foreach($reviews as $rev)
                        <div class="row">
                            <div>
                                <a href="{{ route('reviews.show', [$rev->posts_id, $rev->users_id, $rev->id]) }}">
                                    reviewed by {{ $rev->name }}</a></div></div>
                    @endforeach

            </div>
                    @endif



            </div>
            </div>
            </div>
        </div>
    </div>
@endsection

