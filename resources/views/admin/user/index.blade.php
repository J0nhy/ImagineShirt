@extends('adminLayout')
@section('main')
<div class="justify-content-end " style="display: flex">
<p>
    <a class="btn btn-success " href="{{ route('users.create') }}"><i class="fas fa-plus "></i> &nbsp;Criar novo user</a>
</p>
</div>
    <section class="section dashboard">
        <h1>Users</h1><br>
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
                        <td class="button-icon-col"></td>
                        <td class="button-icon-col">

                            <a class="btn btn-secondary" href="{{ route('users.show', ['user' => $user->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pen" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></a>

                        </td>
                        <td class="button-icon-col">
                            <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                @csrf

                                @method('DELETE')
                                <button type="submit" name="delete" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $users->withQueryString()->links() }}
        </div>
    </section>
@endsection
