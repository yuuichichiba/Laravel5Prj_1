<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * モデルのJSON形式に含めない属性
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
