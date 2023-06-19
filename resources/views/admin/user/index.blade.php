@extends('adminLayout')
@section('main')
    <section class="section dashboard">
        <h1>Users</h1>
        <form method="GET" action="{{ route('users.index') }}" id="">
        <div class="flex-grow-1 pe-2">
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1 mb-3 me-2 form-floating">
                    <select class="form-select" name="user_type" id="inputType">
                        <option {{ old('user_type', $filterByType) === '' ? 'selected' : '' }}
                            value="">Todos os tipos </option>
                            @foreach ($usersTypes->unique('user_type')->pluck('user_type') as $userType)
                            <option
                                {{ old('user_type', $filterByType) == $userType ? 'selected' : '' }}
                                value="{{ $userType }}">{{ $userType }}</option>
                        @endforeach
                    </select>
                    <label for="inputCategoria" class="form-label">Tipo</label>
                </div>
            </div>

        </div>
        <div class="flex-shrink-1 d-flex flex-column justify-content-between">
            <a class="btn btn-secondary mb-2 px-4 flex-shrink-1" style="visibility: hidden;">ffff</a>
            <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1"
                name="filtrar">Filtrar</button>
            <a href="{{ route('users.index') }}"
                class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
        </div>
        </form>
    </div>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Photo</th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                    <th class="button-icon-col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_type }}</td>
                        <td>{{ $user->photo_url }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $users->withQueryString()->links() }}
        </div>
    </section>
@endsection
