@extends('dashboard.layout')

@section('content')
    <div class="m-5">
        <a class="btn__green" href="{{ route('roles.create') }}">CREATE</a>
    </div>
    <table class="table table-fixed">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach( $roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    @can('role-edit')
                        <a class="text-color__blue" href="{{ route('roles.edit', $role) }}">Edit</a>
                    @endcan
                    @can('role-show')
                        <a class="text-color__green" href="{{ route('roles.show', $role) }}">Show</a>
                    @endcan
                    @can('role-delete')
                        <form action="{{ route('roles.destroy', $role) }}" method="post">
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
    {{ $roles->links() }}

@endsection
