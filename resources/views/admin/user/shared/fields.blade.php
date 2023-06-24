@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="row">
    <div class="col-sm-2 d-flex justify-content-center">
        <!--center the image in the columns-->
        <!-- <div class="d-flex justify-content-center"> -->
        @if ($disabledStr)

            @if ($user->photo_url == null)
                <img src="{{ asset('/img/avatar_unknown.png') }}" alt="Imagem do user {{ $user->name }}"
                    class="img-fluid bg-dark rounded-circle">
            @else
                <img src="{{ asset('storage/photos/' . $user->photo_url) }}" alt="Imagem do user {{ $user->name }}"
                class="img-fluid bg-dark rounded-circle">
            @endif
        @else
                <div>
                    <img src="{{ asset('storage/photos/' . $user->photo_url) }}" alt="Imagem do user {{ $user->name }}"
                    class="img-fluid bg-dark rounded-circle">
                    <br>
                    <input type="file" class="form-control @error('imagem') is-invalid @enderror" style="width: 215px;" id="imagem" name="imagem">
                </div>

            @error('imagem')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror


        @endif

    </div>
    <div class="col-sm-8 mt-2">

        <div class="mb-4 form-floating ">
            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="name" id="inputNome"
                {{ $disabledStr }} value="{{ old('nome', $user->name) }}">
            <label for="inputNome" class="form-label">Nome</label>
            @error('nome')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 form-floating">
            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="email"
                id="inputEmail" {{ $disabledStr }} value="{{ old('mail', $user->email) }}">
            <label for="inputEmail" class="form-label">Email</label>
            @error('mail')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 form-floating">
            <input type="password" class="form-control @error('nome') is-invalid @enderror" name="password"
                id="inputPassword" {{ $disabledStr }} value="{{ old('mail', $user->password) }}">
            <label for="inputPassword" class="form-label">Password</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3 form-floating">
            <select class="form-select @error('tipo') is-invalid @enderror" name="tipo" id="inputTipo" {{ $disabledStr }}>
                <option value='A' {{ old('tipo', $user->user_type) == 'A'? 'selected' : '' }}>A</option>
                <option value='E' {{ old('tipo', $user->user_type) == 'E'? 'selected' : '' }}>E</option>
            </select>
            <label for="inputTipo" class="form-label">Tipo de User</label>
            @error('tipo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


    </div>
</div>

<br><br>
