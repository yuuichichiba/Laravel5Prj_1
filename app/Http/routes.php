<?php 

/*
|--------------------------------------------------------------------------
| ルートファイル
|--------------------------------------------------------------------------
|
| ここでアプリケーションのルートを全て登録してください。
| 簡単です。ただ、Laravelへ対応するURIと、そのURIがリクエスト
| されたときに呼び出されるコントローラーを指定してください。
|
*/
/*
Route::get('/', function() {
    return view('welcome');
});
*/
/*
|--------------------------------------------------------------------------
| アプリケーションのルート
|--------------------------------------------------------------------------
|
| このルートグループは、"web"ミドルウェアグループが指定された
| 全ルートに対し適用されます。"web"ミドルウェアグループは
| HTTPカーネルで定義されており、セッションの開始やCSRF保護などを含んでいます。
|
*/

Route::group(['middleware' => ['web']], function() {
    // Route::resource('codelive', 'CodelivesController');
    // Route::resource('codelive/admin', 'AdminController');
    Route::get('/codelive/admin/login', 'AdminAuthController@showLoginForm');
    Route::post('/codelive/admin/login', 'AdminAuthController@login');
    // Route::get('/admin/index', 'AdminController@index');
    Route::get('/admin/logout', 'AdminAuthController@logout');

    Route::post('/codelive/admin/langupdate', 'AdminController@langupdate');
    Route::post('/codelive/admin/bunruirename/{id}', 'AdminController@bunruirename');
    Route::get('/codelive/admin/editbunrui/{id}', 'AdminController@editbunrui');
    Route::post('/codelive/admin/dellang', 'AdminController@dellang');
    Route::post('/codelive/admin/bunruiappend/{id}', 'AdminController@appendbunrui');
    Route::post('/codelive/admin/bumruidel/{id}', 'AdminController@delbunrui');
    Route::post('/codelive/admin/apendlang', 'AdminController@apendlang');
    Route::get('/codelive/admin', 'AdminController@index');
});


Route::group(['middleware' => ['web']], function() {
    Route::get('/codelive/chenglang/{id}', 'CodelivesController@chenglang'); // 言語変更
    Route::get('/codelive/chengbunrui/{id}', 'CodelivesController@chengbunrui'); // 分類変更    
    Route::post('/codelive/changbid/{id}', 'CodelivesController@changbid'); // b_id変更
    Route::post('/codelive/update/{id}', 'CodelivesController@update'); // 修正保存
    Route::get('/codelive/edit/{id}', 'CodelivesController@edit'); // 修正
    Route::post('/codelive/store', 'CodelivesController@store'); // 新規保存
    Route::get('/codelive/create', 'CodelivesController@create'); // 新規
    Route::post('/codelive/delete/{id}', 'CodelivesController@delete'); // 削除
    Route::get('/codelive/{id}', 'CodelivesController@detail'); // 一件表示
    Route::get('/codelive', 'CodelivesController@index'); // 一覧
});

Route::group(['middleware' => 'web'], function() {
    Route::auth();          //  認証に必要なLogin/Registerなどのルートが定義される
                            //  ミドルウエアとしてwebを指定しているのでログイン前は
                            //  web,guestとして認証外で実行される
    // Route::get('/', 'HomeController@index');
});