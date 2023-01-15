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
                        <div>most popular</div>
                        @foreach($find as $new)
                            @if($query_name == 'author')
                                <div>
                                    <a href="{{ route('profile.show', $new->users_id) }}">
                                        {{ $new-> name }}</a>
                                    {{ $new->number_of_post }} posts
                                </div>
                            @else
                                <div>{{ $new->subject }} : {{ $new->number_of_post }} posts</div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
