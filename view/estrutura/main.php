<?php
session_start();
require "cabecalho.php";
include "./util/mensagem.php";

?>

<body>

        <div class="container">
            <nav>
                <div class="nav-wrapper">
                <a href="#" class="brand-logo right">Controle</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
                    <ul class="tabs left hide-on-med-and-down">
                        <li class="tab"><a href="#fornecedores">Fornecedores</a></li>
                        <li class="tab"><a href="#produtos">Produtos</a></li>
                        <li class="tab"><a href="#transportadoras">Transportadoras</a></li>
                    </ul>
                        <div id="fornecedores" class="col s12">
                            <!-- <p class='card-panel red lighten-4'> -->
                                <a class="modal-trigger waves-effect waves-light btn" href="#novo-forn">Novo</a>
                            <!-- </p> -->

                           
                        </div>

                       
                        <div id="produtos" class="col s12">
                            <p class='card-panel red lighten-4'>
                                <a class="modal-trigger waves-effect waves-light btn" href="#novo-prod">Novo</a></p>
                        </div>
                        <div id="transportadoras" class="col s12"> 
                            <p class='card-panel red lighten-4'>
                                <a class="modal-trigger waves-effect waves-light btn" href="#novo-transp">Novo</a></p>
                        </div> 
                        
                    </div>
                </div>
            </nav>

            <ul class="sidenav" id="mobile-demo">
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Fornecedores</a></li>
                <li><a href="#">Transportadoras</a></li>
            </ul>
        </div>
        
       

    <main>
    <div class="container">
            <ul class="collection with-header">
                <li class="collection-header"><h4>First Names</h4></li>
                <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div></li>
                <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div></li>
                <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div></li>
                <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div></li>
            </ul>
    </div>
        <!-- Modal Cadastrar Fornecedor  -->
    <div class="row">
            <!-- Modal Structure -->
            <div id="novo-forn" class="modal modal-fixed-footer">
                
                <div class="modal-content">

                    <div class="card-content white-text">
                        <span class="card-title black-text">Cadastrar Fornecedor</span>

                        <form method="POST">
                            <!-- <input name="id" id="id-edt" type="hidden" value=""></input> -->
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
                                                <input placeholder="" id="ddd" value="" type="number" min=0 class="validate" name="ddd" value="022">
                                                <label for="ddd">DDD</label>
                                            </div>
                                            <div class="input-field col s9">
                                                <input placeholder="" id="numero-tel" value="" type="text" class="validate" require name="numero_tel" value="22222222">
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
                    <a class="waves-effect waves-light btn grey" href="/">Cancelar</a>
                    <button type="submit" class="waves-effect waves-light btn purple">Salvar Alterações</a>
                </div>
                </form>
            </div>
        </div>
    </main>

    <?= Mensagem::mostrar(); ?>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>