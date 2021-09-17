<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="container offset-md-2">
        <h2> Cadastrar Exercício</h2> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">Nome do exercício</label>
                    <input id="nome_exercicio" type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputExercicio">Grupo Musculasr</label>
                    <select id="inputExercicio" class="form-control">
                        <option selected>Selecione</option>
                        <option>Peito</option>
                        <option>Costas</option>
                        <option>Bíceps</option>
                        <option>Ante Braço</option>                    
                        <option>Ombros</option>
                        <option>Tríceps</option>
                        <option>Abdômen</option>
                        <option>Pernas</option>
                        <option>Panturrilha</option>
                    </select>
                </div>
                
            </div>
            <button id="btn_cadastra" class="btn btn-primary">Cadastrar</button>
            <span id="atu_table" class="fas fa-spinner" style="float: right;font-size: 25px;margin-top: 10px;cursor: pointer;"></span>
            <div id="msg_cadastroExercicio"></div>
        <hr> 
        <div class="scrollTable" style="height:530px; overflow-y:auto;">
            <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                        <th scope="col">Nome Exercício</th>
                        <th scope="col">Grupo Muscular</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_exercicios">
                    </tbody>
                </table> 
        </div>
    </div> 
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Exerício</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <input type="hidden" id="inputId" name="" value="">
            <div class="container">
                <div class="row">                    
                    <div class="form-group col-md-12">
                        <label for="inputCity">Nome do exercício</label>
                        <input id="modal_exercicio" type="text" class="form-control" id="inputCity">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="modal_grupo">Grupo Muscular</label>
                        <select id="modal_grupo" class="form-control">
                            <option selected>Selecione</option>
                            <option>Peito</option>
                            <option>Costas</option>
                            <option>Bíceps</option>
                            <option>Ante Braço</option>                    
                            <option>Ombros</option>
                            <option>Tríceps</option>
                            <option>Abdômen</option>
                            <option>Pernas</option>
                            <option>Panturrilha</option>
                        </select>
                    </div>
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

<script src="./backend/exercicios/app.js"></script> 
<?php
    include_once('rodape.php');
?>