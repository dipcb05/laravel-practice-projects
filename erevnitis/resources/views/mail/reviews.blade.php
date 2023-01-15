@component('mail::message')
<div><b> {{ $post->pcaption }}</b></div>
<br>
<br>
<div>reviewed by {{ $user->name }}</div>
<div><b>Prerequisite Subjects</b> : {{ $review->sub }}</div>
<br>
<div><b>Helpful links</b> : {{ $review->link }}</div>
<br>
<div><b>summary</b></div>
<br>
<div><p>{{ $review->summary }} </p></div>
<br>
<div><b>algorithm</b></div>
<br>
<div><p>{{ $review->algo }}</p></div>
@endcomponent
