<x-layout titulo="Avaliação Final - Senac">
    <section class="container-fluid">

        <!-- Cabeçalho -->
        <div class="d-flex align-items-center justify-content-between p-4">
            <div>
                <h2 class="fw-bold mb-1">Avaliação Final da UC</h2>
                <small>{{ $uc->codigoUc }}</small> : <small>{{ $uc->nome }}</small>
            </div>

            <a href="{{ route('centralAula', $aula->id) }}" class="btn btn-primary">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>

        <!-- Cards de estatísticas -->
        <div class="row d-flex justify-content-center mb-4">
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
                    <small>Desenvolvido</small>
                    <h4 id="cardDesenvolvido" class="fw-bold mb-0">{{ $desenvolvido ?? 0 }}</h4>
                </div>
            </div>

            <div class="col w-100">
                <div class="p-3 rounded-3 bg-danger-subtle text-danger hover-shadow">
                    <small>Não Desenvolvido</small>
                    <h4 id="cardNaoDesenvolvido" class="fw-bold mb-0">{{ $naoDesenvolvido ?? 0 }}</h4>
                </div>
            </div>
        </div>

        <!-- Requisitos -->
        <div class="alert alert-primary rounded-4 mb-4">
            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-circle"></i> Requisitos para aprovação:
            </div>
            <ul class="mb-0">
                <li>Mínimo de <strong>65% de presença</strong> nas aulas</li>
                <li>Conceito <strong>Desenvolvido</strong> ou <strong>Não Desenvolvido</strong></li>
            </ul>
        </div>

        <!-- Avaliação Final -->
        <div class="card shadow-sm rounded-4 p-4">
            <form action="{{ route('salvarFinal', $aula->id) }}" method="post">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Avaliação dos Alunos</h4>

                    <div class="d-flex align-items-center gap-2">
                        <span class="fw-semibold text-muted">
                            <i class="bi bi-people"></i> Aplicar para Todos:
                        </span>

                        <select id="conceitoGlobal" class="form-select form-select-sm" style="width: 180px;">
                            <option value="">Selecionar conceito</option>
                            <option value="Desenvolvido">Desenvolvido</option>
                            <option value="Não Desenvolvido">Não Desenvolvido</option>
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
                                style="width:40px;height:40px;">{{ $loop->iteration }}</div>

                            <div>
                                <strong>{{ $aluno->nome }}</strong><br>
                                <small class="text-muted">RA: {{ $aluno->ra }}</small>
                            </div>
                        </div>

                        <div>
                            <small class="text-muted d-block">Presença</small>
                            <span class="badge bg-success">{{ $aluno->presenca ?? 0 }}%</span>
                        </div>

                        <div style="width:200px;">
                            <small class="text-muted d-block">Conceito Final</small>
                            <select name="conceito_final[{{ $aluno->id }}]"
                                class="form-select conceito-final-select"
                                data-aluno="{{ $aluno->id }}">
                                <option value="">Selecionar</option>
                                <option value="Desenvolvido" {{ $aluno->conceito_final == 'Desenvolvido' ? 'selected' : '' }}>Desenvolvido</option>
                                <option value="Não Desenvolvido" {{ $aluno->conceito_final == 'Não Desenvolvido' ? 'selected' : '' }}>Não Desenvolvido</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-muted d-block" id="observacao"><small>Observação</small></label>
                            <textarea class="bg-light border" name="observacao" id="observacao" placeholder="Escreva sua aqui..." rows="1" style="resize: none;"></textarea>
                        </div>

                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#indicadores-{{ $aluno->id }}">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>

                    <div class="collapse border-top" id="indicadores-{{ $aluno->id }}">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Avaliação por Indicador</h6>
                            @foreach ($indicadores as $indicador)
                            <div class="border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="badge bg-light text-dark">{{ $indicador->codigo }}</span>
                                        <span class="ms-2">{{ $indicador->descricao }}</span>
                                    </div>

                                    <div style="width:200px;">
                                        @php
                                        $valorSalvo = '';
                                        if(isset($avaliacoesIndicadores[$aluno->id])) {
                                        $avaliacao = $avaliacoesIndicadores[$aluno->id]->firstWhere('indicador_id', $indicador->id);
                                        if($avaliacao) $valorSalvo = $avaliacao->conceito;
                                        }
                                        @endphp
                                        <select name="indicadores[{{ $aluno->id }}][{{ $indicador->id }}]"
                                            class="form-select indicador-select indicador-aluno-{{ $aluno->id }}">
                                            <option value="">Selecionar conceito</option>
                                            <option value="Desenvolvido" {{ $valorSalvo == 'Desenvolvido' ? 'selected' : '' }}>Desenvolvido</option>
                                            <option value="Não Desenvolvido" {{ $valorSalvo == 'Não Desenvolvido' ? 'selected' : '' }}>Não Desenvolvido</option>
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

    <!-- Script funcional para atualização dinâmica dos cards -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const conceitoGlobal = document.getElementById("conceitoGlobal");
            const btnAplicar = document.getElementById("btnAplicarTodos");

            function pegarSelectsFinais() {
                return document.querySelectorAll('.conceito-final-select');
            }

            function atualizarCards() {
                const selectsFinais = pegarSelectsFinais();
                const totalAlunos = selectsFinais.length;

                let avaliados = 0;
                let desenvolvido = 0;
                let naoDesenvolvido = 0;

                selectsFinais.forEach(select => {
                    const valor = select.value;
                    if (valor !== "") {
                        avaliados++;
                        if (valor === "Desenvolvido") desenvolvido++;
                        else if (valor === "Não Desenvolvido") naoDesenvolvido++;
                    }
                });

                document.getElementById("cardAvaliados").innerText = `${avaliados}/${totalAlunos}`;
                document.getElementById("cardDesenvolvido").innerText = desenvolvido;
                document.getElementById("cardNaoDesenvolvido").innerText = naoDesenvolvido;
            }

            // Atualizar ao mudar individualmente
            document.body.addEventListener("change", function(e) {
                if (e.target.classList.contains('conceito-final-select')) {
                    atualizarCards();
                }
            });

            // Habilitar botão aplicar global
            conceitoGlobal.addEventListener("change", function() {
                btnAplicar.disabled = this.value === "";
            });

            // Aplicar conceito global
            btnAplicar.addEventListener("click", function(e) {
                e.preventDefault();
                const valor = conceitoGlobal.value;
                if (valor === "") return;

                const selectsFinais = pegarSelectsFinais();
                selectsFinais.forEach(select => select.value = valor);

                document.querySelectorAll('.indicador-select').forEach(select => select.value = valor);

                atualizarCards();

                conceitoGlobal.value = "";
                btnAplicar.disabled = true;
            });

            // Atualiza ao carregar a página
            atualizarCards();
        });
    </script>
</x-layout>