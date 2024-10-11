
<?php

require_once 'header.php';
require_once '../controller/loanController.php';
require_once '../model/loanModel.php'; 
require_once '../controller/bookController.php';
require_once '../controller/userController.php';


$objeto = new Loan;
$controller = new ControlLoan; 

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';
$userId = isset($_GET['userId']) ? $_GET['userId'] : '';
$bookId = isset($_GET['bookId']) ? $_GET['bookId'] : '';
$dateLoan = isset($_GET['dateLoan']) ? $_GET['dateLoan'] : '';
$returnDate = isset($_GET['returnDate']) ? $_GET['returnDate'] : '';


if ($acao=='editar') {
    $editLoan = $controller->BuscaId($id);
}

if (isset($_POST['BtnAdicionar'])) {
    $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
    $bookId = isset($_POST['bookId']) ? $_POST['bookId'] : '';
    $dateLoan = isset($_POST['dateLoan']) ? $_POST['dateLoan'] : '';
    $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';
   

    $objeto->setUserId($userId);
    $objeto->setBookId($bookId); 
    $objeto->setDateLoan($dateLoan);
    $objeto->setReturnDate($returnDate);
    


    $controller->Inserir($objeto);

    
    header("Location: loan.php");
    exit;
}

if (isset($_POST['BtnAtualizar'])) {
    $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $bookId = isset($_POST['bookId']) ? $_POST['bookId'] : '';
    $dateLoan = isset($_POST['dateLoan']) ? $_POST['dateLoan'] : '';
    $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';
    

    $objeto->setId($id);
    $objeto->setUserId($userId);
    $objeto->setBookId($bookId); 
    $objeto->setDateLoan($dateLoan);
    $objeto->setReturnDate($returnDate);
    

    $controller->editar($objeto);

    header("Location: loan.php");
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
    <title>Gestão de Empréstimos</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Book Loan Management</h1>

    <?php if ($acao == 'novo' || $acao == 'editar') { ?>
    <h2 class="mt-4"><?php echo ($acao == 'editar') ? 'Editar Empréstimo' : 'Adicionar Empréstimo'; ?></h2>
    <form action="loan.php?acao=<?php echo $acao; ?>" method="POST" class="bg-light p-4 rounded shadow">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bookId">ID do Livro:</label>
                    <select name="bookId" class="form-control" id="bookId">
                        <?php  
                            $books = ControlBooks::BuscaWhere('where id is not null');
                            foreach ($books as $book) {
                                $selected = ($acao === 'editar' && $book->getId() == $editLoan->getBookId()) ? 'selected="selected"' : '';
                                echo '<option '.$selected.' value="'.$book->getId().'">'.$book->getTitle().'</option>' ; 
                            } 
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="userId">ID do Usuário:</label>
                    <select name="userId" class="form-control" id="userId">
                        <?php  
                            $users = ControlUser::BuscaWhere('where id is not null');  
                            foreach ($users as $user) {
                                $selected = ($acao === 'editar' && $user->getId() == $editLoan->getUserId()) ? 'selected="selected"' : '';
                                echo '<option '.$selected.' value="'.$user->getId().'">'.$user->getName().'</option>' ; 
                            } 
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dateLoan">Data do Empréstimo:</label>
                    <input type="date" id="dateLoan" name="dateLoan" class="form-control" 
                           value="<?php echo ($acao === 'editar' && $editLoan) ? date('Y-m-d', strtotime($editLoan->getDateLoan())) : ''; ?>" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="returnDate">Data de Devolução:</label>
                    <input type="date" id="returnDate" name="returnDate" class="form-control" 
                           value="<?php echo ($acao === 'editar' && $editLoan) ? date('Y-m-d', strtotime($editLoan->getReturnDate())) : ''; ?>" required>
                </div>
            </div>
        </div>

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-success" name="<?php echo ($acao == 'editar') ? 'BtnAtualizar' : 'BtnAdicionar'; ?>">
            <?php echo ($acao == 'editar') ? 'Atualizar' : 'Adicionar'; ?>
        </button>
    </form>
<?php } ?>


    <?php if ($acao == '') { ?>
        <a href="/view/loan.php?acao=novo" class="btn btn-success">Novo</a>    
        <h2 class="mt-4"></h2>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>ID do Usuário</th> 
                    <th>ID do Livro</th>
                    <th>Data do Empréstimo</th>
                    <th>Data de Devolução</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>   
                <?php
               
                $loans = ControlLoan::BuscaWhere('where bookId <> ""');

                    if (isset($loans) && count($loans) > 0) {
                        foreach ($loans as $loan) {
                           
                            $bookController = new ControlBooks();
                            $book = $bookController->BuscaId($loan->getBookId());

                            
                            $userController = new ControlUser(); 
                            $user = $userController->BuscaId($loan->getUserId());

                            echo "<tr>";
                            echo "<td>" . $loan->getId() . "</td>";
                            echo "<td>" . ($user ? $user->getName() : 'Usuário não encontrado') . "</td>"; 
                            echo "<td>" . ($book ? $book->getTitle() : 'Livro não encontrado') . "</td>";
                            echo "<td>" . $loan->getDateLoan() . "</td>";  
                            echo "<td>" . $loan->getReturnDate() . "</td>";   
                            echo "<td>
                                <a href='/view/loan.php?acao=editar&id=" . $loan->getId() . "' class='btn btn-warning'>Editar</a>
                                <button class='btn btn-danger removeElement' data-toggle='modal' data-target='#deleteModal' data-id='" . $loan->getId() . "'>Remover</button>
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
                Tem certeza de que deseja remover este empréstimo?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="loan.php" method="POST" id="formDelete">
                    <input type="hidden" name="id" id="loanId">
                    <button type="submit" class="btn btn-danger" name="BtnRemover">Remover</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
</body>
</html>
