<?php

class Conexao{
    public static function criar():PDO{
        $env = parse_ini_file(".env");
        $dataDaseType = $env["databasetype"];
        $dataBase = $env["database"];
        $server = $env["server"];
        $user = $env["user"];
        $pass = $env["pass"];
    
        if($dataDaseType === "mysql"){
            $dataDase = "host=$server;dbname=$dataBase";
        }

        return new PDO("$dataDaseType:$dataBase", $user, $pass);

    }
}