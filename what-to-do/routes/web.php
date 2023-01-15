<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuth;
use App\Http\Controllers\Tasks;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/task',[Tasks::class, 'add'])->name('tasks.add');
    Route::post('/task',[Tasks::class, 'create'])->name('tasks.create');

    Route::get('/task/{task}', [Tasks::class, 'edit'])->name('tasks.edit');
    Route::post('/task/{task}', [Tasks::class, 'update'])->name('tasks.update');
    Route::get('/task/generatePDF', [Task::class, 'generatePDF'])->name('tasks.generatePDF');

});
Route::get('/', function () { return view('landing'); })->name('landing');
Route::get('auth/{provider}', [SocialAuth::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialAuth::class, 'ProviderCallback']);
