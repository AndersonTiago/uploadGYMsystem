$(document).ready(function(){
   
	// Montando tabela
    atualizaTabela()
    
	// Função responsável por atualizar a tabela
	function atualizaTabela(){
		
		$.ajax({
			type: 'POST',
			url:'./backend/usuarios/app.php',
			data: 'action=listaUsuarios',
			cahce: false,
			success:function(e){
				var pesquisa = JSON.parse(e)	
				// Chamando função para montar a tabela
				document.getElementById('tbl_usuarios').innerHMTL = montaTbl(pesquisa)
			}
		})
		
	}


	// Função responsável por montar a tabela de Exercícios
	function montaTbl(tabela){
		if(tabela != ""){
			// Apagando a tabela
			document.getElementById('tbl_usuarios').innerHTML = ""

			// Fazendo a montagem da tabela
			let mountTabela = ''
			for(let i = 0; i < tabela.length; i++){
				mountTabela += '<tr>'
				mountTabela += '<td>'+tabela[i].USER_CPF+'</td>'
				mountTabela += '<td>'+tabela[i].USER_NOME+'</td>'
				mountTabela += '<td>'+tabela[i].USER_CARGO+'</td>'
				mountTabela += '<td><button data-toggle="modal" name="btn_teste" data-target="#exampleModal" class="btn-primary fas fa-edit editBTN" id="'+tabela[i].USER_ID+'"></button</td>'
				mountTabela += '<td><button class="btn-danger fas fa-times-circle deleteBTN" id="'+tabela[i].USER_ID+'"></button</td>'
				mountTabela += '</tr>'
			}

			// Fixando a tabela para visualização
			$('#tbl_usuarios').append(mountTabela)			
		
			/*
				Botão EDITAR
				Logo após a criação da tabela é chamada a função para 
				mandar o ID do botão que foi enviado para o modal
			*/ 
			var elements = document.getElementsByClassName("editBTN");
			var myFunction = function() {
				var attribute = this.id;
				document.getElementById('inputId').value = attribute
				searchEdit(attribute);
			};
			// Colocando evento de Listener em todos os botões EDITAR
			for (var i = 0; i < elements.length; i++) {
				elements[i].addEventListener('click', myFunction, false);
			}

		// ----------------------------------------------------------------

			/*
				Botão EXCLUIR
				Logo após a criação da tabela é chamada a função para 
				mandar o ID do botão que foi enviado para o modal
			*/ 
			var elements2 = document.getElementsByClassName("deleteBTN");
			var myFunction2 = function() {
					
				if(confirm('Tem certeza que deseja excluir item?')){
					let attribute2 = this.id;
					let dataDelete = { id: attribute2}
					let pacDelete = JSON.stringify(dataDelete)
					$.ajax({
					type: 'POST',
					url:'./backend/usuarios/app.php',
					data: 'action=deleteUsuarios&deleteId='+pacDelete,
					cache: false,
					success:function(e){		
						document.getElementById('msg_remocaoUsuario').innerHTML = e;
						setTimeout(function(){
							document.getElementById('msg_remocaoUsuario').innerHTML = ""	
						},3000)	
						atualizaTabela()
						
						}
					})
				}else{
					return
				}

			};
			// Colocando evento de Listener em todos os botões EXCLUIR
			for (var i = 0; i < elements2.length; i++) {
				elements2[i].addEventListener('click', myFunction2, false);
			}
		}else{
			// Apagando a tabela
			document.getElementById('tbl_usuarios').innerHTML = ""

			mountTabela = '<tr><td colspan="5">Usuário não encontrado!</td></tr>'
			// Fixando a tabela para visualização			
			$('#tbl_usuarios').append(mountTabela)
		}
		

	}

	// Procurando todos os usuários(busca por LIKE) -> CPF
	document.querySelector('#cpf_usuario').addEventListener('keyup', function(e){

		if(document.getElementById('cpf_usuario').value != ""){
			$.ajax({
			type:'POST',
			url:'./backend/usuarios/app.php',
			data:'cpfSearch='+document.getElementById('cpf_usuario').value,
			cache: false,
				success: function(e){
					// alert(e)
					var resultado = JSON.parse(e)
					document.getElementById('tbl_usuarios').innerHMTL = montaTbl(resultado)	
				}
			})
		}else{
			atualizaTabela()
		}
		
	})

	// Procurando todos os usuários(busca por LIKE) -> NOME
	document.querySelector('#nome_usuario').addEventListener('keyup', function(e){

		if(document.getElementById('nome_usuario').value != ""){
			$.ajax({
			type:'POST',
			url:'./backend/usuarios/app.php',
			data:'nomeSearch='+document.getElementById('nome_usuario').value,
			cache: false,
				success: function(e){
					// alert(e)
					var resultado = JSON.parse(e)
					document.getElementById('tbl_usuarios').innerHMTL = montaTbl(resultado)
	
				}

			})
		}else{
			atualizaTabela()
		}
		
	})


	// Função responsável por buscar dado no banco e colocar nos input os valores para edição
	function searchEdit(ide){

		let id_search = {id: ide}
		let pacId_search = JSON.stringify(id_search)
		// Buscando no banco novamente e preenchendo os inputs para edição
		$.ajax({
			type: 'POST',
			url:'./backend/usuarios/app.php',
			data: 'action=listaUsuariosID&id_search='+ pacId_search,
			cache: false,
			success:function(e){		
				var pesquisa = JSON.parse(e)

				document.getElementById('modal_nome_usuario').value = pesquisa[0].USER_NOME
				document.getElementById('modal_dta_nascimento').value = pesquisa[0].USER_NASCIMENTO
				document.getElementById('modal_cpf_usuario').value = pesquisa[0].USER_CPF
				document.getElementById('modal_rg_usuario').value = pesquisa[0].USER_RG
				document.getElementById('modal_cargo_usuario').value = pesquisa[0].USER_CARGO
				document.getElementById('cep_usuario').value  = pesquisa[0].USER_CEP
				document.getElementById('cidade_usuario').value  = pesquisa[0].USER_CIDADE
				document.getElementById('rua_usuario').value = pesquisa[0].USER_RUA
				document.getElementById('bairro_usuario').value = pesquisa[0].USER_BAIRRO
				document.getElementById('numero_usuario').value = pesquisa[0].USER_NUMERO
				document.getElementById('modal_email_usuario').value = pesquisa[0].USER_EMAIL
				document.getElementById('modal_tel_usuario').value = pesquisa[0].USER_TELEFONE
				document.getElementById('modal_dtacadastro_usuario').value = pesquisa[0].USER_DATACADASTRO				
			}
		})

	}

	// Botão cadastrar novo usuário
	document.getElementById('btn_new_user').addEventListener('click', function(){
		window.location.href="cadastro_usuario.php"
	})
	
	// Consumindo API do Correio
	document.querySelector('#cep_usuario').addEventListener('keyup', function(){
        let cepValue = document.querySelector('#cep_usuario').value
        if(cepValue.length == 9){
            cepSearch = cepValue.replace('-','')
            $.getJSON(`https://viacep.com.br/ws/${cepValue}/json/`, function(data) {            
				let cidade = data.localidade;
				let bairro = data.bairro; 
                let rua = data.logradouro;
				document.querySelector('#cidade_usuario').value = cidade
                document.querySelector('#rua_usuario').value = rua
                document.querySelector('#bairro_usuario').value = bairro
                document.querySelector('#numero_usuario').focus()
            })
        }else{
			document.querySelector('#cidade_usuario').value = ""
            document.querySelector('#rua_usuario').value = ""
            document.querySelector('#bairro_usuario').value = ""
        }
        
    })


	//Adicionando Máscaras aos INPUTS do MODAL (EDITAR)
	// CPF
	$(document).ready(function () { 
		var $cpf = $("#modal_cpf_usuario");
		$cpf.mask('000.000.000-00', {reverse: true});
	});

	// RG
	$(document).ready(function () { 
		var $rg = $("#modal_rg_usuario");
		$rg.mask('00.000.000-00', {reverse: true});
	});
	// CEP
	$(document).ready(function () { 
		var $cep = $("#modal_cep_usuario");
		$cep.mask('00000-000', {reverse: true});
	});
	// TELEFONE
	$(document).ready(function () { 
		var $cep = $("#modal_tel_usuario");
		$cep.mask('(00) 000000000', {reverse: false});
	});

	// Função responsável por salvar a edição realizada pelo usuário
	document.querySelector('#saveEdit').addEventListener('click', function(){
		
		let editId = document.getElementById('inputId').value 
		let	editNome = document.getElementById('modal_nome_usuario').value
		let	editData = document.getElementById('modal_dta_nascimento').value
		let	editCpf = document.getElementById('modal_cpf_usuario').value
		let	editRg = document.getElementById('modal_rg_usuario').value
		let	editCargo = document.getElementById('modal_cargo_usuario').value
		let	editCep = document.getElementById('cep_usuario').value
		let	editCidade = document.getElementById('cidade_usuario').value
		let	editRua = document.getElementById('rua_usuario').value
		let	editBairro = document.getElementById('bairro_usuario').value
		let	editNumero = document.getElementById('numero_usuario').value
		let	editEmail = document.getElementById('modal_email_usuario').value
		let	editTelefone = document.getElementById('modal_tel_usuario').value


		let dataEdit = {
			editId: editId,
			editNome: editNome,
			editData: editData,
			editCpf: editCpf,
			editRg: editRg,
			editCargo: editCargo,
			editCep: editCep,
			editCidade: editCidade,
			editRua: editRua,
			editBairro: editBairro,
			editNumero: editNumero,
			editEmail: editEmail,
			editTelefone: editTelefone
		}

		let pacEdit = JSON.stringify(dataEdit)

		if(editNome != "" && editData != "" && editCpf != "" && editRg != "" && editCargo != "" && editCep != ""&& editCidade != "" && editRua != "" && editBairro != "" && editNumero != "" && editEmail != "" && editTelefone != ""){
			// fazendo a requisição AJAX
			$.ajax({
				type:'POST',
				url:'./backend/usuarios/app.php',
				data: 'action=editUsuarios&pacEdit='+pacEdit,
				cache: false,
				success:function(e){
					document.getElementById('Editmessage').innerHTML = e
					setTimeout(function(){
						document.getElementById('Editmessage').innerHTML = ""	
					},3000)
					atualizaTabela()
				}
			})

		}else{
			alert('Preencha todos os campos no formulário!')
		}
		
	})

})