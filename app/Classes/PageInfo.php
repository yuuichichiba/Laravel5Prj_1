<?php 
namespace App\Classes;
/*
|--------------------------------------------------------------------------
|           画面表示に必要な情報を保持するクラス
|--------------------------------------------------------------------------
|       このクラスは親にLangクラスを持ち子にCodeliveクラスの
|       コレクションを持ちます
|
*/
/*-------------------------------------------------------------------------------
*           表示するページの制御のためのクラス
-------------------------------------------------------------------------------*/
class Pageinfo {
    //                                              作業ID(0-一覧   1：１件など)
    private $workID;
    //                                              現在の言語名
    private $currLang;
    //                                              現在の分類名    
    private $currBunrui;
    //                                              prims.js用言語マーク
    private $currMark;
    //                                              キーワード
    private $keyword;
    //                                              ドロップダウンに格納する他言語
    private $lang_table;
    //                                              ドロップダウンに格納する他分類
    private $bunrui_table;
    //                                              PHP7ではゲッター/セッターが
    //                                              マジックメソッドで実装できる
    public function __get($key) {
        return $this->$key;
    }
    public function __set($key, $value) {
        $this->$key = $value;
    }
}