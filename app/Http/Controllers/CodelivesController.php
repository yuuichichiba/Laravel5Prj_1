<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Lang;
use App\Bunrui;
use App\Codelive;
use App\Http\Requests\CodeliveRequest;
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
    |       Route::get('/codelive', 'CodelivesController@index'); // 一覧 
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
        if (($bunruiid == null) or($lang->bunruis()->find($bunruiid) == null)) {
            //                                          最初のデータ            
            $bunrui = $lang->bunruis()->first();
            session(['bunrui_id' => $bunrui['id']]);
        } else {
            $bunrui = $lang->bunruis()->find($bunruiid);
        }
        //                                              表示用のデータを用意
        $codelives = $bunrui->codelives()->orderBy('id', 'desc')->paginate(7);
        //                                              画面制御用データ用意
        $viewinfo = $lang->makeDispinfo('0', $bunrui['id']);
        return view('codelives.index', ['codelives' => $codelives, 'viewinfo' => $viewinfo]);
    }
    /*---------------------------------------------------------------------------
     *           一覧で表示された中からデータを特定して詳細表示する
     *----------------------------------------------------------------------------
     *      Route::get('/codelive/{id}', 'CodelivesController@detail'); // 一件表示 
     *----------------------------------------------------------------------------
     *     
     */
    public function detail($id) {
        //                                              パラメータのIDを元にデータを選択
        //                                              ここではデータの表示のみなので
        //                                              直接Codeliveモデルからデータを探す
        $codelive = Codelive::findOrFail($id);
        $lang = Lang::find(session('lang_id'));
        // 　                                            ソースをエンティティ化する
        $codelive['src'] = $lang->makeformatsrc($codelive['src']);
        // 　                                            ビューの制御情報を作成する
        $viewinfo = $lang->makeDispinfo('1', session('bunrui_id'));
        return view('codelives.detail', ['codelive' => $codelive, 'viewinfo' => $viewinfo]);
    }
    /*---------------------------------------------------------------------------
    *           １件表示から削除される
    *----------------------------------------------------------------------------
    *    Route::post('/codelive/delete/{id}', 'CodelivesController@delete'); // 削除   
    *----------------------------------------------------------------------------
    *       データを特定し、delete()メソッドを実行する
    ---------------------------------------------------------------------------
    */
    public function delete($id) {
        $data = Codelive::findOrFail($id);
        $data->delete();\Session::flash('flash_message', '1件のサンプルが削除されました');
        return redirect('/codelive');
    }
    /*---------------------------------------------------------------------------
    *           新規作成
    *----------------------------------------------------------------------------
    *    Route::get('/codelive/create', 'CodelivesController@create'); // 新規  
    *----------------------------------------------------------------------------
    *       作成されたデータは storeでPOSTされる
    ---------------------------------------------------------------------------
    */
    public function create() {
        $lang = Lang::findOrFail(session('lang_id'));
        $viewinfo = $lang->makeDispinfo('2', session('bunrui_id'));
        return view('codelives.create', ['viewinfo' => $viewinfo]);
    }
    /*---------------------------------------------------------------------------
    *           新規データの保存作成
    *----------------------------------------------------------------------------
    *        Route::post('/codelive/store', 'CodelivesController@store');  // 新規保存  
    *----------------------------------------------------------------------------
    *       <分類インスタンス>->codelives()->save(<新規データ>);
    *       を実行することで[b_id]が付加されて保存される
    ---------------------------------------------------------------------------
    */
    public function store(CodeliveRequest $request) {
        $codelive = new Codelive();
        $codelive['title'] = $request['title'];
        $codelive['body'] = $request['body'];
        $codelive['src'] = $request['src'];

        $bunrui = Bunrui::find(session('bunrui_id'));
        $bunrui->codelives()->save($codelive);

        \Session::flash('flash_message', '新規コードが投稿されました');
        return redirect('/codelive');
    }
    /*---------------------------------------------------------------------------
    *           既存データの編集
    *----------------------------------------------------------------------------
    *        Route::get('/codelive/edit/{id}', 'CodelivesController@edit'); // 修正  
    *----------------------------------------------------------------------------
    *
    *
    ---------------------------------------------------------------------------
    */
    public function edit($id) {
        $codelive = Codelive::findOrFail($id);
        $lang = Lang::find(session('lang_id'));
        $viewinfo = $lang->makeDispinfo('3', session('bunrui_id'));
        return view('codelives.edit', ['codelive' => $codelive, 'viewinfo' => $viewinfo]);
    }
    /*---------------------------------------------------------------------------
    *           修正データの保存
    *----------------------------------------------------------------------------
    *        Route::post('/codelive/update/{id}', 'CodelivesController@update'); // 修正保存  
    *----------------------------------------------------------------------------
    *       [b_id]は変更されないのでデータ単体でsave()メソッドを実行する
    *
    ---------------------------------------------------------------------------
    */
    public function update(CodeliveRequest $pr, $id) {
        $codelive = Codelive::findOrFail($id);
        $codelive['title'] = $pr['title'];
        $codelive['body'] = $pr['body'];
        $codelive['src'] = $pr['src'];
        $codelive->save();\Session::flash('flash_message', '１件のサンプルが更新されました');
        return redirect('/codelive');
    }
    public function changbid(Request $pr, $id) {
        $codelive = Codelive::findOrFail($id);
        return redirect('/codelive');
    }
    /*---------------------------------------------------------------------------
    *           分類変更
    *----------------------------------------------------------------------------
    *        Route::get('/codelive/chengbunrui/{id}', 'CodelivesController@chengbunrui'); 
    *----------------------------------------------------------------------------
    *       一覧でで分類の変更を行った
    *       session('bunrui_id')を変える
    ---------------------------------------------------------------------------
    */    
    public function chengbunrui($id) {
        $lang = Lang::find(session('lang_id'));
        if ($id != session('bunrui_id')) {
            $bunrui = $lang->bunruis()->find($id);
            if (!is_null($bunrui)) {
                session(['bunrui_id' => $bunrui['id']]);
                return redirect('/codelive');
            }
        }
    }
    /*---------------------------------------------------------------------------
    *           言語変更
    *----------------------------------------------------------------------------
    *        Route::get('/codelive/chenglang/{id}', 'CodelivesController@chenglang');
    *----------------------------------------------------------------------------
    *       メインMavで言語の変更を行った
    *       session('bunrui_id')を変える
    ---------------------------------------------------------------------------
    */        
    public function chenglang(int $id){
        session(['lang_id' => $id]);
        return redirect('/codelive');
    }
}