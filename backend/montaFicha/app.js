// -------------------- MONTA FICHA ----------------------------	
$(document).ready(function(){

    // Função responsável por trazer todos os alunos do banco
    $.ajax({
        type:'POST',
        url:'./backend/montaFicha/app.php',
        data: 'action=searchAluno',
        cache: false,
        success:function(e){
            let pesquisa = JSON.parse(e)
            montaSelect(pesquisa)
        }
    })

    // Função responsável por montar o SELECT para escolher o aluno na montagem da Ficha
    function montaSelect(alunos){
        // alert(alunos)
        let select = "";
        select += "<option selected>Selecione o aluno</option>"
        for(let i = 0; i < alunos.length; i++){
            select += `<option value="${alunos[i].ALUNO_NOME}"> ${alunos[i].ALUNO_NOME} </option>`
        }
        document.getElementById('aluno_ficha').innerHTML=select
    }


    // Função responsável por atualizar a tabela	
    $.ajax({
        type: 'POST',
        url:'./backend/montaFicha/app.php',
        data: 'action=listaExercicio',
        cahce: false,
        success:function(e){
            var pesquisa = JSON.parse(e)	
            document.getElementById('tbl_alunos').innerHMTL = montaTbl(pesquisa)
        }
    })
		

	// Função responsável por montar a tabela de Exercícios
	function montaTbl(tabela){
		// Apagando a tabela
		document.getElementById('tbl_escolha_exe').innerHTML = ""

		// Fazendo a montagem da tabela
		let mountTabela = ''
		for(let i = 0; i < tabela.length; i++){
			mountTabela += `<tr id="linha_${tabela[i].ID_EXERCICIO}">`
            mountTabela += `<td id="nome_exe_${tabela[i].ID_EXERCICIO}">${tabela[i].NOME_EXERCICIO}</td>`
            mountTabela += `<td id="grupo_exe_${tabela[i].ID_EXERCICIO}">${tabela[i].GRUPO_MUSCULAR}</td>`
            mountTabela += `<td><input id="serie_exe_${tabela[i].ID_EXERCICIO}" type="number" class="form-control" style="width:75px !important;"></td>`
            mountTabela += `<td><input id="repeticao_exe_${tabela[i].ID_EXERCICIO}" type="number" class="form-control" style="width:75px !important;"></td>`
            mountTabela += `<td><button name="deleta_exe_${tabela[i].ID_EXERCICIO}" id="${tabela[i].ID_EXERCICIO}" type="number" class="btn btn-outline-danger deleteExeBtn">X</button></td>`
            mountTabela += `<td><button name="retorna_exe_${tabela[i].ID_EXERCICIO}" id="_${tabela[i].ID_EXERCICIO}" type="number" class="btn btn-outline-success insereExeBtn disabled" >OK</button></td>`
            mountTabela += '</tr>'
		}

		// Fixando a tabela para visualização
	 	$('#tbl_escolha_exe').append(mountTabela)
         
        var elements = document.getElementsByClassName("deleteExeBtn");
			var myFunction = function() {
				var attribute = this.id;
                deletaExe(attribute)

			};
			// Colocando evento de Listener em todos os botões Excluir
			for (var i = 0; i < elements.length; i++) {
				elements[i].addEventListener('click', myFunction, false);
			}

        function deletaExe(id){
            document.getElementById('linha_'+id).classList.add("no-print")
            document.getElementById('linha_'+id).style.opacity = 0.2
            document.getElementById(id).disabled=true
            document.getElementById("_"+id).disabled=false
            document.getElementById("_"+id).style.cursor= "pointer"
        }
        
        var elements2 = document.getElementsByClassName("insereExeBtn");
            var myFunction2 = function() {
                var attribute = this.id;
                insereExe(attribute)

            };
            // Colocando evento de Listener em todos os botões Excluir
            for (var i = 0; i < elements2.length; i++) {
                elements2[i].addEventListener('click', myFunction2, false);
            }
        function insereExe(id){
            document.getElementById('linha'+id).classList.remove("no-print")
            document.getElementById('linha'+id).style.opacity = 1
            document.getElementById(id.substr(1)).disabled=false
            document.getElementById(id).disabled=true
            // alert(id.substr(1))
        }
        
	}

    
    document.getElementById('finaliza_ficha').addEventListener('click', function(){

        if(document.getElementById('aluno_ficha').value == 'Selecione o aluno'){
            alert('Aluno não selecionado')
            document.getElementById('aluno_ficha').focus()
            return  
        }
        $(".no-print").css("display", "none");
        $(".deleteExeBtn").css("display", "none");
        $(".insereExeBtn").css("display", "none");
        $("#tbl_retorna").css("display", "none");
        $("#tbl_delete").css("display", "none");
        $("#row_aluno").css("display", "none");
        $("#finaliza_ficha").css("display", "none");
        $("#retorna_ficha").css("display", "block");
        $("#imprime_ficha").css("display", "block");
        $("#desc_ficha").css("display", "block");

        let nome_aluno = document.getElementById('aluno_ficha').value
        document.getElementById('nome_aluno').innerHTML = "<h4>Aluno: " + nome_aluno + "</h4>"

    })

    document.getElementById('retorna_ficha').addEventListener('click', function(){
        location.reload();
    })

    document.getElementById('imprime_ficha').addEventListener('click', function(){
        $("#retorna_ficha").css("display", "none");
        $("#imprime_ficha").css("display", "none");
        window.print()
    })

	
})