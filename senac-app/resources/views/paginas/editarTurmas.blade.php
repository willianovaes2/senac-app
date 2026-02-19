<x-layout>
    <div class="container-xl py-4 shadow">
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary" href="/dashboardAdm"><i class="bi bi-bar-chart"></i> Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/cursos"><i class="bi bi-backpack"></i> Cursos</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/unidadesCurriculares"><i class="bi bi-book"></i> UCs</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/docentes"><i class="bi bi-person-workspace"></i> Docentes</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/alunos"><i class="bi bi-person"></i> Alunos</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary active" href="/turmas"><i class="bi bi-people-fill"></i> Turmas</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/aulas"><i class="bi bi-person"></i> Aulas</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/indicadores"><i class="bi bi-person"></i> Indicadores</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/relatorios"> <i class="bi bi-clipboard-data"></i> Relatórios</a>
            </li>
        </ul>

        <!-- Conteúdo principal -->
        <section class="container-fluid">

            <!-- Cabeçalho -->
            <div class="d-flex align-items-center justify-content-between  mb-3">
                <div>
                    <h2 class="fw-bold">Turmas</h2>
                    <p class="text-muted">Editar as turmas e Gerenciar alunos e docentes</p>
                </div>
                <a href="/turmas" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <form action="/atualizarTurmas/{{ $dado->id }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Curso -->
                        <div class="col">
                            <label class="form-label fw-semibold">Curso *</label>
                            <select name="curso_id" class="form-select" required>
                                @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}"
                                    {{ $curso->id == $dado->curso_id ? 'selected' : '' }}>
                                    {{ $curso->nome }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="row">

                    </div>

                    <div class="row">
                        <!-- Docentes -->
                        <div class="col">
                            <label class="form-label fw-semibold">Selecionar Docentes</label>

                            <div class="lista-scroll">
                                @foreach ($docentes as $docente)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="docentes[]"
                                        value="{{ $docente->id }}"
                                        id="docente{{ $docente->id }}"
                                        {{ $dado->docentes->contains($docente->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="docente{{ $docente->id }}">
                                        {{ $docente->nomeDocente }}
                                    </label>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- alunos -->
                        <div class="col">
                            <label class="form-label fw-semibold">Selecionar Alunos </label>

                            <div class="lista-scroll">
                                @foreach ($alunos as $aluno)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="alunos[]"
                                        value="{{ $aluno->id }}"
                                        id="aluno{{ $aluno->id }}"
                                        {{ $dado->alunos->contains($aluno->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="aluno{{ $aluno->id }}">
                                        {{ $aluno->nomeAluno }}
                                    </label>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Data de Nascimento -->
                        <div class="col">
                            <label class="form-label fw-semibold">Data de Inicio *</label>
                            <input type="date" name="dataInicio" class="form-control" value="{{$dado->dataInicio}}" required>
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="col">
                            <label class="form-label fw-semibold">Data de Término *</label>
                            <input type="date" name="dataFim" class="form-control" value="{{$dado->dataFim}}" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label class="form-label fw-semibold">Horas por dia *</label>
                            <input type="number"
                                name="horasPorDia"
                                class="form-control"
                                min="1"
                                max="12"
                                value="{{ $dado->horasPorDia }}"
                                required>
                        </div>
                    </div>


                    <div class="row">
                        <!-- Status -->
                        <div class="col">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="ativo" {{ $dado->status == 'ativo' ? 'selected' : '' }}>
                                    Ativo
                                </option>
                                <option value="inativo" {{ $dado->status == 'inativo' ? 'selected' : '' }}>
                                    Inativo
                                </option>
                            </select>

                        </div>

                        <div class="col">
                            <label class="form-label fw-semibold">Turno *</label>
                            <select name="turno" class="form-select" required>
                                <option value="">Selecione o turno</option>
                                <option value="M" {{ $dado->turno == 'M' ? 'selected' : '' }}>Manhã</option>
                                <option value="T" {{ $dado->turno == 'T' ? 'selected' : '' }}>Tarde</option>
                                <option value="N" {{ $dado->turno == 'N' ? 'selected' : '' }}>Noite</option>
                            </select>

                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 filter-tabs mt-3 gap-3">
                    <button type="button" class="btn btn-danger text-white px-4" data-bs-toggle="modal"
                        data-bs-target="#modalExcluirTurma">
                        Excluir
                    </button>
                    <button type="submit" class="btn btn-warning text-white px-4">
                        Salvar
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalExcluirTurma" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir a turma: {{ $dado->codigoTurma }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Não</button>
                                <a type="button" class="btn btn-danger" href="/excluirTurma/{{$dado->id}}">Sim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

    </div>
</x-layout>