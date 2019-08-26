<?php

    /*
    redis key & value //string
        \Redis::set('sd','sf');
         dd(Redis::get('sd'));

   redis key & value //list
         \Redis::lpush('names',['ali','reza']);
         dd(\Redis::lrange('names',0,-1));

    redis key & value :set
    set is a unique and could not add to an set(store the ip address in the set)
         Redis::sadd('credit_id' ,['1','2']);
         dd(Redis::smembers('credit_id'));
*/
// Route::get('/',function(){

// })
Auth::routes();
 Route::get('/', 'FrontendController@welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile');
Route::get('/series/{series}', 'FrontendController@series')->name('series');
Route::get('/logout', function() { auth()->logout(); return redirect('/'); });
Route::get('/series', 'FrontendController@showAllseries')->name('all-series');
Route::get('register/confirm', 'ConfirmEmailController@index')->name('confirm-email');


Route::middleware('auth')->group(function() {
    Route::post('/card/update', 'ProfilesController@updateCard');
    Route::post('/subscribe', 'SubscriptionsController@subscribe');    
    Route::post('/subscription/change', 'SubscriptionsController@change')->name('subscriptions.change');        
    Route::get('/subscribe', 'SubscriptionsController@showSubscriptionForm');
    Route::post('/series/complete-lesson/{lesson}', 'WatchSeriesController@completeLesson');
    Route::get('/watch-series/{series}', 'WatchSeriesController@index')->name('series.learning');
    Route::get('/series/{series}/lesson/{lesson}', 'WatchSeriesController@showLesson')->name('series.watch');
});
