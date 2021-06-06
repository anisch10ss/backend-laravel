<?php

namespace App;
use App\Objet;
use App\Remboursement;
use Illuminate\Database\Eloquent\Model;


class Assurance extends Model
{
    function objets(){
        return $this->belongsTo(Objet::class, 'id_objet');

    }
    function remboursement(){

        return $this->hasMany(Remboursement::class);

    }
}
