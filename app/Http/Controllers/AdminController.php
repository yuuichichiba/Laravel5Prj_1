<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Lang;
use App\Bunrui;
// use App\Codelive;
class AdminController extends Controller {
    public function __construct() {
        $this->middleware('auth:webadmin');
    }    
    
    public function index() {
        $langs = Lang::all();
        return view('admins.index', ['langs' => $langs]);
    }

    public function editbunrui(int $id) {
        $lang = Lang::findOrFail($id);
        $bunruis = $lang->bunruis()->get();
        return view('admins.bunruiedit', ['lang' => $lang], ['bunruis' => $bunruis]);
    }
    public function dellang(int $id) {
        $lang = Lang::findOrFail($id);
        $lang->delete();
        return redirect('/codelive/admin');
    }
    public function apendlang(Request $req) {
        $newLang = new Lang();
        $bun = new Bunrui();
        $bun['b_name'] = '一般';
        $newLang['language'] = $req['language'];
        $newLang['langmark'] = $req['langmark'];
        $newLang['prefix'] = $req['prefix'];
        $newLang['note'] = $req['note'];
        $newLang->save();
        $newLang->bunruis()->save($bun);
        return redirect('/codelive/admin');
    }
    public function appendbunrui(Request $req, int $id) {
        $lang = Lang::findOrFail($id);
        $bunrui = new Bunrui();
        $bunrui['b_name'] = $req['b_name'];
        $lang->bunruis()->save($bunrui);
        return redirect('/codelive/admin/editbunrui/'.$id);
    }
    public function delbunrui(Request $req, int $id) {
        $bunrui = Bunrui::findOrFail($id);
        $bunrui->delete();
        return redirect('/codelive/admin/editbunrui/'.$req['langid']);
    }
    public function bunruirename(Request $req, $bid) {
        $bunid = $req['bid'];
        $bun = Bunrui::findOrFail($bunid);
        $bun['b_name'] = $req['newname'];
        $bun->save();
        return redirect('/codelive/admin/editbunrui/'.$bid);
    }
    function langupdate(Request $req) {
        $lang = Lang::findOrFail($req['lid']);
        $lang['language'] = $req['language'];
        $lang['langmark'] = $req['langmark'];
        $lang['prefix'] = $req['prefix'];
        $lang['note'] = $req['note'];
        $lang->update();
        return redirect('/codelive/admin/');
    }
}