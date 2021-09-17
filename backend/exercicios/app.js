$(document).ready(function(){

	// Montando tabela
	atualizaTabela()

	// Função responsável por atualizar a tabela
	function atualizaTabela(){
		
		$.ajax({
			type: 'POST',
			url:'./backend/exercicios/app.php',
			data: 'action=listaExercicio',
			cahce: false,
			success:function(e){
				var pesquisa = JSON.parse(e)	
				// Chamando função para montar a tabela
				document.getElementById('tbl_exercicios').innerHMTL = montaTbl(pesquisa)
			}
		})
		
	}

	document.getElementById('atu_table').addEventListener('click', function(){atualizaTabela(); alert('tabela atualizada!')})
	
	//Ação realizada quando o botão cadastrar for pressionado
	document.querySelector('#btn_cadastra').addEventListener('click', function(){
		
		//Recebendo valores dos inputs		
		let nome_exerc = document.querySelector('#nome_exercicio').value;
		let grupo_musc = document.querySelector('#inputExercicio').value;
		
		// Preparando JSON para ser enviado para o PHP
		let data_php = {
			nome_exerc: nome_exerc,
			grupo_musc: grupo_musc
		}
		let pac = JSON.stringify(data_php)

		// Verificando se não há inputs vazios
		if(nome_exerc != "" && grupo_musc !="" && grupo_musc !="Selecione"){

			// fazendo a requisição AJAX
			$.ajax({
				type:'POST',
				url:'./backend/exercicios/app.php',
                data: 'cadastraExercicio='+pac,
				cache: false,
				success:function(e){
					//Passando o resultado e exibindo na tela
					document.getElementById('msg_cadastroExercicio').innerHTML = e
					document.querySelector('#nome_exercicio').value = "";
					document.querySelector('#inputExercicio').value = "";
					document.querySelector('#nome_exercicio').focus();
					atualizaTabela()
					setTimeout(function(){
						document.getElementById('msg_cadastroExercicio').innerHTML = ""	
					},3000)					
				}
			})
			
			
		}else{
			alert('Preencha todos os campos no formulário!')
		}

	})

	// Função responsável por montar a tabela de Exercícios
	function montaTbl(tabela){
		// Apagando a tabela
		document.getElementById('tbl_exercicios').innerHTML = ""

		// Fazendo a montagem da tabela
		let mountTabela = ''
		for(let i = 0; i < tabela.length; i++){
			mountTabela += '<tr>'
            mountTabela += '<td>'+tabela[i].NOME_EXERCICIO+'</td>'
            mountTabela += '<td>'+tabela[i].GRUPO_MUSCULAR+'</td>'
            mountTabela += '<td><button data-toggle="modal" name="btn_teste" data-target="#exampleModal" class="btn-primary fas fa-edit editBTN" id="'+tabela[i].ID_EXERCICIO+'"></button</td>'
            mountTabela += '<td><button class="btn-danger fas fa-times-circle deleteBTN" id="'+tabela[i].ID_EXERCICIO+'"></button</td>'
            mountTabela += '</tr>'
		}

		// Fixando a tabela para visualização
	 	$('#tbl_exercicios').append(mountTabela)
		
	
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
				url:'./backend/exercicios/app.php',
				data: 'action=deleteExercicio&deleteId='+pacDelete,
				cache: false,
				success:function(e){		
					// var pesquisa = JSON.parse(e)
					if(e == 'sucesso'){
						alert('Exercício Excluído com sucesso')
					}else{
						alert('Não foi possível excluir exercício')
					}
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

	}


	// Função responsável por buscar dado no banco e colocar nos input os valores para edição
	function searchEdit(ide){

		let id_search = {id: ide}
		let pacId_search = JSON.stringify(id_search)
		// Buscando no banco novamente e preenchendo os inputs para edição
		$.ajax({
			type: 'POST',
			url:'./backend/exercicios/app.php',
			data: 'action=listaExercicioID&id_search='+ pacId_search,
			cache: false,
			success:function(e){		
				var pesquisa = JSON.parse(e)
				document.getElementById('modal_exercicio').value = pesquisa[0].NOME_EXERCICIO
				document.getElementById('modal_grupo').value = pesquisa[0].GRUPO_MUSCULAR
			}
		})

	}

	// Função responsável por salvar a edição realizada pelo usuário
	document.querySelector('#saveEdit').addEventListener('click', function(){
		
		let editId = document.getElementById('inputId').value 
		let editNome = document.getElementById('modal_exercicio').value 
		let editGrupo = document.getElementById('modal_grupo').value 


		let dataEdit = {
			id: editId,
			editNome: editNome,
			editGrupo: editGrupo
		}

		let pacEdit = JSON.stringify(dataEdit)

		if(editNome != "" && editGrupo != ""){
			// fazendo a requisição AJAX
			$.ajax({
				type:'POST',
				url:'./backend/exercicios/app.php',
				data: 'action=editExercicio&pacEdit='+pacEdit,
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