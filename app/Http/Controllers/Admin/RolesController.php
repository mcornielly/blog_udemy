<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRolesRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authorize;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $this->authorize('view', new Role);
       $roles = Role::all();
       return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $role = new Role);

        $permissions = Permission::pluck('name', 'id'); 
        $role = $role;
        return view('admin.roles.create', compact('permissions', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRolesRequest $request)
    {
        $this->authorize('create', new $role);
        // return $request;
        //  $data = $request->validate([
        //     'name' => 'required|unique:roles',
        //     'display_name' => 'required',
        //  ],[
        //      'name.required' => 'El Identificador es obligatorio.',
        //      'name.unique' => 'El Identificador ya se encuentra registrado.',
        //      'display_name.required' => 'El Nombre es obligatorio.',
        //  ]);

         $role = Role::create($request->validated());

         if($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
         }  

        return redirect()->route('admin.roles.index')->with('message','Rol se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $permissions = Permission::pluck('name', 'id'); 

        return view('admin.roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveRolesRequest $request,Role $role)
    {
        $this->authorize('update', $role);
       
        // $data = $request->validate([
        //     'display_name' => 'required',
        // ], [
        //     'display_name.required' => 'El nombre es obligatorio.',
        // ]);

        $role->update($request->validated());

        $role->permissions()->detach();

        if($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        } 

        return redirect()->route('admin.roles.edit', compact('role','permissions'))->with('message','Rol ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->delete();

        return redirect()->route('admin.roles.index')->with('message', 'Rol ha sido eliminado.');
    }
}
