<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codelive extends Model {
    public function parent() {
        return $this->belongsTo('app\Bunrui');
    }
}