<?php
require_once "Conexao.php";
class RepositoryPDO{

    private $conect;

    public function __construct()
    {
        $this->conect = Conexao::criar();
    }

    public function salvarFornecedor($dadosFornecedor){
        $sql = "start TRANSACTION;

                INSERT INTO `fornecedor`(id, nome, descricao, cidade, endereco, bairro, numero) 
                VALUES (DEFAULT,:nome,:descricao,:cidade,:endereco,:bairro, :numero);
                
                SELECT LAST_INSERT_ID() INTO @intIdFornecedor;
                
                INSERT INTO `email`(id, email, id_fornecedor) 
                VALUES (DEFAULT,:email, @intIdFornecedor);
                
                INSERT INTO `telefone`(id, ddd, numero, id_fornecedor) 
                VALUES (DEFAULT,:ddd, :numero_tel, @intIdFornecedor);
                
                COMMIT;";
        
        $stmt = $this->conect->prepare($sql);
        $stmt->bindValue(':nome', $dadosFornecedor['nome'], PDO::PARAM_STR);
        $stmt->bindValue(':descricao',$dadosFornecedor['descricao'], PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $dadosFornecedor['cidade'], PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $dadosFornecedor['endereco'], PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $dadosFornecedor['bairro'], PDO::PARAM_STR);
        $stmt->bindValue(':numero', $dadosFornecedor['numero'], PDO::PARAM_INT);
        $stmt->bindValue(':email', $dadosFornecedor['email'], PDO::PARAM_STR);
        $stmt->bindValue(':ddd', $dadosFornecedor['ddd'], PDO::PARAM_STR);
        $stmt->bindValue(':numero_tel', $dadosFornecedor['numero_tel'], PDO::PARAM_STR);

        $stmt->execute();
        
        $situacao = $stmt->errorInfo();
        if($situacao[0] == 00000){
            return true;
        }else{
            return $situacao;
        }
    }

    public function listaDados(){
        $sql = "SELECT id, nome, cidade FROM fornecedor";
        $stmt = $this->conect->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()){
            $dadosFornecedor = array();
            while ($dado = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($dadosFornecedor, $dado);
            }
            return ['dados'=>$dadosFornecedor];
        }else{
            return ['dados'=>false];
        }
        
    }
}