<?php

namespace App\Http\Controllers;
use App\Models\Discussion;
use App\Models\posts;
use App\Models\Ratings;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function update($type, $id)
    {
        switch ($type)
        {
            case 'post':
                $p = posts::find($id);
                $q = DB::table('upvotes')
                    ->where('users_id', '=', Auth::id())
                    ->where('type', '=', $type)
                    ->where('type_id', '=', $id)
                    ->get();
                if($q == '[]') {
                    if ($p->users_id == Auth::id()) {
                        $msg = 'self rating not allowed';
                        $link = route('home');
                        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                    } else {

                        Auth()->user()->upvote()->create(
                            [
                                'type' => 'post',
                                'type_id' => $id,
                            ]);
                        $p->rating = $p->rating + 2;
                        $p->save();
                        $r = Ratings::find($p->users_id);
                        $r->ratings += 4;
                        $r->save();
                        return redirect()->route('home');
                    }
                }
                else
                {
                        $msg = 'already voted';
                        $link = route('home');
                        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                }

                break;

            case 'review':
                $r = Review::find($id);
                $q = DB::table('upvotes')
                    ->where('users_id', '=', Auth::id())
                    ->where('type', '=', $type)
                    ->where('type_id', '=', $id)
                    ->get();
                if($q == '[]') {
                    if ($r->users_id == Auth::id()) {
                        $msg = 'self rating not allowed';
                        $link =  url()->previous();
                        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                    } else {

                        Auth()->user()->upvote()->create(
                            [
                                'type' => 'review',
                                'type_id' => $id,
                            ]);
                        $r->rating = $r->rating + 4;
                        $r->save();
                        $rat = Ratings::find($r->users_id);
                        $rat->ratings += 6;
                        $rat->save();
                        return redirect()->route('reviews.show', [$r->posts_id, $r->users_id, $r->id]);
                    }
                }
                else
                {
                    $msg = 'already voted';
                    $link = url()->previous();
                    return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                }
                break;
            case 'discussion':
                $d = Discussion::find($id);
                $q = DB::table('upvotes')
                    ->where('users_id', '=', Auth::id())
                    ->where('type', '=', $type)
                    ->where('type_id', '=', $id)
                    ->get();
                if($q == '[]') {
                    if ($d->users_id == Auth::id()) {
                        $msg = 'self rating not allowed';
                        $link = url()->previous();
                        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                    } else {

                        Auth()->user()->upvote()->create(
                            [
                                'type' => 'discussion',
                                'type_id' => $id,
                            ]);
                        $d->rating = $d->rating + 3;
                        $d->save();
                        $r = Ratings::find($d->users_id);
                        $r->ratings = $r->ratings+2;
                        $r->save();
                        return redirect()->route('dis.show', [$id]);
                    }
                }
                else
                {
                    $msg = 'already voted';
                    $link = url()->previous();
                    return view('single_features.error', ['msg' => $msg, 'link' => $link]);
                }

                break;

        }

    return redirect()->home();
    }
}
