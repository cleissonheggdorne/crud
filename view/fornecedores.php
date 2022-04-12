<?php
session_start();
require_once "./view/estrutura/cabecalho.php";
include_once "./util/mensagem.php";

?>

<body>
        <div class="container">
            <nav>
                <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Controle</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
                    <ul class="left hide-on-med-and-down">
                        <li><a href="/fornecedores"id="aciona_tab_fornecedor">Fornecedores</a></li>
                        <li><a href="/produtos" id="aciona_tab_produto">Produtos</a></li>
                        <li><a href="/transportadoras"  id="aciona_tab_transportadora">Transportadoras</a></li>
                    </ul>  
                </div>
            </nav>

            <ul class="sidenav" id="mobile-demo">
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Fornecedores</a></li>
                <li><a href="#">Transportadoras</a></li>
            </ul>
        </div>
        
    <main class="container">

    <ul class="collection with-header">
        <li class="collection-header"><h4 id="title_tab">Fornecedores</h4>
            <div id="fornecedores" class="col s12">           
                <a class="modal-trigger waves-effect waves-light btn" href="#form">Novo</a>

                <!-- Modal Cadastrar Fornecedor  -->
    <div class="row">
            <!-- Modal Structure -->
            <div id="form" class="modal modal-fixed-footer">
                
                <div class="modal-content">

                    <div class="card-content white-text">
                        <span class="card-title black-text">Cadastrar Fornecedor</span>

                        <form method="POST">
                             <input name="idf" id="id-fornecedor" type="hidden" ></input> 
                             <input name="idt" id="id-telefone" type="hidden" ></input>
                             <input name="ide" id="id-email" type="hidden" ></input>
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

                                        <!--input da Cidade-->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" id="cidade" type="text" name="cidade" value="nova friburgo" required>
                                                <label for="cidade">Cidade</label>
                                            </div>
                                        </div>
                                        <!--input do Endereco -->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" id="endereco" type="text" class="validate" name="endereco" value="Av Alberto Braune" required>
                                                <label for="endereco">Endereço</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col s6 m6 l6">

                                        <!--input do bairro -->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" id="bairro" type="text" class="validate" name="bairro" value="centro">
                                                <label for="bairro">Bairro</label>
                                            </div>
                                        </div>
                                     
                                        <!--input do número-->
                                        <div class="row">
                                            <div class="input-field col s5">
                                                <input placeholder="" id="numero" type="number" step="1" min=0 class="validate" value="135" name="numero">
                                                <label for="numero">Número</label>
                                            </div>
                                            <div class="input-field col s5">
                                            <p>
                                                <label>
                                                    <input type="checkbox" />
                                                    <span>SN</span>
                                                </label>
                                                </p>
                                            </div>
                                        </div>
                                        <!--input do numero telefone -->
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <input placeholder="" id="ddd" type="number" min=0 class="validate" required name="ddd" value="022">
                                                <label for="ddd">DDD</label>
                                            </div>
                                            <div class="input-field col s9">
                                                <input placeholder="" id="numero_tel" type="text" class="validate" required name="numero_tel" value="22222222">
                                                <label for="numero-tel">Número Tel</label>
                                            </div>
                                        </div>
                                        <!--input do email -->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input placeholder="" id="email" type="text" class="validate" name="email" value="teste@teste.com">
                                                <label for="email">E-mail</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="waves-effect waves-light btn grey" href="/fornecedores">Cancelar</a>
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
        $dados = $control->listarDados();
        foreach ($dados as $dado) :
        ?>
        <li class="collection-item"><div><?= $dado['nome']." | ".$dado['cidade']?><a href="#form" class="secondary-content modal-trigger" onclick="editarFornecedor(<?= $dado['id']?>)"><i class="material-icons">edit</i></a></div></li>
        <?php endforeach ?>
    </ul>
      
    </main>

    <?= Mensagem::mostrar(); ?>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>