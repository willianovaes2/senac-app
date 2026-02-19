<x-layout>
    <div class="container-xl py-4 shadow">
        <!-- Conteudo Principal -->

        <section class="container-fluid">

            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="fw-bold">Notas, Menções e Atividades</h3>
                    <p class="text-muted">Seleção de Curso, Turma e UC</p>
                </div>
            </div>

            <form method="GET" action="{{ url('/telaInicial') }}">
                <div class="card border-0 shadow-sm mb-2">
                    <div class="card-body rounded-3 text-white d-flex align-items-center gap-3"
                        style="background-color: rgb(0, 77, 139);">

                        <!-- Curso -->
                        <select name="curso_id" class="form-select form-select-sm w-auto">
                            <option value="">Selecione Curso</option>
                            @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ request('curso_id')==$curso->id ? 'selected' : '' }}>
                                {{ $curso->nome }}
                            </option>
                            @endforeach
                        </select>

                        <!-- Turma -->
                        <select name="turma_id" class="form-select form-select-sm w-auto">
                            <option value="">Selecione Turma</option>
                            @foreach ($turmas as $turma)
                            <option value="{{ $turma->id }}" {{ request('turma_id')==$turma->id ? 'selected' : '' }}>
                                {{ $turma->codigoTurma }}
                            </option>
                            @endforeach
                        </select>

                        <!-- Ano -->
                        <div class="ms-auto">
                            <select name="ano" class="form-select form-select-sm w-auto">
                                <option value="">Selecione Ano</option>
                                @foreach ($anos as $ano)
                                <option value="{{ $ano }}" {{ request('ano')==$ano ? 'selected' : '' }}>
                                    {{ $ano }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            Filtrar
                        </button>

                    </div>
                </div>
            </form>


            <div class="card shadow-sm rounded-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-muted">Dia da aula</th>
                                <th class="text-muted">UC Vinculado</th>
                                <th class="text-muted">Curso</th>
                                <th class="text-muted">Docente</th>
                                <th class="text-muted">Status</th>
                                <th class="text-muted">Turmas</th>
                                <th class="text-center text-muted">Nota / Frequência</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($aulas as $aula)
                            <tr>
                                <!-- Dia da Aula -->
                                <td>
                                    <span class="badge bg-light text-dark rounded-pill px-3">
                                        {{ $aula->dia }}
                                    </span>
                                </td>

                                <!-- Nome -->
                                <td class="fw-semibold">
                                    {{ $aula->uc->nome ?? '-' }}
                                </td>

                                <!-- Curso -->
                                <td>
                                    <span class="badge rounded-pill px-3" style="background:#e7f0ff;color:#1d4ed8;">
                                        {{ $aula->curso->nome }}
                                    </span>
                                </td>

                                <!-- Docente -->
                                <td>
                                    {{ $aula->docenteResponsavel->nomeDocente ?? '-' }}
                                </td>

                                <!-- Status -->
                                <td>
                                    @switch($aula->status_calculado)
                                    @case('pendente')
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">
                                        Pendente
                                    </span>
                                    @break

                                    @case('andamento')
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3">
                                        Em andamento
                                    </span>
                                    @break

                                    @case('concluido')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                        Concluído
                                    </span>
                                    @break

                                    @default
                                    <span class="badge bg-light text-dark rounded-pill px-3">
                                        Não definido
                                    </span>
                                    @endswitch
                                </td>

                                <!-- Turmas -->
                                <td>
                                    @foreach ($aula->turmas as $turma)
                                    <span class="badge rounded-pill px-3 me-1"
                                        style="background:#f3e8ff;color:#7c3aed;">
                                        {{ $turma->codigoTurma }}
                                    </span>
                                    @endforeach
                                </td>

                                <!-- Botão -->
                                <td class="text-center">
                                    @if (optional($aula->uc)->status === 'concluido')
                                    <a href="{{ route('centralAluno', $aula->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                        Acessar
                                    </a>

                                    @else
                                    <a href="{{ route('centralAula', $aula->id) }}">
                                        Acessar
                                    </a>
                                    @endif
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Nenhuma aula encontrada
                                </td>
                            </tr>
                            @endforelse


                        </tbody>

                    </table>
                </div>
            </div>
        </section>
    </div>
</x-layout>