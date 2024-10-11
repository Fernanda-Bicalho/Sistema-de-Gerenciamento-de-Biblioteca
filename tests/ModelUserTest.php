<//?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../model/userModel.php'; 
require_once __DIR__ . '/../object/userObject.php';

class ModelUserTest extends TestCase
{
    private $modelUser;
    private $user;

    protected function setUp(): void
    {
        $this->modelUser = new ModelUser();

        // Mock do objeto User
        $this->user = new User();
        $this->user->setName("Test User");
        $this->user->setAge("12");
        $this->user->setDocument("123456");
    }

    public function testInserirUser()
    {
        $result = $this->modelUser->inserir($this->user);
        $this->assertGreaterThan(0, $result, "O método inserir falhou ao retornar o ID esperado.");
    }

    public function testEditarUser()
    {
        $this->user->setId(19);
        $this->user->setName("Updated User");
        $result = $this->modelUser->editar($this->user);
        $this->assertTrue($result, "O método editar falhou.");
    }

    public function testRemoverUser()
    {
        $result = $this->modelUser->remover(1);
        $this->assertTrue($result, "O método remover falhou.");
    }

    public function testBuscaPorId()
    {
        $user = $this->modelUser->buscaid(19);
        $this->assertInstanceOf(User::class, $user, "O método buscaid falhou ao retornar um objeto User.");
    }

    public function testBuscaWhere()
    {
        $users = $this->modelUser->BuscaWhere("WHERE Name = 'Test User'");
        $this->assertIsArray($users, "O método BuscaWhere falhou ao retornar um array.");
        $this->assertInstanceOf(User::class, $users[0], "O método BuscaWhere não retornou um objeto User no array.");
    }
}
