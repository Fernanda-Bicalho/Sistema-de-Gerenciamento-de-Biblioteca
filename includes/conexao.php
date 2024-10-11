<?php

date_default_timezone_set('America/Sao_Paulo');

class Conexao {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=172.17.0.2;dbname=library', 'root', 'root',
                                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                                    );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }

}


?>