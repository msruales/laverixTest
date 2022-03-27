<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Mail\CrudRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::orderBy('id','DESC')->paginate(5);

        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::pluck('id', 'name');
        $role = new Role();

        return view('dashboard.roles.create', compact('permission', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $is_created = $role = Role::create(['name' => $request->validated()['name']]);
        $role->syncPermissions($request->validated()['permission']);

        if( $is_created) {
            Mail::send(new CrudRole($role, 'Store Rol'));
        }
        return to_route('roles.index')->with('status', 'Role created');
    }

    /**
     * Display the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = $role->getAllPermissions();
        echo view('dashboard.roles.show', compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permission = Permission::pluck('id', 'name');
        $permission_checked = $role->getAllPermissions()->pluck('name')->toArray();
        return view('dashboard.roles.edit', compact('permission', 'role','permission_checked'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request,Role $role)
    {

        $role->name = $request->validated()['name'];
        $is_updated = $role->update();
        $role->syncPermissions($request->validated()['permission']);

        if( $is_updated) {
            Mail::send(new CrudRole($role, 'Updated Rol'));
        }

        return to_route('roles.index')->with('status', 'Rol updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $is_deleted = $role->delete();

        if( $is_deleted) {
            Mail::send(new CrudRole($role, 'Deleted Rol'));
        }

        return to_route('roles.index')->with('status', 'Rol deleted');
    }
}
