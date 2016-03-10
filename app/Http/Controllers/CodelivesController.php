<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
/*
|--------------------------------------------------------------------------
| アプリケーションのコントローラ
|--------------------------------------------------------------------------
|       現在の言語はセッションキーを使う（同じマシンなら次回も有効）
|       ビューを呼び出すときは必ず制御用データを渡す
|
|
|
|
|
|
*/
class CodelivesController extends Controller {
    public function __construct() {

    }
    /*
    |----------------------------------------------------------------------
    | index()       一覧表示メソッド
    |----------------------------------------------------------------------
    |   ->      Route::get('/codelive', 'CodelivesController@index');
    |   <-      view('codelives.index')
    |----------------------------------------------------------------------
    |   1:  セッションクッキーからlang_idを読み込む
    |       なければ最初の言語を取得してidをセッションクッキーに格納する
    |       lang_idを元に使用する言語を確定する
    |   2:  言語の持つデータを
    |   3:  言語のインスタンスにViewの制御用データを作ってもらい
    |   4:  指定したビューでページを作成してもらったものを戻す
    |
    |
    */
    public function index() {
        $langID = session('lang_id');
        $bunruiid = session('bunrui_id');
        //                 保存はsession(['key' => 'value']);
        if (($langID == null) or(Lang::find($langID) == null)) {
            $lang = Lang::first();
            session(['lang_id' => $lang['id']]);
        } else {
            $lang = Lang::find($langID);
        }
        if (($bunruiid == nul) or ($lang->bunruis()->find()) )
        codelives = $lang->srcarcs()->orderBy('id', 'desc')->paginate(7);
        $viewinfo = $lang->makeDispinfo('0');
        return view('codelives.index', ['codelives' => codelives, 'dispinfo' => $viewinfo]);
    }
}