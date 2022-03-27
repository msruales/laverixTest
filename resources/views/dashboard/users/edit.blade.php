@extends('dashboard.layout')

@section('content')
    <div class="m-5">

        <h1 class="title">UPDATE USER {{ $user->name }}</h1>

        @include('dashboard.fragment._error-form')
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @method('PATCH')
            @include('dashboard.users.fragment._form')

        </form>

    </div>
@endsection
