@extends('layouts.new')
@section('content')
    <div>
        <p> <img src="{{ asset('images/carosol/5.jpg') }}" alt="hello" height="300px" width="500px">
                Join to Our Community
        <button class="btn-outline-primary"><a href="/register"> Sign Up</a></button>
        </p>
    </div>
<div>
    <br><br><br>
</div>
    <section id = "bas">
        <div id="bas_title"><h3>Basic Idea</h3></div>
        <div><p>
                The World Wide Fund for
                Nature (WWF) is an international
                organization working on issues regarding the conservation,
                research and restoration of the environment, formerly named the World Wildlife Fund.
                WWF was founded in 1961.
            </p></div>
    </section>
    <div><br><br><br></div>
    <section id = "Impact">
        <div id="con_title"><h3>User's Comments about US</h3></div>
        <div><p>
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            </p></div>
    </section>
@endsection
