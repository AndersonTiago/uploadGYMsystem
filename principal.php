<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="container offset-md-2">
        <div class=" row col-md-12">
                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-3">
                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header"><strong>Pagamentos-A</strong></div>
                        <div class="card-body">
                            <div class="icon">
                                <h3 id="qtd_PA">0</h3>
                            </div>
                        </div>
                        <a href="lista_mensalidade_atrasada.php" type="button" class="btn btn-danger" style="background-color:#9a1111bf;">Mais informações&nbsp;<span class="fas fa-arrow-circle-right"></span></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-3">
                    <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                        <div class="card-header"><strong>Alunos Inativos</strong></div>
                        <div class="card-body">
                            <div class="icon">
                                <h3 id="qtd_AI">0</h3>
                            </div>
                        </div>
                        <a href="lista_alunos_inativos.php"  type="button" class="btn btn-warning" style="background-color:#bf9003;">Mais informações&nbsp;<span class="fas fa-arrow-circle-right"></span></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-3">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header"><strong>Cadastrar Aluno</strong></div>
                        <div class="card-body">
                            <div class="icon">
                                <h3><span class="fas fa-user"></span></h3>
                            </div>
                        </div>
                        <a href="cadastro_aluno.php" type="button" class="btn btn-success" style="background-color:#08691ebd;">Mais informações&nbsp;<span class="fas fa-arrow-circle-right"></span></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header"><strong>Mensalidade</strong></div>
                        <div class="card-body">
                            <div class="icon">
                                <h3><span class="fas fa-money-check-alt"></span></h3>
                            </div>
                        </div>
                        <a href="cadastro_mensalidade.php" type="button" class="btn btn-primary" style="background-color:#0743848a;">Mais informações&nbsp;<span class="fas fa-arrow-circle-right"></span></a>
                    </div>
                </div>

            
        </div>
    </div>
</div>
    
<script src="./backend/dashboard/app.js"></script>
<script src="./backend/dashboard/app2.js"></script>

<?php
    include_once('rodape.php');
?>