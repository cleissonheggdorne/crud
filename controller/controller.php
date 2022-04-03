<?php
session_start();
require "./model/repository/repositoryPDO.php";
class Controller{
    public function save($request){
        $dadosFornecedor =  $request;
        $repository = new RepositoryPDO();
        $_SESSION['msg'] = $dadosFornecedor;
    
        $retorno = $repository->salvarFornecedor($dadosFornecedor);

        if(is_bool($retorno)){
            $_SESSION['msg'] = "Fornecedor cadastrado com sucesso";
            header("location: /");
        }else{
            $_SESSION['msg'] = $retorno;
            header("location: /");
        };

    }
}