$(document).ready(function(){
    // Função responsável por trazer todos os alunos do banco
    $.ajax({
        type:'POST',
        url:'./backend/avaliacaoFisica/app.php',
        data: 'action=searchAluno',
        cache: false,
        success:function(e){
            let pesquisa = JSON.parse(e)
            montaSelect(pesquisa)
        }
    })

	function checkZero(data){
		if(data.length == 1){
		  data = "0" + data;
		}
		return data;
	  }

	// Formatando data
    function dataAtual(data){		
        var today = new Date(data);
		var dd = today.getDate() + 1;
        var mm = (today.getMonth() + 1) + "";
        var yyyy = today.getFullYear();

		dd = checkZero(dd);
		mm = checkZero(mm);
		yyyy = checkZero(yyyy);		
        today = dd + '/' + mm + '/' + yyyy;

        return today        
    }

     
    // Função responsável por montar o SELECT
    function montaSelect(alunos){
        let select = "";
        select += "<option selected>Selecione o aluno</option>"
        for(let i = 0; i < alunos.length; i++){
            select += `<option id="${alunos[i].ALUNO_ID}" value="${alunos[i].ALUNO_NOME}"> ${alunos[i].ALUNO_NOME} </option>`
        }
        document.getElementById('aluno_Av').innerHTML=select
    }

    // Função responsável por montar a tabela de Exercícios
	function montaTbl(tabela){
        console.log(tabela)
		if(tabela != ""){
			// Apagando a tabela
			document.getElementById('lista_alunos').innerHTML = ""

			// Fazendo a montagem da tabela
			let mountTabela = ''
			for(let i = 0; i < tabela.length; i++){
				mountTabela += '<button data-toggle="modal" name="btn_teste" data-target="#exampleModalAluno" class="btn btn-secondary btn-lg btn-block btn-sm editBTN" id="'+tabela[i].ID_AVALIACAO+'">'+dataAtual(tabela[i].AV_DATA)+'</button</td>'
			}

			// Fixando a tabela para visualização
			$('#lista_alunos').append(mountTabela)			
		
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

		}else{
			// Apagando a tabela
			document.getElementById('lista_alunos').innerHTML = ""

			mountTabela = '<div class="alert alert-danger" role="alert">Aluno sem avaliação!</div>'

			// Fixando a tabela para visualização			
			$('#lista_alunos').append(mountTabela)
		}
		

	}


    // Pegando o ID do Aluno selecionado
    let IDaluno = ""
    $("#aluno_Av").change(function() {
        IDaluno = $(this).children(":selected").attr("id");
    });

    document.getElementById('av_btn_consulta').addEventListener('click', function(){
        if(IDaluno == "Selecione o aluno" || IDaluno == ""){alert("Selecione o aluno!"); return}
        $.ajax({
            type:'POST',
            url:'./backend/avaliacaoFisica/app.php',
            data: 'consultaAvaliacao='+IDaluno,
            cache: false,
            success:function(e){
                var pesquisa = JSON.parse(e)	
				// Chamando função para montar a tabela
                console.log(pesquisa)
				document.getElementById('lista_alunos').innerHMTL = montaTbl(pesquisa)		
            }
            
        })
    })

    // Função responsável por buscar dado no banco e colocar nos input os valores para edição
	function searchEdit(ide){

		let id_search = {id: ide}
		let pacId_search = JSON.stringify(id_search)
		// Buscando no banco novamente e preenchendo os inputs para edição
		$.ajax({
			type: 'POST',
			url:'./backend/avaliacaoFisica/app.php',
			data: 'action=listaAvaliacaoID&id_search='+ pacId_search,
			cache: false,
			success:function(e){		
				var pesquisa = JSON.parse(e)

				document.getElementById('av_peso').value = pesquisa[0].AV_PESO
				document.getElementById('av_altura').value = pesquisa[0].AV_ALTURA
				document.getElementById('av_imc').value = pesquisa[0].AV_IMC
				document.getElementById('av_torax').value = pesquisa[0].AV_TORAX
				document.getElementById('av_cintura').value  = pesquisa[0].AV_CINTURA
				document.getElementById('av_abdomen').value  = pesquisa[0].AV_ABDOMEN
				document.getElementById('av_quadril').value = pesquisa[0].AV_QUADRIL
				document.getElementById('av_braco').value = pesquisa[0].AV_BRACO
				document.getElementById('av_coxa').value = pesquisa[0].AV_COXA
				document.getElementById('av_antebraco').value = pesquisa[0].AV_ANTEBRACO
				document.getElementById('av_panturrilha').value = pesquisa[0].AV_PANTURRILHA
				document.getElementById('av_pescoco').value = pesquisa[0].AV_PESCOCO
			}
		})
	}

	// Função responsável por salvar a edição realizada pelo aluno
	document.querySelector('#saveEdit').addEventListener('click', function(){
		
		let editId = document.getElementById('inputId').value 
		let editPeso = document.getElementById('av_peso').value
		let editAltura = document.getElementById('av_altura').value
		let editIMC  = document.getElementById('av_imc').value
		let editTorax = document.getElementById('av_torax').value
		let editCintura = document.getElementById('av_cintura').value
		let editAbdomen = document.getElementById('av_abdomen').value
		let editQuadril = document.getElementById('av_quadril').value
		let editBraco = document.getElementById('av_braco').value
		let editCoxa = document.getElementById('av_coxa').value
		let editAntebraco = document.getElementById('av_antebraco').value
		let editPanturrilha = document.getElementById('av_panturrilha').value
		let editPescoco = document.getElementById('av_pescoco').value


		let dataEdit = {
			editId: editId,
			editPeso: editPeso,
			editAltura: editAltura,
			editIMC: editIMC,
			editTorax: editTorax,
			editCintura: editCintura,
			editAbdomen: editAbdomen,
			editQuadril: editQuadril,
			editBraco: editBraco,
			editCoxa: editCoxa,
			editAntebraco: editAntebraco,
			editPanturrilha: editPanturrilha,
			editPescoco: editPescoco
		}

		let pacEdit = JSON.stringify(dataEdit)

		if(editPeso != "" && editAltura != "" && editIMC != "" && editTorax != "" && editCintura != "" && editAbdomen != "" && editQuadril != "" && editQuadril != "" && editBraco != "" && editCoxa != "" && editAntebraco != "" && editPanturrilha != "" && editPescoco != ""){
			// fazendo a requisição AJAX
			$.ajax({
				type:'POST',
				url:'./backend/avaliacaoFisica/app.php',
				data: 'action=editAvaliacao&pacEdit='+pacEdit,
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