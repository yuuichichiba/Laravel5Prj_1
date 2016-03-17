<?php 

namespace App\Http\Controllers;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AdminAuthController extends Controller {
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $guard = 'webadmin';
    public function showLoginForm() {
        return view('admins.login');
    }
    public function __construct() {}
    /*
     * やって来た登録リクエストに対するバリデターを取得
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, ['name' => 'required|max:255', 'email' => 'required|email|max:255|unique:webadmin', 'password' => 'required|min:6|confirmed', ]);
    }

    /**
     * 登録内容を確認後、新しいユーザーインスタンスを生成
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return Admin::create(['name' => $data['name'], 'email' => $data['email'], 'password' => bcrypt($data['password']), ]);
    }
}