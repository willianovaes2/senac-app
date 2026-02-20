<x-layout titulo="Presença do Docente - Senac">
    <div class="container-xl py-4 shadow">

        <section class="container-fluid">

            <div class="border-0 mx-auto">
                <div>

                    <!-- Cabeçalho -->
                    <div class="d-flex align-items-center justify-content-between p-4">
                        <div>
                            <h2 class="fw-bold mb-1">
                                {{ $aula->uc->nome ?? '-' }}
                            </h2>
                            <small class="text-muted">ID da Aula: {{ $aula->id }}</small>
                        </div>

                        <a href="{{ route('telaInicial') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>

                    <!-- Informações -->
                    <div class="row g-3">

                        <!-- Professor -->
                        <div class="col">
                            <div class="bg-primary bg-opacity-10 rounded p-3 h-100">

                                <div class="d-flex align-items-center mb-1">
                                    <i class="bi bi-person-fill me-2 text-primary"></i>
                                    <small class="text-muted">Professor</small>
                                </div>

                                <p class="mb-0 fw-semibold text-primary">
                                    {{ $aula->docenteResponsavel->nomeDocente ?? 'Sem docente' }}
                                </p>

                            </div>
                        </div>

                        <!-- Horário -->
                        <div class="col">
                            <div class="bg-primary bg-opacity-10 rounded p-3 h-100">

                                <div class="d-flex mb-1">
                                    <i class="bi bi-clock-fill me-2 text-primary"></i>
                                    <small class="text-muted">Horário</small>
                                </div>

                                <p class="mb-0 fw-semibold text-primary">
                                    {{ $aula->uc->horaInicio ?? '--:--' }}
                                    /
                                    {{ $aula->uc->horaFim ?? '--:--' }}
                                </p>

                            </div>
                        </div>

                        <!-- Data atual -->
                        <div class="col">
                            <div class="bg-primary bg-opacity-10 rounded p-3 h-100">

                                <small class="text-muted mb-1">
                                    <i class="bi bi-calendar-event-fill me-2 text-primary"></i>
                                    Data Atual:
                                </small>

                                <span class="text-primary fw-semibold">
                                    {{ \Carbon\Carbon::parse($aula->dia)->format('d/m/Y') }}
                                </span>

                            </div>
                        </div>

                    </div>

                    <!-- Status UC -->
                    <section class="alert alert-success d-flex justify-content-between align-items-center mt-4">

                        <div>
                            <strong>Status:</strong>
                            {{ ucfirst($aula->status_calculado) }}
                            <br>

                            <small>
                                Dia da aula:
                                {{ \Carbon\Carbon::parse($aula->dia)->format('d/m/Y') }}
                            </small>
                        </div>

                    </section>

                    <!-- Botões -->
                    <div class="d-flex gap-2">

                        <a href="{{ route('chamada', $aula->id) }}" class="btn btn-primary w-50 mt-3 py-3">
                            <i class="bi bi-clipboard-check-fill me-2"></i>
                            Iniciar Chamada
                        </a>

                        <a href="{{ route('avaliacaoParcial', $aula->id) }}" class="btn btn-primary w-50 mt-3 py-3">
                            <i class="bi bi-clipboard-check-fill me-2"></i>
                            Avaliação Parcial
                        </a>

                        <a href="{{ route('avaliacaoFinal', $aula->id) }}" class="btn btn-success w-50 mt-3 py-3">
                            <i class="bi bi-clipboard-check-fill me-2"></i>
                            Avaliação Final
                        </a>

                    </div>

                </div>
            </div>

        </section>

    </div>
</x-layout>