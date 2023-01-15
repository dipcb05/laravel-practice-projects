@extends('layouts.app')
@section('content')
    <div class="container">
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
                        You are in ADMIN Dashboard!
                    </div>
                    <div class="align-content-center"><a href = "{{ route('check_edit_req') }}">Check edit request</a></div>
                    <div class="align-content-center"><a href = "{{ route('admin.peerassign') }}">Assign new </a></div>
                    <div class="align-content-center"><a href = "{{ route('check_paper_req') }}">Check new paper request</a></div>
                    <div class="align-content-center"><a href = "{{ route('admin.stat') }}">Check statistics</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
