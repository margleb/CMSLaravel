<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Post;
use App\Country;
use App\Photo;
use App\Tag;

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

// Insert
Route::get('/userInsert', function() {
    DB::insert('insert into users(name,email,password) values(?,?,?)', ['Глеб', 'margleb@yandex.ru', '123456']);
});

Route::get('/postInsert', function() {
    DB::insert('insert into posts(title,content, user_id) values(?,?,?)', ['Заголовок 3', 'Контент заголовка 3', '1']);
});

Route::get('/roleInsert', function() {
    DB::insert('insert into roles(name) values(?)', ['Пользователь']);
});

Route::get('/roleUserInsert', function() {
    DB::insert('insert into role_user(user_id, role_id) values(?, ?)', ['1','2']);
});

Route::get('/countryInsert', function() {
    DB::insert('insert into countries(name) values(?)', ['Новозеландия']);
});

Route::get('/photoInsert', function() {
    DB::insert('insert into photos(path, imageable_id, imageable_type) values(?, ?, ?)', ['/images/image.jpg', '1', 'App\Photo']);
});

Route::get('/tagInsert', function() {
    DB::insert('insert into tags(name) values(?)', ['кулинария']);
});

Route::get('/taggableInsert', function() {
    DB::insert('insert into taggables(tag_id, taggable_id, taggable_type) values(?, ?, ?)', ['1', '3', 'App\Post']);
});
///////////////////////////////////////////

// Cвязь один к одному
Route::get('/user/{id}/post', function($id) {
   $user = User::find($id);
   return $user->post->title;
});

// Обратная связь один к одному
Route::get('/post/{id}/user', function($id) {
   $post = Post::find($id);
   return $post->user->name;
});

// Cвязь один к многим
Route::get('/user/{id}/posts', function($id) {
    $user = User::find($id);
    foreach($user->posts as $post) {
        echo $post->title . '<br>';
    }
});

// Cвязь многие к многим
Route::get('/user/{id}/roles', function($id) {
    $user = User::find($id);
    foreach($user->roles as $role) {
        return $role->name;
    }
});

Route::get('/user/{id}/rolesObj', function($id) {
   $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
   return $user;
});

// Запрос данных из промежуточной таблицы
Route::get('/user/pivot', function() {
   $user = User::find(1);
   foreach($user->roles as $role) {
       echo $role->pivot->created_at;
   }
});

// Связь многие через
Route::get('/country/{id}/user/posts', function($id) {
   $country = Country::find($id);
   foreach($country->posts as $post) {
       echo $post->title . '<br>';
   }
});

// Полиморфная связь
/*
 * Использовать полиморфные связи стоит тогда, когда у нас появляется две и более таблицы,
 * у которых будет связь один-ко-многим с какой-то другой одной и той же таблицей
 * (articles-comments, news-comments, posts-comments и т.д.).
 * В базе данных указывается 2 параметра: 1 - тип сущности (например, App\Post), id сущности - например 1
 */
Route::get('/user/{id}/photos', function($id) {
   $user = User::find($id);
   foreach($user->photos as $photo) {
       echo $photo->path . '<br>'; // путь до фотографии пользователя
   }
});

Route::get('/post/{id}/photos', function($id) {
    $post = Post::find($id);
    foreach($post->photos as $photo) {
        echo $photo->path . '<br>';
    }
});

// Реверсивная полиморфная связь
Route::get('photo/{id}/post', function($id) {
  $photo = Photo::findOrFail($id);
  return $photo->imageable;
});

// Полиморфная связь многие к многим
/*
 * Связывается посредством промежуточной таблицы taggables, где
 * tag_id - id тега / taggable_id - id связываемой сущности / taggable_type - тип сущности
*/
Route::get('/tag/{id}/posts', function($id) {
   $tag = Tag::find($id);
   foreach($tag->posts as $post) {
       echo $post->title;
   }
});