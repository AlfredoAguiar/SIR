<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarManager - Gestão de Veículos e Manutenção</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Trabalho Pratico\style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="d-flex align-items-center">
                    <img src="/Trabalho Pratico\logo.jpg" alt="CarManager Logo" width="50" height="50">
                    <span class="ml-3">CarManager</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto"> 
                    <li class="nav-item active">
                        <a class="nav-link" href="/Trabalho Pratico\index.html">Página Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Trabalho Pratico\veiculos.html">Veículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Trabalho Pratico\Serviços\manuten.html">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">Veículos-user</a>
                    </li>
                    <li class="nav-item">
                            <button class="button-3" onclick="location.href='../logout.php'">Sair</button>
                        </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h2>Lista de Usuários</h2>
        <?php include 'ret_u.php'; ?>
    </div>
                                

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="info.js"></script>
  
</body>
</html>