<?php
    include_once('cabecalho.php');
?>
<div id="cont_principal" class="container">
    <div class="row offset-md-2"><h1 id="tela-desc" class="tela-desc">&nbsp;Cadastrar Aluno</h1></div>

        <div class="container offset-md-2">
            <div class="row">
                <div class="input-group mb-3 col-md-7">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">Nome</span>
                    </div>
                    <input id="nome_aluno" type="text" class="form-control " placeholder="Nome do aluno" aria-describedby="basic-addon1" >
                </div>
                <div class="input-group mb-3 col-md-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">Data de Nascimento</span>
                    </div>
                    <input id="dta_nascimento" type="date" class="form-control " placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" >
                </div>
            </div>

            <div class="row">
                <div class="input-group mb-3 col-md-6">
                    <div class="input-group-prepend ">
                        <span class="input-group-text color-span" id="basic-addon1">CPF</span>
                    </div>
                    <input id="cpf_usuario" type="text" class="form-control is-invalid" placeholder="CPF" aria-label="Username" aria-describedby="basic-addon1" maxlength="14" >
                </div>
                <div class="input-group mb-3 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">RG</span>
                    </div>
                    <input id="rg_usuario" type="text" class="form-control " placeholder="RG" aria-label="Username" aria-describedby="basic-addon1" maxlength="13" >
                </div>  
            </div>

            <div class="row">
                <div class="input-group mb-3 col-md-5">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">CEP</span>
                    </div>
                    <input id="cep_usuario" type="text" class="form-control " placeholder="xxxxx-xxx" aria-label="Username" aria-describedby="basic-addon1" maxlength="9" >
                </div>
                <div class="input-group mb-3 col-md-7">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">Rua</span>
                    </div>
                    <input id="rua_usuario" type="text" class="form-control " placeholder="Nome da Rua" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                </div>   
            </div>

            <div class="row">
                <div class="input-group mb-3 col-md-4">
                    <div class="input-group-prepend col-md-">
                        <span class="input-group-text color-span" id="basic-addon1">Cidade</span>
                    </div>
                    <input id="cidade_usuario" type="text" class="form-control " placeholder="Nome da Cidade" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                </div>
                <div class="input-group mb-3 col-md-4">
                    <div class="input-group-prepend col-md-">
                        <span class="input-group-text color-span" id="basic-addon1">Bairro</span>
                    </div>
                    <input id="bairro_usuario" type="text" class="form-control " placeholder="Nome do Bairro" aria-label="Username" aria-describedby="basic-addon1" readOnly>
                </div>
                <div class="input-group mb-3 col-md-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">Número</span>
                    </div>
                    <input id="numero_usuario" type="number" class="form-control " placeholder="Número" aria-label="Username" aria-describedby="basic-addon1" >             
                </div>
            </div>
            
            <div class="row">
                <div class="input-group mb-3 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">E-mail</span>
                    </div>
                    <input id="email_aluno" type="text" class="form-control " placeholder="E-mail" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3 col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text color-span" id="basic-addon1">Telefone</span>
                    </div>
                    <input id="tel_usuario" type="text" class="form-control " placeholder="(xx) x xxxx-xxxx" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <hr>
            <div class="row">
                <button id="btn_cad_user"type="submit" class="btn btn-light">Cadastrar Aluno</button>
            </div>
            <hr>
            <div id="msg_cadastroAluno"></div> 

        </div>
    </div>
</div>

<script src="./backend/alunos/cadastro.js"></script> 
<?php
    include_once('rodape.php');
?>
