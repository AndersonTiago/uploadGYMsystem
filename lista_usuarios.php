<?php
    include_once('cabecalho.php');
?>

<div id="cont_principal" class="container">
    <div class="row offset-md-2"><h1 id="tela-desc" class="tela-desc">&nbsp;Lista de Usuários</h1></div>
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
                    <input id="nome_usuario" type="text" class="form-control " placeholder="Pesquise pelo Nome" aria-label="Username" aria-describedby="basic-addon1">
                </div> 
            </div>

            <button id="btn_new_user" style="float:right;margin-bottom:3px;" class="btn btn-success">Novo Usuário</button>
            <div id="msg_remocaoUsuario"></div>
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                    <th scope="col">CPF</th>
                    <th scope="col" style="width:45%;">Nome</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody id="tbl_usuarios">
                </tbody>
            </table>
        </div>    
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
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
                        <input id="modal_nome_usuario" type="text" class="form-control" placeholder="Nome do usuário" aria-describedby="basic-addon1" >
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
                        <input id="modal_rg_usuario" type="text" class="form-control " placeholder="RG" aria-label="Username" aria-describedby="basic-addon1" maxlength="13" >
                    </div>
                </div>
                <div class="row"> 
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Cargo</span>
                        </div>
                        <select id="modal_cargo_usuario" class="custom-select " required>
                            <option selected>Selecione o cargo</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Recepcionista">Recepcionista</option>
                            <option value="Educador Físico">Educador Físico</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">CEP</span>
                        </div>
                        <input id="cep_usuario" type="text" class="form-control " placeholder="xxxxx-xxx" aria-label="Username" aria-describedby="basic-addon1" maxlength="9" >
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Cidade</span>
                        </div>
                        <input id="cidade_usuario" type="text" class="form-control " placeholder="cidade" aria-label="Username" aria-describedby="basic-addon1" readOnly >
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend col-md-">
                            <span class="input-group-text color-span" id="basic-addon1">Bairro</span>
                        </div>
                        <input id="bairro_usuario" type="text" class="form-control " placeholder="Nome do Bairro" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Rua</span>
                        </div>
                        <input id="rua_usuario" type="text" class="form-control " placeholder="Nome da Rua" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                    </div>   
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Número</span>
                        </div>
                        <input id="numero_usuario" type="number" class="form-control " placeholder="Número" aria-label="Username" aria-describedby="basic-addon1" >             
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">E-mail</span>
                        </div>
                        <input id="modal_email_usuario" type="text" class="form-control t" placeholder="E-mail" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Telefone</span>
                        </div>
                        <input id="modal_tel_usuario" type="text" class="form-control " placeholder="(xx) x xxxx-xxxx" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text color-span" id="basic-addon1">Data Cadastro</span>
                        </div>
                        <input id="modal_dtacadastro_usuario" type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readOnly>
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
    
<script src="./backend/usuarios/listagem.js"></script> 
<?php
    include_once('rodape.php');
?>