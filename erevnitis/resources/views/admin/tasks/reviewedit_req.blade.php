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
                                                request by {{ $post -> name}}
                                            </div>
                                            <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div>Summary: <p> {{ $post -> summary }}</p>
                                                         Changes: {{ $post -> sum_percent }}% percent
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div>algorithms: <p> {{ $post -> algo }}</p></div>
                                                <div> Changes: {{ $post -> algo_percent }}% percent</div>
                                                </li>
                                                <li class="list-group-item">
                                                    Prerequisite: {{ $post -> sub }}
                                                    <div>Changes: {{ $post -> sub_percent }}% percent</div>
                                                </li>
                                                <li class="list-group-item">
                                                    links: {{ $post -> link }}
                                                    <div>Changes: {{ $post -> li_percent }}% percent</div>
                                                </li>
                                           <li class="list-group-item">
                                               @if(is_null($post -> res))
                                                    Resources: No change
                                               @else
                                                   Resources: <a href =" /storage/{{ $post -> res }}">New Docs</a>
                                                    <div> Changes: Yes</div>
                                               @endif
                                                </li>
                                            </ul>

                                                <form action ="{{ route('editreq.approve', [$post-> reviews_id]) }}"
                                                      enctype="multipart/form-data"
                                                      method="post">
                                                    @csrf
                                                <button type="submit"
                                                   class="btn btn-outline-dark">Approve</button>
                                                </form>
                                                <form action ="{{ route('editreq.decline', [$post -> id]) }}"
                                                      enctype="multipart/form-data"
                                                      method="post">
                                                    @csrf
                                                    <button type="submit"
                                                       class="btn btn-outline-danger">Decline</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    @endforeach
    @endif
@endsection
