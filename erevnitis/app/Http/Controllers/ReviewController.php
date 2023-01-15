<?php

namespace App\Http\Controllers;
use App\Mail\reviews;
use App\Models\comments;
use App\Models\posts;
use App\Models\Ratings;
use App\Models\Review;
use App\Models\Review_files;
use App\Models\View;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($post)
    {
        $posts = posts::find($post);
        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'users_id')
            ->where('posts.id', $posts->id)
            ->get();
        $reviews = DB::table('reviews')
            ->rightJoin('users', 'reviews.users_id', '=', 'users.id')
            ->where('reviews.posts_id', '=', $posts->id)
            ->select('users.name', 'reviews.users_id', 'reviews.posts_id', 'reviews.id')
            ->get();
        if ($reviews == '[]') $reviews = null;
        $v = DB::table('views')
            ->join('users', 'views.users_id', '=', 'users.id')
            ->where('posts_id', '=', $post)
            ->where('role', '=', '3')
            ->select('reviews_id')
            ->distinct()
            ->get();
        if ($v == '[]') $v = null;
        return view('posts.reviews.review',
            ['posts' => $posts, 'user' => $users[0], 'reviews' => $reviews, 'v' => $v]);
    }

    public function form($post)
    {
        $post = posts::find($post);

        return view('posts.reviews.ReviewForm', ['post' => $post]);
    }

    public function review_create($post, Request $request)
    {
        $user = User::find(Auth::id());
        $post = posts::find($post);
        $status = DB::table('reviews')
            ->select(DB::raw('count(users_id) as status, posts_id'))
            ->groupBy('posts_id')
            ->where('reviews.users_id', '=', $user->id)
            ->get();
        if ($status->isEmpty())
            $rev_total = 0;
        else {
            $rev_total = $status[0];
            if ($rev_total->posts_id != $post->id)
                $rev_total = 0;
            else $rev_total = $rev_total->status;
        }
        if ($rev_total < 1) {
            $review = new Review();
            $rev_file = new Review_files();
            $summary = $request->input('summary');
            $algo = $request->input('algorithms');
            $sub = $request->input('sub');
            $link = $request->input('link');
            $resources = $request->file('res');
            if ($resources)
                $res_bool = true;
            else $res_bool = false;
            if ($summary || $algo || $sub || $link || $res_bool) {
                $review->posts_id = $post->id;
                $review->users_id = $user->id;
                $review->save();
                if ($summary) {
                    $review->summary = $summary;
                    $content = $this->doc_generate($post, $review, $user, 'summary');
                    if(Storage::disk('public')->put($content['docs_link'], $content['docs']))
                        $rev_file->summary_doc = $content['docs_link'];
                    if(Storage::disk('public')->put($content['txt_link'], $content['txt']))
                        $rev_file->summary_txt = $content['txt_link'];
                }
                if ($algo) {
                    $review->algo = $algo;
                    $content = $this->doc_generate($post, $review, $user, 'algo');
                    if(Storage::disk('public')->put($content['docs_link'], $content['docs']))
                        $rev_file->algo_doc = $content['docs_link'];
                    if(Storage::disk('public')->put($content['txt_link'], $content['txt']))
                        $rev_file->algo_txt = $content['txt_link'];
                }
                if ($sub) {
                    $review->sub = $sub;
                }
                if ($link) {
                    $review->link = $link;
                }
                if ($res_bool) {
                            $resources = $resources->store('review_resources', 'public');
                            $review->res = $resources;
                }
                $content = $this->doc_generate($post, $review, $user, 'full');
                if(Storage::disk('public')->put($content['docs_link'], $content['docs']))
                    $rev_file->full_reviews_doc = $content['docs_link'];
                if(Storage::disk('public')->put($content['txt_link'], $content['txt']))
                    $rev_file->full_reviews_txt = $content['txt_link'];
                $review->save();
                $rev_file->reviews_id = $review->id;
                $rev_file->save();
                $r = Ratings::find($user->id);
                $r->ratings = $r->ratings + 20;
                $r->save();
                return redirect()->route('reviews.show', [$post, $user, $review]);
            }
        else {
                $msg = 'nothing to update';
                $link = url()->previous();
                return view('single_features.error', ['msg' => $msg, 'link' => $link]);
            }
        }
        else
        {
            $msg = 'you cant give more than one review. you can edit request your previous one to admin';
            $link = route('posts.reviews', $post);
            return view('single_features.error', ['msg' => $msg, 'link' => $link]);
        }


    }
    public function show(posts $post, User $user, Review $review)
    {
        $p = $post->id;
        $r = $review->id;
        $e = DB::table('users')
            ->where('id' , '=', Auth::id())
            ->select('role')
            ->get();
        ($e[0]->role == 3) ? $m = "peer reviewed" : $m = " ";
        $ed = DB::table('reviews_edit')
            ->where('reviews_id' , '=', $review->id)
            ->select('approve')
            ->get();
        if($ed == '[]')$m2 = null;
        else{
              ($ed[0]->approve) ? $m2 = "edited. watch for previous version" : $m2 = " ";}
        $view = new View();
        $view->posts_id = $p;
        $view->reviews_id = $r;
        $view->users_id = Auth::id();
        $view->save();
        $total = DB::table('comments')
            ->select(DB::raw('count(*) as count, comments.reviews_id'))
            ->groupBy('comments.reviews_id')
            ->where('reviews_id', '=', $review->id)
            ->get();
        $com = DB::table('comments')
            ->join('reviews', 'comments.reviews_id', '=', 'reviews.id')
            ->leftJoin('users', 'comments.users_id', '=', 'users.id')
            ->where('reviews.id', '=', $review->id)
            ->select('comments.*', 'reviews.id', 'users.name', 'comments.users_id')
            ->get();
        $e = ($total->isEmpty()) ? '0' : $total;
        $q = DB::table('upvotes')
            ->where('users_id', '=', Auth::id())
            ->where('type', '=', 'review')
            ->where('type_id', '=', $r)
            ->get();
        $docs = DB::table('review_files')
            ->where('reviews_id', '=', $review->id)
            ->select('*')
            ->get();
        if($q == '[]')$button2 = 'yes';
        else $button2 = null;
        if($review->users_id == Auth::id())
            $button = 'yes';
        else $button = null;

        return view('posts.reviews.reviewshow',
            ['posts' => $post,
                'user' => $user,
                'review' => $review,
                'total' => $e,
                'comments' => $com,
                'button' => $button,
                'button2' => $button2,
                'm' => $m,
                'm2' => $m2,
                'docs' => $docs[0]
            ]);
    }
    public function review_delete($post, $review)
    {
        DB::table('comments')
            ->where('reviews_id', '=', $review)
            ->delete();
        DB::table('reviews')
            ->where('id', '=', $review)
            ->delete();

        return redirect()->route('posts.show', $post);
    }
    public function reviews_edit($review)
    {
        $review = Review::find($review);
        return view('posts.reviews.reviewedit', ['review' => $review]);
    }
    public function reviews_editpost($review, Request $request)
    {
        $review = Review::find($review);
        $p = posts::find($review->posts_id);
        $u = User::find($review->users_id);
        $s = similar_text($review->summary,$request->input('summary'),$percent);
        $a = similar_text($review->algo,$request->input('algo'),$percent);
        $su = similar_text($review->sub,$request->input('sub'),$percent);
        $li = similar_text($review->link,$request->input('link'),$percent);

        if($review->edit) {
        $review->edit()->create([
                'posts_id' => $review->posts_id,
                'reviews_id' => $review->id,
                'summary' => $request->input('summary'),
                'algo' => $request->input('algo'),
                'sub' => $request->input('sub'),
                'link' => $request->input('link'),
                'res'  => 'null',
                'sum_percent' => $s,
                'algo_percent' => $a,
                'sub_percent' => $su,
                'li_percent' => $li
            ]);
            $resources = $request->file('res');
            if($resources) {
                if($resources)
                    $resources = $resources->store('upload/review_resources', 'public');
            }
             DB::table('reviews_edit')
                 ->where('reviews_id', '=', $review->id)
                 ->update(['res' => $resources]);
             $review->edit = '0';
             $review->save();
        }

    else {
        $msg = 'not possible. limit over';
        $link = route('reviews.show', [$p, $u, $review]);
        return view('single_features.error', ['msg' => $msg, 'link' => $link]);
    }
    return redirect()->route('reviews.show', [$p, $u, $review]);
    }

    public function comment(posts $post, Review $review, Request $request)
    {
        $r = Ratings::find(Auth::id());
        $r->ratings = $r->ratings+2;
        $r->save();
        $comment = new comments();
        $comment->users_id = Auth::id();
        $comment->posts_id = $post->id;
        $comment->reviews_id = $review->id;
        $comment->comment = $request->input('comment');
        $comment->save();
        $user = User::find(Auth::id());
        return redirect()->route('reviews.show', [$post, $user, $review]);
    }

    public function old_version(posts $post, Review $review)
    {
        $q = DB::table('reviews_edit')
            ->where('posts_id', '=', $post->id)
            ->where('reviews_id', '=', $review->id)
            ->get();
        if($q[0]->approve)
        {
            return view('posts.reviews.edited_review', ['review' => $q[0], 'get_back' => url()->previous()]);
        }
        else {
            $msg = 'Probably not approved! enjoy!';
            $link = url()->previous();
            return view('single_features.error', ['msg' => $msg, 'link' => $link]);
        }
    }

    public function doc_generate($post, $review, $user, $type)
    {
        switch ($type) {
            case 'full':
                $doc_content = "<img src = '" . asset('images/logo & icon/explorerhub_logo.png') . "'" . " alt='ExplorerHub logo'" .
                               " style='width:400px;height:100px;'" . ">" . "<br><br>" .
                               "<b>" . $post->pcaption . "</b><br><br>" .
                               "<b>" . "reviewed by " . "</b>" . $user->name . "<br><br>" .
        "<b>" . "create time: " . "</b>" . $review->created_at . " (local time)" . "<br><br>" .
        "<b>" . "pre requisite: " . "</b>" . $review->sub . "<br><br>" .
        "<a href ='" . $review->link . "'>" . "<b>" . "additional links" . "</b></a><br><br>" .
        "<b>" . "summary" . "</b><br>" .
        "<p>" . $review->summary . "</p>" . "<br><br>" .
        "<b>" . "algorithm" . "</b>" . "<br><br>" .
        "<p>" . $review->algo . "</p>" . "<br><br>" .
        "thanks for stay with ExplorerHub. Good Luck!";

                $txt_content = "ExplorerHub" . "\n\n" .
                    $post->pcaption . "\n" .
                    "reviewed by: " . $user->name . "\n" .
                    "create time: " . $review->created_at . " (local time)" . "\n\n" .
                    "pre requisite: " . $review->sub . "\n\n" .
                    "summary" . "\n" . $review->summary . "\n\n" .
                    "algorithm" . "\n\n" . $review->algo . "\n" . "\n\n" .
                    "thanks for stay with ExplorerHub. Good Luck!";

                    $txt_link = '/upload/post' . '/' . $post->id . '/review/' . $review->id . '/txt/full_reviews.txt';
                    $docs_link = '/upload/post' . '/' . $post->id . '/review/' . $review->id . '/doc/full_reviews.docx';
                return ['docs' => $doc_content, 'txt' => $txt_content, 'docs_link' => $docs_link, 'txt_link' => $txt_link];

            case 'summary':
                $doc_content =  "<img src = '" . asset('images/logo & icon/explorerhub_logo.png') . "'" . " alt='ExplorerHub logo'" .
                    " style='width:400px;height:100px;'" . ">" . "<br><br>" .
                    "<b>" . $post->pcaption . "</b><br><br>" .
                    "<b>" . "reviewed by " . "</b>" . $user->name . "<br><br>" .
                    "<b>" . "create time: " . "</b>" . $review->created_at . " (local time)" . "<br><br>" .
                    "<b>" . "summary" . "</b><br>" .
                    "<p>" . $review->summary . "</p>" . "<br><br>" .
                    "thanks for stay with ExplorerHub. Good Luck!";
                $txt_content = $post->pcaption . "\n" .
                    "reviewed by " . $user->name . "\n" .
                    "summary" . "\n" . $review->summary;

                $docs_link = '/upload/post/' . $post->id . '/review/' . $review->id . '/doc/review_summary.docx';
                $txt_link = '/upload/post/' . $post->id . '/review/' . $review->id . '/txt/review_summary.txt';
                return ['docs' => $doc_content,
                         'txt' => $txt_content,
                        'docs_link' => $docs_link,
                        'txt_link' => $txt_link];

            case 'algo':
                $doc_content =  "<img src = '" . asset('images/logo & icon/explorerhub_logo.png') . "'" . " alt='ExplorerHub logo'" .
                    " style='width:400px;height:100px;'" . ">" . "<br><br>" .
                    "<b>" . $post->pcaption . "</b><br><br>" .
                    "<b>" . "reviewed by " . "</b>" . $user->name . "<br><br>" .
                    "<b>" . "create time: " . "</b>" . $review->created_at . " (local time)" . "<br><br>" .
                    "<b>" . "algorithm" . "</b>" . "<br><br>" .
                    "<p>" . $review->algo . "</p>" . "<br><br>" .
                    "thanks for stay with ExplorerHub. Good Luck!";
                $txt_content = $post->pcaption . "\n" .
                    "reviewed by " . $user->name . "\n" .
                    'algorithm' . "\n" . $review->algo;
                $docs_link = '/upload/post/' . $post->id . '/review/' . $review->id . '/' . 'doc/review_algo.docx';
                $txt_link = '/upload/post/' . $post->id . '/review/' . $review->id . '/' . 'txt/review_algo.txt';
                return ['docs' => $doc_content,
                    'txt' => $txt_content,
                    'docs_link' => $docs_link,
                    'txt_link' => $txt_link];

        }
        return false;
    }


}
