<?php 
namespace App\Classes;

/*-------------------------------------------------------------------------------
*           表示するページの制御のためのクラス
-------------------------------------------------------------------------------*/
class Pageinfo {
    //                                              作業ID(0-一覧   1：１件など)
    private $workID;
    //                                              現在の言語名
    private $currLang;
    //                                              prims.js用言語マーク
    private $currMark;
    //                                              ドロップダウンに格納する他言語
    private $lang_table;
    //                                              PHP7ではゲッター/セッターが
    //                                              マジックメソッドで実装できる
    public function __get($key) {
        return $this->$key;
    }
    public function __set($key, $value) {
        $this->$key = $value;
    }
}