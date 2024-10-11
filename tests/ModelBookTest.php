<//?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../view/book.php';
require_once __DIR__ . '/../controller/bookController.php';
require_once __DIR__ . '/../object/bookObject.php';

class ModelBookTest extends TestCase
{
    private $modelBook;
    private $book;

    protected function setUp(): void
    {
        $this->modelBook = new ModelBook();
        
        $this->book = new Book();
        $this->book->setTitle("Test Title");
        $this->book->setAuthor("Test Author");
        $this->book->setIsbn("1234567890123"); 
    }

    public function testInserirBook()
    {
        $result = $this->modelBook->inserir($this->book);
        $this->assertGreaterThan(0, $result, "O método inserir falhou ao retornar o ID esperado.");
    }

    public function testEditarBook()
    {
        $this->book->setId(1); 
        $this->book->setTitle("Edited Title");
        $result = $this->modelBook->editar($this->book);
        $this->assertTrue($result, "O método editar falhou.");
    }

    public function testRemoverBook()
    {
    
        $this->modelBook->inserir($this->book); 
    
        $result = $this->modelBook->remover(1); 
        $this->assertTrue($result, "O método remover falhou. Verifique se o livro com ID 1 existe e pode ser removido.");
        
        $bookAfterRemoval = $this->modelBook->buscaid(1);
        $this->assertNull($bookAfterRemoval, "O livro ainda existe após a remoção. Verifique a lógica do método remover.");
    }
    


    public function testBuscaPorId()
    {
        $book = $this->modelBook->buscaid(5); 
        $this->assertInstanceOf(Book::class, $book, "O método buscaid falhou ao retornar um objeto Book.");
    }

    public function testBuscaWhere()
    {
        $books = $this->modelBook->BuscaWhere("WHERE author = 'Test Author'");
        $this->assertIsArray($books, "O método BuscaWhere falhou ao retornar um array.");
        $this->assertInstanceOf(Book::class, $books[0], "O método BuscaWhere não retornou um objeto Book no array.");
    }
}