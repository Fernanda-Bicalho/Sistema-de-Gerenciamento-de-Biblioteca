<?php

require_once __DIR__ . '/../model/loanModel.php';


class ControlLoan{

  public static function inserir(Loan $value){
    return ModelLoan::inserir($value);
  }
  public static function editar(Loan $value){
    return  ModelLoan::editar($value);
  }
  public static function remover($id){
    return  ModelLoan::remover($id);
  }
  public static function BuscaWhere($value){
    return  ModelLoan::BuscaWhere($value);
  }
  public static function BuscaId($id){
    return  ModelLoan::buscaid($id);
  }

}