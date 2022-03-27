@csrf
<div class="m-5">
    <div class="mb-6">
        <label class="label__form" for="name">NAME</label>
        <input class="input__form" type="text" name="name" value="{{ old("name", $user->name) }}"/>
    </div>
    <div class="mb-6">
        <label class="label__form" for="last_name">LAST NAME</label>
        <input class="input__form" type="text" name="last_name" value="{{ old("last_name",$user->last_name) }}"/>
    </div>
    <div class="mb-6">
        <label class="label__form" for="email">EMAIL</label>
        <input class="input__form" type="email" name="email" value="{{ old("email",$user->email) }}"/>
    </div>
    <div class="mb-6">
        <label class="label__form" for="password">PASSWORD</label>
        <input class="input__form" type="password" name="password"/>
    </div>
    <div class="mb-6">
        <label class="label__form" for="telephone">TELEPHONE</label>
        <input class="input__form" type="number" name="telephone" value="{{ old("telephone",$user->telephone) }}"/>
    </div>
    <div class="mb-6">
        <label class="label__form" for="direction">DIRECTION</label>
        <input class="input__form" type="text" name="direction" value="{{ old("direction",$user->direction) }}"/>
    </div>
    <div class="mb-6">
        <label class="label__form" for="date_of_birth">DATE OF BIRTH</label>
        <input class="input__form" type="date" name="date_of_birth"
               value="{{ old("date_of_birth",$user->date_of_birth) }}"/>
    </div>
    <div class="mb-6">
        <select name="roles[]" multiple>
            @foreach( $roles as $value => $key )
                <option
                    {{ in_array($value, $user->getRoleNames()->toArray()) ? "selected" : '' }}  value="{{ $key }}"> {{ $value }}</option>
            @endforeach
        </select>
    </div>

    <br>
    <button class="btn__blue" type="submit">ENVIAR</button>
</div>

