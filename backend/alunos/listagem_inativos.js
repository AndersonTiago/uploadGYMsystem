$(document).ready(function(){
   
	// Montando tabela
    atualizaTabela()
    
	// Função responsável por atualizar a tabela
	function atualizaTabela(){		
		$.ajax({
			type: 'POST',
			url:'./backend/alunos/app2.php',
			data: 'action=listaAlunos',
			cahce: false,
			success:function(e){
				var pesquisa = JSON.parse(e)	
				// console.log(e)
				// Chamando função para montar a tabela
				document.getElementById('tbl_alunos').innerHMTL = montaTbl(pesquisa)
			}
		})		
	}


	// Função responsável por montar a tabela
	function montaTbl(tabela){
		if(tabela != ""){
			// Apagando a tabela
			document.getElementById('tbl_alunos').innerHTML = ""

			// Fazendo a montagem da tabela
			let mountTabela = ''
			for(let i = 0; i < tabela.length; i++){
				mountTabela += '<tr>'
				mountTabela += '<td>'+tabela[i].ALUNO_CPF+'</td>'
				mountTabela += '<td>'+tabela[i].ALUNO_NOME+'</td>'
				mountTabela += '<td>'+tabela[i].ALUNO_TELEFONE+'</td>'
				mountTabela += '<td>'+tabela[i].ALUNO_EMAIL+'</td>'
				mountTabela += '</tr>'
			}

			// Fixando a tabela para visualização
			$('#tbl_alunos').append(mountTabela)			
		}else{
			// Apagando a tabela
			document.getElementById('tbl_alunos').innerHTML = ""
			mountTabela = '<tr><td colspan="5">Aluno não encontrado!</td></tr>'
			// Fixando a tabela para visualização			
			$('#tbl_alunos').append(mountTabela)
		}	

	}

	// Botão cadastrar novo usuário
	document.getElementById('btn_new_aluno').addEventListener('click', function(){
		window.location.href="cadastro_mensalidade.php"
	})

	// Procurando todos os alunos(busca por LIKE) -> CPF
	document.querySelector('#cpf_usuario').addEventListener('keyup', function(e){

		if(document.getElementById('cpf_usuario').value != ""){
			$.ajax({
			type:'POST',
			url:'./backend/alunos/app2.php',
			data:'cpfSearch='+document.getElementById('cpf_usuario').value,
			cache: false,
				success: function(e){
					var resultado = JSON.parse(e)
					document.getElementById('tbl_alunos').innerHMTL = montaTbl(resultado)	
				}
			})
		}else{
			atualizaTabela()
		}		
	})

	// Procurando todos os alunos(busca por LIKE) -> NOME
	document.querySelector('#nome_aluno').addEventListener('keyup', function(e){

		if(document.getElementById('nome_aluno').value != ""){
			$.ajax({
			type:'POST',
			url:'./backend/alunos/app2.php',
			data:'nomeSearch='+document.getElementById('nome_aluno').value,
			cache: false,
				success: function(e){
					// alert(e)
					var resultado = JSON.parse(e)
					document.getElementById('tbl_alunos').innerHMTL = montaTbl(resultado)	
				}
			})
		}else{
			atualizaTabela()
		}
		
	})
})