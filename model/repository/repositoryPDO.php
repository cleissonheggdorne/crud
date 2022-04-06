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
        $stmt->bindValue(':id', $dadosFornecedor['numero'], PDO::PARAM_INT);
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

    public function infoFornecedor($id){
        $sql = "SELECT f.id, f.descricao,
                    f.nome, 
                    f.cidade,
                    f.endereco, 
                    f.bairro, 
                    f.numero, 
                    tel.ddd, 
                    tel.numero as numero_tel, 
                    e.email,
                    tel.id as id_tel,
                    e.id as id_email FROM fornecedor f 
                inner join telefone tel ON
                f.id = tel.id_fornecedor
                
                left join email e ON
                e.id_fornecedor = f.id
                WHERE f.id = :id";
        
        $stmt = $this->conect->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
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

    public function($dados){
        $sql = "start TRANSACTION;

        UPDATE fornecedor
        SET     nome=:nome
                descricao= :desc
                cidade= :cidade
                endereco= :endereco
                bairro= :bairro
                numero= :numero
        WHERE id = :id_fornecedor;
                        
        UPDATE email 
        SET email= :email
        WHERE id_fornecedor = :id_fornecedor
        AND id= :id_email;
                        
        UPDATE telefone
        SET ddd= :ddd, numero= :numero_tel
        WHERE id= :id_tel
        AND id_fornecedor = :id_fornecedor ;
                        
        COMMIT;";
   }
}

