<?php

namespace App;
use App\Assurance;
use Illuminate\Database\Eloquent\Model;

class Remboursement extends Model
{
   function assurance(){
    return $this->belongsTo(Assurance::class, 'id_assurance');
}
}