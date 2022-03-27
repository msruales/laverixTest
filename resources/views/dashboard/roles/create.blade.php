@extends('dashboard.layout')

@section('content')
    <div>

        <h1 class="title">CREATE ROL</h1>

        @include('dashboard.fragment._error-form')
        <form action="{{ route('roles.store') }}" method="post">

            @include('dashboard.roles.fragment._form')

        </form>

    </div>
@endsection
