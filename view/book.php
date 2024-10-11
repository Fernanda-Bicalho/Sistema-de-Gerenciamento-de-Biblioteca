<?php

require_once 'header.php';
require_once __DIR__ . '/../controller/bookController.php';
require_once __DIR__ . '/../model/bookModel.php'; 

$objeto = new Book;
$controller = new ControlBooks; 

$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';
$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$title = (isset($_GET['title'])) ? $_GET['title'] : '';     
$author = (isset($_GET['author'])) ? $_GET['author'] : '';  
$isbn = (isset($_GET['isbn'])) ? $_GET['isbn'] : '';



if ($acao=='editar') {
    $editBook = $controller->BuscaId($id);
}


if (isset($_POST['BtnAdicionar'])) {

    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';

    $objeto->setTitle($title);
    $objeto->setAuthor($author); 
    $objeto->setIsbn($isbn);

    $controller->inserir($objeto);

}

if (isset($_POST['BtnAtualizar'])) {

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';

    $objeto->setId($id);
    $objeto->setTitle($title);
    $objeto->setAuthor($author); 
    $objeto->setIsbn($isbn);

    $controller->editar($objeto);
}


if (isset($_POST['BtnRemover'])) {
    $id = $_POST['id']; 
    $controller->remover($id); 
}


?>
    
    <div class="container mt-5">
        <h1 class="text-center">Book Management</h1>

        <?php if ($acao == 'novo' || $acao == 'editar') { ?>
            <h2 class="mt-4">Adicionar Livro</h2>
            <form action="book.php" method="POST" class="bg-light p-4 rounded shadow">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" value= "<?php echo $acao ==='editar' ? $editBook->getTitle() : '' ?>"required >
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" class="form-control" value= "<?php echo $acao ==='editar' ? $editBook->getAuthor(): '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="isbn">Isbn</label>
                    <input type="text" id="isbn" name="isbn" class="form-control" value= "<?php echo $acao ==='editar' ? $editBook->getIsbn(): ''  ?>" required>
                </div>
                    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">

                <button type="submit" class="btn btn-success" name= "<?php echo ($acao == 'editar') ? 'BtnAtualizar' : 'BtnAdicionar' ?>"><?php echo ($acao == 'editar') ? 'Atualizar' : 'Adicionar' ?></button>
            </form>
        <?php } ?>

        <?php if ($acao == '') { ?>
            <a href="/view/book.php?acao=novo"><button class="btn btn-success">Novo</button></a>    
            <h2 class="mt-4"></h2>
            <table class="table table-bordered">
                <thead class="thead-light">

                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Isbn</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php
                    

                        $books = ControlBooks:: BuscaWhere('where title <> ""' );

                        if (isset($books) && count($books) > 0) {
                            
                        foreach ($books as $book) {     
                            echo "<tr>";
                            echo "<td>".$book->getId()."</td>";
                            echo "<td>".$book->getTitle()."</td>"; 
                            echo "<td>".$book->getAuthor()."</td>";
                            echo "<td>".$book->getIsbn()."</td>";  
                            echo "<td><a href='/view/book.php?acao=editar&id=" . $book->getId() . "' class='btn btn-warning'>Editar</a> <button class='btn btn-danger removeElement' data-toggle='modal' data-target='#deleteModal' data-id='" . $book->getId() . "'>Remover</button></td>";
                            echo "</tr>";

                    } 
                        ?>

                        
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
                                        Tem certeza de que deseja remover este livro?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form action="book.php" method="POST" id="formDelete">
                                            <input type="hidden" name="id" id="bookId">
                                            <button type="submit" class="btn btn-danger" name="BtnRemover">Remover</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </tbody>
            </table>
        <?php } ?> 
        <?php } ?>
    </div>  
</body>


<?php require_once 'footer.php'; ?>
