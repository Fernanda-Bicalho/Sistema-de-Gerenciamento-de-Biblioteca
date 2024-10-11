<?php

require_once __DIR__ . '/../model/bookModel.php';


class ControlBooks{

  public static function inserir(Book $value){
    return ModelBook::inserir($value);
  }
  public static function editar(Book $value){
    return ModelBook::editar($value);
  }
  public static function remover($id){
    return ModelBook::remover($id);
  }
  public static function BuscaWhere($value){
    return ModelBook::BuscaWhere($value);
  }
  public static function BuscaId($id){
    return ModelBook::buscaid($id);
  }

}
