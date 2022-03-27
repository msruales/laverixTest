<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Mail\CrudUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filter_column = $request->has('filter_column') ? $request->get('filter_column') : 'id';
        $filter_option = $request->has('filter_option') ? $request->get('filter_option') : 'DESC';
        $search = $request->has('search') ? $request->get('search') : '';

        $columns = Schema::getColumnListing('users'); // users table
        $columns = array_slice($columns, 1, 6);

        $users = User::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name','LIKE',"%$search%")
                ->orderBy($filter_column, $filter_option)
                ->paginate(5);


        return view('dashboard.users.index', compact('users', 'search', 'filter_option', 'filter_column','columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $roles = Role::pluck('id', 'name');
        $user = new User();

        return view('dashboard.users.create', compact('user', 'roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $is_created = $user = User::create($data);
        $user->assignRole($data['roles']);

        if ($is_created) {
            Mail::send(new CrudUser($user, 'create User'));
        }
        return to_route('users.index')->with('status', 'User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('id', 'name');
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        $is_updated = $user->update($data);

        $user->syncRoles($data['roles']);

        if ($is_updated) {
            Mail::send(new CrudUser($user, 'Update User'));
        }

        return to_route('users.index')->with('status', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $is_deleted = $user->delete();
        if ($is_deleted) {
            Mail::send(new CrudUser($user, 'Delete User'));
        }
        return to_route('users.index')->with('status', 'User deleted');
    }
}
