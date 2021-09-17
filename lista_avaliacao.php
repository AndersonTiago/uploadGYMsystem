<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="container offset-md-2">
        <div class="row" id="row_aluno">
            <div class="input-group mb-3 col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">Aluno</span>
                </div>
                <select id="aluno_Av" class="custom-select">
                </select>
                <button id="av_btn_consulta" style="margin:0px auto;" class="btn btn-success">Consultar</button>
            </div>
        </div>  
        <hr>
    </div> 
    <div class="container offset-md-2">
        <div id="lista_alunos">
            Pesquise pela Avaliação do aluno
        </div>
    </div>  
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModalAluno" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AVALIAÇÃO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="inputId" name="" value="">
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
                <input id="av_imc" type="number" class="form-control">
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
        </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="saveEdit" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
            <hr>
            <div id="Editmessage"></div>
        </div>
    </div>  
</div>
    
<script src="./backend/avaliacaoFisica/listagem.js"></script> 
<?php
    include_once('rodape.php');
?>