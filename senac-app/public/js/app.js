// ===============================
// STATUS DA UC
// ===============================
function simularEstado(tipo) {

    const card = document.getElementById('ucStatusCard');
    const dataAtual = document.getElementById('dataAtual');
    const btnAvaliar = document.getElementById('btnAvaliar');

    btnAvaliar.classList.add('d-none');

    if (tipo === 1) {
        card.className = 'alert alert-success';
        card.innerHTML = `
            <strong>UC em andamento</strong><br>
            63 dias restantes<br>
            <small>Período: 19/01/2026 até 23/03/2026</small>
        `;
        dataAtual.innerText = '19/01/2026';
    }

    if (tipo === 2) {
        card.className = 'alert alert-warning';
        card.innerHTML = `
            <strong>Atenção: Próximo ao fim</strong><br>
            Restam 3 dias - Avaliação liberada<br>
            <small>Período: 19/01/2026 até 23/03/2026</small>
        `;
        dataAtual.innerText = '20/03/2026';
        btnAvaliar.classList.remove('d-none');
    }

    if (tipo === 3) {
        card.className = 'alert alert-warning';
        card.innerHTML = `
            <strong>Atenção: Próximo ao fim</strong><br>
            Restam 0 dias - Avaliação liberada<br>
            <small>Período: 19/01/2026 até 23/03/2026</small>
        `;
        dataAtual.innerText = '23/03/2026';
        btnAvaliar.classList.remove('d-none');
    }

    if (tipo === 4) {
        card.className = 'alert alert-danger';
        card.innerHTML = `
            <strong>UC finalizada</strong><br>
            Finalizada há 5 dias<br>
            <small>Período: 19/01/2026 até 23/03/2026</small>
        `;
        dataAtual.innerText = '28/03/2026';
        btnAvaliar.classList.remove('d-none');
    }
}


// ===============================
// FORMATAÇÃO DE DATA
// ===============================
function atualizarData(data) {
    const dias = ['domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado'];
    const meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];

    const d = new Date(data + 'T00:00');
    const texto = `${dias[d.getDay()]}, ${d.getDate()} de ${meses[d.getMonth()]} de ${d.getFullYear()}`;

    document.getElementById('dataFormatada').innerText = texto;
}


// ===============================
// FILTRO DE RELACIONAMENTOS
// ===============================
const filterButtons = document.querySelectorAll('[data-filter]');
const blocos = document.querySelectorAll('.relacionamento');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {

        filterButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const tipo = button.dataset.filter;

        blocos.forEach(bloco => {
            if (bloco.dataset.tipo === tipo) {
                bloco.classList.remove('d-none');
            } else {
                bloco.classList.add('d-none');
            }
        });
    });
});


// ===============================
// VALIDAÇÃO DE TURNOS (FORM DOCENTE)
// ===============================
document.getElementById('form-docente')?.addEventListener('submit', function (e) {

    const checkboxes = document.querySelectorAll('.turno-checkbox');
    let marcado = false;

    checkboxes.forEach(cb => {
        if (cb.checked) marcado = true;
    });

    if (!marcado) {
        e.preventDefault();

        let erro = document.getElementById('erro-turnos');

        if (!erro && checkboxes.length > 0) {
            erro = document.createElement('div');
            erro.id = 'erro-turnos';
            erro.className = 'text-danger small mb-2';
            erro.innerText = 'Selecione pelo menos um turno.';
            checkboxes[0].closest('.lista-scroll').before(erro);
        }

        checkboxes.forEach(cb => cb.classList.add('is-invalid'));
    }
});


// ===============================
// MODAL DETALHES DA TURMA
// ===============================
document.querySelectorAll('.btn-ver-turma').forEach(btn => {

    btn.addEventListener('click', function () {

        document.getElementById('modalTitulo').innerText =
            'Detalhes da Turma ' + this.dataset.nome;

        document.getElementById('modalCurso').innerText =
            this.dataset.curso;

        document.getElementById('modalStatus').innerText =
            this.dataset.status;

        document.getElementById('modalDocente').innerText =
            this.dataset.docente;

        document.getElementById('modalPeriodo').innerText =
            this.dataset.periodo;

        const alunos = JSON.parse(this.dataset.alunos);
        const lista = document.getElementById('listaAlunos');
        lista.innerHTML = '';

        document.getElementById('totalAlunos').innerText = alunos.length;

        alunos.forEach(aluno => {
            lista.innerHTML += `
                <div class="d-flex align-items-center bg-light rounded-3 p-3">
                    <div class="rounded-circle bg-warning text-white fw-bold
                        d-flex align-items-center justify-content-center me-3"
                        style="width: 40px; height: 40px;">
                        ${aluno.nome.charAt(0)}
                    </div>
                    <div>
                        <strong>${aluno.nome}</strong><br>
                        <small class="text-muted">RA: ${aluno.ra}</small>
                    </div>
                </div>
            `;
        });
    });
});


// ===============================
// APLICAR CONCEITO GLOBAL
// ===============================
document.addEventListener('DOMContentLoaded', function () {

    const conceitoGlobal = document.getElementById('conceitoGlobal');
    const btnAplicar = document.getElementById('btnAplicarTodos');

    if (conceitoGlobal && btnAplicar) {

        conceitoGlobal.addEventListener('change', function () {
            btnAplicar.disabled = !this.value;
        });

        btnAplicar.addEventListener('click', function () {

            const conceito = conceitoGlobal.value;
            if (!conceito) return;

            if (!confirm("Deseja aplicar este conceito para todos os alunos?")) {
                return;
            }

            document.querySelectorAll('.conceito-final-select')
                .forEach(select => select.value = conceito);

            document.querySelectorAll('.indicador-select')
                .forEach(select => select.value = conceito);

            alert("Conceito aplicado com sucesso!");
        });
    }
});


// ===============================
// HABILITAR BOTÃO SALVAR QUANDO TODOS INDICADORES PREENCHIDOS
// ===============================
document.addEventListener('DOMContentLoaded', function () {

    const btnSalvar = document.getElementById('btnSalvar');
    if (!btnSalvar) return;

    function verificarIndicadores() {

        const selects = document.querySelectorAll('.indicador-select');
        let todosPreenchidos = true;

        selects.forEach(select => {
            if (!select.value) {
                todosPreenchidos = false;
            }
        });

        btnSalvar.disabled = !todosPreenchidos;
    }

    document.querySelectorAll('.indicador-select')
        .forEach(select => {
            select.addEventListener('change', verificarIndicadores);
        });

    verificarIndicadores();
});


// ===============================
// BUSCAR DADOS DE PRESENÇA
// ===============================
document.querySelectorAll('.uc-item').forEach(item => {

    item.addEventListener('click', function (e) {
        e.preventDefault();

        const ucId = this.dataset.ucId;

        // ⚠ IMPORTANTE:
        // você precisa definir alunoId corretamente no Blade:
        // const alunoId = {{ $aluno->id }};
        // ou colocar como data-attribute

        fetch(`/presenca/dados/${ucId}/${alunoId}`)
            .then(response => response.json())
            .then(data => {

                document.getElementById('percentual').innerText = data.percentual + '%';
                document.getElementById('totalAulas').innerText = data.total_aulas;
                document.getElementById('presencas').innerText = data.presencas;
                document.getElementById('faltas').innerText = data.faltas;

            });
    });

});
