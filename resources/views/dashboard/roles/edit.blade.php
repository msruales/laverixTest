@extends('dashboard.layout')
@section('content')

    <h1 class="title">ACTUALIZAR ROL: {{ $role->name }}</h1>


    @include('dashboard.fragment._error-form')
    <form action="{{ route('roles.update', $role->id) }}" method="post">
        @method('PATCH')
        @include('dashboard.roles.fragment._form', compact('permission_checked'))

    </form>

@endsection
