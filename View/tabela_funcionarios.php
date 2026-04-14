<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários - Informações</title>
</head>
<body>
    <h1>Funcionários</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Funcionário</th>
                <th>Cargo</th>
                <th>Nível</th>
                <th>Data de Início</th>
                <th>Hash da Íris (Simulado)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($funcionarios as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f['Funcionário']) ?></td>
                <td><?= htmlspecialchars($f['Cargo']) ?></td>
                <td><?= htmlspecialchars($f['Nível']) ?></td>
                <td><?= htmlspecialchars($f['Data de Início']) ?></td>
                <td class="hash-code">
                    <?php if($f['Iris_Hash'] !== "Não Registrado"): ?>
                        <?= htmlspecialchars(substr($f['Iris_Hash'], 0 , 15)) ?>
                    <?php else: ?>
                        <span style="color: red;">Pendente</span>
                    <?php endif; ?>
                </td>
            </tr>      
            <?php endforeach; ?>  
        </tbody>
    </table>
</body>
</html>