<x-layout titulo="Editar Unidade Curricular - Senac">
    <div class="container-xl py-4 shadow">
        <!-- Abas -->
        <ul class="nav nav-pills gap-2 mb-4">
            <li class="nav-item">
                <a class="btn btn-primary" href="/dashboardAdm"><i class="bi bi-bar-chart"></i> Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary" href="/cursos"><i class="bi bi-backpack"></i> Cursos</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary active" href="/unidadesCurriculares"><i class="bi bi-book"></i> UCs</a>
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

        <!-- Conteudo Principal -->
        <section class="container-fluid">
            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold">Unidades Curriculares (UCs)</h2>
                    <p class="text-muted">Editar as unidades curriculares dos cursos</p>
                </div>

                <a href="/unidadesCurriculares" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <form action="/atualizarUc/{{$dado->id}}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <!-- Nome -->
                        <div class="col">
                            <label class="form-label fw-semibold">Nome da UC *</label>
                            <input type="text" name="nome" class="form-control"
                                placeholder="Ex: Desenvolvimento de Banco de Dados" value="{{$dado->nome}}" required>
                        </div>

                        <!-- Tipo -->
                        <div class="col">
                            <label class="form-label fw-semibold">Código *</label>
                            <input type="text" name="codigoUc" class="form-control" placeholder="Ex: UC10" value="{{$dado->codigoUc}}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="form-label fw-semibold">Curso *</label>
                            <select name="cursoCodigo" class="form-select" required>
                                <option value="">Selecione o curso</option>

                                @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}"
                                    {{ $curso->id == $dado->cursoCodigo ? 'selected' : '' }}>
                                    {{ $curso->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Carga Horária -->
                        <div class="col">
                            <label class="form-label fw-semibold">Carga Horária (horas) *</label>
                            <input type="number" name="cargaHoraria" class="form-control" min="0" value="{{$dado->cargaHoraria}}" required>
                        </div>

                        <!-- Presença Mínima -->
                        <div class="col">
                            <label class="form-label fw-semibold">Presença Mínima (%) *</label>
                            <input type="number" name="presencaMinima" class="form-control" min="0" value="{{$dado->presencaMinima}}" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Descrição -->
                        <div class="col">
                            <label class="form-label fw-semibold">Descrição</label>
                            <textarea rows="3" type="text" name="descricao" class="form-control"
                                placeholder="Descreva o conteúdo da UC..." style="resize: none;">{{$dado->descricao}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Status -->
                        <div class="col">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="ativo" {{ $dado->status == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo" {{ $dado->status == 'inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>
                        
                        <div class="col"></div>
                    </div>
                </div>


                <!-- Footer -->
                <div class="modal-footer border-0 filter-tabs mt-3 gap-3">
                    <button type="button" class="btn btn-danger text-white px-4" data-bs-toggle="modal"
                        data-bs-target="#modalExcluirUnidades">
                        Excluir
                    </button>
                    <button type="submit" class="btn btn-warning text-white px-4">
                        Salvar
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalExcluirUnidades" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir a Unidade Curricular: {{ $dado->nome }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Não</button>
                                <a type="button" class="btn btn-danger" href="/excluirUc/{{$dado->id}}">Sim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</x-layout>