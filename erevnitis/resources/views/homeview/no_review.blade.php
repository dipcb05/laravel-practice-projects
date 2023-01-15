@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">no reviews collection</div>
    <div class="card-body">
        @foreach($p as $pp)
            <a href="{{ route('posts.reviews', $pp->id) }}">See posts and review to get points</a>
        @endforeach
    </div>
</div>
@endsection
