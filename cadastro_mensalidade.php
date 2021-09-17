<?php
    include_once('cabecalho.php');
?>
<div id="cont_principal" class="container">
    <div class="row offset-md-2"><h1 id="tela-desc" class="tela-desc">&nbsp;Cadastrar Mensalidade</h1></div>

        <div class="row offset-md-2" id="row_aluno">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">Aluno</span>
                </div>
                <select id="aluno_mensalidade" class="custom-select">
                </select>
            </div>
            <hr>
        </div>  
        

        <div class="container offset-md-2">
        <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Plano Mensal</h5>
                                <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputCity">Data Pagamento</label>
                                    <input id="dta_mensal" type="date" class="form-control" id="">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputCity">Vencimento</label>
                                    <input id="dta_mensalV" type="date" class="form-control" id="">
                                </div>                          
                                </div>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label id="btn_plan_mensal" class="btn btn-secondary active">
                                        <input type="checkbox" checked autocomplete="off"> Escolher Plano
                                    </label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Plano Trimestral</h5>                                
                                <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputCity">Data Pagamento</label>
                                    <input id="dta_trimestral" type="date" class="form-control" id="">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputCity">Vencimento</label>
                                    <input id="dta_trimestralV" type="date" class="form-control" id="">
                                </div>                          
                                </div>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label id="btn_plan_trimestral" class="btn btn-secondary active">
                                        <input type="checkbox" checked autocomplete="off"> Escolher Plano
                                    </label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Plano Anual</h5>
                                <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputCity">Data Pagamento</label>
                                    <input id="dta_anual" type="date" class="form-control" id="">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputCity">Vencimento</label>
                                    <input id="dta_anualV" type="date" class="form-control" id="">
                                </div>                          
                                </div>
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label id="btn_plan_anual" class="btn btn-secondary active">
                                        <input  type="checkbox" checked autocomplete="off"> Escolher Plano
                                    </label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="msg_mensalidadeAluno"></div>
        </div>
        
    </div>
</div>

<script src="./backend/mensalidade/app.js"></script> 
<?php
    include_once('rodape.php');
?>
