<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function index(User $user, Request $request)
    {
        //$use = User::find($user);
        //$follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $posts = DB::table('posts')
                 ->where('users_id', '=', $user->id)
                 ->get();
        $count_review = DB::table('reviews')
                        ->select(DB::raw('count(id) as review_count'))
                        ->where('users_id', '=', $user->id)
                        ->get();
        $count_post = DB::table('posts')
                      ->select(DB::raw('count(id) as post_count'))
                      ->where('users_id', '=', $user->id)
                      ->get();
        $count_comment = DB::table('comments')
                         ->select(DB::raw('count(id) as comment_count'))
                         ->where('users_id', '=', $user->id)
                         ->get();
        return view('profile.profile',
                           ['user' => $user,
                            'posts' => $posts,
                           // 'follows' => $follows,
                            'count_review' => $count_review[0]->review_count,
                            'count_post' => $count_post[0]->post_count,
                            'count_comment' => $count_comment[0]->comment_count,
                            ]
                  );
    }
    public function edit($user)
    {
        $user = User::find($user);

        if(Auth::id() == $user->profile->users_id)
        return view('profile.EditProfile', ['user' => $user]);
        else return redirect()->route('profile.show', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        if(Auth::id() == $user->profile->users_id) {
            $name = $request->input('name');
            $country = $request->input('country');
            $bdate = $request->input('bdate');
            $job = $request->input('job');
            $wdate = $request->input('wdate');
            $des = $request->input('description');
            $web = $request->input('website');
            $pic = request('pic');
            if ($pic) $pic = $pic->store('upload/pro_pic', 'public');
            if ($name || $country || $bdate || $job || $wdate || $pic || $web || $des) {
                if ($name) {
                    $user->name = $name;
                    $user->save();
                }
                if ($country) {
                    $user->profile->country = $country;
                    $user->profile->save();
                }
                if ($bdate) {
                    $user->profile->bdate = $bdate;
                    $user->profile->save();
                }
                if ($job) {
                    $user->profile->job = $job;
                    $user->profile->save();
                }
                if ($wdate) {
                    $user->profile->wdate = $wdate;
                    $user->profile->save();
                }
                if ($pic) {
                    $user->profile->pic = $pic;
                    $user->profile->save();
                }
                if ($des) {

                    $user->profile->description = $des;
                    $user->profile->save();
                }
                if ($web) {

                    $user->profile->website = $web;
                    $user->profile->save();
                }
                echo 'updated';
            } else echo 'nothing to update';

            return redirect()->route('profile.show', $user);
        }
        else return redirect()->route('home');
    }
    public function follow_store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
