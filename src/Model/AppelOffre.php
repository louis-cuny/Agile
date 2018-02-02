<?php

namespace App\Model;

use Cartalyst\Sentinel\Users\EloquentUser;

class AppelOffre extends EloquentUser
{
    protected $table = 'appeloffre';

    protected $primaryKey = 'id';

    protected $fillable = [
        'intitule',
        'commanditaire',
        'adresse',
        'ville',
        'mail',
        'tel',
        'mission',
        'budget',
        'datelimitecandidature',
        'docreponse',
        'autre'
    ];
    public function user()
    {
        return $this->belongsTo('App/Model/User');
    }
}
