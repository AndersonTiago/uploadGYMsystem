$(document).ready(function(){

	// Montando tabela
	atualizaTabela()

	// Função responsável por atualizar a tabela
	function atualizaTabela(){		
		$.ajax({
			type: 'POST',
			url:'./backend/equipamentos/app.php',
			data: 'action=listaEquipamento',
			cahce: false,
			success:function(e){
				var pesquisa = JSON.parse(e)	
				// Chamando função para montar a tabela
				document.getElementById('tbl_equipamento').innerHMTL = montaTbl(pesquisa)
			}
		})
		
	}

	// Função responsável por montar a tabela de Equipamentos
	function montaTbl(tabela){
		// Apagando a tabela
		document.getElementById('tbl_equipamento').innerHTML = ""

		// Fazendo a montagem da tabela
		let mountTabela = ''
		for(let i = 0; i < tabela.length; i++){
			mountTabela += '<tr>'
            mountTabela += '<td>'+tabela[i].ap_nome+'</td>'
            mountTabela += '<td>'+tabela[i].ap_kg+'</td>'
			mountTabela += '<td>'+tabela[i].ap_marca+'</td>'
			mountTabela += '<td>'+tabela[i].ap_qtd+'</td>'
            mountTabela += '<td><button data-toggle="modal" name="btn_teste" data-target="#exampleModalEquipamento" class="btn-primary fas fa-edit editBTN" id="'+tabela[i].ap_id+'"></button</td>'
            mountTabela += '<td><button class="btn-danger fas fa-times-circle deleteBTN" id="'+tabela[i].ap_id+'"></button</td>'
            mountTabela += '</tr>'
		}

		// Fixando a tabela para visualização
	 	$('#tbl_equipamento').append(mountTabela)
		
	
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
				url:'./backend/equipamentos/app.php',
				data: 'action=deleteEquipamento&deleteId='+pacDelete,
				cache: false,
				success:function(e){		
					// var pesquisa = JSON.parse(e)
					document.getElementById('mensagem').innerHTML = e
					setTimeout(function(){
                        document.getElementById('mensagem').innerHTML = ""	
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

	}


	// Função responsável por buscar dado no banco e colocar nos input os valores para edição
	function searchEdit(ide){

		let id_search = {id: ide}
		let pacId_search = JSON.stringify(id_search)
		// Buscando no banco novamente e preenchendo os inputs para edição
		$.ajax({
			type: 'POST',
			url:'./backend/equipamentos/app.php',
			data: 'action=listaEquipamentoID&id_search='+ pacId_search,
			cache: false,
			success:function(e){		
				var pesquisa = JSON.parse(e)
				document.getElementById('edit_ap_nome').value = pesquisa[0].ap_nome
				document.getElementById('edit_ap_marca').value = pesquisa[0].ap_marca
				document.getElementById('edit_ap_kg').value = pesquisa[0].ap_kg
				document.getElementById('edit_ap_qtd').value = pesquisa[0].ap_qtd
			}
		})

	}

	// Função responsável por salvar a edição realizada pelo usuário
	document.querySelector('#saveEdit').addEventListener('click', function(){
		
		let editId = document.getElementById('inputId').value 
		let editNome = document.getElementById('edit_ap_nome').value 
		let editMarca = document.getElementById('edit_ap_marca').value 
		let editKg = document.getElementById('edit_ap_kg').value 
		let editQtd = document.getElementById('edit_ap_qtd').value 


		let dataEdit = {
			editId: editId,
			editNome: editNome,
			editMarca: editMarca,
			editKg: editKg,
			editQtd: editQtd
		}

		let pacEdit = JSON.stringify(dataEdit)

		if(editNome != "" && editQtd != ""){
			// fazendo a requisição AJAX
			$.ajax({
				type:'POST',
				url:'./backend/equipamentos/app.php',
				data: 'action=editEquipamento&pacEdit='+pacEdit,
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