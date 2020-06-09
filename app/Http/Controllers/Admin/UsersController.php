<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserWasCreated;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // eliminando query scope userscontroller allowed - usando directiva @can
        // $users = User::allowed()->get();
        $users = User::get();

        //relationship - model
        // $posts = auth()->user()->posts;
   
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
       
        $this->authorize('create', $user);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');

        return view('admin.users.create', compact('user', 'roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);

        //Validamos el formulario
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        //Generamos una contraseña
        $data['password'] = str_random(8);

        //Creamos el usuario
        $user = User::create($data);
        
        //Asignamos los roles
        if($request->filled('roles')){
            $user->assignRole($request->roles);
        }
        
        //Asignamos los permisos
        if($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }

        // Envio del correo
        UserWasCreated::dispatch($user, $data['password']);

        // Enviamos a la vista
        return redirect()->route('admin.users.index')->with('message','El usurio  se creo de forma satisfactoria.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        // $roles = Role::pluck('name', 'id');
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->validated());

        // return back()->with('message','Usuario Actualizado.');
        return redirect()->route('admin.users.edit', compact('user'))->with('message','Usuario actualizado.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        
        return redirect()->route('admin.users.index')->with('message','Usuario eliminado.');
    }
}
