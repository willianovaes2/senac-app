<x-layout titulo="Aulas - Senac">
    <div class="container-xl py-4 shadow">
 
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary" href="dashboardAdm"><i class="bi bi-bar-chart"></i> Dashboard</a>
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
                <a class="btn btn-primary" href="turmas"><i class="bi bi-people-fill"></i> Turmas</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary active" href="aulas"><i class="bi bi-file-bar-graph"></i> Aulas</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="indicadores"><i class="bi bi-card-list"></i> Indicadores</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="relatorios"><i class="bi bi-clipboard-data"></i> Relatórios</a>
            </li>
        </ul>
 
        <section class="container-fluid">
 
            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold mb-0">Aulas</h2>
                <small class="text-muted">Visualização automática das aulas geradas ao iniciar uma UC</small>
            </div>
 
            <!-- Card -->
            <div class="card border-0 shadow rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
 
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Data</th>
                                    <th>UC</th>
                                    <th>Curso</th>
                                    <th>Docente Responsável</th>
                                    <th>Status</th>
                                    <th>Turmas</th>
                                </tr>
                            </thead>
 
                            <tbody>
 
                                @forelse ($aulas as $ucNome => $grupo)
 
                                <!-- TITULO DA UC -->
                                <tr class="table-primary">
                                    <td colspan="6" class="fw-bold ps-4">
                                        {{ $ucNome }}
                                    </td>
                                </tr>
 
                                @foreach ($grupo as $aula)
                                <tr>
 
                                    <!-- DATA -->
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ \Carbon\Carbon::parse($aula->dia)->format('d/m/Y') }}
                                        </span>
                                    </td>
 
                                    <!-- UC -->
                                    <td class="fw-semibold">
                                        {{ $aula->uc->nome ?? '-' }}
                                    </td>
 
                                    <!-- CURSO -->
                                    <td>
                                        <span class="badge rounded-pill px-3" style="background:#e7f0ff;color:#1d4ed8;">
                                            {{ $aula->curso->nome ?? '-' }}
                                        </span>
                                    </td>
 
                                    <!-- DOCENTE -->
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $aula->docenteResponsavel->nomeDocente }}
                                        </span>
                                    </td>
 
                                    <!-- STATUS -->
                                    <td>
                                        @switch($aula->status_calculado)
 
                                        @case('prevista')
                                        <span class="badge bg-secondary-subtle text-secondary px-3">Prevista</span>
                                        @break
 
                                        @case('andamento')
                                        <span class="badge bg-warning-subtle text-warning px-3">Em andamento</span>
                                        @break
 
                                        @case('pendente')
                                        <span class="badge bg-warning-subtle text-warning px-3">Pendente</span>
                                        @break
 
                                        @default
                                        <span class="badge bg-light text-dark">—</span>
 
                                        @endswitch
                                    </td>
 
                                    <!-- TURMAS -->
                                    <td>
                                        @foreach($aula->turmas as $turma)
                                        <span class="badge rounded-pill px-3 me-1" style="background:#f3e8ff;color:#7c3aed;">
                                            {{ $turma->codigoTurma }}
                                        </span>
                                        @endforeach
                                    </td>
 
                                </tr>
                                @endforeach
 
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Nenhuma aula cadastrada
                                    </td>
                                </tr>
                                @endforelse
 
                            </tbody>
                        </table>
 
                    </div>
                </div>
            </div>
 
        </section>
    </div>
</x-layout>