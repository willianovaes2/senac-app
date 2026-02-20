<x-layout>
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
                <a class="btn btn-primary active" href="indicadores"><i class="bi bi-card-list"></i>
                    Indicadores</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="relatorios"><i class="bi bi-clipboard-data"></i>
                    Relatórios</a>
            </li>
        </ul>

        <section class="container-fluid">
            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="fw-bold">Indicadores</h2>
                    <p class="text-muted">Gerencie os indicadores de avaliação e suas UCs relacionadas</p>
                </div>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoIndicador">
                    <i class="bi bi-plus-lg"></i> Novo Indicador
                </button>
            </div>

            <!-- Cards -->
            <div class="row g-4">
                @forelse ($indicadores as $indicador)
                <div class="col-md-6">
                    <div class="card hover-shadow h-100 rounded-4">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="width:45px;height:45px;background:#ff7a1a;border-radius:12px;">
                                        <i class="bi bi-graph-up-arrow text-white"></i>
                                    </div>
                                    <h5 class="fw-semibold mb-0">{{ $indicador->nome }}</h5>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ url('/editarIndicador/'.$indicador->id) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ url('/excluirIndicador/'.$indicador->id) }}" class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>

                            <p class="text-muted small">{{ $indicador->descricao }}</p>
                            <hr>

                            <p class="small text-uppercase text-muted fw-semibold mb-2">
                                Unidades Curriculares Vinculadas ({{ $indicador->ucs->count() ?? 0 }})
                            </p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($indicador->ucs as $uc)
                                <span class="badge rounded-pill px-3 py-2" style="background:#e7f0ff;color:#1d4ed8;">
                                    {{ $uc->nome }}
                                </span>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">
                    Nenhum indicador encontrado
                </div>
                @endforelse
            </div>

            <!-- Modal Novo Indicador -->
            <div class="modal fade" id="modalNovoIndicador" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0">

                        <form method="POST" action="{{ url('/inserirIndicador') }}">
                            @csrf

                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-semibold">
                                    <i class="bi bi-graph-up-arrow text-warning me-2"></i> Novo Indicador
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nome do Indicador *</label>
                                    <input type="text" name="nome" class="form-control rounded-3"
                                        placeholder="Ex: Competência em Programação" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Descrição *</label>
                                    <textarea name="descricao" rows="3" class="form-control rounded-3"
                                        placeholder="Descreva o que este indicador avalia..." style="resize: none;" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Unidades Curriculares *
                                        <small class="text-muted">(múltipla seleção)</small>
                                    </label>
                                    <div class="border rounded-3 p-3 lista-scroll">
                                        @foreach($cursos as $curso)
                                        <div class="mb-3">
                                            <div class="fw-semibold text-secondary mb-2">{{ $curso->nome }}</div>
                                            @foreach($curso->ucs as $uc)
                                            <div class="form-check mb-2 ms-3">
                                                <label class="form-check-label" for="uc{{ $curso->id }}-{{ $uc->id }}">{{ $uc->nome }}</label>
                                                <input class="form-check-input" type="checkbox" name="ucs[]" value="{{ $uc->id }}" id="uc{{ $curso->id }}-{{ $uc->id }}">
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer border-0 filter-tabs">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning text-white px-4">Salvar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>

</x-layout>