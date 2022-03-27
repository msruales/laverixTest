@extends('dashboard.layout')

@section('content')


    <div class="m-5">
        <h1 class="title">USUARIO {{ $user->name }}</h1>

        <div class="m-5">

            <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                    Name: {{ $user->name }}</li>
                <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">Last
                    Name: {{ $user->last_name }}</li>
                <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
                    Email: {{ $user->email }}</li>
            </ul>

            <h2 class="m-2">ROLES</h2>
            <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @foreach( $user->getRoleNames() as $value => $key )
                    <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                        {{ $key }}
                    </li>
                @endforeach
            </ul>

        </div>

    </div>

@endsection
