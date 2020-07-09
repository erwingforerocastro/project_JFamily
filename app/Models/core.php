<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class core extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level', 'description', 'vertex_1','vertex_2',
    ];

    #level /nivel de consanguinidad
    #description /nombre cualitativo del pariente
    #vertex_1 /nodo del familiar principal
    #vertex_2 /nodo del familiar secundario

}
