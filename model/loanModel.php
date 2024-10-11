<?php

require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../object/loanObject.php';


class ModelLoan{
  public static $instance;
  public static $table = 'loan';

  function __construct(){

  }

  public static function getInstance(){
    if(!isset(self::$instance)){                
      self::$instance = new ModelLoan();
    }
    return self::$instance;
  }

  public static function inserir(Loan $objeto){
    try {
      $sql = "INSERT INTO ".self::$table." (userId,bookId,dateLoan,returnDate) VALUES (:userId,:bookId, :dateLoan, :returnDate)";
      $psql = Conexao::getInstance()->prepare($sql);
      $psql->bindValue(":userId", $objeto->getUserId());
      $psql->bindValue(":bookId", $objeto->getBookId());
      $psql->bindValue(":dateLoan", $objeto->getDateLoan());
      $psql->bindValue(":returnDate", $objeto->getReturnDate());
      


      if($psql->execute()){
        return Conexao::getInstance()->lastInsertId();
      }else{
        return 0;
      }
    }catch(Exception $e){
      print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
    }
  }

  public static function editar(Loan $objeto){
    try {
        $sql = "UPDATE ".self::$table." SET
            userId = :userId,
            bookId = :bookId,
            dateLoan = :dateLoan,
            returnDate = :returnDate
            WHERE id = :id"; 

        $psql = Conexao::getInstance()->prepare($sql);
        $psql->bindValue(":id", $objeto->getId()); 
        $psql->bindValue(":userId", $objeto->getUserId());
        $psql->bindValue(":bookId", $objeto->getBookId());
        $psql->bindValue(":dateLoan", $objeto->getDateLoan());
        $psql->bindValue(":returnDate", $objeto->getReturnDate());

        if ($psql->execute()) {
            return true; 
        } else {
            return false; 
        }
    } catch (Exception $e) {
        echo "Ocorreu um erro ao tentar editar: " . $e->getMessage();
    }
}


  public static function remover($id){
    try {
      $sql = "DELETE FROM ".self::$table." WHERE id = :id";
      $p_sql = Conexao::getInstance()->prepare($sql);
      $p_sql->bindValue(":id", $id);
      return $p_sql->execute();
    } catch (Exception $e) {
      print "Exclusão não permitida: o ID permanece associado à estrutura de dados de empréstimos";
    }
  }

  public static function buscaid($id) {
    try {
        $sql = "SELECT * FROM ".self::$table." WHERE id = :id";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        $p_sql->execute();
        $result = $p_sql->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return self::Popular($result); 
        } else {
            return null; 
        }
    } catch (Exception $e) {
        print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
    }
}



  public static function BuscaWhere($query) {
    try {
      $sql = "SELECT * FROM ".self::$table." ".$query;
      $p_sql = Conexao::getInstance()->prepare($sql);
      $p_sql->execute();
      return self::PopularTodos($p_sql->fetchAll(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
      print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
    }
  }

  public static function Popular($row){
    $retorno = new Loan;
    $retorno->setId($row['id']);
    $retorno->setUserId($row['userId']);
    $retorno->setBookId($row['bookId']);
    $retorno->setDateLoan($row['dateLoan']);
    $retorno->setReturnDate($row['returnDate']);

    return $retorno;
  }

  public static function PopularTodos($rows) {
    $array = array();
    foreach ($rows as $linha) {
        $array[] = self::Popular($linha);
    }
    return $array;
  }


}
