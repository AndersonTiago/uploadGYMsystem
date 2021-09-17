$(document).ready(function(){
   
    // Bloqueando cadastro de dois CPF iguais
    document.getElementById("cpf_usuario").addEventListener('keyup', function(){
        let dobCPF = document.getElementById("cpf_usuario").value

        if(dobCPF.length == 14){
            $.ajax({
                type: "POST",
                url: "./backend/alunos/app.php",
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
        let nome  = document.getElementById('nome_aluno').value
        let data  = document.getElementById('dta_nascimento').value
        let cpf   = document.getElementById('cpf_usuario').value
        let rg    = document.getElementById('rg_usuario').value
        let cep   = document.getElementById('cep_usuario').value
        let cidade= document.getElementById('cidade_usuario').value 
        let rua   = document.getElementById('rua_usuario').value
        let bairro= document.getElementById('bairro_usuario').value
        let numero= document.getElementById('numero_usuario').value
        let email = document.getElementById('email_aluno').value
        let telefone = document.getElementById('tel_usuario').value 


        // Montando array com todos os dados do formulário
        let dadosAluno = []
        dadosAluno[0] = nome
        dadosAluno[1] = data
        dadosAluno[2] = cpf
        dadosAluno[3] = rg
        dadosAluno[4] = cep
        dadosAluno[5] = cidade
        dadosAluno[6] = rua
        dadosAluno[7] = bairro
        dadosAluno[8] = numero
        dadosAluno[9] = email
        dadosAluno[10] = telefone


        // Verificando CPF
        if(cpf.length < 14){alert("Invalido"); return}
        
        // Verificando se todos os dados estão preenchidos
        if(dadosAluno.indexOf("") != -1) {alert('Preencha todos os campos!'); return}

        // Preparando JSON para ser enviado para o PHP
		let data_php = {
			nome: nome,
            data: data,
            cpf: cpf,
            rg: rg,
            cep: cep,
            cidade:cidade,
            rua: rua,
            bairro: bairro,
            numero: numero,
            email: email,
            telefone: telefone
		}
		let pac = JSON.stringify(data_php)

        // Realizando o cadastro do usuário
        $.ajax({
            type:'POST',
            url:'./backend/alunos/app.php',
            data: 'cadastraAluno='+pac,
            cache: false,
            success:function(e){
                //Passando o resultado e exibindo na tela    
                document.getElementById('msg_cadastroAluno').innerHTML = e;
                document.getElementById('nome_aluno').value = "";
                document.getElementById('dta_nascimento').value = "";
                document.getElementById('cpf_usuario').value = "";
                document.getElementById('rg_usuario').value = "";
                document.getElementById('cep_usuario').value = "";
                document.getElementById('cidade_usuario').value = "";
                document.getElementById('rua_usuario').value = "";
                document.getElementById('bairro_usuario').value = "";
                document.getElementById('numero_usuario').value = "";
                document.getElementById('email_aluno').value = "";
                document.getElementById('tel_usuario').value = "";
                document.getElementById('nome_aluno').focus();
                setTimeout(function(){
                    document.getElementById('msg_cadastroAluno').innerHTML = ""	
                },3000)					
            }
        })
    })
})