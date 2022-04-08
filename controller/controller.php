<?php

session_start();
require_once "./model/repository/RepositoryPDO.php";
class Controller{
    public function save($request){
        $dadosFornecedor =  $request;
        
        $repository = new RepositoryPDO();
        
        $retorno = $repository->salvarFornecedor($dadosFornecedor);
        //$retorno = true;
        if(is_bool($retorno)){
            $_SESSION['msg'] = "Fornecedor cadastrado com sucesso";
            header("location: /fornecedores");
        }else{
            $_SESSION['msg'] = $retorno;
            header("location: /fornecedores");
        };
    }

    public function saveProduct($request){
        $dadosProduto =  $request;
        
        $repository = new RepositoryPDO();
        
        $retorno = $repository->salvarProduto($dadosProduto);
        //$retorno = true;
        if(is_bool($retorno)){
            $_SESSION['msg'] = "Produto cadastrado com sucesso";
            header("location: /produtos");
        }else{
            $_SESSION['msg'] = $retorno;
            header("location: /produtos");
        };
    }

    public function listarDados(){
        $repository = new RepositoryPDO();
        $dados = $repository->listaDados();
        //$dados = ['dados'=>false];
        if(!($dados['dados'] === false)){
            return $dados['dados'];
        }else{
            return "NÃO HÁ DADOS PARA LISTAR";
        }
    }

    public function listProduts(){
        $repository = new RepositoryPDO();
        $dados = $repository->listaDadosProdutos();
        //$dados = ['dados'=>false];
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

    public function atualizaRegistro($request){
        $dadosFornecedor =  $request;
        
        $repository = new RepositoryPDO();
        
        $retorno = $repository->atualizaRegistroFornecedor($dadosFornecedor);
        //$retorno = true;
        if(is_bool($retorno)){
            $_SESSION['msg'] = "Dados atualizados com sucesso";
            header("location: /fornecedores");
        }else{
            $_SESSION['msg'] = $retorno;
            header("location: /fornecedores");
        };
    }
}