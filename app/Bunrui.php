<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
|--------------------------------------------------------------------------
|           言語モデルクラス
|--------------------------------------------------------------------------
|       このクラスは親にLangクラスを持ち子にCodeliveクラスの
|       コレクションを持ちます
|
*/
class Bunrui extends Model {
    /*
    |----------------------------------------------------------------------
    | Bunruiクラスは、１対多の Codeliveクラスをコレクションする
    |----------------------------------------------------------------------
    |       そのためCodeliveクラスにアクセスするために
    |       hasmany('App\Codelive');
    |       と定義する 
    |----------------------------------------------------------------------
    */
    public function codelives() {
        return $this->hasmany('App\Codelive');
    }
    public function parent()
    {
       return $this->belongsTo('app\Langs');
    }
}