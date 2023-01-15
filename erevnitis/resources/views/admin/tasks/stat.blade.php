@extends('layouts.app')
@section('content')
    <h1>today's report</h1>
    <h3>total post: {{ $total_post }}</h3>
    <h3>total account so far: {{ $total_profiles }}</h3>
    <h3>today's post: {{ $today_post }}</h3>
    <h3>today's account: {{ $today_ac }}</h3>
@endsection
