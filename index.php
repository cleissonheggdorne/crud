<?php
ini_set('display_errors', 0);

include "./controller/controller.php";

$rota = $_SERVER["REQUEST_URI"];
$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo){
    case "POST":
        
        if(substr($rota, 0 , strlen("/controle/editar/")) === "/controle/editar/"){
            $controll = new Controller();
            $controll->edit(basename($rota));
            exit;
        }

        $controll = new Controller();
        $controll->save($_REQUEST);
        break;
        
    case "GET";
        
        if(substr($rota, 0 , strlen("/controle/editar/")) === "/controle/editar/"){
            $controll = new Controller();
            $controll->edit(basename($rota));
            exit;
        }
        //PRODUTOS
        if(substr($rota, 0 , strlen("/produtos")) === "/produtos"){
           // $controll = new Controller();
           // $controll->edit(basename($rota));
           require "./view/produtos.php";
            exit;
        }

        require "./view/fornecedores.php";
        break;
}