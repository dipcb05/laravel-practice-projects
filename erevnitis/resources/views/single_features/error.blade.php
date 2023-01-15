@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
             Error Message
        </div>
        <div class="card-body">
            <div>Message: {{ $msg }}</div>

                <div><a href = {{ $link }} > Get Back </a> </div>

        </div>
    </div>
@endsection
