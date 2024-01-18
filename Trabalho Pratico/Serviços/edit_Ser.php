<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <div class="container mt-5">
        <h2>Editar Serviço</h2>
        <form action="upd_ser.php" method="post">
            <input type="hidden" name="id_ser" value="<?= $car['id_ser'] ?>" class="form-control">
    
            <div class="form-group">
                <label for="tipoServico">Tipo de serviço:</label>
                <select name="newtipoServico" class="form-control" onchange="updatePrice()" required>
                    <option value="mudarOleo" <?= ($car['Tipo'] === 'mudarOleo') ? 'selected' : '' ?>>Mudar o Óleo</option>
                    <option value="trocarPneus" <?= ($car['Tipo'] === 'trocarPneus') ? 'selected' : '' ?>>Trocar Pneus</option>
                    <option value="reparacaoMotor" <?= ($car['Tipo'] === 'reparacaoMotor') ? 'selected' : '' ?>>Reparação do Motor</option>
                    <option value="alinhamentoDirecao" <?= ($car['Tipo'] === 'alinhamentoDirecao') ? 'selected' : '' ?>>Alinhamento da Direção</option>
                    <option value="outro" <?= ($car['Tipo'] === 'outro') ? 'selected' : '' ?>>Outro</option>
                </select>
            </div>
    
            <div class="form-group">
                <label for="dataServico">Data:</label>
                <input type="date" name="newdataServico" value="<?= $car['Data'] ?>" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select name="newestado" class="form-control" required>
                    <option value="pendente" <?= ($car['Estado'] === 'pendente') ? 'selected' : '' ?>>Pendente</option>
                    <option value="cancelado" <?= ($car['Estado'] === 'cancelado') ? 'selected' : '' ?>>Cancelado</option>
                    
                </select>
            </div>
            <button type="submit" class="button-3">Save Changes</button>
            <button type="button" class="button-3" onclick="navigateToPage()">Voltar</button>
        </form>
    </div>
<script src="scripts_m.js"></script>
</body>
</html>