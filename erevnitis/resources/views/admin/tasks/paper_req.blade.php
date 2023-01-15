@extends('layouts.app')
@section('content')
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if(is_null($posts))
                        <div class = "text-center">
                            <h3><br>No New Request</h3>
                        </div>
                    @else
                        <div class = "text-center">
                            <h3><br>New request</h3>
                        </div>
                    @foreach($posts as $post)

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card" style="width: 30rem;">
                                        <div class="card-header">
                                            request by {{ $post -> from}}
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">title: {{ $post -> name }}</h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Authors: {{ $post -> authors }}</li>
                                            <li class="list-group-item">Publishers: {{ $post -> publisher }}</li>
                                            <li class="list-group-item">Published in: {{ $post -> year }}</li>
                                        </ul>
                                        <a href="http://google.com" class="btn btn-success">search</a>
                                    </div>
                                </div>
                            </div>
    @endforeach
    @endif
@endsection
