@extends('dashboard.layout')

@section('content')

    @can('user-create')
        <div class="m-5">
            <a class="btn__green" href="{{ route('users.create') }}">Create</a>

        </div>

        <div class="pt-2 relative mx-auto text-gray-600">

        </div>

        <form action="{{ route('users.index') }}" method="POST">
            <div class="mb-3 ml-5">
                @method('GET')
                @csrf
                <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                       type="search" name="search" autofocus placeholder="Search..." value="{{ old("search", $search) }}">
                <select name="filter_column"
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none">
                    @foreach($columns as $column => $col )
                        <option
                            {{ old("filter_column", $filter_column) == $col ? "selected" : ''  }} value="{{$col}}">{{ ucwords(str_replace('_', ' ',$col)) }}</option>
                    @endforeach

                </select>
                <select name="filter_option"
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none">
                    <option {{ old("filter_option", $filter_option) == "ASC" ? "selected" : ''  }} value="ASC">ASC
                    </option>
                    <option {{ old("filter_option", $filter_option) == "DESC" ? "selected" : ''  }} value="DESC">DESC
                    </option>
                </select>
                <button class="btn__blue" type="submit">Search</button>
            </div>
        </form>

    @endcan
    <table class="table table-fixed">
        <thead>
        <tr>
            <th>Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Roles</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach( $users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telephone }}</td>
                <td>
                    @foreach( $user->getRoleNames() as $role)
                        {{ $role }}
                    @endforeach
                </td>
                <td>
                    @can('user-edit')
                        <a class="text-color__blue" href="{{ route('users.edit', $user) }}">Edit</a>
                    @endcan
                    @can('user-show')
                        <a class="text-color__green" href="{{ route('users.show', $user) }}">Show</a>
                    @endcan
                    @can('user-delete')
                        <form action="{{ route('users.destroy', $user) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="text-color__red" type="submit">Delete</button>
                        </form>
                    @endcan

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $users->links() }}

@endsection
