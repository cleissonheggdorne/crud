<?php
ini_set('display_errors', 0);

include "./controller/controller.php";

$rota = $_SERVER["REQUEST_URI"];
$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo){
    case "POST":
        
        if($_REQUEST['idf'] != "" && substr($rota, 0 , strlen("/fornecedores")) === "/fornecedores"){
            $controll = new Controller();
            $controll->atualizaRegistro($_REQUEST);
            exit;
        }else if ($_REQUEST['idf'] == "" && substr($rota, 0 , strlen("/fornecedores")) === "/fornecedores"){
            $controll = new Controller();
            $controll->save($_REQUEST);
            exit;
        }else if (substr($rota, 0 , strlen("/produtos")) === "/produtos")
            $controll = new Controller();
            $controll->saveProduct($_REQUEST);
            exit;
        break;
        
    case "GET";
        
        if(substr($rota, 0 , strlen("/controle/editar/")) === "/controle/editar/"){
            $controll = new Controller();
            $controll->edit(['dados'=>basename($rota), 'rota'=>'fornecedor']);
            exit;
        }

        //Fornecedores
        if(substr($rota, 0 , strlen("/fornecedores")) === "/fornecedores"){
            require "./view/fornecedores.php";
            exit;
        }
        if($rota === '/produtos'){
            require "./view/produtos.php";
            exit;
        }
        if(substr($rota, 0 , strlen("/controle/produto")) === "/controle/produto"){
            $controll = new Controller();
            $controll->edit(['dados'=>basename($rota), 'rota'=>'produto']);
            $_SESSION['msg'] = basename($rota);
            exit;
        }
        break;
}