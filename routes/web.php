<?php

use Illuminate\Http\Request;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use App\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function (){
    Route::resource('users', 'UserController');
});

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

Route::get('/checkPolicy',  function (Request $request) {

  $user = User::find(1);

  $response = Gate::inspect('create', $user);

  if ($response->allowed()) {
      return "you can create new user";

  } else {
      echo $response->message();
  }
});

Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('m.h.durjoi@gmail.com');
	});

});

Route::get('eventFire', function () {
    event(new App\Events\ProjectCreated('Shohan'));
    return "Event has been sent!";
});

Route::get('eventBroadcast', function () {
    return view('event');
});

Route::get('redisTest', function () {
  $redis = Redis::connection();
  $size = $redis->dbSize();
  echo "Redis has $size keys\n";
  $info = $redis->info();
  echo "<pre>";
  print_r($info);
  echo "</pre>";
});


Route::get('cacheTest', function () {
  $value = Cache::get('key');
  dd($value);
});
