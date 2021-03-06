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
        <button id="btn_new_aluno" style="float:right;margin-bottom:3px;" class="btn btn-success">Novo Aluno</button>
        <div id="msg_remocaoAluno"></div>
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                <th scope="col">CPF</th>
                <th scope="col">RG</th>
                <th scope="col" style="width:36%;">Nome</th>
                <th scope="col" style="width:16%;">Telefone</th>
                <th scope="col">Editar</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody id="tbl_alunos">
            </tbody>
        </table>
    </div>    
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModalAluno" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="inputId" name="" value="">
                <div class="container">
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Nome</span>
                        </div>
                        <input id="modal_nome_aluno" type="text" class="form-control" placeholder="Nome do usu??rio" aria-describedby="basic-addon1" >
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Data de Nascimento</span>
                        </div>
                        <input id="modal_dta_nascimento" type="date" class="form-control " placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" >
                    </div>
                </div>

                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend ">
                            <span class="input-group-text color-span" id="basic-addon1">CPF</span>
                        </div>
                        <input id="modal_cpf_usuario" type="text" class="form-control" placeholder="CPF" aria-label="Username" aria-describedby="basic-addon1" maxlength="14" >
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">RG</span>
                        </div>
                        <input id="modal_rg_aluno" type="text" class="form-control " placeholder="RG" aria-label="Username" aria-describedby="basic-addon1" maxlength="13" >
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">CEP</span>
                        </div>
                        <input id="cep_aluno" type="text" class="form-control " placeholder="xxxxx-xxx" aria-label="Username" aria-describedby="basic-addon1" maxlength="9" >
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Cidade</span>
                        </div>
                        <input id="cidade_aluno" type="text" class="form-control " placeholder="Nome da Cidade" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                    </div>   
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend col-md-">
                            <span class="input-group-text color-span" id="basic-addon1">Bairro</span>
                        </div>
                        <input id="bairro_aluno" type="text" class="form-control " placeholder="Nome do Bairro" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Rua</span>
                        </div>
                        <input id="rua_aluno" type="text" class="form-control " placeholder="Nome da Rua" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                    </div>   
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">N??mero</span>
                        </div>
                        <input id="modal_numero_aluno" type="number" class="form-control " placeholder="N??mero" aria-label="Username" aria-describedby="basic-addon1" >             
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">E-mail</span>
                        </div>
                        <input id="modal_email_aluno" type="text" class="form-control t" placeholder="E-mail" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Telefone</span>
                        </div>
                        <input id="modal_tel_aluno" type="text" class="form-control " placeholder="(xx) x xxxx-xxxx" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Data Cadastro</span>
                        </div>
                        <input id="modal_dtacadastro_aluno" type="date" class="form-control " aria-label="Username" aria-describedby="basic-addon1" readOnly>
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


<script src="./backend/alunos/listagem.js"></script>    
<?php
    include_once('rodape.php');
?>