<?php

class Conexao{
    public static function criar():PDO{
        $env = parse_ini_file('.env');
        $dataBaseType = $env["databasetype"];
        $dataBase = $env["database"];
        $server = $env["server"];
        $user = $env["user"];
        $pass = $env["pass"];
    
        if($dataBaseType === "mysql"){
            $dataBase = "host=$server;dbname=$dataBase";
        }
        $opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        return new PDO("$dataBaseType:$dataBase", $user, $pass, $opcoes);
    }
}