<x-layout titulo="Login - Senac">
    <div class="main">
        <div class="login-box shadow-lg">
            <div class="title">
                <img src="/images/logo-senac.png" alt="logotipo SENAC" width="420">
            </div>
            @if(session('erro'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            <form action="login" method="POST">
                @csrf
                <fieldset class="d-flex">
                    <label class="d-flex btn btn-outline-primary" style="margin: auto;">
                        <input type="radio" name="opcao" value="aluno" class="" checked />
                        <span><i class="bi bi-backpack"></i> Aluno</span>
                    </label>
                    <label class="d-flex btn btn-outline-primary" style="margin: auto;">
                        <input type="radio" name="opcao" value="docente" class="" />
                        <span><i class="bi bi-clipboard-data"></i> Docente</span>
                    </label>
                    <label class="d-flex btn btn-outline-primary" style="margin: auto;">
                        <input type="radio" name="opcao" value="administrador" class="" />
                        <span><i class="bi bi-buildings"></i> Administrador</span>
                    </label>
                </fieldset>

                <div id="formLogin">
                    <h4>Login</h4>
                    <p>Entre com suas credenciais</p>

                    <div class="row">
                        <div class="col">
                            <label for="lCpf" class="form-label">Email: </label>
                            <input type="text" class="form-control" id="emailLogin" name="emailLogin"
                                placeholder="email@senacsp.edu.br">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="emailse" class="form-label">Senha: </label>
                            <input type="password" class="form-control" id="senhaLogin" name="senhaLogin"
                                placeholder="Digite sua senha" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-end">
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-layout>