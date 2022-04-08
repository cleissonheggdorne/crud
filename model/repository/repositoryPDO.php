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
                        VALUES (DEFAULT, :nome, :descricao, :cidade, :endereco, :bairro, :numero);
                        -- ON DUPLICATE KEY UPDATE nome= :nome, descricao= :descricao, cidade= :cidade, endereco= :endereco, bairro= :bairro, numero= :numero;
        
                        SELECT LAST_INSERT_ID() INTO @intIdFornecedor;
                        
                        INSERT INTO `email`(id, email, id_fornecedor) 
                        VALUES (DEFAULT, :email, @intIdFornecedor);
                        -- ON DUPLICATE KEY UPDATE email= :email;
        
                        INSERT INTO `telefone`(id, ddd, numero, id_fornecedor) 
                        VALUES (DEFAULT , :ddd, :numero, @intIdFornecedor );
                       -- ON DUPLICATE KEY UPDATE ddd= :ddd, numero= :numero_tel;
                        
                        COMMIT;";
        
        $stmt = $this->conect->prepare($sql);

        $stmt->bindValue(':nome', $dadosFornecedor['nome'], PDO::PARAM_STR);
        $stmt->bindValue(':descricao',$dadosFornecedor['descricao'], PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $dadosFornecedor['cidade'], PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $dadosFornecedor['endereco'], PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $dadosFornecedor['bairro'], PDO::PARAM_STR);
        $stmt->bindValue(':numero', $dadosFornecedor['numero'], PDO::PARAM_INT);
        $stmt->bindValue(':email', $dadosFornecedor['email'], PDO::PARAM_STR);
        $stmt->bindValue(':ddd', $dadosFornecedor['ddd'], PDO::PARAM_INT);
        $stmt->bindValue(':numero_tel', $dadosFornecedor['numero_tel'], PDO::PARAM_STR);
        
        try{
            $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }

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

    public function listaDadosProdutos(){
        $sql = "SELECT pro.id, pro.nome, pro.descricao, it.quantidade, it.valor  FROM produto pro 
                INNER JOIN item it on
                pro.id = it.id_produto";
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

    public function atualizaRegistroFornecedor($dados){
        $sql = "
            UPDATE fornecedor
            SET     nome= :nome,
                    descricao= :descricao,
                    cidade= :cidade,
                    endereco= :endereco,
                    bairro= :bairro,
                    numero= :numero
            WHERE id = :id_fornecedor";   

        $sql2 = "UPDATE email 
                SET     email= :email
                WHERE   id_fornecedor = :id_fornecedor
                AND     id= :id_email";
               
        $sql3 = "UPDATE telefone
                SET ddd= :ddd, numero= :numero_tel
                WHERE id= :id_tel
                AND id_fornecedor = :id_fornecedor";

        $stmt= $this->conect->prepare($sql);
        $stmt2= $this->conect->prepare($sql2);
        $stmt3= $this->conect->prepare($sql3);

        $stmt->bindValue(':id_fornecedor', intval($dados['idf']), PDO::PARAM_INT);
        $stmt2->bindValue(':id_fornecedor', intval($dados['idf']), PDO::PARAM_INT);
        $stmt3->bindValue(':id_fornecedor', intval($dados['idf']), PDO::PARAM_INT);

        $stmt2->bindValue(':id_email', $dados['ide'], PDO::PARAM_INT);
        $stmt3->bindValue(':id_tel', $dados['idt'], PDO::PARAM_INT);

        $stmt->bindValue(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindValue(':descricao',$dados['descricao'], PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $dados['cidade'], PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $dados['endereco'], PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $dados['bairro'], PDO::PARAM_STR);
        $stmt->bindValue(':numero', $dados['numero'], PDO::PARAM_INT);
        $stmt2->bindValue(':email', $dados['email'], PDO::PARAM_STR);
        $stmt3->bindValue(':ddd', $dados['ddd'], PDO::PARAM_INT);
        $stmt3->bindValue(':numero_tel', $dados['numero_tel'], PDO::PARAM_STR);
        
        
        $stmt->execute();
        $stmt2->execute();
        $stmt3->execute();
        

        $situacao = $stmt->errorInfo();
        $situacao2 = $stmt2->errorInfo();
        $situacao3 = $stmt3->errorInfo();
        if($situacao[0] == 00000 && $situacao2[0] == 00000 && $situacao3[0] == 00000){
            return true;
        }else{
            return $situacao;
        }
   }

   public function salvarProduto($dadosProduto){
    $sql = "start TRANSACTION;
                    INSERT INTO `produto`(id, nome, descricao) 
                    VALUES (DEFAULT, :nome, :descricao);
                    -- ON DUPLICATE KEY UPDATE nome= :nome, descricao= :descricao, cidade= :cidade, endereco= :endereco, bairro= :bairro, numero= :numero;
    
                    SELECT LAST_INSERT_ID() INTO @intIdProduto;
                    
                    INSERT INTO `item`(id, quantidade, valor, id_produto) 
                    VALUES (DEFAULT, :quantidade, :valor, @intIdProduto);
                    -- ON DUPLICATE KEY UPDATE email= :email;
    
                    COMMIT;";
    
    $stmt = $this->conect->prepare($sql);

    $stmt->bindValue(':nome', $dadosProduto['nome'], PDO::PARAM_STR);
    $stmt->bindValue(':descricao',$dadosProduto['descricao'], PDO::PARAM_STR);
    $stmt->bindValue(':quantidade', $dadosProduto['quantidade'], PDO::PARAM_STR);
    $stmt->bindValue(':valor', $dadosProduto['valor'], PDO::PARAM_STR);
    
    try{
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    $situacao = $stmt->errorInfo();
    if($situacao[0] == 00000){
        return true;
    }else{
        return $situacao;
    }
}

}

