@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <div class="card">
    <div class="card-header">
        {{ __('Profile') }}
    </div>
<div class = "card-body">
    <div>
    @if(is_null($user->profile->pic))
     @if($user->gender == 'male')
        <img class="img-thumbnail img-fluid rounded mx-auto d-block max-width: 50% height: 50%" src = " {{ asset('images/default_pro_pic/profile_male.jpeg')}}" alt = "profile picture">
            @else
                <img class="img-thumbnail img-fluid rounded mx-auto d-block max-width: 100% height: auto" src = " {{ asset('images/default_pro_pic/profile_female.png')}}" alt = "profile picture">
    @endif
                @else
        <img class="img-thumbnail img-fluid rounded mx-auto d-block" src = " /storage/{{ $user->profile->pic }}" alt = "profile picture">
    @endif
    </div>
    @if($user->id != \Illuminate\Support\Facades\Auth::id())
        <div>
{{--            <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>--}}
            <div><br><a href="{{ route('message.person', $user->id) }}" class="btn btn-outline-dark">Message</a></div>
        </div>
    @endif


<div class="justify-content-center">
    <div><h2>{{ $user->name }}</h2></div>
<div><h5>lived in {{ $user->profile->country }}</h5></div>
</div>
<div class = "justify-content-center">
    <div><strong>{{ $count_post }}</strong> post</div>
    <div><strong>{{ $count_review }}</strong> reviews</div>
    <div><strong>{{ $count_comment }}</strong> comments </div>
</div>
<div>
    <div><h3>{{ $user->profile->job }}</h3></div>
    <div><strong>Profile Description</strong></div>
    <div><p>{{ $user->profile->description ?? 'N/A' }}</p></div>
    <div class="pr-3"><strong>website: </strong></div>
   <div>
       @if(is_null($user->profile->website))
           <a href = "#">No Website</a>
       @else
       <a href = "{{ $user->profile->website }}">User Website</a>
           @endif
   </div>
</div>
    @foreach($posts as $post)
        <div class = "row justify-content-center">
        <div class="col-sm-3 pt-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    published on {{ $post -> journal }}
                </div>
                <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Authors: {{ $post -> author }}</li>
                                    <li class="list-group-item">Topic: {{ $post -> subject }}</li>
                                    <li class="list-group-item">Uploaded at: {{ $post -> created_at }}</li>
                                    <li class="list-group-item">Uploader:   <a href="{{ route('profile.show', $post->users_id) }}">{{ $user->name }}</a></li>
                                </ul>
                                    <a href="{{ $post -> posts }}" class="card-link">Paper link</a>
                                    <a href="{{ route('posts.reviews', $post->id) }}"
                                       class="btn btn-outline-success">reviews section</a>
                    @if($post -> users_id == \Illuminate\Support\Facades\Auth::id())
                        <a href=" {{ route('posts.delete', $post->id) }}" class="btn btn-outline-danger">delete</a>
                    @endif
                </div>
            </div>
        </div>
        </div>
    @endforeach
    </div>
</div>
</div>
</div>
@endsection

