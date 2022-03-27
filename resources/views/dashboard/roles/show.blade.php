@extends('dashboard.layout')
@section('content')

    <div class="m-5">
        <h1 class="title">ROL: {{ $role->name }}</h1>
        <div class="m-5">
            @foreach( $permissions as $value => $key )
                <li>
                    {{ $key->name }}
                </li>
            @endforeach
        </div>

    </div>


@endsection
