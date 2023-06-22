@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->customer_id) }}">
    <label for="inputNome" class="form-label">ID do cliente</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->status) }}">
    <label for="inputNome" class="form-label">Estado da encomenda</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="date" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->date) }}">
    <label for="inputNome" class="form-label">Data</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->notes) }}">
    <label for="inputNome" class="form-label">Notas</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->nif) }}">
    <label for="inputNome" class="form-label">NIF</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->address) }}">
    <label for="inputNome" class="form-label">Endereço</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->payment_type   ) }}">
    <label for="inputNome" class="form-label">Tipo de pagamento</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="inputNome" id="inputNome"
        {{ $disabledStr }} value="{{ old('nome', $encomenda->payment_ref) }}">
    <label for="inputNome" class="form-label">Referencia de pagamento</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


