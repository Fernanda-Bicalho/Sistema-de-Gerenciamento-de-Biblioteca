<?php

require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../object/userObject.php';


class ModelUser{
  public static $instance;
  public static $table = 'users';

  function __construct(){

  }

  public static function getInstance(){
    if(!isset(self::$instance)){                
      self::$instance = new ModelUser();
    }
    return self::$instance;
  }

  public static function inserir(User $objeto){
    try {
      $sql = "INSERT INTO ".self::$table." (name, age, document) VALUES (:name, :age, :document)";
      $psql = Conexao::getInstance()->prepare($sql);
      $psql->bindValue(":name", $objeto->getName());
      $psql->bindValue(":age", $objeto->getAge());
      $psql->bindValue(":document", $objeto->getDocument());

      if($psql->execute()){
        return Conexao::getInstance()->lastInsertId();
      }else{
        return 0;
      }
    }catch(Exception $e){
      print "Ocorreu um erro ao tentar executar esta ação, tente novamente mais tarde. ".$e->getMessage();
    }
  }

  public static function editar(User $objeto){
    try {
        $sql = "UPDATE ".self::$table." SET
        name = :name,
        age = :age,
        document = :document
        WHERE id = :id";

        $psql = Conexao::getInstance()->prepare($sql);
        $psql->bindValue(":id", $objeto->getId());
        $psql->bindValue(":name", $objeto->getName());
        $psql->bindValue(":age", $objeto->getAge());
        $psql->bindValue(":document", $objeto->getDocument());

        $success = $psql->execute();
        return $success; 
    } catch(Exception $e) {
        error_log($e->getMessage()); 
        return false; 
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

  public static function buscaId($id) {
    try {
        $sql = "SELECT * FROM ".self::$table." WHERE id = :id";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        $p_sql->execute();
        $result = $p_sql->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return self::Popular($result); 

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

  public static function Popular($row) {
    $retorno = new User;
    $retorno->setId($row['id']);
    $retorno->setName($row['name']); 
    $retorno->setAge($row['age']);
    $retorno->setDocument($row['document']);
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
