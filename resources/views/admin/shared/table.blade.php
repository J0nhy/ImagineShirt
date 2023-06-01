<table class="table">
    <thead class="table-dark">
        <tr>
            @if ($showFoto)
                <th></th>
            @endif
            <th>Nome</th>
            @if ($showDepartamento ?? true)
                <th>Departamento</th>
            @endif
            @if ($showContatos)
                <th>E-Mail</th>
                <th>Gabinete</th>
                <th>Extensão</th>
                <th>Cacifo</th>
            @endif
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showEdit)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($docentes as $docente)
            <tr>
                @if ($showFoto)
                    <td width="45">
                        @if ($docente->user->url_foto)
                            <img src="{{ $docente->user->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                        @endif
                    </td>
                @endif
                <td>{{ $docente->user->name }}</td>
                @if ($showDepartamento ?? true)
                    <td>{{ $docente->departamentoRef->nome ?? '' }}</td>
                @endif
                @if ($showContatos)
                    <td>{{ $docente->user->email }}</td>
                    <td>{{ $docente->gabinete }}</td>
                    <td>{{ $docente->extensao }}</td>
                    <td>{{ $docente->cacifo }}</td>
                @endif
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('docentes.show', ['docente' => $docente]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('docentes.edit', ['docente' => $docente]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                @if ($showDelete)
                    <td class="button-icon-col">
                        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal"
                            data-msgLine1="Quer realmente apagar o docente <strong>&quot;{{ $docente->user->name }}&quot;</strong>?"
                            data-action="{{ route('docentes.destroy', ['docente' => $docente]) }}">
                            <i class="fas fa-trash"></i></button>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@if ($showDelete)
    @include('shared.confirmationDialog', [
        'title' => 'Apagar docente',
        'msgLine1' => 'Clique no botão "Apagar" para confirmar a operação',
        'msgLine2' => '',
        'confirmationButton' => 'Apagar',
        'formMethod' => 'DELETE',
    ])
@endif
