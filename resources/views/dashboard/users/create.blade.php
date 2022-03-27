@extends('dashboard.layout')

@section('content')
    <div class="m-5">

        <h1 class="title">CREATE USER</h1>

        @include('dashboard.fragment._error-form')
        <form action="{{ route('users.store') }}" method="post">

            @include('dashboard.users.fragment._form')

        </form>

    </div>
@endsection
