<?php
session_start();
require_once "./view/estrutura/cabecalho.php";
include "./util/mensagem.php";



?>

<body>

        <div class="container">
            <nav>
                <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Controle</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
                    <ul class="left hide-on-med-and-down">
                        <li class=""><a href="/fornecedores"id="aciona_tab_fornecedor">Fornecedores</a></li>
                        <li class=""><a href="/produtos" id="aciona_tab_produto">Produtos</a></li>
                        <li class=""><a href="/transportadoras"  id="aciona_tab_transportadora">Transportadoras</a></li>
                    </ul>  
                </div>
            </nav>

            <ul class="sidenav" id="mobile-demo">
                <li><a href="/produtos">Produtos</a></li>
                <li><a href="#">Fornecedores</a></li>
                <li><a href="#">Transportadoras</a></li>
            </ul>
        </div>
        
    <main class="container">

    <ul class="collection with-header">
        <li class="collection-header"><h4 id="title_tab">Produtos</h4>
            <div id="fornecedores" class="col s12">           
                <a class="modal-trigger waves-effect waves-light btn" href="#form">Novo</a>

                <!-- Modal Cadastrar Produto  -->
    <div class="row">
            <!-- Modal Structure -->
            <div id="form" class="modal modal-fixed-footer">
                
                <div class="modal-content">

                    <div class="card-content white-text">
                        <span class="card-title black-text">Cadastrar Produto</span>

                        <form method="POST">
                             <input name="idp" id="id-produto" type="hidden" value=""></input> 
                             <input name="idi" id="id-telefone" type="hidden" value=""></input>
                             <!-- <input name="ide" id="id-email" type="hidden" value=""></input> -->
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <div class="col s6 m6 l6">
                                        <!--input do nome -->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" id="nome" type="text" class="validate" name="nome" value= "teste fornecedor" required>
                                                <label for="nome">Nome</label>
                                            </div>
                                        </div>

                                        <!--input da descrição -->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea placeholder="" id="descricao" class="materialize-textarea" name="descricao" required>Isto é uma descrição</textarea>
                                                <label for="descricao">Descrição</label>
                                            </div>
                                        </div>
                                        <div class="input-field col s12">
                                        <?php
                                        include_once "./controller/Controller.php";
                                        $control = new Controller();
                                        $dados = $control->listarDados();
                                        ?>
                                        <select name="id_fornecedor">
                                            <option value="1" disabled selected>Choose your option</option>
                                        <?php foreach ($dados as $dado) : ?>
                                            <option value="<?= $dado['id'] ?>"><?= $dado['nome'] ?></option>
                                        <?php endforeach ?>
                                        </select>
                                            <label>Fornecedor</label>
                                        </div>
                                    </div>

                                    <div class="col s6 m6 l6">

                                        <!--input do bairro -->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" id="quantidade" type="number" step=".1" min=0 class="validate" name="quantidade" value="">
                                                <label for="bairro">Quantidade</label>
                                            </div>
                                        </div>
                                     
                                        <!--input do número-->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" id="valor" type="number" step=".1" min=0 class="validate" value="135" name="valor">
                                                <label for="numero">Valor</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>  
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="waves-effect waves-light btn grey" href="/produtos">Cancelar</a>
                    <button type="submit" class="waves-effect waves-light btn purple" id="gravar">Salvar Alterações</button>
                </div>
                </form>
            </div>
        </div>
            </div>
        </li>

        <?php
        include_once "./controller/Controller.php";
        $control = new Controller();
        $dados = $control->listProduts();
        foreach ($dados as $dado) :
        ?>                                                                           
        <li class="collection-item"><div><?= $dado['nome']." | R$".$dado['valor']?><a href="#form" id="edit_produto" class="secondary-content modal-trigger" onclick="editarProduto(<?= $dado['id']?>)"><i class="material-icons">edit</i></a></div></li>
        <?php endforeach ?>
    </ul>
      
    </main>

    <?= Mensagem::mostrar(); ?>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>