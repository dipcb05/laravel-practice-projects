@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">review</div>
                    <div class="card-body">
                        <div class = "card">
                            <div class="card-header">reviews by <a href = "{{ route('profile.show', $review->users_id) }}">{{ $review->user->name }}</a>
                                <div>{{ $m }}</div>
                                <div><a href = {{ route('edited_review', [$posts->id, $review->id]) }}> {{ $m2 }}</a></div>
                            </div>

                            <div class="card-body">
                                <div>pre requisite subjects</div>
                                <div>{{ $review->sub }}</div>
                                <div>referred links: </div>
                                <div>{{ $review->link }}</div>
                                <div>short summary</div>
                                <div class="justify-content-center" style="background-color: #95c5ed">
                                    @markdown ``` {{ $review->summary }} ``` @endmarkdown
                                   </div>
                                <br>
                                <div>download as <a href="/storage/{{ $docs->summary_doc }}">docx file</a>/
                                    <a href = "/storage/{{ $docs->summary_txt }}">text file</a></div>
                                <br>
                                <div>key algorithm</div>

                                <div class = "text-center" style="background-color: #D3D3D3">
                                    @markdown ```{{ $review->algo }}``` @endmarkdown
                                </div>
                                <br>
                                <div>download as <a href="/storage/{{ $docs->algo_doc }}">docx file</a>/
                                    <a href = "/storage/{{ $docs->algo_txt }}">text file</a></div>
                                <br>
                                @if(is_null($review->res))
                                    <div>no additional resources</div>
                                @else
                                    <div>additional resources</div>
                                    <div><a href = "/storage/{{ $review->res }}">download here</a></div>
                                @endif
                                <form action ="{{ route('rating.update', ['review', $review->id]) }}"
                                      enctype="multipart/form-data" method="post">
                                    @csrf
                                @if(!is_null($button))
                                    <a href="{{ route('reviews.editget', $review->id) }}"
                                       class="btn btn-outline-dark">Edit the Review</a>
                                @endif
                                @if(!is_null($button2))
                                        <button class="btn btn-secondary" type="submit">Upvote</button>
                                    @else upvoted
                                @endif
                                </form>
                            </div>
                            <div class="card-footer">
                                <div>full review</div>
                                download as <a href="/storage/{{ $docs->full_reviews_doc }}">docx file</a>/
                                    <a href = "/storage/{{ $docs->full_reviews_txt }}">text file</a></div>
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
                                <form action ="{{ route('comment.update', [$review->posts_id, $review->id]) }}"
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
