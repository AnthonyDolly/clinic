<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->belognsToMany('App\Models\User')->withTimestamps();
    }

// ALMACENAMIENTO
    public function store($request)
    {
        $slug = Str::of($request->name)->slug('-');
        alert('Exito!','El rol ha sido guardado', 'success');
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
        alert('Exito!','El rol ha sido actualizado', 'success');
    }

// VALIDACION

// RECUPERACIÓN DE INFORMACIÓN

//OTRAS OPERACIONES

}
