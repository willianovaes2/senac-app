<x-layout titulo="Docentes - Senac">

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
                <a class="btn btn-primary active" href="docentes"><i class="bi bi-person-workspace"></i> Docentes</a>
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
                    <h2 class="fw-bold">Monitores de Educação Profissional</h2>
                    <p class="text-muted ">Gerencie os docentes cadastrados</p>
                </div>

                <a class="btn btn-primary text-end" data-bs-toggle="modal" data-bs-target="#modalNovoDocente">
                    <i class="bi bi-plus-lg me-1"></i> Novo Docente
                </a>
            </div>

            <!-- Cards -->
            <div class="row g-4">
                @if ($docentes->isEmpty())
                <div colspan="8" class="text-center text-muted py-4">
                    Nenhum Docente encontrado
                </div>
                @else

                @foreach ($docentes as $docente)
                <div class="col-md-6 col-lg-4 float-start">
                    <div class="card docente-card p-4 h-100 hover-shadow">

                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-3">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">{{ $docente->nomeDocente }}</h6>
                                <small class="text-muted">{{ $docente->emailDocente }}</small>
                            </div>
                        </div>

                        <ul class="list-unstyled small mb-3">
                            <li><strong>CPF:</strong> {{ $docente->cpf }}</li>
                            <li><strong>Telefone:</strong> {{ $docente->telefone }}</li>
                            <li><strong>Formação:</strong> {{ $docente->formacao }}</li>
                            <li><strong>Especialização:</strong> {{ $docente->especializacao }}</li>
                            <li><strong>Turno:</strong> {{ $docente->turno }}</li>
                            <li><strong>Carga Horária:</strong> {{ $docente->cargaHoraria }}</li>
                        </ul>

                        <div class="d-flex justify-content-between align-items-center mt-auto p-1">
                            @if ($docente->status === 'ativo')
                            <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                ativo
                            </span>
                            @else
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                inativo
                            </span>
                            @endif

                            <small class="text-muted">
                                Desde {{$docente->created_at->format('d/m/Y')}}
                            </small>
                        </div>

                        <div class="mt-auto d-flex">
                            <a href="/editarDocentes/{{$docente->id}}" class="btn btn-outline-dark btn-sm w-100">
                                <i class="bi bi-pencil me-1"></i> Editar
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
                @endif


            </div>
        </section>

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
                    <form action="/inserirDocente" method="POST">
                        @csrf

                        <div class="modal-body">
                            <div class="row">

                                <!-- Nome -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Nome Completo *</label>
                                    <input type="text" name="nomeDocente" class="form-control"
                                        value="{{ old('nomeDocente') }}" placeholder="Nome completo do docente" required>
                                </div>

                            </div>

                            <div class="row">
                                <!-- CPF -->
                                <div class="col">
                                    <label class="form-label fw-semibold">CPF *</label>
                                    <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}" placeholder="000.000.000-00" required>
                                    @error('cpf')
                                    <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Data de Nascimento -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Data de Nascimento *</label>
                                    <input type="date" name="dataNascimento" class="form-control" max="{{ now()->subYears(18)->format('Y-m-d') }}" required>
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
                                    <input type="text" name="emailDocente" class="form-control"
                                        value="{{ old('emailDocente') }}" placeholder="email@senacsp.edu.br" required>
                                    @error('emailDocente')
                                    <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Formação -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Formação (Graduação)</label>
                                    <input type="text" name="formacao" class="form-control"
                                        value="{{ old('formacao') }}" placeholder="Ex: Ciência da Computação">
                                </div>
                                <!-- Especialização -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Especialização (Pós)</label>
                                    <input type="text" name="especializacao" class="form-control"
                                        value="{{ old('especializacao') }}" placeholder="Ex: Banco de dados">
                                </div>
                                <!--Area-->
                                <div class="col">
                                    <label class="form-label fw-semibold">Área de Atuação</label>
                                    <input type="text" name="area" class="form-control"
                                        value="{{ old('area') }}" placeholder="Ex: Desenvolvedor BackEnd">
                                </div>
                            </div>

                            <div class="row">
                                <!-- Carga Horária Diária -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Carga Horária Diária *</label>
                                    <select name="cargaHoraria" value="{{ old('cargaHoraria') }}" class="form-select">
                                        <option value="4">4 horas</option>
                                        <option value="6">6 horas</option>
                                        <option value="8" selected>8 horas</option>
                                    </select>
                                </div>

                                <!-- Turno de Trabalho -->
                                <div class="col">
                                    <label class="form-label fw-semibold">Turno *</label>
                                    <select name="turno" class="form-select" value="{{ old('Turno') }}" required>
                                        <option value="">Selecione o turno</option>
                                        <option value="manha">Manhã</option>
                                        <option value="tarde">Tarde</option>
                                        <option value="noite">Noite</option>
                                        <option value="integral">Integral</option>
                                    </select>
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
                                    <label class="form-label fw-semibold">Senha</label>
                                    <input type="text" name="senhaDocente" class="form-control" value="{{ old('senhaDocente') }}" placeholder="Informe a senha do docente" required>
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

                    </form>

                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
    </div>
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('modalNovoDocente');

            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            }
        });
    </script>
    @endif
</x-layout>