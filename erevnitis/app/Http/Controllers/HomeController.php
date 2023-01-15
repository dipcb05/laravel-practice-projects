<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\discussion_comments;
use App\Models\message;
use App\Models\Ratings;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = DB::table('posts')
            ->leftJoin('users', 'posts.users_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->orderBy('id', 'DESC')
            ->get();
        $q = DB::table('upvotes')
            ->join('posts', 'upvotes.type_id', '=', 'posts.id')
            ->where('upvotes.users_id', '=', Auth::id())
            ->where('upvotes.type', '=', 'post')
            ->select('posts.id')
            ->orderBy('posts.id', 'DESC')
            ->get();
        if ($posts == '[]')
            $posts = null;
        if ($q == '[]')
            $q = null;
        return view('homeview.home', ['posts' => $posts, 'q' => $q]);

    }

    public function search(Request $request)
    {
        $r = Ratings::find(Auth::id());
        $r->ratings = $r->ratings + 1;
        $r->save();
        $post = DB::table('posts')
            ->whereRaw('pcaption or author like ?',
                ["%{$request->get('search')}%"])
            ->get();
        $user = DB::table('users')
            ->whereRaw('name like ?',
                ["%{$request->get('search')}%"])
            ->get();
        if($post == '[]')$post = null;
        if($user == '[]')$user = null;
        return view('query.search', ['query_name' => $request->get('search'),
            'posts' => $post, 'user' => $user]);
    }

    public function see_paper($element)
    {

        if ($element == 'author') {

            $find = DB::table('posts')
                ->join('users', 'posts.users_id', '=', 'users.id')
                ->select(DB::raw('count(posts) as number_of_post, users_id, name'))
                ->groupBy('users_id')
                ->orderByRaw('count(posts) DESC')
                ->take(3)
                ->get();
        } else if ($element == 'subject') {

            $find = DB::table('posts')
                ->select(DB::raw('count(posts) as number_of_post, subject'))
                ->groupBy('subject')
                ->orderByRaw('count(posts) DESC')
                ->take(3)
                ->get();
        }
        return view('query.author', ['query_name' => $element, 'find' => $find]);
    }

    public function paper_req()
    {
        $user = User::find(Auth::id());
        return view('single_features.paper_req', ['user' => $user]);
    }

    public function admin_task($user, Request $request)
    {
        $r = Ratings::find($user);
        $r->ratings = $r->ratings + 2;
        $r->save();
        $n = DB::table('users')
            ->select('name')
            ->where('id', '=', $user)
            ->get();
        DB::table('admin_paper_request')
            ->insert([
                'from' => $n[0]->name,
                'name' => $request->get('name'),
                'publisher' => $request->get('publisher'),
                'authors' => $request->get('author'),
                'year' => $request->get('year')
            ]);
        return redirect()->route('home');
    }

    public function dis_index()
    {
        $posts = DB::table('discussions')
            ->leftJoin('users', 'discussions.users_id', '=', 'users.id')
            ->select('discussions.*', 'users.name')
            ->orderBy('id', 'DESC')
            ->get();
        if ($posts == '[]')
            $posts = null;
        return view('single_features.discussion.discussion', ['posts' => $posts]);

    }

    public function dis_update(Request $request)
    {
        $r = Ratings::find(Auth::id());
        $r->ratings = $r->ratings + 5;
        $r->save();
        $d = new discussion();
        $d->users_id = Auth::id();
        $d->keyword = $request->input('keyword');
        $d->question = $request->input('question');
        $d->save();
        return redirect()->route('discussion');
    }

    public function dis_show($dis)
    {
        $qus = DB::table('users')
            ->Join('discussions', 'users.id', '=', 'discussions.users_id')
            ->where('discussions.id', $dis)
            ->select('users.name', 'discussions.*')
            ->get();
        $comment = DB::table('discussions_comments')
            ->Join('users', 'users.id', '=', 'discussions_comments.users_id')
            ->where('discussions_comments.discussions_id', $dis)
            ->select('users.name', 'discussions_comments.*')
            ->get();
        $total_comments = DB::table('discussions_comments')
            ->select(DB::raw('count(*) as count, discussions_comments.discussions_id'))
            ->groupBy('discussions_comments.discussions_id')
            ->where('discussions_comments.discussions_id', '=', $dis)
            ->get();
        $q = DB::table('upvotes')
            ->where('users_id', '=', Auth::id())
            ->where('type', '=', 'discussion')
            ->where('type_id', '=', $dis)
            ->get();
        if ($q == '[]') $button2 = 'yes';
        else $button2 = null;
        $e = ($total_comments->isEmpty()) ? '0' : $total_comments;
        return view('single_features.discussion.dis_show',
            ['qus' => $qus[0], 'comments' => $comment, 'total' => $e, 'button' => $button2]);
    }

    public function dis_comment($dis, Request $request)
    {
        $r = Ratings::find(Auth::id());
        $r->ratings = $r->ratings + 1;
        $r->save();
        $comment = new discussion_comments();
        $comment->users_id = Auth::id();
        $comment->discussions_id = $dis;
        $comment->comment = $request->input('comment');
        $comment->save();
        return redirect()->route('dis.show', [$dis]);
    }


    public function msg_index($other)
    {
        $check = User::find($other);
        $u = User::find(Auth::id());
        if ($check) {
            if ($other != Auth::id()) {
                $fetch_msg = DB::table('messages')
                    ->join('users', 'messages.users_id', '=', 'users.id')
                    ->select('messages.*', 'users.username')
                    ->where('users_id', '=', Auth::id())
                    ->where('others_id', '=', $other)
                    ->orWhere('users_id', '=', $other)
                    ->where('others_id', '=', Auth::id())
                    ->orderBy('created_at', 'asc')
                    ->get();
                if ($fetch_msg == '[]')
                    $fetch_msg = null;
                return view('single_features.chat', ['msg' => $fetch_msg, 'other' => $other, 'u_name' => $u->username]);
            } else {
                return redirect()->route('profile.show', $other);
            }
        } else {
            $msg = "User not found";
            $link = url()->previous();
            return view('error', ['msg' => $msg, 'link' => $link]);
        }
    }

    public function msg_update($others, Request $request)
    {
        if ($request->input('msg')) {
            $message = new message();
            $message->users_id = Auth::id();
            $message->others_id = $others;
            $message->message = $request->input('msg');
            $message->save();
            return redirect()->route('message.person', [$others]);
        } else {
            $msg = "Message body can't be empty";
            $link = url()->previous();
            return view('error', ['msg' => $msg, 'link' => $link]);
        }
    }

    public function peer_activity()
    {
        $u = User::find(Auth::id());
        if ($u->role == 3) {
            $p = DB::table('posts')
                ->select('id')
                ->whereNotExists(function ($query) {
                    $query->select("reviews.posts_id")
                        ->from('reviews')
                        ->whereRaw('reviews.posts_id = posts.id');
                })
                ->get();
            return view('homeview.no_review', ['p' => $p]);
        } else return redirect()->route('home');

    }
}
