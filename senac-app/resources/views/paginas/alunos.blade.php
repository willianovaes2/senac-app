<x-layout titulo="Alunos - Senac">
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
                <a class="btn btn-primary active" href="alunos"><i class="bi bi-person"></i> Alunos</a>
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="fw-bold ">Alunos</h2>
                    <p class="text-muted">Gerencie os alunos matriculados</p>
                </div>

                <button class="btn btn-primary text-end" data-bs-toggle="modal" data-bs-target="#modalNovoAluno">
                    <i class="bi bi-plus-lg"></i> Novo Aluno
                </button>
            </div>

            <!-- Cards resumo -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card hover-shadow rounded-3 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Total de Alunos</small>
                                <h4 class="fw-bold mb-0">{{ $totalAlunos }}</h4>
                            </div>
                            <i class="bi bi-person fs-3 text-primary"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card hover-shadow rounded-3 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Alunos Pagantes</small>
                                <h4 class="fw-bold mb-0">{{ $alunosPagantes }}</h4>
                            </div>
                            <i class="bi bi-person-check fs-3 text-success"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card hover-shadow rounded-3 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Bolsistas</small>
                                <h4 class="fw-bold mb-0">{{ $alunosBolsistas }} </h4>
                            </div>
                            <i class="bi bi-award fs-3 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabela -->
            <div class="card shadow-sm rounded-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-muted">Aluno</th>
                                <th class="text-muted">Intenção do Aluno</th>
                                <th class="text-muted">RA</th>
                                <th class="text-muted">CPF</th>
                                <th class="text-muted">Telefone</th>
                                <th class="text-muted">Tipo</th>
                                <th class="text-muted">Status</th>
                                <th class="text-center text-muted">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($alunos->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Nenhum aluno encontrado
                                </td>
                            </tr>
                            @else
                            @foreach ($alunos as $aluno)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $aluno->nomeAluno }}</div>
                                    <small class="text-muted">{{ $aluno->emailAluno }}</small>
                                </td>

                                <td>{{ $aluno->intencao }}</td>
                                <td>{{ $aluno->ra }}</td>
                                <td>{{ $aluno->cpf }}</td>
                                <td>{{ $aluno->telefone }}</td>

                                <td>
                                    @if ($aluno->tipo === 'pagante')
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                        Pagante
                                    </span>
                                    @else
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3">
                                        Bolsista
                                    </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($aluno->status === 'ativo')
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
                                    <a href="/editarAlunos/{{$aluno->id}}"
                                        class="btn btn-sm btn-outline-dark me-1">
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
                                        value="{{ old('nomeAluno') }}" placeholder="Nome completo do aluno" required>
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
                                    <input type="text" class="form-control" value="Gerado automáticamente" disabled>
                                </div>
                                <!-- CPF -->
                                <div class="col">
                                    <label class="form-label fw-semibold">CPF *</label>
                                    <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" value="{{ old('cpf') }}" required>
                                    @error('cpf')
                                    <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <!-- Data de Nascimento -->
                                @if ($errors->has('dataNascimento'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('dataNascimento') }}
                                </div>
                                @endif
                                <div class="col">
                                    <label class="form-label fw-semibold">Data de Nascimento *</label>
                                    <input type="date" name="dataNascimento" class="form-control" max="{{ now()->subYears(15)->format('Y-m-d') }}" required>
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
                                        value="{{ old('endereco') }}" placeholder="Rua, número, bairro, cidade" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Telefone -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Telefone *</label>
                                    <input type="text" name="telefone" class="form-control"
                                        value="{{ old('telefone') }}" placeholder="(00) 00000-0000" required>
                                </div>

                                <!-- Email -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Email *</label>
                                    <input type="text" name="emailAluno" class="form-control" value="{{ old('emailAluno') }}" placeholder="email@senacsp.edu.br" required>
                                    @error('emailAluno')
                                    <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Carga Horária Diária -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Tipo de Matrícula *</label>
                                    <select name="tipo" class="form-select" required>
                                        <option value="pagante {{ old('tipo') == 'pagante' ? 'selected' : '' }}">Pagante</option>
                                        <option value="bolsista {{ old('tipo') == 'bolsista' ? 'selected' : '' }}">Bolsista</option>
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
                                    <input type="text" name="senhaAluno" class="form-control" value="{{ old('senhaAluno') }}" placeholder="Informe a senha do aluno" required>
                                </div>

                                <div class="col">

                                </div>
                            </div>

                            <div class="alert alert-primary d-flex align-items-start gap-2 mt-3">
                                <i class="bi bi-info-circle"></i>
                                <div class="w-75">
                                    <strong>Nota:</strong>
                                     O e-mail e o CPF devem ser únicos. Não será permitido cadastro com dados já existentes.
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

                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
    </div>
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
</x-layout>