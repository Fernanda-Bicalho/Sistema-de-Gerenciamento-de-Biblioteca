<//?php

use PHPUnit\Framework\TestCase;


require_once __DIR__ . '/../model/loanModel.php'; 
require_once __DIR__ . '/../object/loanObject.php'; 

class ModelLoanTest extends TestCase
{
    private $modelLoan;
    private $loan;

    protected function setUp(): void
    {
        
        $this->modelLoan = new ModelLoan();

       
        $this->loan = new Loan();
        $this->loan->setBookId(33);
        $this->loan->setDateLoan("2024-10-01");
        $this->loan->setReturnDate("2024-10-10");
    }

    public function testInserirLoan()
    {
        $result = $this->modelLoan->inserir($this->loan);
        $this->assertGreaterThan(0, $result, "O método inserir falhou ao retornar o ID esperado.");
    }

    public function testEditarLoan()
    {
        $this->loan->setId(1);
        $this->loan->setReturnDate("2024-10-15");
        $result = $this->modelLoan->editar($this->loan);
        $this->assertTrue($result, "O método editar falhou.");
    }

    public function testRemoverLoan()
    {
        $result = $this->modelLoan->remover(1);
        $this->assertTrue($result, "O método remover falhou.");
    }

    public function testBuscaPorId()
    {
        $loan = $this->modelLoan->buscaid(49);
        $this->assertInstanceOf(Loan::class, $loan, "O método buscaid falhou ao retornar um objeto Loan.");
    }

    public function testBuscaWhere()
    {
        $loans = $this->modelLoan->BuscaWhere("WHERE id = 49");
        $this->assertIsArray($loans, "O método BuscaWhere falhou ao retornar um array.");
        $this->assertInstanceOf(Loan::class, $loans[0], "O método BuscaWhere não retornou um objeto Loan no array.");
    }
}
