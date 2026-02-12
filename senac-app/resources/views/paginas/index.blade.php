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
            <form action="login" method="GET">

                <fieldset class="d-flex">
                    <label class="d-flex btn btn-outline-primary" style="margin: auto;">
                        <input type="radio" name="opcao" value="3" class="" checked />
                        <span><i class="bi bi-backpack"></i> Estudante</span>
                    </label>
                    <label class="d-flex btn btn-outline-primary" style="margin: auto;">
                        <input type="radio" name="opcao" value="2" class="" />
                        <span><i class="bi bi-clipboard-data"></i> Professor</span>
                    </label>
                    <label class="d-flex btn btn-outline-primary" style="margin: auto;">
                        <input type="radio" name="opcao" value="1" class="" />
                        <span><i class="bi bi-buildings"></i> Instituição</span>
                    </label>
                </fieldset>

                <div class="mt-2">
                    <h4>Login</h4>
                    <p>Entre com suas credenciais</p>

                    <div class="row">
                        <div class="col">
                            <label for="email" class="form-label">Email: </label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="email@senacsp.edu.br" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="emailse" class="form-label">Senha: </label>
                            <input type="password" class="form-control" id="senha" name="senha"
                                placeholder="********" required>
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