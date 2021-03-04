<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return 'Hello';
// });

Route::get('/', function () {
    $res = 2 + 3;
    $name = 'John';
    //return view('home',['var'=> $res, 'name' => $name]);
    return view('home', compact('res', 'name'));
})->name('home') ;

Route::get('/about', function () {
    return '<h1>about</h1>';
});

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::post('/send-email', function () {
//     if(!empty($_POST)){
//         dump($_POST);
//     }
//     return 'Send email';
// });

// Route::match(['post','get'], '/contact', function () {
//     if(!empty($_POST)){
//                 dump($_POST);
//             }
//     return view('contact');
// });

Route::match(['post', 'get', 'put'], '/contact', function () {
    if (!empty($_POST)) {
        dump($_POST);
    }
    return view('contact');
})->name('contact');

Route::view('/test', 'test', ['test' => 'Test Data']);

Route::redirect('/about', '/contact', 301);
Route::permanentRedirect('about', 'contact');

// Route::get('post/{id}/{slug}', function($id,$slug){
//     return "Post $id | $slug";
// })->where(['id' => '[0-9]+', 'slug' => '[A-Za-z0-9-]+']);

// Route::get('post/{id}/{slug}', function($id,$slug){
//     return "Post $id | $slug";
// });


Route::get('post/{id}/{slug?}', function($id,$slug = null){
    return "Post $id | $slug";
})->name('post');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', function () {
        return 'Posts List';
    });

    Route::get('/post/create', function () {
        return 'Post Create';
    });

    Route::get('/post/{id}/edit', function ($id) {
        return "Edit Post $id";
    })->name('post');
});

Route::fallback(function(){
    //return redirect()->route('home');
    abort(404, 'Oopssd! Not found');
});