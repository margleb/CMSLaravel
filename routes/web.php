<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Address;
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

// Добавление данных ( связь, один к одному )
Route::get('/insert', function() {
    $user = User::find(3);
    $address = new Address(['name' => 'Санкт-Петерубрг, ул. Шелгунова, д. 12 кв.64']);
    $user->address()->save($address);
});

// Обновление данных ( связь, один к одному )
Route::get('/update', function() {
    // $address = Address::where('user_id', 1)->first(); // 1ый вариант
    // $address = Address::where('user_id', '=', 1)->first(); // 2ой вариант
    $address = Address::whereUserId(3)->first(); // 3ий вариант
    $address->name = 'Москва, ул. Арбат д. 12, кв. 13';
    $address->save();
});

// Прочтение данных ( связь, один к одному )
Route::get('/read', function() {
   $user = User::find(3);
   return $user->address->name;
});

// Удаление данных ( связь, один к одному )
Route::get('/delete', function() {
   $user = User::findOrFail(3);
   $user->address()->delete();
   return 'Запись успешно удалена';
});