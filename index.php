<?php


$rota = $_SERVER["REQUEST_URI"];
$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo){
    case "POST":
        break;
    case "GET";
        require "./view/estrutura/main.php";
        break;
}