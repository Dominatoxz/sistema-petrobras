<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários - Informações</title>
</head>
<style>
    body { font-family: sans-serif; padding: 20px; background-color: #f4f7f6; }
    table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
    th { background-color: #2c3e50; color: white; }
    tr:hover { background-color: #f1f1f1; }
    .hash-code { font-family: monospace; color: #27ae60; font-weight: bold; }
    button { cursor: pointer; transition: opacity 0.2s; }
    button:hover { opacity: 0.8; }
</style>
<body>
    <?php if (isset($_GET['status'])): ?>
        <div style="padding: 15px; margin: 10px 0; border-radius: 4px; font-family: sans-serif; text-align: center;
                    background-color: <?= $_GET['status'] == 'sucesso' ? '#d4edda' : '#f8d7da' ?>; 
                    color: <?= $_GET['status'] == 'sucesso' ? '#155724' : '#721c24' ?>;
                    border: 1px solid <?= $_GET['status'] == 'sucesso' ? '#c3e6cb' : '#f5c6cb' ?>;">
            <?= htmlspecialchars($_GET['msg']) ?>
        </div>
    <?php endif; ?>
    <h1>Funcionários</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Funcionário</th>
                <th>Cargo</th>
                <th>Nível</th>
                <th>Data de Início</th>
                <th>Hash da Biometria</th>
                <th colspan="2">Ações</th>
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
                <td>
                    <?php if($f['Iris_Hash'] !== "Não Registrado"): ?>
                        <form action="../Controller/biometria.php" method="POST">
                            <input type="hidden" name="matricula" value="<?= $f['Matricula'] ?>">
                            <input  value="Remover Cadastro" type="submit" style="background: #e74c3c; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px;">
                                
                        </form>
                    <?php else: ?>
                        <small style="color: grey;">Sem óculos</small>
                    <?php endif; ?>
                    
                    <a href="index.php?action=validar&id=<?= $f['id_funcionario_iris'] ?>">🔍 Verificar Hash</a>
                </td>
            </tr>      
            <?php endforeach; ?>  
        </tbody>
    </table>
</body>
</html>