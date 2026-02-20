<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <script src="../js/app.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sanchez:ital@0;1&display=swap" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <div class="header-top shadow">
            @if(session('usuario') && !request()->is('/'))
            <form action="/logout" method="POST" class="d-inline m-2">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm border-0">
                    <i class="bi bi-box-arrow-left"></i> Sair
                </button>
            </form>
            @endif
        </div>

        <div class="header-mid shadow">
            <a class="logo-senac">
                <img src="/images/logo-senac.png" alt="Logo do Senac" width="350px">
            </a>
        </div>
    </header>

    <main>
        <div>
            {{$slot}}
        </div>
    </main>

    <footer class="mt-auto">
        <div class="footer-top">
            <p>Senac - Serviço Nacional de Aprendizagem Comercial - CNPJ: <a href="#">[consulte as unidades]</a> ou pelo
                <a href="#">Fale Conosco</a> Informações: 4090-1030 para capitais e regiões metropolitanas e
                0800-883-2000 para demais regiões
            </p>
        </div>

        <div class="footer-bottom">
            <picture class="logo-branco">
                <img src="/images/logo_branco.png" alt="Logotipo do Senac" width="120">
            </picture>

            <div class="logos">
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-twitter-x"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="#" class="me-4 text-reset">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
        </div>
    </footer>
</body>

</html>