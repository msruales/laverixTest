@if ($errors->any())
    @foreach ($errors->all() as $e )

        <div class="pt-1">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                    {{ $e }}
                </div>
            </div>
        </div>
    @endforeach
@endif
