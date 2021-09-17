<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
<div class="row offset-md-2"><h1 id="tela-desc" class="tela-desc">&nbsp;Lista Validade Fichas</h1></div>
    <div class="container offset-md-2">
        <div class="row">
            <div class="input-group mb-3 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">CPF</span>
                </div>
                <input id="cpf" type="text" class="form-control color-input" placeholder="Pesquise pelo CPF" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3 col-md-6">
                <div class="input-group-prepend">
                    <span class="input-group-text color-span" id="basic-addon1">Nome</span>
                </div>
                <input type="text" class="form-control color-input" placeholder="Pesquise pelo Nome" aria-label="Username" aria-describedby="basic-addon1">
            </div> 
        </div>
        <hr>
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                <th scope="col">CPF</th>
                <th scope="col">RG</th>
                <th scope="col" style="width:45%;">Nome</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">111.111.111-11</th>
                    <td>11.111.111-11</td>
                    <td>Mark Otto</td>
                    <td><button class="btn-primary fas fa-edit editBTN"></button></td>
                    <td><button class="btn-danger fas fa-times-circle deleteBTN" id="21"></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>
    
<?php
    include_once('rodape.php');
?>