<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Pageinfo;
use App\Bunrui;
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
*           Lang インスタンスから分類データを取得するには
*           <instance>->bunruis()->get()
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
    public function makeDispinfo($workid, $bid, $kw = null) {
        $retval = new Pageinfo();
        $retval->workID = $workid;
        $retval->currLang = $this['language'];
        $retval->currMark = $this['langmark'];
        $retval->keyword = $kw;
        if ($workid == '0') {
            $retval->lang_table = $this->getlangslist();
        }
        //                                                  現在の分類名を取得
        $bun = Bunrui::findOrFail($bid);
        $retval->currBunrui = $bun['b_name'];
        //      必要なのは一覧表示と修正
        if (($workid == '0') or($workid == '1')) {
            if (is_null($bun)) {
                $retval->bunrui_table = null;
            } else {
                $retval->bunrui_table = $this->getbunruilist($bid);
            }
        }
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
        $ball = $this->bunruis()->get();
        // $all = Bunrui::where('lang_id', $this['id']);
        $retval = null;
        foreach($ball as $itm) {
            if ($bid != $itm['id']) {
                $tmp = new class {
                    public $bname;
                    public $bid;
                };
                $tmp->bid = $itm['id'];
                //                              $tmp['lid']は使えないようです
                $tmp->bname = $itm['b_name'];
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