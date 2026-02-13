<x-layout titulo="Editar Cursos - Senac">
    <div class="container-xl py-4 shadow">
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary" href="/dashboardAdm"><i class="bi bi-bar-chart"></i> Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary active" href="/cursos"><i class="bi bi-backpack"></i> Cursos</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/unidadesCurriculares"><i class="bi bi-book"></i> UCs</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/docentes"><i class="bi bi-person-workspace"></i> Docentes</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/alunos"><i class="bi bi-person"></i> Alunos</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/turmas"><i class="bi bi-people-fill"></i> Turmas</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/aulas"><i class="bi bi-person"></i> Aulas</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/indicadores"><i class="bi bi-person"></i> Indicadores</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/relatorios"> <i class="bi bi-clipboard-data"></i> Relatórios</a>
            </li>
        </ul>

        <!-- Conteúdo principal -->
        <section class="container-fluid">

            <!-- Cabeçalho -->
            <div class="d-flex align-items-center justify-content-between  mb-3">
                <div>
                    <h2 class="fw-bold">Cursos</h2>
                    <p class="text-muted">Editar e gerenciar cursos disponíveis</p>
                </div>
                <a href="/cursos" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <form action="/atualizarCurso/{{ $dado->id }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <!-- Nome -->
                        <div class="col">
                            <label class="form-label fw-semibold">Nome do Curso *</label>
                            <input type="text" id="name" name="nome" class="form-control" value="{{$dado->nome}}"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label fw-semibold">Sigla do Curso *</label>
                            <input type="text" name="sigla" class="form-control" value="{{ $dado->sigla }}" maxlength="5"
                                required>
                        </div>

                        <!-- Tipo -->
                        <div class="col">
                            <label class="form-label fw-semibold">Tipo *</label>
                            <select name="tipo" id="tipo" class="form-select" required>
                                <option value="">Selecione o tipo</option>
                                <option value="tecnico" {{ $dado->tipo == 'tecnico' ? 'selected' : '' }}>
                                    Técnico
                                </option>
                                <option value="graduacao" {{ $dado->tipo == 'graduacao' ? 'selected' : '' }}>
                                    Graduação
                                </option>
                                <option value="livre" {{ $dado->tipo == 'livre' ? 'selected' : '' }}>
                                    Curso Livre
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <!-- Turno de Trabalho -->
                            <label class="form-label fw-semibold">Selecione os dias da semana</label>

                            <div class="lista-scroll">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dias[]"
                                        value="segunda-feira"
                                        {{ in_array('segunda-feira', $dado->dias ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label">Segunda-feira</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dias[]"
                                        value="terca-feira"
                                        {{ in_array('terca-feira', $dado->dias ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label">Terça-feira</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dias[]"
                                        value="quarta-feira"
                                        {{ in_array('quarta-feira', $dado->dias ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label">Quarta-feira</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dias[]"
                                        value="quinta-feira"
                                        {{ in_array('quinta-feira', $dado->dias ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label">Quinta-feira</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dias[]"
                                        value="sexta-feira"
                                        {{ in_array('sexta-feira', $dado->dias ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label">Sexta-feira</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dias[]"
                                        value="sabado"
                                        {{ in_array('sabado', $dado->dias ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label">Sábado</label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Carga Horária -->
                        <div class="col">
                            <label class="form-label fw-semibold">Carga Horária (horas) *</label>
                            <input type="number" name="cargaHoraria" id="cargaHoraria" class="form-control"
                                value="{{$dado->cargaHoraria}}" required>
                        </div>

                        <!-- Preço -->
                        <div class="col">
                            <label class="form-label fw-semibold">Preço (R$) *</label>
                            <input type="number" name="preco" id="preco" class="form-control" min="0" step="0.01"
                                value="{{$dado->preco}}" required>
                        </div>

                        <!-- Vagas -->
                        <div class="col">
                            <label class="form-label fw-semibold">Número de Vagas *</label>
                            <input type="number" name="vagas" id="vagas" class="form-control" min="0"
                                value="{{$dado->vagas}}" required>
                        </div>

                    </div>

                    <div class="row">

                        <!-- Status -->
                        <div class="col">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="situacao" class="form-select">
                                <option value="ativo" {{ $dado->situacao == 'ativo' ? 'selected' : '' }}>
                                    Ativo
                                </option>
                                <option value="inativo" {{ $dado->situacao == 'inativo' ? 'selected' : '' }}>
                                    Inativo
                                </option>
                            </select>

                        </div>

                        <div class="col">
                            <!-- Bolsas -->
                            <label class="form-label fw-semibold">Bolsas de Estudo</label>
                            <input type="number" name="bolsas" id="bolsas" class="form-control" min="0"
                                value="{{$dado->bolsas}}">
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 filter-tabs mt-3 gap-3">
                    <button type="button" class="btn btn-danger text-white px-4" data-bs-toggle="modal" data-bs-target="#modalExcluirCurso">
                        Excluir
                    </button>
                    <button type="submit" class="btn btn-warning text-white px-4">
                        Salvar
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalExcluirCurso" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir o curso: {{ $dado->nome }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Não</button>
                                <a type="button" class="btn btn-danger" href="/excluirCurso/{{$dado->id}}">Sim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </section>
    </div>
</x-layout>