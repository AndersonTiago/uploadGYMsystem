<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="container offset-md-2">
        <h2> Cadastrar Equipamento</h2> 

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputCity">Nome do Equipamento</label>
                    <input id="ap_nome" type="text" class="form-control" id="">
                </div>
                <div class="form-group col-md-12">
                    <label for="inputCity">Marca</label>
                    <input id="ap_marca" type="text" class="form-control" id="">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Kg</label>
                    <input id="ap_kg" type="number" class="form-control" id="">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Quantidade</label>
                    <input id="ap_qtd" type="number" class="form-control" id="">
                </div>
                <button style="margin:0px auto;" id="ap_cadastra" class="btn btn-primary">Cadastrar</button>    
            </div>
            <hr>            
            <div id="msg_cadastroEquipamento"></div>

    </div> 
</div>

<script src="./backend/equipamentos/cadastro.js"></script> 
<?php
    include_once('rodape.php');
?>