<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Pageinfo;
/* ----------------------------------------------------------------------------
*               言語を扱うモデルクラス
* -----------------------------------------------------------------------------
*           データベース項目
*               1: [id]         --- auto ----
*               2: [language]   --- 言語名称
*               3: [langmark]   --- prism用言語タグ
*               4: [prefix]     --- 
*               5: [note]
*               6: [create_at]  --- auto ----
*               7: [update_at]  --- auto ----
* -----------------------------------------------------------------------------
*           このモデルクラスが最上位
*               < 言語 >
*                   ┗< 分類 >
*                       ┗< サンプルコード >
*           
*           
---------------------------------------------------------------------------- */
class Lang extends Model {
    public function bunruis() {
        return $this->hasmany('App\Bunrui');
    }
    /*---------------------------------------------------------------------------
    *           表示するページの制御の情報を作成してビューに渡す
    *----------------------------------------------------------------------------
    *       ここで作成する情報
    *           1： 現在表示している言語名
    *           2:  呼び出すコントローラメソッド
    *           3:  prims.js 用
    *           4:  他の言語リスト(navのドロップダウンに格納される)
    ---------------------------------------------------------------------------*/
    public function makeDispinfo($workid, $bid) {
        $retval = new DispInfo();
        $retval->workID = $workid;
        $retval->currLang = $this['language'];
        $retval->currMark = $this['note'];
        $retval->lang_table = $this->getlangslist();
        $retval->bunrui_table = $this->getbunruilist($bid);
        return $retval;
    }
    /*---------------------------------------------------------------------------
    *           言語リストの収集
    *----------------------------------------------------------------------------
    *       PHP7から使える無名クラスを使用
    *       id と language をセットにしている
    ---------------------------------------------------------------------------*/
    private function getlangslist() {
        $all = parent::all();
        foreach($all as $itm) {
            if ($this['id'] != $itm['id']) {
                $tmp = new class {
                    public $lname;
                    public $lid;
                };
                $tmp->lid = $itm['id'];
                //                              $tmp['lid']は使えないようです
                $tmp->lname = $itm['language'];
                $retval[] = $tmp;
                //                              配列に入れる
            }
        }
        return $retval;
    }
    /*---------------------------------------------------------------------------
    *           分類リストの収集
    *----------------------------------------------------------------------------
    *       PHP7から使える無名クラスを使用
    *       id と language をセットにしている
    ---------------------------------------------------------------------------*/
    private function getbunruilist($bid) {
        $all = $this.bunruis()->all();
        foreach($all as $itm) {
            if ($bid != $itm['id']) {
                $tmp = new class {
                    public $lname;
                    public $lid;
                };
                $tmp->lid = $itm['id'];
                //                              $tmp['lid']は使えないようです
                $tmp->lname = $itm['language'];
                $retval[] = $tmp;
                //                              配列に入れる
            }
        }
        return $retval;
    }
    /*---------------------------------------------------------------------------
    *           HTML用にエンコードして戻す
    *----------------------------------------------------------------------------
    *       ソースコードなので間違いないようにする
    ---------------------------------------------------------------------------*/
    public function makeformatsrc($src) {
        return htmlentities($src);
    }
}