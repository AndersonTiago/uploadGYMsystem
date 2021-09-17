$(document).ready(function(){
   
	// Montando tabela
    atualizaTabela()
    
	function dataAtual(data){
		data = new Date(data)
        var dd = String(data.getDate()).padStart(2, '0');
        var mm = String(data.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = data.getFullYear();
        data = dd + '/' + mm + '/' + yyyy;

        return data        
    }
	
	// Função responsável por atualizar a tabela
	function atualizaTabela(){
		
		$.ajax({
			type: 'POST',
			url:'./backend/mensalidade/app.php',
			data: 'action=listaMensalidade',
			cahce: false,
			success:function(e){
				var pesquisa = JSON.parse(e)	
				// Chamando função para montar a tabela
				document.getElementById('tbl_mensalidade').innerHMTL = montaTbl(pesquisa)
			}
		})
		
	}

	function montaTbl(tabela){
		// Apagando a tabela
		document.getElementById('tbl_mensalidade').innerHTML = ""
		console.log(tabela)
		// Fazendo a montagem da tabela
		let mountTabela = ''
		for(let i = 0; i < tabela.length; i++){
			mountTabela += '<tr>'
            mountTabela += '<td>'+tabela[i].ALUNO_NOME+'</td>'
            mountTabela += '<td>'+tabela[i].MENSALIDADE_PLANO+'</td>'
			mountTabela += '<td>'+dataAtual(tabela[i].MENSALIDADE_DATA)+'</td>'
			mountTabela += '<td>'+dataAtual(tabela[i].MENSALIDADE_VENCIMENTO)+'</td>'
			mountTabela += '<td>'+tabela[i].MENSALIDADE_AI+'</td>'
            mountTabela += '</tr>'
		}

		// Fixando a tabela para visualização
	 	$('#tbl_mensalidade').append(mountTabela)

	// ----------------------------------------------------------------

	}

	// Botão cadastrar novo usuário
	document.getElementById('btn_new_mensalidade').addEventListener('click', function(){
		window.location.href="cadastro_mensalidade.php"
	})

})