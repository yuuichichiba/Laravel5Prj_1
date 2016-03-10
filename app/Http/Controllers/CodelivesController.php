<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Lang;
use App\Bunrui;
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
    |----------------------------------------------------------------------
    |   一覧表示するデータは
    |       Langクラス
    |        ┗ Bunnruiクラス
    |               ┗ Codeliveクラス
    |   という構造のため、言語 ➡ 分類を確定する必要がある
    |----------------------------------------------------------------------
    */
    public function index() {
        $langID = session('lang_id');

        //                                              言語を確定する
        if (($langID == null) or(Lang::find($langID) == null)) {
            $lang = Lang::first();
            //                                          最初のデータ
            session(['lang_id' => $lang['id']]);
        } else {
            //                                          前回使用した言語
            $lang = Lang::find($langID);
        }
        //                                              言語が確定したので
        //                                              ここからは分類の確定
        $bunruiid = session('bunrui_id');        
        if (($bunruiid == nul) or ($lang->bunruis()->find($bunruiid) == null) ){
            $bunrui = $lang->bunruis()->first();
            session(['lang_id' => $bunrui['id']]);
        } else {
            $bunrui = $lang->bunruis()->find($bunruiid);
        }
        
        $codelives = $bunrui->codelives()->orderBy('id', 'desc')->paginate(7);
        $viewinfo = $lang->makeDispinfo('0', $bunrui['id']);
        return view('codelives.index', ['codelives' => codelives, 'dispinfo' => $viewinfo]);
    }
}