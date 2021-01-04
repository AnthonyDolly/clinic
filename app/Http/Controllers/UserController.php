<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Http\Request;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.backoffice.pages.user.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.backoffice.pages.user.create', [
            'roles' => \App\Models\Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, User $user)
    {
        $user = $user->store($request);
        return redirect()->route('backoffice.user.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('theme.backoffice.pages.user.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('theme.backoffice.pages.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->my_update($request);
        return redirect()->route('backoffice.user.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert('Exito', 'Usuario eliminado', 'success');
        return redirect()->route('backoffice.user.index');
    }

    /**
     * Mostrar formulario para asignar rol
     * 
     */
    public function assign_role(User $user)
    {
        return view('theme.backoffice.pages.user.assign_role', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Asignar los roles en la tabla pivote de la base de datos
     * 
     */
    public function role_assignment(Request $request, User $user)
    {
        $user->role_assignment($request);
        return redirect()->route('backoffice.user.show', $user);
    }
    
    /**
     * Mostrar el formulario para asignar los permisos
     * 
     */
    public function assign_permission(User $user)
    {
        return view('theme.backoffice.pages.user.assign_permission', [
            'user' => $user,
            'roles' => $user->roles
        ]);
    } 

    /**
     * Asignar permisos en la tabla pivote de la base de datos
     */
    public function permission_assignment(Request $request, User $user)
    {
        $user->permissions()->sync($request->permissions);
        alert('Exito', 'Permisos asignados', 'success');
        return redirect()->route('backoffice.user.show', $user);
    }

    /**
     * Mostrar el formulario para importar usuarios
     * 
     */
    public function import()
    {
        return view('theme.backoffice.pages.user.import');
    }

    /**
     * Importar usuarios desde una hoja de excel
     * 
     */
    public function make_import(Request $request)
    {
        Excel::import(new UsersImport, $request->file('excel'));
        alert('Exito', 'Usuarios importados', 'success');
        return redirect()->route('backoffice.user.index');
    }
}
