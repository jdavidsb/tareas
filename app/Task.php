<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
      'texto',
    ];

    public function user(){
      ### LE INDICAMOS QUE UN Task PERTENECE A UN USUARIO
      return $this->belongsTo('App\User');
    }
}
