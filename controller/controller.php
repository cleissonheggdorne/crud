<?php

session_start();
require_once "./model/repository/RepositoryPDO.php";
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

    public function listarDados(){
        $repository = new RepositoryPDO();
        $dados = $repository->listaDados();
        if(!($dados['dados'] === false)){
            return $dados['dados'];
        }else{
            return "NÃO HÁ DADOS PARA LISTAR";
        }
    }
    public function edit($id){
        $repository= new RepositoryPDO();
        $res = $repository->infoFornecedor($id);
        
        header('Content-type: application/json');
        echo json_encode($res);
        
    }
}