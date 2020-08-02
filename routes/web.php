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

// http:/cmslaravel/public/example
Route::get('/example', function () {;
    // return view('welcome');
    return 'Hello, Gleb';
});

// Страницы "О нас" и "Контакты"
Route::get('/about', function() {
   return 'Страница о нас и контакты';
});

Route::get('/contacts', function() {
   return 'Страница контакты!';
});

// Пост с id
Route::get('/post/{id}/{name}', function($id, $name) {
   return "This is post number " . $id . " " . $name;
});

// C указанием URL
Route::get('/admin/posts/example', array('as' => 'admin.home', function() {
    $url = route('admin.home'); // сохраняем url;
    return "This url is " . $url;
}));