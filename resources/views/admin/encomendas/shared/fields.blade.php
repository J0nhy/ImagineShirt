@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $cor->name) }}">
    <label for="inputNome" class="form-label">Nome</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

