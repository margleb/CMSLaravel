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

Route::get('/', function () {
    return view('welcome');
});

// Добавление записи в БД
Route::get('/insert', function() {
    DB::insert('insert into posts(title, content) values (?, ?)', ['PHP c Laravel', 'Laravel это лучшее, что произошло с PHP']);
});

// Прочитывание записи из БД
Route::get('/read', function() {
   $results = DB::select('select * from posts where id = ?', [1]);
   foreach($results as $result) {
       return $result->title;
   }
});

// Обновление данных
Route::get('/update', function() {
   $updated = DB::update('update posts set title = "Обновленный тайтл" where id = ?', [1]);
   return $updated; // возращает id обновленной записи
});

// Удаление данных
Route::get('/delete', function() {
   $deleted = DB::select('delete from posts where id = ?', [1]);
   return $deleted;
});