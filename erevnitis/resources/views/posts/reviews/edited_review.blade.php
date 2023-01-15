@extends('layouts.app')
@section('content')
<div class="card">
<div class="card-body">
    <div class="card-header">old version</div>
    <div>pre requisite subjects</div>
    <div>{{ $review->sub }}</div>
    <div>referred links: </div>
    <div>{{ $review->link }}</div>
    <div>short summary</div>
    <div class="justify-content-center" style="background-color: #95c5ed">
        @markdown ``` {{ $review->summary }} ``` @endmarkdown
    </div>
    <div>key algorithm</div>

    <div class = "text-center" style="background-color: #D3D3D3">
        @markdown ```{{ $review->algo }}``` @endmarkdown
    </div>
</div>
    <div class="card-footer"><a href = {{ $get_back }} > Get Back to the original </a> </div>
</div>
@endsection
