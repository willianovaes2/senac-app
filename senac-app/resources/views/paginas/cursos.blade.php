<x-layout titulo="Cursos - Senac">

    <div class="container-xl py-4 shadow">
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary" href="dashboardAdm"><i class="bi bi-bar-chart"></i></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary active" href="cursos"><i class="bi bi-backpack"></i> Cursos</a>
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

        <!-- Conteúdo principal -->
        <section class="container-fluid">

            <!-- Cabeçalho -->
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h2 class="fw-bold">Cursos</h2>
                    <p class="text-muted">Cadastre e gerencie cursos disponíveis</p>
                </div>
                <a class="text-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNovoCurso"><i class="bi bi-plus-lg me-1"></i>Novo Curso</a>
            </div>

            <!-- Tabela de Cursos -->
            <div class="card shadow-sm rounded-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-muted">Curso</th>
                                <th class="text-muted">Tipo</th>
                                <th class="text-muted">Dias da semana</th>
                                <th class="text-muted">Carga Horária</th>
                                <th class="text-muted">Vagas</th>
                                <th class="text-muted">Preço</th>
                                <th class="text-muted">Status</th>
                                <th class="text-center text-muted">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($ids->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Nenhum curso encontrado
                                </td>
                            </tr>
                            @else

                            @foreach ($ids as $curso)
                            <tr>

                                <td>
                                    <div class="fw-semibold">{{ $curso->nome }}</div>
                                    <small class="text-muted">{{ $curso->horario }}</small>
                                </td>

                                <td>{{ $curso->tipo }}</td>

                                {{-- DIAS DA SEMANA (RESUMIDO) --}}
                                <td>
                                    @php
                                    $ordem = [
                                    'segunda-feira',
                                    'terca-feira',
                                    'quarta-feira',
                                    'quinta-feira',
                                    'sexta-feira',
                                    'sabado'
                                    ];

                                    $dias = $curso->dias ?? [];

                                    usort($dias, fn($a, $b) =>
                                    array_search($a, $ordem) <=> array_search($b, $ordem)
                                        );

                                        $indices = array_map(
                                        fn($d) => array_search($d, $ordem),
                                        $dias
                                        );

                                        $sequencial = count($indices) > 1 &&
                                        max($indices) - min($indices) + 1 === count($indices);
                                        @endphp

                                        @if (!empty($dias))
                                        @if ($sequencial)
                                        {{ ucfirst(str_replace('-', ' ', $ordem[min($indices)])) }}
                                        a
                                        {{ ucfirst(str_replace('-', ' ', $ordem[max($indices)])) }}
                                        @else
                                        {{ implode(', ', array_map(
                            fn($d) => ucfirst(str_replace('-', ' ', $d)),
                            $dias
                        )) }}
                                        @endif
                                        @else
                                        —
                                        @endif
                                </td>

                                <td>{{ $curso->cargaHoraria }}</td>
                                <td>{{ $curso->vagas }} ({{ $curso->bolsas }} bolsas)</td>
                                <td>R$ {{ number_format($curso->preco, 2, ',', '.') }}</td>

                                <td>
                                    @if ($curso->situacao === 'ativo')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                        ativo
                                    </span>
                                    @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                        inativo
                                    </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="/editarCurso/{{ $curso->id }}" class="btn btn-sm btn-outline-dark me-1">
                                        <i class="bi bi-pencil"></i>
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

        <!-- Modal Novo Curso -->
        <div class="modal fade" id="modalNovoCurso" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0">

                    <!-- Header -->
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">Novo Curso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Form -->
                    <form action="/inserir" method="POST">

                        @csrf

                        <div class="modal-body">
                            <div class="row g-3">
                                <!-- Nome -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Nome do Curso *</label>
                                    <input type="text" name="nome" class="form-control" placeholder="Ex: Técnico em Informática"
                                        required>
                                </div>

                                <!-- Sigla -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Sigla *</label>
                                    <input type="text" name="sigla" class="form-control text-uppercase" placeholder="TI, ADM..." maxlength="5"
                                        required>
                                </div>

                                <!-- Tipo -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Tipo *</label>
                                    <select name="tipo" class="form-select" required>
                                        <option value="">Selecione</option>
                                        <option value="Técnico">Técnico</option>
                                        <option value="Graduação">Graduação</option>
                                        <option value="Livre">Curso Livre</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <!-- Dias da Semana -->
                                    <label class="form-label fw-semibold">Selecione os dias da semana</label>

                                    @if ($errors->has('dias'))
                                    <div class="alert alert-danger py-2 mb-2">
                                        {{ $errors->first('dias') }}
                                    </div>
                                    @endif

                                    <div class="lista-scroll">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dias[]"
                                                value="segunda-feira" id="segunda-feira">
                                            <label class="form-check-label" for="segunda-feira">
                                                Segunda-feira
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dias[]"
                                                value="terca-feira" id="terca-feira">
                                            <label class="form-check-label" for="terca-feira">
                                                Terça-feira
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dias[]"
                                                value="quarta-feira" id="quarta-feira">
                                            <label class="form-check-label" for="quarta-feira">
                                                Quarta-feira
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dias[]"
                                                value="quinta-feira" id="quinta-feira">
                                            <label class="form-check-label" for="quinta-feira">
                                                Quinta-feira
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dias[]"
                                                value="sexta-feira" id="sexta-feira">
                                            <label class="form-check-label" for="sexta-feira">
                                                Sexta-feira
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="dias[]"
                                                value="sabado" id="sabado">
                                            <label class="form-check-label" for="sabado">
                                                Sábado
                                            </label>
                                        </div>
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

                                <!-- Preço -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Preço (R$) *</label>
                                    <input type="number" name="preco" class="form-control" min="0" step="0.01" value="0"
                                        required>
                                </div>

                                <!-- Vagas -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Número de Vagas *</label>
                                    <input type="number" name="vagas" class="form-control" min="0" value="0" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Bolsas -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Bolsas de Estudo</label>
                                    <input type="number" name="bolsas" class="form-control" min="0" value="0">
                                </div>

                                <!-- Status -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select name="situacao" class="form-select">
                                        <option value="ativo" selected>Ativo</option>
                                        <option value="inativo">Inativo</option>
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

    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(
                document.getElementById('modalNovoCurso')
            );
            modal.show();
        });
    </script>
    @endif


</x-layout>