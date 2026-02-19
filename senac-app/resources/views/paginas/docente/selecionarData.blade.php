<x-layout titulo="Selecionar Data da Aula - Senac">
    <!-- Conteudo Principal -->
    <section class="container-fluid">

        <div class="container mt-4">

            <div class="d-flex align-items-center justify-content-between p-1">
                <div>
                    <!-- TITULO -->
                    <h4 class="fw-bold mb-1">Selecionar Data da Aula</h4>
                    <p class="text-muted">Escolha o dia para registrar a presença</p>
                </div>

                <a href="/presencaDocente.html" class="text-end btn btn-primary">
                    <i class="bi bi-arrow-left me-1"></i> Voltar
                </a>
            </div>

            <!-- Card da Data -->
            <div class="card card-data border-primary bg-light mt-4"
                onclick="document.getElementById('data').showPicker()">
                <div class="card-body">

                    <small class="text-primary fw-semibold">
                        <i class="bi bi-calendar"></i>
                        Data Selecionada <br>
                        <span class="text-muted">Clique para alterar</span>
                    </small>

                    <!-- Input Date -->
                    <input type="date" id="data" name="data" class="input-date mt-2" min="2026-01-19"
                        max="2026-03-23" value="2026-01-19" onchange="atualizarData(this.value)">

                    <!-- Texto formatado -->
                    <div id="dataFormatada" class="mt-2 fw-semibold">
                        segunda-feira, 19 de janeiro de 2026
                    </div>

                </div>
            </div>

            <!-- INPUT DATE REAL (ESCONDIDO) -->
            <input type="date" id="inputData" class="d-none" min="2026-01-19" max="2026-03-23" value="2026-01-19">

            <!-- INFO -->
            <div class="alert alert-warning mt-4">
                <i class="bi bi-info-circle"></i>
                Você pode fazer a chamada de qualquer dia dentro do período da UC
                (19/01/2026 até 23/03/2026).
            </div>

            <!-- BOTÃO -->
            <a href="realizarChamada.html" class="btn btn-warning w-100 ">
                <i class="bi bi-check2-square"></i>
                Continuar com esta Data
            </a>

        </div>
    </section>
</x-layout>