<?php

use Illuminate\Support\Facades\Route;
use App\Post;

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

Route::get('/', function () {
    return view('welcome');
});

// Прочитываем все данные
Route::get('/read', function() {
    $posts = Post::all();
    foreach($posts as $post) {
        return $post->title;
    }
});

// Находим данные по id
Route::get('/find', function() {
   $post = Post::find(1);
   return $post->title;
});

// Находим с ограничениями
Route::get('/findwhere', function() {
   $post = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
   return $post;
});

// Поиск данных либо 'Бросание исключения'
Route::get('/findOrFail', function() {
   $post = Post::findOrFail(2);
   return $post;
});

Route::get('/firstOrFail', function() {
   $post = Post::where('id','<', '4')->firstOrFail();
   return $post;
});

// Cоздание/Сохранение данных
Route::get('/basicInsert', function() {
   $post = new Post();
   $post->title = 'Новый Eloquent заголовок';
   $post->content = 'Eloquent действительно эффективный способ';
   $post->save();
});

Route::get('/basicUpdate', function() {
    $post = Post::find(3);
    $post->title = 'Новый Eloquent заголовок';
    $post->content = 'Eloquent действительно эффективный способ';
    $post->save();
});

// Cоздание данных
Route::get('/create', function() {
   Post::create(['title' => 'Mетод create', 'content' => 'Ура! Я освоил метод сreate']);
});

// Обновление данных
Route::get('/update', function() {
   Post::where('id', 2)->where('is_admin', 0)->update(['title' => 'Новый PHP заголовок', 'content' => 'Это новый PHP заголовок, данные обновлены']);
});

// Удаление данных "мягкое"
Route::get('/delete', function() {
   $post = Post::find(5);
   $post->delete();
});

Route::get('/deleteMany', function() {
    Post::destroy([3, 4]); // Удаление сразу нескольких строк
});

// "Мягкое удаление" (помещение в карзину)
Route::get('/softDelete', function() {
   Post::find(5)->delete();
});

// Получение "мягко" удаленных записей
Route::get('/readSoftDelete', function() {
   // $post = Post::withTrashed()->where('id', 9)->get();
   $post = Post::onlyTrashed()->where('is_admin', 0)->get();
   return $post;
});

// Восстановление "мягко" удаленных записей
Route::get('/restoreSoftDelete', function() {
   Post::withTrashed()->where('is_admin', 0)->restore();
});

// Удаление "мягких" записей навсегда
Route::get('/deleteSoftDelete', function() {
   Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});