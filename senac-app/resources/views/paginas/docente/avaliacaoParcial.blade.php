<x-layout titulo="Avaliação Parcial - Senac">
    <div class="container-xl px-4 shadow">
        <!-- Conteudo Principal -->
        <section class="container-fluid">

            <!-- Cabeçalho -->
            <div class="d-flex align-items-center justify-content-between p-4">
                <div>
                    <h2 class="fw-bold  mb-1">
                        Avaliação Parcial da UC <br>
                    </h2>
                    <small>{{ $uc->codigoUc }}</small> : <small>{{ $uc->nome }}</small>
                </div>

                <a href="{{ route('centralAula', $aula->id) }}" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>

            </div>

            <div class="row d-flex justify-content-center">
                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-primary-subtle text-primary hover-shadow">
                        <small>Total de Alunos</small>
                        <h4 id="cardTotal" class="fw-bold mb-0">{{ $totalAlunos }}</h4>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-dark-subtle hover-shadow">
                        <small>Avaliados</small>
                        <h4 id="cardAvaliados" class="fw-bold mb-0">{{ $avaliados }}/{{ $totalAlunos }}</h4>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-success-subtle text-success hover-shadow">
                        <small>Atendido</small>
                        <h4 id="cardAtendido" class="fw-bold mb-0">{{ $atendido }}</h4>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-warning-subtle text-warning hover-shadow">
                        <small>Parcialmente</small>
                        <h4 id="cardParcial" class="fw-bold mb-0">{{ $parcial }}</h4>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-danger-subtle text-danger hover-shadow">
                        <small>Não Atendido</small>
                        <h4 id="cardNaoAtendido" class="fw-bold mb-0">{{ $naoAtendido }}</h4>
                    </div>
                </div>
            </div>

            <!-- REQUISITOS -->
            <div class="alert alert-primary rounded-4 mt-4">
                <div class="fw-semibold mb-2">
                    <i class="bi bi-exclamation-circle"></i> Requisitos para Aprovação na UC:
                </div>
                <ul class="mb-0">
                    <li>Mínimo de <strong>65% de presença</strong> nas aulas</li>
                    <li>Conceito <strong>Atendido</strong>, <strong>Parcialmente Atendido</strong> ou <strong>Não
                            Atendido</strong></li>
                </ul>
            </div>

            <!-- AVALIAÇÃO -->
            <div class="card shadow-sm rounded-4 p-4 mt-4">

                <form action="{{ route('salvarParcial', $aula->id) }}" method="post">
                    @csrf
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Avaliação dos Alunos</h4>

                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-semibold text-muted">
                                <i class="bi bi-people"></i> Aplicar para Todos:
                            </span>

                            <select id="conceitoGlobal" class="form-select form-select-sm" style="width: 180px;">
                                <option value="">Selecionar conceito</option>
                                <option value="Atendido">Atendido</option>
                                <option value="Parcialmente Atendido">Parcialmente Atendido</option>
                                <option value="Não Atendido">Não Atendido</option>
                            </select>

                            <button type="button" id="btnAplicarTodos" class="btn btn-secondary btn-sm" disabled>
                                Aplicar
                            </button>
                        </div>
                    </div>

                    @foreach ($alunos as $aluno)
                    <div class="card mb-3 shadow-sm">


                        <div class="card-body d-flex justify-content-between align-items-center">

                            <div class="d-flex align-items-center gap-3">


                                <div class="rounded-circle bg-light text-primary fw-bold d-flex align-items-center justify-content-center"
                                    style="width:40px;height:40px;">
                                    {{ $loop->iteration }}
                                </div>


                                <div>
                                    <strong>{{ $aluno->nomeAluno     }}</strong><br>
                                    <small class="text-muted">RA: {{ $aluno->ra }}</small>
                                </div>
                            </div>


                            <div>
                                <small class="text-muted d-block">Presença</small>
                                <span class="badge bg-success">
                                    {{ $aluno->porcentagem_presenca }}%
                                </span>
                            </div>


                            <div style="width:200px;">
                                <small class="text-muted d-block">Conceito Final</small>
                                <select name="conceito_final[{{ $aluno->id }}]"
                                    class="form-select conceito-final-select"
                                    data-aluno="{{ $aluno->id }}">
                                    <option value="">Selecionar</option>
                                    <option value="Atendido">Atendido</option>
                                    <option value="Parcialmente Atendido">Parcialmente Atendido</option>
                                    <option value="Não Atendido">Não Atendido</option>
                                </select>
                            </div>


                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#indicadores-{{ $aluno->id }}">
                                <i class="bi bi-chevron-down"></i>
                            </button>

                        </div>


                        <div class="collapse border-top" id="indicadores-{{ $aluno->id }}">

                            <div class="card-body">

                                <h6 class="fw-semibold mb-3 ">Avaliação por Indicador</h6>
                                @foreach ($indicadores as $indicador)

                                <div class="border rounded p-3 mb-3">

                                    <div class="d-flex justify-content-between align-items-start">

                                        <div>
                                            <span class="badge bg-light text-dark">
                                                {{ $indicador->id }}
                                            </span>

                                            <strong class="ms-2">
                                                {{ $indicador->nome }}
                                            </strong>
                                        </div>

                                        <div style="width:200px;">
                                            @php
                                            $valorSalvo = '';

                                            if(isset($avaliacoesIndicadores[$aluno->id])) {
                                            $avaliacao = $avaliacoesIndicadores[$aluno->id]
                                            ->firstWhere('indicador_id', $indicador->id);

                                            if($avaliacao) {
                                            $valorSalvo = $avaliacao->conceito;
                                            }
                                            }
                                            @endphp
                                            <select name="indicadores[{{ $aluno->id }}][{{ $indicador->id }}]"
                                                class="form-select indicador-select indicador-aluno-{{ $aluno->id }}">
                                                <option value="">Selecionar conceito</option>
                                                <option value="Atendido" {{ $valorSalvo == 'Atendido' ? 'selected' : '' }}>Atendido</option>
                                                <option value="Parcialmente Atendido" {{ $valorSalvo == 'Parcialmente Atendido' ? 'selected' : '' }}>Parcialmente Atendido</option>
                                                <option value="Não Atendido" {{ $valorSalvo == 'Não Atendido' ? 'selected' : '' }}>Não Atendido</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                @endforeach

                            </div>

                        </div>

                    </div>
                    @endforeach
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="bi bi-floppy"></i> Salvar Avaliação
                        </button>
                    </div>
                </form>
            </div>

        </section>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const conceitoGlobal = document.getElementById("conceitoGlobal");
                const btnAplicar = document.getElementById("btnAplicarTodos");
                const selectsFinais = document.querySelectorAll('.conceito-final-select');
                const totalAlunos = selectsFinais.length;

                function atualizarCards() {

                    let avaliados = 0;
                    let atendido = 0;
                    let parcial = 0;
                    let naoAtendido = 0;

                    selectsFinais.forEach(select => {

                        const valor = select.value;

                        if (valor !== "") {

                            avaliados++;

                            if (valor === "Atendido") atendido++;
                            else if (valor === "Parcialmente Atendido") parcial++;
                            else if (valor === "Não Atendido") naoAtendido++;
                        }
                    });

                    document.getElementById("cardAvaliados").innerText =
                        avaliados + "/" + totalAlunos;

                    document.getElementById("cardAtendido").innerText = atendido;
                    document.getElementById("cardParcial").innerText = parcial;
                    document.getElementById("cardNaoAtendido").innerText = naoAtendido;
                }

                // Atualizar ao mudar individualmente
                selectsFinais.forEach(select => {
                    select.addEventListener("change", atualizarCards);
                });

                // Aplicar global
                conceitoGlobal.addEventListener("change", function() {
                    btnAplicar.disabled = this.value === "";
                });

                btnAplicar.addEventListener("click", function() {

                    const valor = conceitoGlobal.value;
                    if (valor === "") return;

                    // Atualiza conceito final
                    selectsFinais.forEach(select => {
                        select.value = valor;
                    });

                    // Atualiza todos indicadores também
                    document.querySelectorAll('.indicador-select').forEach(select => {
                        select.value = valor;
                    });

                    atualizarCards();

                    conceitoGlobal.value = "";
                    btnAplicar.disabled = true;
                });

                // Atualiza ao carregar a página
                atualizarCards();

            });
        </script>
    </div>
</x-layout>