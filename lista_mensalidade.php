<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    
    <div class="row offset-md-2"><h1 id="tela-desc" class="tela-desc">&nbsp;Lista de Mensalidades</h1></div>
        <div class="container offset-md-2">
        <button id="btn_new_mensalidade" style="float:right;margin-bottom:3px;" class="btn btn-success">Nova Mensalidade</button>
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                    <th scope="col" >Aluno</th>
                    <th scope="col">Plano</th>
                    <th scope="col">Data Pagamento</th>
                    <th scope="col">Data Vencimento</th>
                    <th scope="col">A/I</th>
                    </tr>
                </thead>
                <tbody id="tbl_mensalidade">
                </tbody>
            </table>
        </div>    
</div>
    
<script src="./backend/mensalidade/listagem.js"></script> 
<?php
    include_once('rodape.php');
?>