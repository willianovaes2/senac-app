<x-layout titulo="Relatorios - Senac">
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
                <a class="btn btn-primary" href="indicadores"><i class="bi bi-card-list"></i>
                    Indicadores</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary active" href="relatorios"><i class="bi bi-clipboard-data"></i>
                    Relatórios</a>
            </li>
        </ul>

        <!-- Conteudo Principal -->

        <section class="container-fluid">

            <!-- Cabeçalho -->
            <h2 class="fw-bold">Relatórios de Avaliação</h2>
            <p class="text-muted mb-4">Revise e aprove os relatórios enviados pelos docentes</p>

            <!-- Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card card-resumo p-3 hover-shadow">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Pendentes</small>
                                <h4 class="fw-bold text-warning">{{ $pendente }}</h4>
                            </div>
                            <i class="bi bi-clock text-warning fs-3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-resumo p-3 hover-shadow">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Aprovados</small>
                                <h4 class="fw-bold text-success">{{ $aprovado }}</h4>
                            </div>
                            <i class="bi bi-check-circle text-success fs-3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-resumo p-3 hover-shadow">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Rejeitados</small>
                                <h4 class="fw-bold text-danger">{{ $rejeitado }}</h4>
                            </div>
                            <i class="bi bi-x-circle text-danger fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtro -->
            <div class="d-flex justify-content-end align-items-center mb-3 gap-3 flex-wrap">


                <div class="filter-tabs btn-group shadow-sm">
                    <button class="btn btn-light">Todos</button>
                    <button class="btn btn-light">Pendentes</button>
                    <button class="btn btn-light">Aprovados</button>
                    <button class="btn btn-light">Rejeitados</button>
                </div>
            </div>

            <!-- TABELA -->
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-muted">Aluno</th>
                                <th class="text-muted">UC</th>
                                <th class="text-muted">Curso</th>
                                <th class="text-muted">Docente</th>
                                <th class="text-muted">Resultado</th>
                                <th class="text-muted">Data</th>
                                <th class="text-muted">Status</th>
                                <th class="text-muted">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($ids->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Nenhum relatório encontrado
                                </td>
                            </tr>
                            @else

                            @foreach ($ids as $avaliacao)
                            <tr>
                                <td>
                                    <strong>{{ $avaliacao->nome }}</strong><br>
                                    <small class="text-muted">RA: {{ $avaliacao->ra }}</small>
                                </td>

                                <td>{{ $avaliacao->uc }}</td>
                                <td>{{ $avaliacao->curso }}</td>
                                <td>{{ $avaliacao->docente }}</td>

                                <td>
                                    @if ($avaliacao->resultado === 'desenvolvido')
                                    <span class="badge badge-soft-success">
                                        Desenvolvido
                                    </span>
                                    @else
                                    <span class="badge badge-soft-danger">
                                        Não desenvolvido
                                    </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $avaliacao->data_avaliacao->format('d/m/Y') }}
                                </td>

                                <td>
                                    @if ($avaliacao->status === 'pendente')
                                    <span class="badge badge-soft-warning">
                                        Pendente
                                    </span>
                                    @else
                                    <span class="badge badge-soft-success">
                                        Concluído
                                    </span>
                                    @endif
                                </td>

                                <td>
                                    <a href="" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-file-earmark-text"></i> Ver
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
</x-layout>