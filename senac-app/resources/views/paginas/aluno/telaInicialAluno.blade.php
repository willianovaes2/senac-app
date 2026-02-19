<x-layout titulo="Área do Aluno - Senac">
    <div class="container-xl py-4 shadow">
        <!-- Conteudo Principal -->
        <section class="container-fluid">

            <!-- HEADER -->
            <div class="card shadow-sm rounded-4 p-4 mb-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="fw-bold text-primary mb-1">Controle de Presença</h4>
                        <small class="text-muted">Visualização do Aluno</small>
                    </div>
                </div>

                <hr>

                <div class="d-flex align-items-center gap-3">
                    <span class="badge rounded-pill bg-primary-subtle text-primary fs-6">👤</span>
                    @if($aluno)
                    <div>
                        <div class="fw-semibold">{{ $aluno->nomeAluno}}</div>
                        <small class="text-muted">{{ $aluno->ra}}</small>
                    </div>
                    @endif
                </div>
            </div>

            <!-- UC -->
            <div class="card shadow-sm rounded-4 p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-book fs-5"></i>
                        @if($ucAtual)
                        <div>
                            <div class="fw-bold">
                                {{ $ucAtual->nome }}
                                <span class="badge bg-success ms-2">Selecionada</span>
                            </div>
                            <small class="text-muted">
                                {{ $ucAtual->docente->nomeDocente ?? 'Docente não informado' }}
                            </small>
                        </div>
                        @else
                        <div>
                            <div class="fw-bold text-muted">Nenhuma UC disponível</div>
                            <small class="text-muted">Você ainda não possui unidades curriculares vinculadas.</small>
                        </div>
                        @endif
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-warning text-white dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Ver outras UCs
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <!-- UCs Passadas -->
                            @if($ucsPassadas->isNotEmpty())
                            <li class="dropdown-header">UCs Concluídas</li>
                            @foreach($ucsPassadas as $ucItem)
                            <li>
                                <a href="{{ request()->url() }}?uc_id={{ $ucItem->id }}"
                                    class="dropdown-item
                                    {{ isset($ucAtual) && $ucAtual->id == $ucItem->id ? 'active' : '' }}">
                                    {{ $ucItem->nome }}
                                </a>

                            </li>
                            @endforeach
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @endif

                            <!-- UCs Futuras -->
                            @if($ucsFuturas->isNotEmpty())
                            <li class="dropdown-header">Próximas UCs</li>
                            @foreach($ucsFuturas as $ucItem)
                            <li>
                                <a href="{{ request()->url() }}?uc_id={{ $ucItem->id }}"
                                    class="dropdown-item
                                {{ isset($ucAtual) && $ucAtual->id == $ucItem->id ? 'active' : '' }}">
                                    {{ $ucItem->nome }}
                                </a>

                            </li>
                            @endforeach
                            @endif

                            <!-- Caso não exista nenhuma -->
                            @if($ucsPassadas->isEmpty() && $ucsFuturas->isEmpty())
                            <li>
                                <span class="dropdown-item text-muted">
                                    Nenhuma outra UC disponível
                                </span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- STATUS -->
            @if(!empty($ucAtual))
            <div class="alert {{ $percentualPresenca >= 75 ? 'alert-success' : 'alert-danger' }} rounded-4 d-flex align-items-center gap-3 mb-4">
                <span class="badge {{ $percentualPresenca >= 75 ? 'bg-success' : 'bg-danger' }} rounded-pill fs-4">
                    {{ $percentualPresenca >= 75 ? '✔' : '⚠' }}
                </span>
                <div>
                    <div class="fw-bold fs-4">
                        {{ number_format($percentualPresenca, 1) }}%
                    </div>
                    <small>
                        {{ $percentualPresenca >= 75 ? 'Você está aprovado!' : 'Atenção ao limite de faltas.' }}
                    </small>
                </div>
            </div>
            @endif
            <!-- RESUMO -->
            <div class="row g-3 mb-4">
                @if(!empty($ucAtual))
                <div class="col-md-4">
                    <div class="p-3 bg-primary-subtle rounded-4">
                        <small>Total de Aulas</small>
                        <h3 class="fw-bold text-primary mb-0">{{ $totalAulas }}</h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-success-subtle rounded-4">
                        <small>Presenças</small>
                        <h3 class="fw-bold text-success mb-0">{{ $totalPresencas }}</h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-danger-subtle rounded-4">
                        <small>Faltas</small>
                        <h3 class="fw-bold text-danger mb-0">{{ $totalFaltas }}</h3>
                    </div>
                </div>
                @else
                <div class="text-center text-muted py-4">
                    Não há dados de presença para exibir.
                </div>
                @endif
            </div>
        </section>
    </div>
</x-layout>