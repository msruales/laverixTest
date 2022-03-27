@csrf
<div class="m-5">
    <div class="mb-6">
        <label class="label__form" for="name">Nombre</label>
        <input class="input__form" type="text" name="name" value="{{ old("name", $role->name) }}"/>
    </div>
    <div class="mb-6">
        <ul>
            @foreach( $permission as $value => $key )
                <li>
                    <input type="checkbox"
                           {{ (isset($permission_checked) && in_array($value, $permission_checked)) ? 'checked' : ''}} name="permission[]"
                           id="check-box-{{$value}}"
                           value="{{ $value }}"> {{ $value }}</input>
                </li>
            @endforeach
        </ul>
    </div>

    <br>
    <button class="btn__blue" type="submit">GUARDAR</button>
</div>

