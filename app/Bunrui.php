<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bunrui extends Model {
    public function codelives() {
        return $this->hasmany('App\Codelive');
    }
}