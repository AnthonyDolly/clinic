<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];

// RELACIONES
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

// ALMACENAMIENTO
    public function store($request)
    {
        return self::create($request->all());
    }    

    public function my_update($request)
    {
        return self::update($request->all());
    }

// VALIDACION

// RECUPERACIÓN DE INFORMACIÓN

//OTRAS OPERACIONES
}
