@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 30rem;">
                <div class="card-header">
                    Candidates
                </div>
    <div class="card-body">
    @foreach($r as $rr)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <form action ="{{ route('peer.assign', [$rr->users_id]) }}"
                                      enctype="multipart/form-data" method="post">
                                    @csrf
                                <div>
                                    <a href="{{ route('profile.show', $rr->users_id) }}"> {{ $rr->name }} </a> {{ $rr->ratings }} points
                                    <button class="btn btn-secondary" type="submit">Assign</button>
                                </div>
                                </form>
                            </li>
    @endforeach
                        </ul>
    </div>
            </div>
        </div>
    </div>
@endsection
