<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codelive extends Model {
    public function parent() {
        return $this->belongsTo('app\Bunrui');
    }
    
    public function getBodyentities(int $len)
    {
        $retval = $this->body;
        if (mb_strlen($retval) > $len){
            $retval =  mb_substr($retval, 0, 120).'...';
        }
            
       return htmlentities($retval);
    }
        
}