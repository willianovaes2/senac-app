<x-layout titulo="Turmas - Senac">
    <div class="container-xl py-4 shadow">
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary" href="dashboardAdm"><i class="bi bi-bar-chart"></i></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="cursos"><i class="bi bi-backpack"></i> Cursos</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="unidadesCurriculares"><i class="bi bi-book"></i> UCs</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="docentes"><i class="bi bi-person-workspace"></i> Docentes</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="alunos"><i class="bi bi-person"></i> Alunos</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary active" href="turmas"><i class="bi bi-people-fill"></i> Turmas</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="aulas"><i class="bi bi-file-bar-graph"></i>
                    Aulas</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="indicadores"><i class="bi bi-card-list"></i>
                    Indicadores</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="relatorios"><i class="bi bi-clipboard-data"></i>
                    Relatórios</a>
            </li>
        </ul>
 
        <!-- Conteudo Principal -->
 
        <section class="container-fluid">
 
            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="fw-bold">Turmas</h2>
                    <p class="text-muted">
                        Gerencie as turmas e vincule alunos e docentes
                    </p>
                </div>
 
                <a class="btn btn-primary text-end" data-bs-toggle="modal" data-bs-target="#modalNovaTurma">
                    <i class="bi bi-plus-lg"></i> Nova Turma
                </a>
            </div>
 
            <!-- Cards -->
            <div class="row g-4">
 
                <!-- Card Turma -->
 
                @if ($turmas->isEmpty())
 
                <div colspan="8" class="text-center text-muted py-4">
                    Nenhuma turma encontrada
                </div>
 
                @else
                @foreach ($turmas as $turma)
                <div class="col-md-6 col-lg-4 float-start">
                    <div class="card rounded-4 h-100 p-2 hover-shadow">
                        <div class="card-body d-flex flex-column">
 
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h4 class="fw-bold">{{ $turma->codigoTurma }} </h4>
 
                                @if ($turma->status === 'ativo')
                                <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                    ativo
                                </span>
                                @else
                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                    inativo
                                </span>
                                @endif
                            </div>
 
                            <small class="text-muted mb-2">
                                {{ $turma->curso->nome ?? '—' }}
                            </small>
 
                            <div class="mb-2">
                                <small class="text-muted">Docente:</small>
                                <div class="fw-semibold">
                                    @if ($turma->docentes->isEmpty())
                                    <div class="text-muted">Não definido</div>
                                    @else
                                    @foreach ($turma->docentes as $docente)
                                    <div>{{ $docente->nomeDocente }}</div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
 
                            <div class="mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-people text-muted"></i>
                                <span>
                                    {{ $turma->alunos->count() }} alunos
                                </span>
                            </div>
 
                            <div class="mb-1">
                                <small class="text-muted">Início:</small>
                                <span class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($turma->dataInicio)->format('d/m/Y') }}
                                </span>
                            </div>
 
                            <div class="mb-3">
                                <small class="text-muted">Previsão Término:</small>
                                <span class="fw-semibold">
                                    @if($turma->dataFim)
                                    {{ \Carbon\Carbon::parse($turma->dataFim)->format('d/m/Y') }}
                                    @else
                                    —
                                    @endif
 
                                </span>
                            </div>
 
 
                            <div class="mt-auto d-flex gap-2">
                                <a href="/editarTurmas/{{$turma->id}}" class="btn btn-outline-dark w-100">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
 
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
 
            </div>
 
        </section>
 
        <!-- Modal Novo Turma -->
        <div class="modal fade" id="modalNovaTurma" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0">
 
                    <!-- Header -->
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">Nova Turma</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
 
                    <!-- Form -->
                    <form action="/inserirTurma" method="POST">
                        @csrf
 
 
                        <div class="modal-body">
                            <div class="row">
                                <!-- Curso -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Curso *</label>
                                    <select name="curso_id" class="form-select" required>
                                        <option value="">Selecione o curso</option>
 
                                        @if ($cursos->isEmpty())
 
                                        <div colspan="8" class="text-center text-muted py-4">
                                            Nenhum Curso encontrado
                                        </div>
 
                                        @else
                                        @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}">
                                            {{ $curso->nome }}
                                        </option>
                                        @endforeach
                                        @endif
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
                                        @if ($docentes->isEmpty())
 
                                        <div colspan="8" class="text-center text-muted py-4">
                                            Nenhum docente encontrada
                                        </div>
 
                                        @else
                                        @foreach ($docentes as $docente)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="docentes[]"
                                                value="{{ $docente->id }}"
                                                id="docente{{ $docente->id }}">
                                            <label class="form-check-label" for="docente{{ $docente->id }}">
                                                {{ $docente->nomeDocente }}
                                            </label>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
 
                            <div class="row">
                                <!-- Horário -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Selecionar Alunos</label>
 
                                    <div class="lista-scroll">
                                        @if ($alunos->isEmpty())
 
                                        <div colspan="8" class="text-center text-muted py-4">
                                            Nenhum aluno encontrado
                                        </div>
 
                                        @else
                                        @foreach ($alunos as $aluno)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="alunos[]"
                                                value="{{ $aluno->id }}"
                                                id="aluno{{ $aluno->id }}">
                                            <label class="form-check-label" for="aluno{{ $aluno->id }}">
                                                {{ $aluno->nomeAluno }}
                                            </label>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
 
                            <div class="row">
                                <div class="col">
                                    <label class="form-label fw-semibold">Data de Início *</label>
                                    <input type="date" name="dataInicio" class="form-control" required>
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
                                        required>
                                </div>
                            </div>
 
                            <div class="row">
                                <!-- Status -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="ativo" selected>Ativo</option>
                                        <option value="inativo">Inativo</option>
                                    </select>
                                </div>
 
                                <div class="col">
                                    <label class="form-label fw-semibold">Turno *</label>
                                    <select name="turno" class="form-select" required>
                                        <option value="">Selecione o turno</option>
                                        <option value="M">Manhã</option>
                                        <option value="T">Tarde</option>
                                        <option value="N">Noite</option>
                                    </select>
                                </div>
                            </div>
                        </div>
 
                        <!-- Footer -->
                        <div class="modal-footer border-0 filter-tabs">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-warning text-white px-4">
                                Salvar
                            </button>
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
    </div>
</x-layout>
 