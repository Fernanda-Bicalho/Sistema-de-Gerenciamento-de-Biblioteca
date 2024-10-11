<?php

require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../object/bookObject.php';


class ModelBook {
  public static $instance;
  public static $table = 'books';

  function __construct(){

  }

  public static function getInstance(){
    if(!isset(self::$instance)){
      self::$instance = new ModelBook();
    }
    return self::$instance;
  }

  public static function inserir(Book $objeto){
    try {
      $sql = "INSERT INTO ".self::$table." (title, author, isbn) VALUES (:title, :author, :isbn)";
      $psql = Conexao::getInstance()->prepare($sql);
      $psql->bindValue(":title", $objeto->getTitle());
      $psql->bindValue(":author", $objeto->getAuthor());
      $psql->bindValue(":isbn", $objeto->getIsbn());

      if($psql->execute()){
        return Conexao::getInstance()->lastInsertId();
      }else{
        return 0;
      }
    }catch(Exception $e){
      print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
    }
  }

  public static function editar(Book $objeto){
    try {
      $sql = "UPDATE ".self::$table." SET
      title = :title,
      author = :author,
      isbn = :isbn
      WHERE id = :id
      ";
      $psql = Conexao::getInstance()->prepare($sql);
      $psql->bindValue(":id", $objeto->getid());
      $psql->bindValue(":title", $objeto->getTitle());
      $psql->bindValue(":author", $objeto->getAuthor());
      $psql->bindValue(":isbn", $objeto->getIsbn());

      return $psql->execute();
    }catch(Exception $e){
      print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
    }
  }

  public static function remover($id){
    try {
      $sql = "DELETE FROM ".self::$table." WHERE id = :id";
      $p_sql = Conexao::getInstance()->prepare($sql);
      $p_sql->bindValue(":id", $id);
      return $p_sql->execute();
    } catch (Exception $e) {
      print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde.";
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
    $retorno = new Book;
    $retorno->setId($row['id']);
    $retorno->setTitle($row['title']);
    $retorno->setAuthor($row['author']);
    $retorno->setIsbn($row['isbn']);

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
