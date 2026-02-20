<x-layout titulo="Alunos - Senac">
    <div class="container-xl py-4 shadow">
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary" href="/dashboardAdm"><i class="bi bi-bar-chart"></i></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="/cursos"><i class="bi bi-backpack"></i> Cursos</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary " href="/unidadesCurriculares"><i class="bi bi-book"></i> UCs</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="/docentes"><i class="bi bi-person-workspace"></i> Docentes</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary active" href="/alunos"><i class="bi bi-person"></i> Alunos</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="/turmas"><i class="bi bi-people-fill"></i> Turmas</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="/aulas"><i class="bi bi-file-bar-graph"></i>
                    Aulas</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="/indicadores"><i class="bi bi-card-list"></i>
                    Indicadores</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" href="/relatorios"><i class="bi bi-clipboard-data"></i>
                    Relatórios</a>
            </li>
        </ul>

        <!-- Conteúdo principal -->
        <section class="container-fluid">

            <!-- Cabeçalho -->
            <div class="d-flex align-items-center justify-content-between  mb-3">
                <div>
                    <h2 class="fw-bold ">Alunos</h2>
                    <p class="text-muted">Editar os alunos matriculados</p>
                </div>
                <a href="/alunos" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <form action="../atualizarAluno/{{$dado->id}}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <!-- Nome -->
                        <div class="col">
                            <label class="form-label fw-semibold">Nome Completo *</label>
                            <input type="text" name="nomeAluno" class="form-control" placeholder="Nome completo do aluno"
                                value="{{$dado->nomeAluno}}" required>
                        </div>

                    </div>

                    <div class="row">
                        <!-- RA do Aluno -->
                        <div class="col">
                            <label class="form-label fw-semibold">RA (Registro Acadêmico) *</label>
                            <input type="text" name="ra" class="form-control" placeholder="1140279318"
                                value="{{$dado->ra}}" disabled>
                        </div>
                        <!-- CPF -->
                        <div class="col">
                            <label class="form-label fw-semibold">CPF *</label>
                            <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00"
                                value="{{$dado->cpf}}" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Data de Nascimento -->
                        <div class="col">
                            <label class="form-label fw-semibold">Data de Nascimento *</label>
                            <input type="date" name="dataNascimento" class="form-control"
                                value="{{$dado->dataNascimento}}" max="{{ now()->subYears(15)->format('Y-m-d') }}" required>
                        </div>
                        <!-- Data de Matrícula -->
                        <div class="col">
                            <label class="form-label fw-semibold">Data de Matrícula</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($dado->dataMatricula)->format('d/m/Y') }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Endereço -->
                        <div class="col">
                            <label class="form-label fw-semibold">Endereço *</label>
                            <input type="text" name="endereco" class="form-control"
                                placeholder="Rua, número, bairro, cidade" value="{{$dado->endereco}}" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Telefone -->
                        <div class="col">
                            <label class="form-label fw-semibold">Telefone *</label>
                            <input type="text" name="telefone" class="form-control" placeholder="(00) 00000-0000"
                                value="{{$dado->telefone}}" required>
                        </div>

                        <!-- Email -->
                        <div class="col">
                            <label class="form-label fw-semibold">Email *</label>
                            <input type="text" name="emailAluno" class="form-control" placeholder="email@senacsp.edu.br"
                                value="{{$dado->emailAluno}}" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Carga Horária Diária -->
                        <div class="col">
                            <label class="form-label fw-semibold">Tipo de Matrícula *</label>
                            <select name="tipo" class="form-select">
                                <option value="pagante" {{ $dado->tipo == 'pagante' ? 'selected' : '' }}>
                                    Pagante
                                </option>
                                <option value="bolsista" {{ $dado->tipo == 'bolsista' ? 'selected' : '' }}>
                                    Bolsista
                                </option>
                            </select>
                        </div>

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

                        <!-- Senha -->
                        <div class="row">
                            <div class="col">
                                <label class="form-label fw-semibold">Senha</label>
                                    <input type="password"  value="{{$dado->senhaAluno}}" name="senhaAluno" class="form-control"  required>
                            </div>

                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 filter-tabs mt-3 gap-3">
                    <button type="button" class="btn btn-danger text-white px-4" data-bs-toggle="modal"
                        data-bs-target="#modalExcluirAluno">
                        Excluir
                    </button>
                    <button type="submit" class="btn btn-warning text-white px-4">
                        Salvar
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalExcluirAluno" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir o aluno: {{ $dado->nomeAluno }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Não</button>
                                <a type="button" class="btn btn-danger" href="/excluirAluno/{{$dado->id}}">Sim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </section>
    </div>
</x-layout>