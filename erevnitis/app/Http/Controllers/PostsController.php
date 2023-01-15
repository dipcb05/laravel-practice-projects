<?php

namespace App\Http\Controllers;
use App\Models\posts;
use App\Models\Ratings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $id = Auth::id();
        $user = DB::table('users')
              ->find($id);
        return view('posts.posts', ['user' => $user]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'pcaption' => 'required',
            'posts' => 'required',
            'author' => 'required',
            'subject' => 'required',
            'journal' => 'required',
            'time' => 'required'
        ]);
        $post = new posts();
        $post->pcaption = $data['pcaption'];
        $post->posts = $data['posts'];
        $post->author = $data['author'];
        $post->subject = $data['subject'];
        $post->journal = $data['journal'];
        $post->time = $data['time'];
         Auth()->user()->posts()->create(
           [
               'pcaption'  => $post->pcaption,
               'posts'     => $post->posts,
               'author'    => $post->author,
               'subject'   => $post->subject,
               'journal'   => $post->journal,
               'time'      => $post->time,
            ]);
          $r = Ratings::find(Auth::id());
          $r->ratings = $r->ratings+10;
          $r->save();
         return redirect()->route('home');
    }

    public function post_delete($post)
    {
        DB::table('comments')
            ->where('posts_id', '=', $post)
            ->delete();
        DB::table('reviews')
            ->where('posts_id', '=', $post)
            ->delete();
        DB::table('posts')
            ->where('id', '=', $post)
            ->delete();
        $user = User::find(Auth::id());
        return redirect()->route('profile.show', $user);
    }

    }
