<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'role_id'
    ];

// RELACIONES
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

// ALMACENAMIENTO
    public function store($request)
    {
        $slug = Str::of($request->name)->slug('-');
        alert('Exito','El permiso se ha creado', 'success');
        return self::create($request->all() + [
            'slug' => $slug
        ]);
    }

    public function my_update($request)
    {
        $slug = Str::of($request->name)->slug('-');
        self::update($request->all() + [
            'slug' => $slug
        ]);
        alert('Exito','El permiso se ha actualizado', 'success');
    }

// VALIDACION

// RECUPERACIÓN DE INFORMACIÓN

//OTRAS OPERACIONES
}
