<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description'
    ];

// RELACIONES
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }

    public function users()
    {
        return $this->belognsToMany('App\Models\User');
    }

// ALMACENAMIENTO

// VALIDACION

// RECUPERACIÓN DE INFORMACIÓN

//OTRAS OPERACIONES

}
