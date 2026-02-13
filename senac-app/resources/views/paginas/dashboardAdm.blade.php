<x-layout titulo="Dashboard - Senac">
    <div class="container-xl py-4 shadow">
        <!-- Abas -->

        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary active" href="dashboardAdm"><i class="bi bi-bar-chart"></i>
                    Dashboard</a>
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
                <a class="btn btn-primary" href="relatórios"><i class="bi bi-clipboard-data"></i>
                    Relatórios</a>
            </li>
        </ul>

        <!-- Conteúdo Principal Dashboard -->

        <section class="container-fluid">
            <!-- Título -->
            <div class="mb-4">
                <h2 class="fw-bold">Dashboard</h2>
                <p class="text-muted">Bem-vindo ao Sistema de Gestão Acadêmica SENAC</p>
            </div>

            <!-- Cards de resumo -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card hover-shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Total de Cursos</small>
                                <h3 class="fw-bold mb-0">{{ $totalCursos }}</h3>
                            </div>
                            <div class="bg-primary text-white p-2">
                                <i class="bi bi-book fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card hover-shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Total de Docentes</small>
                                <h3 class="fw-bold mb-0">{{ $totalDocentes }}</h3>
                            </div>
                            <div class="bg-warning text-white p-2">
                                <i class="bi bi-mortarboard fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card hover-shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Total de Alunos</small>
                                <h3 class="fw-bold mb-0">{{ $totalAlunos }}</h3>
                            </div>
                            <div class="bg-success text-white p-2">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card hover-shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Turmas Ativas</small>
                                <h3 class="fw-bold mb-0">{{ $turmasAtivas }}</h3>
                            </div>
                            <div class="bg-purple text-white p-2">
                                <i class="bi bi-diagram-3 fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações rápidas -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Ações Rápidas</h5>

                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn btn-outline-warning w-100 py-3 text-start" style="color: black;"
                                data-bs-toggle="modal" data-bs-target="#modalNovoCurso">
                                <i class="bi bi-book me-1"></i>
                                <strong>Novo Curso</strong><br>
                                <small>Cadastrar curso</small>
                            </a>
                        </div>

                        <div class="col">
                            <a href="#" class="btn btn-outline-warning w-100 py-3 text-start" style="color: black;"
                                data-bs-toggle="modal" data-bs-target="#modalNovoDocente">
                                <i class="bi bi-mortarboard me-1"></i>
                                <strong>Novo Docente</strong><br>
                                <small>Cadastrar docente</small>
                            </a>
                        </div>

                        <div class="col">
                            <a href="#" class="btn btn-outline-warning w-100 py-3 text-start" style="color: black;"
                                data-bs-toggle="modal" data-bs-target="#modalNovoAluno">
                                <i class="bi bi-person-plus me-1"></i>
                                <strong>Novo Aluno</strong><br>
                                <small>Matricular aluno</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gestão de vínculos -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-2">
                        <i class="bi bi-link-45deg me-1"></i>
                        Gestão de Vínculos
                    </h5>
                    <p class="text-muted">
                        Gerencie os relacionamentos entre alunos, turmas, cursos, UCs e docentes
                    </p>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <a data-bs-toggle="modal" data-bs-target="#modalAlunoTurmas"
                                class="btn btn-light border-black w-100 text-start py-3" style="color: black;">
                                <i class="bi bi-person-lines-fill me-2"></i>
                                <strong>Aluno → Turma</strong><br>
                                <small>Matricular em turma</small>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a data-bs-toggle="modal" data-bs-target="#modalVincularUC"
                                class="btn btn-light border-black w-100 text-start py-3" style="color: black;">
                                <i class="bi bi-journal-bookmark me-2"></i>
                                <strong>Curso → UCs</strong><br>
                                <small>Vincular UCs ao curso</small>
                            </a>
                        </div>

                        <div data-bs-toggle="modal" data-bs-target="#modalVincularDocente" class="col-md-4">
                            <a href="#" class="btn btn-light border-black w-100 text-start py-3" style="color: black;">
                                <i class="bi bi-mortarboard me-2"></i>
                                <strong>Docente → Cursos</strong><br>
                                <small>Atribuir a cursos</small>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a data-bs-toggle="modal" data-bs-target="#modalVincularDocentesUC"
                                class="btn btn-light border-black w-100 text-start py-3" style="color: black;">
                                <i class="bi bi-people me-2"></i>
                                <strong>Docentes → UC</strong><br>
                                <small>Múltiplos docentes</small>
                            </a>
                        </div>

                        <div class="col-md-4">
                            <a data-bs-toggle="modal" data-bs-target="#modalVincularDocenteTurma"
                                class="btn btn-light border-black w-100 text-start py-3" style="color: black;">
                                <i class="bi bi-diagram-2 me-2"></i>
                                <strong>Docente → Turmas</strong><br>
                                <small>Múltiplas turmas</small>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Filtro -->
                <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap m-4">

                    <div class="filter-tabs btn-group shadow-sm">
                        <button class="btn btn-light active" data-filter="aluno-turma">
                            Aluno → Turma
                        </button>

                        <button class="btn btn-light" data-filter="curso-uc">
                            Cursos → UCs
                        </button>

                        <button class="btn btn-light" data-filter="docente-curso">
                            Docentes → Cursos
                        </button>

                        <button class="btn btn-light" data-filter="docente-uc">
                            Docentes → UCs
                        </button>

                        <button class="btn btn-light" data-filter="docente-turma">
                            Docentes → Turmas
                        </button>
                    </div>
                </div>

                <div class="relacionamento" data-tipo="aluno-turma">

                    <div class="d-flex align-items-center justify-content-between px-4">
                        <div>
                            <h5 class="fw-bold">Aluno → Turma</h5>
                        </div>
                    </div>

                    <div class="card shadow-sm rounded-2 m-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-muted">Código</th>
                                        <th class="text-muted">Aluno</th>
                                        <th class="text-muted">Turma</th>
                                        <th class="text-muted text-center">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($alunoTurmas as $vinculo)
                                    <tr>
                                        <td>{{ $vinculo->id }}</td>
                                        <td>{{ $vinculo->nomeAluno }}</td>
                                        <td>{{ $vinculo->codigoTurma }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="relacionamento d-none" data-tipo="curso-uc">

                    <div class="d-flex align-items-center justify-content-between px-4">
                        <div>
                            <h5 class="fw-bold">UCs → Cursos</h5>
                        </div>
                    </div>

                    <div class="card shadow-sm rounded-2 m-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-muted">Código</th>
                                        <th class="text-muted">Uc</th>
                                        <th class="text-muted">Curso</th>
                                        <th class="text-muted text-center">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($cursoUcs as $vinculo)
                                    <tr>
                                        <td>{{ $vinculo->id }}</td>
                                        <td>{{ $vinculo->codigoUc }}</td>
                                        <td>{{ $vinculo->nomeCurso }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="relacionamento d-none" data-tipo="docente-curso">

                    <div class="d-flex align-items-center justify-content-between px-4">
                        <div>
                            <h5 class="fw-bold">Docentes → Cursos</h5>
                        </div>
                    </div>

                    <div class="card shadow-sm rounded-2 m-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-muted">Código</th>
                                        <th class="text-muted">Docente</th>
                                        <th class="text-muted">Curso</th>
                                        <th class="text-muted text-center">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($docenteCursos as $vinculo)
                                    <tr>
                                        <td>{{ $vinculo->id }}</td>
                                        <td>{{ $vinculo->nomeDocente }}</td>
                                        <td>{{ $vinculo->nomeCurso }}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="relacionamento d-none" data-tipo="docente-uc">

                    <div class="d-flex align-items-center justify-content-between px-4">
                        <div>
                            <h5 class="fw-bold">Docentes → UCs</h5>
                        </div>
                    </div>

                    <div class="card shadow-sm rounded-2 m-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-muted">Código</th>
                                        <th class="text-muted">Docente</th>
                                        <th class="text-muted">UC</th>
                                        <th class="text-muted text-center">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($docenteUcs as $vinculo)
                                    <tr>
                                        <td>{{ $vinculo->id }}</td>
                                        <td>{{ $vinculo->nomeDocente }}</td>
                                        <td>{{ $vinculo->codigoUc}}</td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="relacionamento d-none" data-tipo="docente-turma">

                    <div class="d-flex align-items-center justify-content-between px-4">
                        <div>
                            <h5 class="fw-bold">Docentes → Turmas</h5>
                        </div>
                    </div>

                    <div class="card shadow-sm rounded-2 m-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-muted">Código</th>
                                        <th class="text-muted">Docente</th>
                                        <th class="text-muted">Turma</th>
                                        <th class="text-muted text-center">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($docenteTurmas as $vinculo)
                                    <tr>
                                        <td>{{ $vinculo->id }}</td>
                                        <td>{{ $vinculo->nomeDocente }}</td>
                                        <td>{{ $vinculo->codigoTurma}}</td>
                                        <td class="text-center">
                                            <a href="/vinculos/removerDocenteTurma" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                                        <option value="tecnico">Técnico</option>
                                        <option value="graduacao">Graduação</option>
                                        <option value="livre">Curso Livre</option>
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
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->

        <!-- Modal Novo Docente -->
        <div class="modal fade" id="modalNovoDocente" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0">

                    <!-- Header -->
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">Novo Docente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Form -->
                    <form action="/inserirDocente" method="POST" id="form-docente">
                        @csrf

                        <div class="modal-body">
                            <div class="row">

                                <!-- Nome -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Nome Completo *</label>
                                    <input type="text" name="nomeDocente" class="form-control"
                                        placeholder="Nome completo do docente" required>
                                </div>

                            </div>

                            <div class="row">
                                <!-- CPF -->
                                <div class="col">
                                    <label class="form-label fw-semibold">CPF *</label>
                                    <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00"
                                        required>
                                </div>

                                <!-- Data de Nascimento -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Data de Nascimento *</label>
                                    <input type="date" name="dataNascimento" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">

                                <!-- Endereço -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Endereço *</label>
                                    <input type="text" name="endereco" class="form-control"
                                        placeholder="Rua, número, bairro, cidade" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Telefone -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Telefone *</label>
                                    <input type="text" name="telefone" class="form-control"
                                        placeholder="(00) 00000-0000" required>
                                </div>

                                <!-- Email -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Email *</label>
                                    <input type="text" name="emailDocente" class="form-control"
                                        placeholder="email@senacsp.edu.br" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Formação -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Formação (Graduação)</label>
                                    <input type="text" name="formacao" class="form-control"
                                        placeholder="Ex: Ciência da Computação">
                                </div>
                                <!-- Especialização -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Especialização (Pós)</label>
                                    <input type="text" name="especializacao" class="form-control"
                                        placeholder="Ex: Banco de dados">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Carga Horária Diária -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Carga Horária Diária *</label>
                                    <select name="cargaHoraria" class="form-select">
                                        <option value="4">4 horas</option>
                                        <option value="6">6 horas</option>
                                        <option value="8" selected>8 horas</option>
                                    </select>
                                </div>

                                <!-- Turno de Trabalho -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Senha</label>
                                    <input type="text" name="senhaDocente" class="form-control" placeholder="Informe a senha do docente" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Carga Horária Diária -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Data de Cadastro</label>
                                    <input type="text" class="form-control" value="{{ now()->format('d/m/Y') }}"
                                        readonly>
                                </div>

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
                                    <!-- Turno de Trabalho -->
                                    <label class="form-label fw-semibold">Turnos</label>

                                    @if ($errors->has('turnos'))
                                    <div class="text-danger small mb-2">
                                        {{ $errors->first('turnos') }}
                                    </div>
                                    @endif

                                    <div class="lista-scroll">
                                        <div class="form-check">
                                            <input class="form-check-input turno-checkbox"
                                                type="checkbox" name="turno[]"
                                                value="manha" id="manha">
                                            <label class="form-check-label" for="manha">
                                                Manhã
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input turno-checkbox"
                                                type="checkbox" name="turno[]"
                                                value="tarde" id="tarde">
                                            <label class="form-check-label" for="tarde">
                                                Tarde
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input turno-checkbox"
                                                type="checkbox" name="turno[]"
                                                value="noite" id="noite">
                                            <label class="form-check-label" for="noite">
                                                Noite
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">

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

        <!-- Modal Novo Aluno -->
        <div class="modal fade" id="modalNovoAluno" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 border-0">

                    <!-- Header -->
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">Novo Aluno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Form -->
                    <form action="/inserirAluno" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row">

                                <!-- Nome -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Nome Completo *</label>
                                    <input type="text" name="nomeAluno" class="form-control"
                                        placeholder="Nome completo do aluno" required>
                                </div>

                            </div>

                            <div class="row">
                                <!-- Intenção do Aluno -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Intenção do Aluno *</label>
                                    <select name="intencao" class="form-select" required>
                                        <option value="">Selecione o curso</option>
                                        @foreach ($cursos as $curso)
                                        <option value="{{ $curso->nome }}">
                                            {{ $curso->nome }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- RA do Aluno -->
                                <div class="col">
                                    <label class="form-label fw-semibold">RA (Registro Acadêmico) *</label>
                                    <input type="text" name="ra" class="form-control" placeholder="1140279318" required>
                                </div>
                                <!-- CPF -->
                                <div class="col">
                                    <label class="form-label fw-semibold">CPF *</label>
                                    <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Data de Nascimento -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Data de Nascimento *</label>
                                    <input type="date" name="dataNascimento" class="form-control" required>
                                </div>
                                <!-- Data de Matrícula -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Data de Matrícula</label>
                                    <input type="text" class="form-control" value="{{ now()->format('d/m/Y') }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Endereço -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Endereço *</label>
                                    <input type="text" name="endereco" class="form-control"
                                        placeholder="Rua, número, bairro, cidade" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Telefone -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Telefone *</label>
                                    <input type="text" name="telefone" class="form-control"
                                        placeholder="(00) 00000-0000" required>
                                </div>

                                <!-- Email -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Email *</label>
                                    <input type="text" name="emailAluno" class="form-control"
                                        placeholder="email@senacsp.edu.br" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Carga Horária Diária -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Tipo de Matrícula *</label>
                                    <select name="tipo" class="form-select">
                                        <option value="pagante" selected>Pagante</option>
                                        <option value="bolsista">Bolsista</option>
                                    </select>
                                </div>

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
                                    <label class="form-label fw-semibold">Senha</label>
                                    <input type="text" name="senhaAluno" class="form-control" placeholder="Informe a senha do aluno" required>
                                </div>

                                <div class="col">

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

                        @if (session('success'))
                        <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px;">
                            {{ session('success') }}
                        </div>
                        @endif
                    </form>
                    @if ($errors->any())
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const modal = new bootstrap.Modal(
                                document.getElementById('modalNovoAluno')
                            );
                            modal.show();
                        });
                    </script>
                    @endif
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->

        <!-- Modal ALUNO - TURMAS -->

        <!-- Modal -->
        <div class="modal fade" id="modalAlunoTurma" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4">

                    <form action="/vinculos/alunoTurma" method="POST">
                        @csrf

                        <!-- Header -->
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-semibold">
                                <i class="bi bi-mortarboard text-warning me-2"></i>
                                Vincular Aluno a Cursos
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- Aluno -->
                            <div class="mb-3">
                                <label class="form-label">Selecione o Aluno</label>
                                <select name="aluno_id" class="form-select" required>
                                    <option value="">-- Selecione um Aluno --</option>
                                    @foreach ($alunos as $aluno)
                                    <option value="{{ $aluno->id }}">
                                        {{ $aluno->nomeAluno }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Turma -->
                            <div class="mb-2">
                                <label class="form-label">
                                    Selecione as Turmas
                                    <small class="text-muted">(múltipla seleção)</small>
                                </label>

                                <div class="border rounded p-3" style="max-height: 240px; overflow-y: auto;">
                                    @foreach ($turmas as $turma)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" value="{{ $turma->id }}" id="turma{{ $turma->id }}">
                                        <label class="form-check-label fw-semibold text-dark" for="turma{{ $turma->id }}">
                                            {{ $turma->codigoTurma }}
                                            <div class="small text-muted">
                                                {{ $turma->horasPorDia }}h
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Nota -->
                            <div class="alert alert-primary d-flex align-items-start gap-2 mt-3">
                                <i class="bi bi-info-circle"></i>
                                <div>
                                    <strong>Nota:</strong>
                                    Um aluno pode participar de diversas turmas.
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnVincularDocente">
                                Vincular
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DA MODAL -->

        <!-- Modal CURSO - UCs -->

        <!-- Modal -->
        <div class="modal fade" id="modalVincularUC" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4">

                    <form action="/vinculos/cursoUc" method="POST">
                        @csrf

                        <!-- Header -->
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-semibold">
                                <i class="bi bi-book text-warning me-2"></i>
                                Vincular UCs a Curso
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- Curso -->
                            <div class="mb-3">
                                <label class="form-label">Selecione o Curso</label>
                                <select name="curso_id" class="form-select" required>
                                    <option value="">-- Selecione um curso --</option>
                                    @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">
                                        {{ $curso->nome }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- UCs -->
                            <div class="mb-2">
                                <label class="form-label">
                                    Selecione as UCs <small class="text-muted">(múltipla seleção)</small>
                                </label>

                                <div class="border rounded p-3" style="max-height: 220px; overflow-y: auto;">

                                    @foreach ($ucs as $uc)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="ucs[]"
                                            value="{{ $uc->id }}"
                                            id="uc{{ $uc->id }}">

                                        <label class="form-check-label fw-semibold"
                                            for="uc{{ $uc->id }}">
                                            {{ $uc->nome }}
                                            <div class="small text-muted">
                                                {{ $uc->cargaHoraria }}h
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Nota -->
                            <div class="alert alert-primary d-flex align-items-start gap-2 mt-3">
                                <i class="bi bi-info-circle"></i>
                                <div>
                                    <strong>Nota:</strong> Um curso pode ter múltiplas UCs associadas.
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnVincular">
                                Vincular
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DA MODAL -->

        <!-- Modal -->
        <div class="modal fade" id="modalVincularDocenteCurso" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4">

                    <form action="" method="POST">
                        @csrf

                        <!-- Header -->
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-semibold">
                                <i class="bi bi-mortarboard text-warning me-2"></i>
                                Vincular Docente a Cursos
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- Docente -->
                            <div class="mb-3">
                                <label class="form-label">Selecione o Docente</label>
                                <select name="docente_id" class="form-select" required>
                                    <option value="">-- Selecione um docente --</option>
                                    @foreach ($docentes as $docente)
                                    <option value="{{ $docente->id }}">
                                        {{ $docente->nome }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Cursos -->
                            <div class="mb-2">
                                <label class="form-label">
                                    Selecione os Cursos
                                    <small class="text-muted">(múltipla seleção)</small>
                                </label>

                                <div class="border rounded p-3" style="max-height: 240px; overflow-y: auto;">
                                    @foreach ($cursos as $curso)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="cursos[]"
                                            value="{{ $curso->id }}" id="curso{{ $curso->id }}">
                                        <label class="form-check-label fw-semibold" for="curso{{ $curso->id }}">
                                            {{ $curso->nome }}
                                            <div class="small text-muted">
                                                {{ $curso->cargaHoraria }}h
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Nota -->
                            <div class="alert alert-primary d-flex align-items-start gap-2 mt-3">
                                <i class="bi bi-info-circle"></i>
                                <div>
                                    <strong>Nota:</strong>
                                    Um docente pode lecionar em múltiplos cursos, UCs e turmas.
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnVincularDocente">
                                Vincular
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->

        <!-- Modal -->
        <div class="modal fade" id="modalVincularDocenteUC" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4">

                    <form action="vinculos/docenteUc" method="POST">
                        @csrf

                        <!-- Header -->
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-semibold">
                                <i class="bi bi-mortarboard text-warning me-2"></i>
                                Vincular Docentes a UC
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- UC -->
                            <div class="mb-3">
                                <label class="form-label">Selecione a UC</label>
                                <select name="uc_id" class="form-select" required>
                                    <option value="">-- Selecione uma UC --</option>
                                    @foreach ($ucs as $uc)
                                    <option value="{{ $uc->id }}">
                                        {{ $uc->nome }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Docentes -->
                            <div class="mb-2">
                                <label class="form-label">
                                    Selecione os Docentes
                                    <small class="text-muted">(múltipla seleção)</small>
                                </label>

                                <div class="border rounded p-3" style="max-height: 240px; overflow-y: auto;">
                                    @foreach ($docentes as $docente)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="docentes[]"
                                            value="{{ $docente->id }}" id="docente{{ $docente->id }}">
                                        <label class="form-check-label fw-semibold" for="docente{{ $docente->id }}">
                                            {{ $docente->nomeDocente }}
                                            <div class="small text-muted">
                                                <p>{{ $docente->formacao }} {{ $docente->especializacao}} {{ $docente->area}}</p>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Nota -->
                            <div class="alert alert-primary d-flex align-items-start gap-2 mt-3">
                                <i class="bi bi-info-circle"></i>
                                <div>
                                    <strong>Nota:</strong>
                                    Múltiplos docentes podem lecionar a mesma UC em diferentes turmas ou horários.
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnVincularDocentes">
                                Vincular
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->

        <!-- Modal -->
        <div class="modal fade" id="modalVincularDocenteTurma" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content rounded-4">

                    <form action="/vinculos/docenteTurma" method="POST">
                        @csrf

                        <!-- Header -->
                        <div class="modal-header border-0">
                            <h5 class="modal-title fw-semibold">
                                <i class="bi bi-people text-warning me-2"></i>
                                Vincular Docente a Turmas
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- Docente -->
                            <div class="mb-3">
                                <label class="form-label">Selecione o Docente</label>
                                <select name="docente_id" class="form-select" required>
                                    <option value="">-- Selecione um docente --</option>
                                    @foreach ($docentes as $docente)
                                    <option value="{{ $docente->id }}">
                                        {{ $docente->nomeDocente }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Turmas -->
                            <div class="mb-2">
                                <label class="form-label">
                                    Selecione as Turmas
                                    <small class="text-muted">(múltipla seleção)</small>
                                </label>

                                <div class="border rounded p-3" style="max-height: 240px; overflow-y: auto;">
                                    @foreach ($turmas as $turma)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="turmas[]"
                                            value="{{ $turma->id }}" id="turma{{ $turma->id }}">
                                        <label class="form-check-label fw-semibold" for="turma{{ $turma->id }}">
                                            {{ $turma->curso->nome }} - {{ $turma->codigoTurma }}
                                            <div class="small text-muted">
                                                {{ $turma->turno }} - {{ $turma->alunos_count }} alunos
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Nota -->
                            <div class="alert alert-primary d-flex align-items-start gap-2 mt-3">
                                <i class="bi bi-info-circle"></i>
                                <div>
                                    <strong>Nota:</strong>
                                    Um docente pode lecionar para múltiplas turmas simultaneamente.
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnVincularTurmas">
                                Vincular
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
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
    </div>
</x-layout>