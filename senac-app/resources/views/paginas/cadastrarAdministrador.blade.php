<x-layout titulo="cadastrar">
    <form class="container" action="inserirAdministrador" method="GET">
        @csrf

        <div class="mb3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" id="nome"></input>
        </div>

        <div class="mb3">
            <label class="form-label">CPF</label>
            <input type="number" name="cpf" class="form-control" id="cpf" placeholder="000.000.000-00" required></input>
        </div>

        <div class="mb3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="dataNascimento" class="form-control" id="dataNascimento" max="{{ now()->subYears(18)->format('Y-m-d') }}" required>
        </div>

        <div class="mb3">
            <label class="form-label">Telefone</label>
            <input type="number" name="telefone" class="form-control" id="telefone"></input>
        </div>

        <div class="mb3">
            <label class="form-label">Email</label>
            <input name="email" class="form-control" id="email"></input>
        </div>

        <div class="mb3">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="senha"></input>
        </div>

        <div class="col">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="ativo" selected>Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Salvar</button>   
    </form>
    <a class="btn btn-primary" href="/">Voltar</a>
</x-layout>