@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="name" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $core->name) }}">
    <label for="inputNome" class="form-label">Nome</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <div>
        <input type="color" id="head" name="colorValue"
        {{ $disabledStr }} value="{{ old('colorValue', '#' . $core->code) }}">
        <label for="colorValue" style="font-color: bg0">Cor</label>
    </div>
    @error('colorValue')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    @if(!$disabledStr )

    <div>
        <input type="file" class="btn btn-secondary mb-3 px-4 flex-grow-1" id="imagem"
        name="imagem" accept=".png">
        <label for="imagem" class="form-label">Imagem</label>
    </div>
    @else
        <img src="{{ asset('tshirt_base/' . $core->code . '.png') }}" alt="Imagem da cor {{ $core->name }}" class="img-fluid">
    @endif
    @error('imagem')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>



