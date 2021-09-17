<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
<div class="row offset-md-2"><h1 id="tela-desc" class="tela-desc">&nbsp;Lista de Alunos</h1></div>
    <div class="container offset-md-2">
        <div class="row">
            <div class="input-group mb-3 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">CPF</span>
                </div>
                    <input id="cpf_usuario" type="text" class="form-control " placeholder="CPF" aria-label="Username" aria-describedby="basic-addon1" maxlength="14" >
            </div>
            <div class="input-group mb-3 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">Nome</span>
                </div>
                <input id="nome_aluno" type="text" class="form-control " placeholder="Pesquise pelo Nome" aria-label="Username" aria-describedby="basic-addon1">
            </div> 
        </div>
        <button id="btn_new_aluno" style="float:right;margin-bottom:3px;" class="btn btn-success">Ativar Aluno</button>
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">CPF</th>
                    <th scope="col" style="width:36%;">Nome</th>
                    <th scope="col" style="width:16%;">Telefone</th>
                    <th scope="col" style="width:16%;">Email</th>
                </tr>
            </thead>
            <tbody id="tbl_alunos">
            </tbody>
        </table>
    </div>    
</div>

<script src="./backend/alunos/listagem_inativos.js"></script>    
<?php
    include_once('rodape.php');
?>