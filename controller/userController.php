<?php

require_once __DIR__ . '/../model/userModel.php';


class ControlUser{

  public static function inserir(User $value){
    return ModelUser::inserir($value);
  }
  public static function editar(User $value){
    return ModelUser::editar($value);
  }
  public static function remover($id){
    return ModelUser::remover($id);
  }
  public static function BuscaWhere($value){
    return ModelUser::BuscaWhere($value);
  }
  public static function BuscaId($id){
    return ModelUser::buscaid($id);
  }

}