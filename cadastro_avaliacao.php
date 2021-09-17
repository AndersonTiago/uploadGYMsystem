<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="row offset-md-2 no-print"><h3 id="tela-desc" class="tela-desc">&nbsp;Cadastrar Avaliação Física</h3></div>
    
    <div class="container offset-md-2">
        <div class="row" id="row_aluno">
            <div class="input-group mb-3 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">Aluno</span>
                </div>
                <select id="aluno_Av" class="custom-select">
                </select>
            </div>
        </div>  
        <hr>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputCity">Peso/kg</label>
                <input id="av_peso" type="number" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Altura</label>
                <input id="av_altura" type="number" class="form-control" pattern="[a-zA-Z0-9]+">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">IMC</label>
                <input id="av_imc" type="number" class="form-control" readOnly>
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Tórax ou Busto</label>
                <input id="av_torax" type="number" class="form-control">
            </div>

            <div class="form-group col-md-3">
                <label for="inputCity">Cintura-menor circunferência</label>
                <input id="av_cintura" type="number" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Abdômen-maior circunferência</label>
                <input id="av_abdomen" type="number" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Quadril-maior circunferência</label>
                <input id="av_quadril" type="number" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Braço</label>
                <input id="av_braco" type="number" class="form-control">
            </div>
            
            <div class="form-group col-md-3">
                <label for="inputCity">Coxa</label>
                <input id="av_coxa" type="number" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Antebraço</label>
                <input id="av_antebraco" type="number" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Panturrilhas</label>
                <input id="av_panturrilha" type="number" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Pescoço</label>
                <input id="av_pescoco" type="number" class="form-control">
            </div>
               
            <button id="av_btn_cadastra" style="margin:0px auto;" class="btn btn-success">Cadastrar Avaliação</button>
            
        </div>
        <hr>
        <div id="msg_avaliacao"></div>  
    </div>  
</div>
    
<script src="./backend/avaliacaoFisica/app.js"></script> 
<?php
    include_once('rodape.php');
?>