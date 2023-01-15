@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Discussion Forum</div>
                    <div class="card-body">
                        <div class = "card">
                            <div class="card-header">question by <a href = "{{ route('profile.show', $qus->users_id) }}">{{ $qus->name }}</a>
                                <div>Upload time: {{ $qus -> created_at }}</div>
                            </div>

                            <div class="card-body">
                                <div><p><b>{{ $qus->question }}</b></p></div>
                                <form action ="{{ route('rating.update', ['discussion', $qus->id]) }}"
                                      enctype="multipart/form-data" method="post">
                                    @csrf
                                    @if(!is_null($button))
                                        <button class="btn btn-secondary" type="submit">Upvote</button>
                                    @else upvoted
                                    @endif
                                </form>
                            </div>
                            <div class="card-footer">{{ $qus->keyword }}</div>
                        </div>

                        @if($total == '0')
                            <div class = "pl-2"> no one comment yet</div>
                        @else
                            <div> {{ $total[0]->count }} comments</div>
                            <div class="pl-2">
                                <div class="card">
                                    <div class="card-header">show all comments</div>
                                    <div class="card-body">
                                        @foreach($comments as $comment)
                                            <div class="row justify-content-center">
                                                <div>comment by
                                                    <a href="{{ route('profile.show', $comment->users_id) }}">
                                                        {{ $comment->name }}</a>
                                                </div>
                                            </div>
                                            <div class="row" style="background-color: #ebe0b2">
                                                {{ $comment->comment }}
                                            </div>
                                            <div class = "row" style="background-color: #ced4da">
                                                comment time:
                                                {{ $comment->updated_at }}
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                                @endif
                                <div><br><br></div>
                                <form action ="{{ route('dis.comment', [$qus->id]) }}"
                                      enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="comment">
                                            discussion
                                        </label>
                                        <div class="col-md-7">

                                <textarea
                                    id="comment"
                                    type="text"
                                    class="form-control
                                       @error('summary') is-invalid @enderror"
                                    name="comment">
                            </textarea>

                                            @error('comment')
                                            <span
                                                class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4  offset-md-4">
                                            <button type="submit"
                                                    class="btn btn-primary">
                                                {{ __('comment') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                    </div>
                </div>
            </div>
@endsection
