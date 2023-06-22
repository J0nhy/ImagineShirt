@can('viewAny', \App\Models\users::class)
    @extends('adminLayout')
    @section('main')
        <div class="justify-content-end " style="display: flex">
            <p>
                <a class="btn btn-success " href="{{ route('users.create') }}"><i class="fas fa-plus "></i> &nbsp;Criar novo
                    user</a>
            </p>
        </div>
        <section class="section dashboard">
            <h1>Users</h1><br>
            <form method="GET" action="{{ route('users.index') }}" id="">
                <div class="flex-grow-1 pe-2">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 mb-3 me-2 form-floating">
                            <select class="form-select" name="user_type" id="inputType">
                                <option {{ old('user_type', $filterByType) === '' ? 'selected' : '' }} value="">Todos os
                                    tipos </option>
                                @foreach ($usersTypes->unique('user_type')->pluck('user_type') as $userType)
                                    <option {{ old('user_type', $filterByType) == $userType ? 'selected' : '' }}
                                        value="{{ $userType }}">{{ $userType }}</option>
                                @endforeach
                            </select>
                            <label for="inputType" class="form-label">Tipo</label>
                        </div>

                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 mb-3 me-2 form-floating">
                            <select class="form-select" name="blocked" id="inputBlocked">
                                <option {{ old('blocked', $filterByBlocked) === '' ? 'selected' : '' }} value="">Todos os
                                    estados </option>
                                @foreach ($usersTypes->unique('blocked')->pluck('blocked') as $userType)
                                    <option {{ old('blocked', $filterByBlocked) == $userType ? 'selected' : '' }}
                                        value="{{ $userType }}">{{ $userType }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="inputBlocked" class="form-label">Estado</label>
                        </div>

                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 me-2 flex-grow-1 form-floating">
                            <input type="text" class="form-control" name="name" id="inputName"
                                value="{{ old('name', $filterByNome) }}">
                            <label for="inputName" class="form-label">Nome</label>
                        </div>
                    </div>

                </div>
                <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                    <a class="btn btn-secondary mb-2 px-4 flex-shrink-1" style="visibility: hidden;">ffff</a>
                    <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
                </div>

            </form>
            </div>

            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Apagado</th>
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
                            <td>{{ $user->deleted_at }}</td>
                            <td class="button-icon-col">

                                <a class="btn btn-secondary" href="{{ route('users.show', ['user' => $user]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pen" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg></a>

                            </td>


                            @if ($user->blocked == 1)
                                <td class="button-icon-col">

                                    <form method="POST" action="{{ route('users.unblock', ['user' => $user]) }}">
                                        @csrf

                                        @method('PUT')
                                        <button type="submit" name="recover" class="btn btn-success" title="Desbloquear">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z" />
                                            </svg>
                                        </button>

                                    </form>

                                </td>
                            @else
                                <td class="button-icon-col">



                                    <form method="POST" action="{{ route('users.block', ['user' => $user]) }}">
                                        @csrf

                                        @method('PUT')
                                        <button type="submit" name="recover" class="btn btn-danger "title="Bloquear">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                            </svg>
                                        </button>


                                    </form>

                                </td>
                            @endif

                            @if ($user->deleted_at != null)
                                <td class="button-icon-col">
                                    <form method="POST"

                                        action="{{ route('users.recover', ['user' => $user->id]) }}">
                                        @csrf

                                        @method('PUT')
                                        <button type="submit" name="recover" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                <path fill-rule="evenodd"
                                                    d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            @else
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
                            @endif



                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->withQueryString()->links() }}
            </div>
        </section>
    @endsection
@endcan
