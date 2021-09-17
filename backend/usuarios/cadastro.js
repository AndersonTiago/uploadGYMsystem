$(document).ready(function(){
   
    // Bloqueando cadastro de dois CPF iguais
    document.getElementById("cpf_usuario").addEventListener('keyup', function(){
        let dobCPF = document.getElementById("cpf_usuario").value

        if(dobCPF.length == 14){
            $.ajax({
                type: "POST",
                url: "./backend/usuarios/app.php",
                data: "dbCPF="+dobCPF,
                cache: false,
                success: function(e){
                    if(e != ""){
                        alert("CPF já cadastrado")
                        document.getElementById("cpf_usuario").value = ""
                        document.getElementById("cpf_usuario").focus()
                    }
                }
            })
        }        
    })

    // Ação dada quando tenta cadastrar um usuário
    document.querySelector('#btn_cad_user').addEventListener('click', function(){
        
        // Pegando os valores dos inputs
        let nome  = document.getElementById('nome_usuario').value
        let data  = document.getElementById('dta_nascimento').value
        let cpf   = document.getElementById('cpf_usuario').value
        let rg    = document.getElementById('rg_usuario').value
        let cargo = document.getElementById('cargo_usuario').value
        let cep   = document.getElementById('cep_usuario').value 
        let cidade   = document.getElementById('cidade_usuario').value 
        let rua   = document.getElementById('rua_usuario').value
        let bairro= document.getElementById('bairro_usuario').value
        let numero= document.getElementById('numero_usuario').value
        let email = document.getElementById('email_usuario').value
        let telefone = document.getElementById('tel_usuario').value 
        let senha = document.getElementById('senha_usuario').value
        let senha2= document.getElementById('senha2_usuario').value

        // Montando array com todos os dados do formulário
        let dadosUsuario = []
        dadosUsuario[0] = nome
        dadosUsuario[1] = data
        dadosUsuario[2] = cpf
        dadosUsuario[3] = rg
        dadosUsuario[4] = cargo
        dadosUsuario[5] = cep
        dadosUsuario[6] = cidade
        dadosUsuario[7] = rua
        dadosUsuario[8] = bairro
        dadosUsuario[9] = numero
        dadosUsuario[10] = email
        dadosUsuario[11] = telefone
        dadosUsuario[12] = senha


        // Verificando CPF
        if(cpf.length < 14){alert("Invalido"); return}

        // Verificando o cargo
        if(cargo =="Selecione o cargo"){alert("Cargo inválido"); return}

        // Verificando as senhas informadas
        if(senha != senha2){alert('Senhas incompatíveis! Digite novamente'); senha.value=""; senha2.value=""; senha.focus(); return}
        
        // Verificando se todos os dados estão preenchidos
        if(dadosUsuario.indexOf("") != -1) {alert('Preencha todos os campos!'); return}

        // Preparando JSON para ser enviado para o PHP
		let data_php = {
			nome: nome,
            data: data,
            cpf: cpf,
            rg: rg,
            cargo: cargo,
            cep: cep,
            cidade: cidade,
            rua: rua,
            bairro: bairro,
            numero: numero,
            email: email,
            telefone: telefone,
            senha: senha
		}
		let pac = JSON.stringify(data_php)

        // Realizando o cadastro do usuário
        $.ajax({
            type:'POST',
            url:'./backend/usuarios/app.php',
            data: 'cadastraUsuario='+pac,
            cache: false,
            success:function(e){
                //Passando o resultado e exibindo na tela
    
                document.getElementById('msg_cadastroUsuario').innerHTML = e;
                document.getElementById('nome_usuario').value = "";
                document.getElementById('dta_nascimento').value = "";
                document.getElementById('cpf_usuario').value = "";
                document.getElementById('rg_usuario').value = "";
                document.getElementById('cargo_usuario').value = "";
                document.getElementById('cep_usuario').value = "";
                document.getElementById('cidade_usuario').value = "";
                document.getElementById('rua_usuario').value = "";
                document.getElementById('bairro_usuario').value = "";
                document.getElementById('numero_usuario').value = "";
                document.getElementById('email_usuario').value = "";
                document.getElementById('tel_usuario').value = "";
                document.getElementById('senha_usuario').value = "";
                document.getElementById('senha2_usuario').value = "";
                document.getElementById('nome_usuario').focus();
                setTimeout(function(){
                    document.getElementById('msg_cadastroUsuario').innerHTML = ""	
                },3000)					
            }
        })
    })
})