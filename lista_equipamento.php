<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="row offset-md-2"><h1 id="tela-desc" class="tela-desc">&nbsp;Lista de Equipamentos</h1></div>
    <div class="container offset-md-2">
        <hr>
        <div id="mensagem"></div>
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                <th scope="col" style="width:36%;">Equipamento</th>
                <th scope="col">Kg</th>
                <th scope="col" style="width:36%;" >Marca</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody id="tbl_equipamento">
            </tbody>
        </table>
    </div>    
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModalEquipamento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Equipamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="inputId" name="" value="">
                <div class="container">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputCity">Nome do Equipamento</label>
                            <input id="edit_ap_nome" type="text" class="form-control" id="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputCity">Marca</label>
                            <input id="edit_ap_marca" type="text" class="form-control" id="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">Kg</label>
                            <input id="edit_ap_kg" type="number" class="form-control" id="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">Quantidade</label>
                            <input id="edit_ap_qtd" type="number" class="form-control" id="">
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


<script src="./backend/equipamentos/listagem.js"></script>    
<?php
    include_once('rodape.php');
?>