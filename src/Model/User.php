<?php

namespace App\Model;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'password',
        'siret',
        'siege_social',
        'chiffre_affaire',
        'last_name',
        'first_name',
        'permissions'
    ];

    protected $loginNames = ['email'];


    public function appeloffres()
    {
        return $this->hasMany('App/Model/AppelOffre');
    }
}
