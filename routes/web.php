<?php

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
use Illuminate\Http\Request;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile', function (Request $request) {
    // Only authenticated users may enter...
    return $request->user();
})->middleware('auth.basic');



Route::get('/passGate',  function (Request $request) {
  if (Gate::allows('view-profile')) {
    return "you can pass the gate";
    // or let him view some data
  }
  else {

  }
});
