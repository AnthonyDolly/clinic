<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'dob',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['dob'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

// RELACIONES
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

// ALMACENAMIENTO
    public function store($request)
    {
        $user = self::create($request->all());
        $user->update(['password' => Hash::make($request->password)]);
        $roles = [$request->role];
        $user->role_assignment(null, $roles);
        alert('Exito', 'Usuario creado con exito', 'success');
        return $user;
    }

    public function my_update($request)
    {
        self::update($request->all());
        alert('Exito', 'Usuario actualizado', 'success');
    }

    public function role_assignment($request, array $roles = null)
    {
        $roles = (is_null($roles)) ? $request->roles : $roles;
        $this->permission_mass_assignment($roles);
        $this->roles()->sync($roles);
        $this->verify_permission_integrity($roles);
        alert('Exito', 'Roles asignados', 'success');
    }

// VALIDACIÓN
    public function is_admin()
    {
        $admin = config('app.admin_role');
        if ($this->has_role($admin)) {
            return true;
        } else {
            return false;
        }
    }

    public function has_role($id)
    {
        foreach ($this->roles as $role) {
            if ($role->id == $id || $role->slug == $id) {
                return true;
            }
        }
        return false;
    }

    public function has_any_role($roles)
    {
        foreach ($roles as $role) {
            if ($this->has_role($role)) return true;
        }
        return false;
    }

    public function has_permission($id)
    {
        foreach ($this->permissions as $permission) {
            if ($permission->id == $id || $permission->slug == $id) return true;
        }
        return false;
    }

// RECUPERACIÓN DE INFORMACIÓN
    public function age()
    {
        if (!is_null($this->dob)) {
            $age = $this->dob->age;
            $years = ($age == 1) ? 'año' : 'años' ;
            $msj = $age . ' ' . $years;
        } else {
            $msj = 'indefinido';
        }
        return $msj;
    }

// OTRAS OPERACIONES
    public function verify_permission_integrity(array $roles)
    {
        $permissions = $this->permissions;
        foreach ($permissions as $permission) {
            if (!in_array($permission->role->id, $roles)) {
                $this->permissions()->detach($permission->id);
            }
        }
    }

    public function permission_mass_assignment(array $roles)
    {
        foreach ($roles as $role) {
            if (!$this->has_role($role)) {
                $role_obj = \App\Models\Role::findOrFail($role);
                $permissions = $role_obj->permissions;
                $this->permissions()->syncWithoutDetaching($permissions);
            }
        }
    }
}
