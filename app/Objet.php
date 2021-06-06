<?php

namespace App;
use App\Assurance;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{ 
    function assurance(){
    return $this->hasMany(Assurance::class);

}
}
