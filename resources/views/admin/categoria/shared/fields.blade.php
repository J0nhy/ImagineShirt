@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $categoria->nome) }}">
    <label for="inputAbr" class="form-label">Nome</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

