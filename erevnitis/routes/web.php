 <?php

 use App\Mail\WelcomeMail;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Route;

 /*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application. These
 | routes are loaded by the RouteServiceProvider within a group which
 | contains the "web" middleware group. Now create something great!
 |
 */


 Route::get('/email', function () {
     return new WelcomeMail();
 });
Auth::routes(['verify' => true]);
//home section
 Route::get('/apitoken', 'Auth/ApiTokenController@update')->name('newapitoken');
Route::get('/', function() { 
       return view('homeview.firstpage');
});// very first page
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');//home
 //profile section
Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');//profile showing
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');//profile edit
Route::post('/edit', 'ProfileController@update')->name('profile.update');//profile edit process
 //posts section
Route::get('/p/create', 'PostsController@create')->name('posts.create');//posts
Route::post('/p', 'PostsController@store')->name('posts.store');//posts storing process
Route::get('/p/{post}', 'PostsController@showdata')->name('posts.show'); //posts show
Route::get('/p/{post}/delete', 'PostsController@post_delete')->name('posts.delete'); //post delete
Route::get('/preq', 'HomeController@paper_req')->name('paper.req');
Route::post('/{user}/adminsend', 'HomeController@admin_task')->name('req.save');
 //query section
 Route::post('/search', 'HomeController@search')->name('search');
Route::get('/query/{key}', 'HomeController@see_paper')->name('query.show');
//review & comment section
 Route::get('p/{post}/review/', 'ReviewController@index')->name('posts.reviews'); //review page
 Route::get('p/{post}/review/reviewform', 'ReviewController@form')->name('reviews.edit'); //review writing
 Route::post('p/{post}/r', 'ReviewController@review_create')->name('reviews.update'); //review posts
 Route::get('p/{post}/r/{reviews}/delete', 'ReviewController@review_delete')->name('reviews.delete');
 Route::get('p/{post}/review/by{user}/{review}','ReviewController@show')->name('reviews.show'); //show single reviews
 Route::post('{post}/{review}/commentupdate', 'ReviewController@comment')->name('comment.update');//comment
 Route::get('r/{review}/edit', 'ReviewController@reviews_edit')->name('reviews.editget');
 Route::post('r/{review}/p', 'ReviewController@reviews_editpost')->name('reviews.editpost');
 Route::get('r/{post}/{review}/prev', 'ReviewController@old_version')->name('edited_review');

 Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/a', 'AdminController@generate_ac')->name('admin_first_time');
Route::get('/admin/stat', 'AdminController@stats')->name('admin.stat');
Route::get('/admin/ap', 'AdminController@assign_peer')->name('admin.peerassign');
 Route::post('/admin/ap/{user}', 'AdminController@peer_assign')->name('peer.assign');
Route::get('/admin_editprofile/{id}', 'AdminController@index2')->name('admin_editprofile');
Route::post('/{admin}/aep', 'AdminController@profile_update')->name('admin.profile_update');
Route::get('/admin/paper_req', 'AdminController@paper_request')->name('check_paper_req');
Route::get('/admin/edit_req', 'AdminController@edit_request')->name('check_edit_req');
Route::post('/er/app/{reviews}', 'AdminController@editreq_approve')->name('editreq.approve');
Route::post('/er/dec/{req}', 'AdminController@editreq_decline')->name('editreq.decline');
//message
 Route::get('/m/{other}', 'HomeController@msg_index')->name('message.person');
 Route::post('/m/{other}', 'HomeController@msg_update')->name('message.update');
 //follow
 Route::post('follow/{user}', 'ProfileController@follow_store');
 //discussion
 Route::get('/discussion', 'HomeController@dis_index')->name('discussion');
 Route::post('/dis/', 'HomeController@dis_update')->name('qus.update');
 Route::get('/dis/{id}', 'HomeController@dis_show')->name('dis.show');
 Route::post('/dis/comment/{id}', 'HomeController@dis_comment')->name('dis.comment');
//rating
 Route::get('rating/{type}/{id}', 'RatingController@get')->name('rating.get');
 Route::post('r/{type}/{id}', 'RatingController@update')->name('rating.update');

//peer
 Route::get('norev', 'HomeController@peer_activity')->name('noreviews');
