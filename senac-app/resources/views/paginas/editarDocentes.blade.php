<x-layout titulo="Editar Docentes - Senac">
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
                <a class="btn btn-primary" href="/unidadesCurriculares"><i class="bi bi-book"></i> UCs</a>
            </li>

            <li class="nav-item">
                <a class="btn btn-primary active" href="/docentes"><i class="bi bi-person-workspace"></i> Docentes</a>
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
                    <h2 class="fw-bold">Monitores de Educação Profissional</h2>
                    <p class="text-muted ">Editar o docente cadastrado</p>
                </div>

                <a href="/docentes" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>


            <form action="/atualizarDocente/{{$dado->id}}" method="POST" id="form-editar-docente">

                @csrf

                <div class="modal-body">

                    <div class="row">

                        <!-- Nome -->
                        <div class="col">
                            <label class="form-label fw-semibold">Nome Completo *</label>
                            <input type="text" name="nomeDocente" class="form-control" placeholder="Nome completo do docente" value="{{$dado->nomeDocente}}"
                                required>
                        </div>

                    </div>

                    <div class="row">
                        <!-- CPF -->
                        <div class="col">
                            <label class="form-label fw-semibold">CPF *</label>
                            <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" value="{{$dado->cpf}}" required>
                        </div>

                        <!-- Data de Nascimento -->
                        <div class="col">
                            <label class="form-label fw-semibold">Data de Nascimento *</label>
                            <input type="date" name="dataNascimento" class="form-control" value="{{$dado->dataNascimento}}" required>
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
                            <input type="text" name="telefone" class="form-control" placeholder="(00) 00000-0000" value="{{$dado->telefone}}" required>
                        </div>

                        <!-- Email -->
                        <div class="col">
                            <label class="form-label fw-semibold">Email *</label>
                            <input type="text" name="emailDocente" class="form-control" placeholder="email@senacsp.edu.br" value="{{$dado->emailDocente}}" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Formação -->
                        <div class="col">
                            <label class="form-label fw-semibold">Formação (Graduação)</label>
                            <input type="text" name="formacao" class="form-control" value="{{$dado->formacao}}" placeholder="Ex: Ciência da Computação" required>
                        </div>
                        <!-- Especialização -->
                        <div class="col">
                            <label class="form-label fw-semibold">Especialização (Pós)</label>
                            <input type="text" name="especializacao" class="form-control" value="{{$dado->especializacao}}" placeholder="Ex: Banco de dados" required>
                        </div>

                        <!--Area-->
                        <div class="col">
                            <label class="form-label fw-semibold">Área de Atuação</label>
                            <input type="text" name="area" class="form-control"
                                value="{{$dado->area}}" placeholder="Ex: Desenvolvedor BackEnd" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Carga Horária Diária -->
                        <div class="col">
                            <label class="form-label fw-semibold">Carga Horária Diária *</label>
                            <select name="cargaHoraria" class="form-select">
                                <option value="4" {{ $dado->cargaHoraria == 4 ? 'selected' : '' }}>4 horas</option>
                                <option value="6" {{ $dado->cargaHoraria == 6 ? 'selected' : '' }}>6 horas</option>
                                <option value="8" {{ $dado->cargaHoraria == 8 ? 'selected' : '' }}>8 horas</option>
                            </select>

                        </div>

                        <div class="col">
                            <!-- Senha -->
                            <label class="form-label fw-semibold">Senha</label>
                            <input type="password" name="senhaDocente" class="form-control" value="{{$dado->senhaDocente}}" placeholder="Informe a senha do docente" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Carga Horária Diária -->
                        <div class="col">
                            <label class="form-label fw-semibold">Data de Cadastro</label>
                            <input type="text" class="form-control" value="{{$dado->dataCadastro}}" readonly>
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

                                <label class="form-label fw-semibold">Turnos</label>

                                @if ($errors->has('turno'))
                                <div class="text-danger small mb-2">
                                    {{ $errors->first('turno') }}
                                </div>
                                @endif
                                <div class="lista-scroll">
                                    <div class="form-check">
                                        <input class="form-check-input turno-checkbox"
                                            type="checkbox"
                                            name="turno[]"
                                            value="manha"
                                            {{ in_array('manha', $dado->turno ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label">Manhã</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input turno-checkbox"
                                            type="checkbox" name="turno[]" value="tarde"
                                            {{ in_array('tarde', $dado->turno ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label">Tarde</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input turno-checkbox"
                                            type="checkbox" name="turno[]" value="noite"
                                            {{ in_array('noite', $dado->turno ?? []) ? 'checked' : '' }}>

                                        <label class="form-check-label">Noite</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 filter-tabs mt-3 gap-3">
                    <button type="button" class="btn btn-danger text-white px-4" data-bs-toggle="modal"
                        data-bs-target="#modalExcluirDocentes">
                        Excluir
                    </button>
                    <button type="submit" class="btn btn-warning text-white px-4">
                        Salvar
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalExcluirDocentes" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir o compromisso: {{$dado->nome}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Não</button>
                                <a type="button" class="btn btn-danger" href="/excluirDocente/{{$dado->id}}">Sim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </section>
    </div>

    <script>
        const form = document.getElementById('form-editar-docente');
        const checkboxes = document.querySelectorAll('.turno-checkbox');

        form.addEventListener('submit', function(e) {
            const algumMarcado = Array.from(checkboxes).some(cb => cb.checked);
            let erro = document.getElementById('erro-turnos');

            if (!algumMarcado) {
                e.preventDefault();

                if (!erro) {
                    erro = document.createElement('div');
                    erro.id = 'erro-turnos';
                    erro.className = 'text-danger small mb-2';
                    erro.innerText = 'Selecione pelo menos um turno.';
                    checkboxes[0].closest('.lista-scroll').prepend(erro);
                }
            }
        });

        // remove erro assim que marcar qualquer checkbox
        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                const erro = document.getElementById('erro-turnos');
                if (erro) erro.remove();
            });
        });
    </script>


</x-layout>