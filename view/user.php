<?php
require_once 'header.php';
require_once '../controller/userController.php'; 
require_once '../model/userModel.php'; 

$objeto = new User;
$controller = new ControlUser; 

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$age = isset($_GET['age']) ? $_GET['age'] : '';
$document = isset($_GET['document']) ? $_GET['document'] : '';

if ($acao == 'editar') {
    $editUser = $controller->BuscaId($id);
}

if (isset($_POST['BtnAdicionar'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $document = isset($_POST['document']) ? $_POST['document'] : '';

    $objeto->setName($name); 
    $objeto->setAge($age);
    $objeto->setDocument($document);

    $controller->Inserir($objeto);

    
    header("Location: user.php");
    exit;
}

if (isset($_POST['BtnAtualizar'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $document = isset($_POST['document']) ? $_POST['document'] : '';

    $objeto->setId($id);
    $objeto->setName($name); 
    $objeto->setAge($age);
    $objeto->setDocument($document);

    $controller->editar($objeto);

    header("Location: user.php");
    exit;
}

if (isset($_POST['BtnRemover'])) {
    $id = $_POST['id']; 
    $controller->remover($id); 
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Gestão de Usuários</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">User Management</h1>

    <?php if ($acao == 'novo' || $acao == 'editar') { ?>
        <h2 class="mt-4">Usuário</h2>
        <form action="user.php" method="POST" class="bg-light p-4 rounded shadow">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" 
                       value="<?php echo ($acao === 'editar' && $editUser) ? $editUser->getName() : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Idade:</label>
                <input type="number" id="age" name="age" class="form-control" 
                       value="<?php echo ($acao === 'editar' && $editUser) ? $editUser->getAge() : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="document">Documento:</label>
                <input type="text" id="document" name="document" class="form-control" 
                       value="<?php echo ($acao === 'editar' && $editUser) ? $editUser->getDocument() : ''; ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <button type="submit" class="btn btn-success" name="<?php echo ($acao == 'editar') ? 'BtnAtualizar' : 'BtnAdicionar'; ?>">
                <?php echo ($acao == 'editar') ? 'Atualizar' : 'Adicionar'; ?>
            </button>
        </form>
    <?php } ?>

    <?php if ($acao == '') { ?>
        <a href="/view/user.php?acao=novo" class="btn btn-success mb-3">Novo</a>    
        <h2 class="mt-4"></h2>
        <table class="table table-bordered">
        <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Documento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>   
                <?php
                
                $users = ControlUser::BuscaWhere('where id is not null');

                if (isset($users) && count($users) > 0) {
                    foreach ($users as $user) {     
                        echo "<tr>";
                        echo "<td>" . $user->getId() . "</td>";
                        echo "<td>" . $user->getName() . "</td>";
                        echo "<td>" . $user->getAge() . "</td>";  
                        echo "<td>" . $user->getDocument() . "</td>";  
                        echo "<td>
                                <a href='/view/user.php?acao=editar&id=" . $user->getId() . "' class='btn btn-warning'>Editar</a>
                                <button class='btn btn-danger removeElement' data-toggle='modal' data-target='#deleteModal' data-id='" . $user->getId() . "'>Remover</button>
                              </td>";
                        echo "</tr>";
                    }
                } 
                ?>
            </tbody>
        </table>
    <?php } ?>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Remoção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalDelete">
                Tem certeza de que deseja remover este usuário?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="user.php" method="POST" id="formDelete">
                    <input type="hidden" name="id" id="userId">
                    <button type="submit" class="btn btn-danger" name="BtnRemover">Remover</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
</body>
</html>
