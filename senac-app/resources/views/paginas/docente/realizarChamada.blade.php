<x-layout titulo="Realizar Chamada - Senac">
    <div class="container-xl px-4 shadow">
        <!-- Conteudo Principal -->
        <section class="container-fluid">

            <!-- Cabeçalho -->
            <div class="d-flex align-items-center justify-content-between p-4">
                <div>
                    <h2 class="fw-bold  mb-1">
                        Realizar Chamada <br>
                    </h2>
                    <h6 class="text-muted">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</h6>
                </div>

                <a href="{{ route('centralAula', $aula->id) }}" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>

            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-primary-subtle text-primary hover-shadow">
                        <small>Total de Alunos</small>
                        <h4 class="fw-bold mb-0">{{ $totalAlunos }}</h4>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-success-subtle text-success hover-shadow">
                        <small>Presença</small>
                        <h4 class="fw-bold mb-0">{{ $totalPresenca }}</h4>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-danger-subtle text-danger hover-shadow">
                        <small>Faltas</small>
                        <h4 class="fw-bold mb-0">{{ $totalFaltas }}</h4>
                    </div>
                </div>

                <div class="col w-100">
                    <div class="p-3 rounded-3 bg-warning-subtle text-warning hover-shadow">
                        <small>% da Faltas</small>
                        <h4 class="fw-bold mb-0">{{ $percentualFalta }}%</h4>
                    </div>
                </div>
            </div>

            <form action="{{ route('salvarChamada', $aula->id) }}" method="POST">
                @csrf
                <!-- Lista de Alunos -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4"><i class="bi bi-people"></i> Lista de Alunos</h5>
                        <div class="mb-3">
                            <button type="button" class="btn btn-success btn-sm" onclick="marcarTodos(1)">
                                Marcar todos como Presença
                            </button>

                            <button type="button" class="btn btn-danger btn-sm" onclick="marcarTodos(0)">
                                Marcar todos como Falta
                            </button>
                        </div>
                        @foreach ($alunos as $aluno)
                        <div class="card aluno-card mb-3">
                            <div class="card-body d-grid gap-3">

                                <div class="flex-grow-1">
                                    <strong>{{ $aluno->nomeAluno }}</strong><br>
                                    <small class="text-muted">RA: {{ $aluno->ra }}</small>
                                </div>

                                <div class="d-flex">
                                    <!-- Presente -->
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="presenca[{{ $aluno->id }}]"
                                            id="presente_{{ $aluno->id }}" value="1" checked>
                                        <label class="form-check-label text-success" for="presente_{{ $aluno->id }}">
                                            Presente
                                        </label>
                                    </div>

                                    <!-- Falta -->
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="presenca[{{ $aluno->id }}]"
                                            id="falta_{{ $aluno->id }}" value="0">
                                        <label class="form-check-label text-danger" for="falta_{{ $aluno->id }}">
                                            Falta
                                        </label>
                                    </div>
                                </div>

                                <input type="text" name="observacao[{{ $aluno->id }}]"
                                    class="form-control w-100 bg-light" placeholder="Anotações sobre o aluno...">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <label class="fw-bold mb-2">Observações Gerais da Aula</label>
                    <textarea name="descricao" class="form-control bg-light" rows="3"
                        placeholder="Digite aqui observações gerais sobre a aula, comportamento da turma, conteúdo ministrado, etc..."
                        style="resize: none;"></textarea>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-warning w-100">
                        <i class="bi bi-floppy"></i> Salvar Chamada
                    </button>
                </div>
            </form>
        </section>
        <script>
            function marcarTodos(valor) {

                const radios = document.querySelectorAll('input[name^="presenca"]');

                radios.forEach(function(radio) {
                    if (radio.value == valor) {
                        radio.checked = true;
                    }
                });

            }
        </script>
    </div>
</x-layout>