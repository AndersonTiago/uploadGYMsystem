<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="row offset-md-2 no-print"><h3 id="tela-desc" class="tela-desc">&nbsp;Montar Ficha</h3></div>
    <div id="desc_ficha" style="display:none;" class="row offset-md-2 print">
        <table style="width:100%;">
            <tr>
                <td>
                    <div style="width:185px; border:2px dashed;" class="col-md-12">                        
                        <h1><b>GYM SYSTEM</b></h1>                        
                    </div>
                </td>
                <td>
                    <div class="col-md-12">
                        <h2>FICHA DE MUSCULAÇÃO</h2> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="col-md-12">
                        <h4 id="nome_aluno"></h4> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="col-md-12">
                        <h4>Professor:</h4> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="col-md-12">
                        <h4>Obs:</h4> 
                    </div>
                </td>
            </tr>
        </table>
            
            
    </div>
    <div class="container offset-md-2">
        <div class="row" id="row_aluno">
            <div class="input-group mb-3 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">Aluno</span>
                </div>
                <select id="aluno_ficha" class="custom-select">
                </select>
            </div>
        </div>  
        <hr>
        <table class="table table-hover table-dark">
            <thead>
                <tr>            
                    <th scope="col">Grupo Muscular</th>
                    <th scope="col">Nome Exercício</th>
                    <th scope="col">Série</th>
                    <th scope="col">Repetição</th>                    
                    <th id="tbl_delete" scope="col">Deleta</th>
                    <th id="tbl_retorna" scope="col">Retorna</th>                    
                </tr>
            </thead>
            <tbody id="tbl_escolha_exe"></tbody>
        </table>
    </div>
    <div class="row offset-md-2" >
        <button id="finaliza_ficha" type="button" style="margin:0px auto;" class="btn btn-primary no-print">Finalizar Treino</button>
        <button id="retorna_ficha" type="button" style="margin-left:20px; display:none" class="btn btn-primary no-print">Voltar</button>
        <button id="imprime_ficha" type="button" style="margin:0px auto; display:none" class="btn btn-success no-print">Imprimir Ficha</button>
    </div>
    
</div>
    
<script src="./backend/montaFicha/app.js"></script> 
<?php
    include_once('rodape.php');
?>