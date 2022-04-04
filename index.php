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
        $_SESSION['msg'] = $rota;
        if(substr($rota, 0 , strlen("/controle/editar/")) === "/controle/editar/"){
            $controll = new Controller();
            $controll->edit(basename($rota));
            //exit;
            //header('Content-type: application/json');
            //echo json_encode(['teste'=>'teste']);
        }
       

        require "./view/estrutura/main.php";
        break;
}