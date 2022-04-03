<?php
ini_set('display_errors', 0);
include "./controller/controller.php";

$rota = $_SERVER["REQUEST_URI"];
$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo){
    case "POST":
        $controll = new Controller();
        //echo "Entrou no post";
        $controll->save($_REQUEST);
        break;
    case "GET";
        require "./view/estrutura/main.php";
        break;
}