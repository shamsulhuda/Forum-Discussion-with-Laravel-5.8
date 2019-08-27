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

Auth::routes(['verify' => true]);

// Route::get('profile', function () {
//     return view('/profile');
// })->middleware('verified');

Route::get('/forum', [
    'uses' => 'ForumsController@index',
    'as' => 'forum'
])->name('forum');


Route::get('/', function () {
    return view('welcome');
});

// search
Route::get('/search', 'DiscussionsController@search');

Route::get('/discuss', function () {
    return view('discuss');
});

//discussion with slug
Route::get('discussion/{slug}', [
    'uses' => 'DiscussionsController@show',
    'as' => 'discussion'
]);

// Show discussion on particular under discussions
Route::get('channel/{slug}', [
    'uses' => 'ForumsController@channel',
    'as' => 'channel'
]);



// socialite
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

// Route group
Route::group(['middleware' => 'auth'], function(){

	Route::resource('channels', 'channelsController');

	// discussion page
	Route::get('discussion/create/new',[
		'uses' => 'DiscussionsController@create',
		'as' => 'discussions.create'
	])->middleware('verified');

	// discussion store
	Route::post('discussions/store',[
		'uses' => 'DiscussionsController@store',
		'as' => 'discussions.store'
    ]);
    
    // Comment section
    Route::post('/discussion/reply/{id}', [
        'uses' => 'DiscussionsController@reply',
        'as' => 'discussion.reply'
    ])->middleware('verified');

    // like a post
    Route::get('/reply/like/{id}', [
        'uses' => 'RepliesController@like',
        'as' => 'reply.like'
    ])->middleware('verified');
    
    // unlike post
    Route::get('/reply/unlike/{id}', [
        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'
    ]);

    //Follow or Unfollow discussion
    Route::get('/discussion/watch/{id}', [
        'uses' => 'WatchersController@watch',
        'as' => 'discussion.watch'
    ]);

    Route::get('/discussion/unwatch/{id}', [
        'uses' => 'WatchersController@unwatch',
        'as' => 'discussion.unwatch'
    ]);

    // mark the best answer
    Route::get('/discussion/best/reply/{id}', [

    	'uses' => 'RepliesController@best_answer',
    	'as' => 'discussion.best.answer'
    ]);

    // Edit and update discussion
    Route::get('/discussions/edit/{slug}', [
        'uses' => 'DiscussionsController@edit',
        'as' => 'discussion.edit'
    ]);

    Route::post('/discussions/update/{id}', [
        'uses' => 'DiscussionsController@update',
        'as' => 'discussions.update'
    ]);

    // edit and update reply
    Route::get('/reply/edit/{id}', [
        'uses' => 'RepliesController@edit',
        'as' => 'reply.edit'
    ]);

    Route::post('/reply/update/{id}', [
        'uses' => 'RepliesController@update',
        'as' => 'reply.update'
    ]);
});

