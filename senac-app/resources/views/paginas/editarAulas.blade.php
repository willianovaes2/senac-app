<x-layout titulo="Unidade Curricular - Senac">
    <div class="container-xl py-4 shadow">
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary active" href="dashboardAdm"><i class="bi bi-bar-chart"></i></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="cursos"><i class="bi bi-backpack"></i> Cursos</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary " href="unidadesCurriculares"><i class="bi bi-book"></i> UCs</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="docentes"><i class="bi bi-person-workspace"></i> Docentes</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="alunos"><i class="bi bi-person"></i> Alunos</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="turmas"><i class="bi bi-people-fill"></i> Turmas</a>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Unidades Curriculares (UCs)</h2>
                    <p class="text-muted">Gerencie as unidades curriculares dos cursos</p>
                </div>

                <a class="btn btn-primary text-end" data-bs-toggle="modal" data-bs-target="#modalNovaUc">
                    <i class="bi bi-plus-lg me-1"></i> Nova UC
                </a>
            </div>

            <!-- Cards -->
            <div class="row g-4">
                @if ($ucs->isEmpty())
                <div colspan="8" class="text-center text-muted py-4">
                    Nenhuma Unidade Curricular encontrada
                </div>
                @else
                @foreach ($ucs as $uc)
                @php
                $ucIniciada = $uc->aulas->count() > 0;
                @endphp

                <div class="col-md-6 col-lg-4 float-start">
                    <div class="card uc-card p-4 h-100 hover-shadow">

                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold mb-0">{{ $uc->nome }}</h5>

                            @if ($uc->status === 'ativo')
                            <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                ativo
                            </span>
                            @else
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                inativo
                            </span>
                            @endif
                        </div>

                        <p class="text-muted small mb-2">
                            Código: {{ $uc->codigoUc }}
                        </p>

                        <ul class="list-unstyled small mb-3">
                            <li><strong>Curso:</strong> {{ $uc->curso->nome ?? 'Curso não encontrado' }}</li>
                            <li><strong>Carga Horária:</strong> {{ $uc->cargaHoraria }}h</li>
                            <li><strong>Presença Mínima:</strong> {{ $uc->presencaMinima }}%</li>
                            @if($uc->docentes->count())
                            <li><strong>Docentes:</strong>
                                {{ $uc->docentes->pluck('nomeDocente')->join(', ') }}
                            </li>
                            @endif
                        </ul>

                        <p class="small text-muted">{{ $uc->descricao }}</p>

                        {{-- ================= LISTA DE AULAS ================= --}}
                        @if($uc->aulas->count())
                        <hr>
                        <h6 class="fw-bold small mb-2">Aulas geradas:</h6>
                        <ul class="small ps-3">
                            @foreach($uc->aulas as $aula)
                            <li>
                                {{ \Carbon\Carbon::parse($aula->dia)->format('d/m/Y') }} —
                                <span class="text-muted">{{ ucfirst($aula->status) }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        {{-- ==================================================== --}}

                        <div class="mt-auto d-flex gap-2">
                            @if($ucIniciada)
                            <button class="btn btn-secondary btn-sm w-100" disabled>UC Iniciada</button>
                            @else
                            <button type="button"
                                class="btn btn-success btn-sm w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modalIniciarUc-{{ $uc->id }}">
                                Iniciar UC
                            </button>
                            @endif

                            <a href="/editarUnidadesCurriculares/{{$uc->id}}" class="btn btn-outline-dark btn-sm w-100">
                                <i class="bi bi-pencil me-1"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>

                {{-- ================= MODAL INICIAR UC ================= --}}
                <div class="modal fade" id="modalIniciarUc-{{ $uc->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="/iniciarUc">
                            @csrf
                            <input type="hidden" name="uc_id" value="{{ $uc->id }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Iniciar {{ $uc->nome }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Seleção de turma -->
                                    <label>Turma</label>
                                    <select name="turma_id" class="form-select" required>
                                        @foreach($turmas as $turma)
                                        <option value="{{ $turma->id }}">{{ $turma->codigoTurma }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Data início -->
                                    <label class="mt-3">Data início</label>
                                    <input type="date" name="data_inicio" class="form-control" required>

                                    <!-- Docente responsável -->
                                    <label class="mt-3">Docente responsável</label>
                                    <select name="docente_responsavel" class="form-select" required>
                                        <option value="">Selecione o responsável</option>
                                        @foreach($uc->docentes as $docente)
                                        <option value="{{ $docente->id }}">{{ $docente->nomeDocente }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success">Iniciar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- ==================================================== --}}

                @endforeach
                @endif
            </div>
        </section>

        <!-- Modal Novo UC -->
        <div class="modal fade" id="modalNovaUc" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0">

                    <!-- Header -->
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">Nova UC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Form -->
                    <form action="/inserirUc" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <!-- Nome -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Nome da UC *</label>
                                    <input type="text" name="nome" class="form-control"
                                        placeholder="Ex: Desenvolvimento de Banco de Dados" required>
                                </div>

                                <!-- Tipo -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Código *</label>
                                    <input type="text" name="codigoUc" class="form-control" placeholder="Ex: UC10"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label fw-semibold">Curso *</label>
                                    <select name="cursoCodigo" class="form-select" required>
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
                                <!-- Selecionar Docentes -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Docentes da UC</label>
                                    <div class="lista-scroll mb-2">
                                        @foreach($docentes as $docente)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input uc-docente-checkbox"
                                                type="checkbox"
                                                name="docentes[]"
                                                value="{{ $docente->id }}"
                                                id="docente{{ $docente->id }}"
                                                @if(in_array($docente->id, old('docentes', []))) checked @endif>
                                            <label class="form-check-label" for="docente{{ $docente->id }}">
                                                {{ $docente->nomeDocente }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Carga Horária -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Carga Horária (horas) *</label>
                                    <input type="number" name="cargaHoraria" class="form-control" min="0" value="0"
                                        required>
                                </div>

                                <!-- Turno -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Presença Mínima (%) *</label>
                                    <input type="number" name="presencaMinima" class="form-control" min="0" value="0"
                                        required>
                                </div>
                            </div>

                            <div class="row">

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
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label class="form-label fw-semibold">Descrição</label>
                                    <textarea rows="3" type="text" name="descricao" class="form-control"
                                        placeholder="Descreva o conteúdo da UC..." style="resize: none;">
                                    </textarea>
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