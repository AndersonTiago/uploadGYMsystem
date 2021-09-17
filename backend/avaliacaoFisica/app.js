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
     
    // Função responsável por montar o SELECT
    function montaSelect(alunos){
        // alert(alunos)
        let select = "";
        select += "<option selected>Selecione o aluno</option>"
        for(let i = 0; i < alunos.length; i++){
            select += `<option id="${alunos[i].ALUNO_ID}" value="${alunos[i].ALUNO_NOME}"> ${alunos[i].ALUNO_NOME} </option>`
        }
        document.getElementById('aluno_Av').innerHTML=select
    }

    // Pegando o ID do Aluno selecionado
    let IDaluno = ""
    $("#aluno_Av").change(function() {
        IDaluno = $(this).children(":selected").attr("id");
    });

    // Fazendo o IMC
    function calcularIMC(kilos, altura) {
        return (kilos / (altura * altura)).toFixed(2);
    }
    //Aplicando Mascara no input de Altura
    var $alt = $("#av_altura");
    $alt.mask('0.00', {reverse: false});


    document.querySelector('#av_peso').addEventListener('keyup', function(){
        let pesoIMC = document.getElementById('av_peso').value
        let alturaIMC = document.getElementById('av_altura').value

        if(pesoIMC.length >=6){
            if(alturaIMC != ''){
                document.getElementById('av_imc').value = calcularIMC(pesoIMC, alturaIMC)
                document.getElementById('av_torax').focus()
            }else{
                document.getElementById('av_imc').value = ''
                document.getElementById('av_altura').focus()
            }
        }else if(pesoIMC.length < 4){
            document.getElementById('av_imc').value = ''
        }
    })

    document.querySelector('#av_altura').addEventListener('keyup', function(){
        let pesoIMC = document.getElementById('av_peso').value
        let alturaIMC = document.getElementById('av_altura').value

        if(alturaIMC.length >= 4){
            if(pesoIMC != ''){
                document.getElementById('av_imc').value = calcularIMC(pesoIMC, alturaIMC)
                document.getElementById('av_torax').focus()
            }else{
                document.getElementById('av_imc').value = ''
                document.getElementById('av_peso').focus()
            }
        }else if(alturaIMC.length < 4){
            document.getElementById('av_imc').value = ''
        }
        
    })

    // Ação dada quando tenta cadastrar
    document.querySelector('#av_btn_cadastra').addEventListener('click', function(){
        if(IDaluno == "Selecione o aluno" || IDaluno == ""){alert("Selecione o aluno!"); return}
        // Pegando os valores dos inputs
        let peso = document.getElementById('av_peso').value
        let altura = document.getElementById('av_altura').value
        let imc = document.getElementById('av_imc').value
        let torax = document.getElementById('av_torax').value
        let cintura = document.getElementById('av_cintura').value
        let abdomen = document.getElementById('av_abdomen').value 
        let quadril = document.getElementById('av_quadril').value
        let braco = document.getElementById('av_braco').value
        let coxa = document.getElementById('av_coxa').value
        let antebraco = document.getElementById('av_antebraco').value
        let panturrilha = document.getElementById('av_panturrilha').value 
        let pescoco = document.getElementById('av_pescoco').value 


        // Montando array com todos os dados do formulário
        let dadosAluno = []
        dadosAluno[0] = peso
        dadosAluno[1] = altura
        dadosAluno[2] = imc
        dadosAluno[3] = torax
        dadosAluno[4] = cintura
        dadosAluno[5] = abdomen
        dadosAluno[6] = quadril
        dadosAluno[7] = braco
        dadosAluno[8] = coxa
        dadosAluno[9] = antebraco
        dadosAluno[10] = panturrilha
        dadosAluno[11] = pescoco
        dadosAluno[12] = IDaluno


        // Verificando se todos os dados estão preenchidos
        if(dadosAluno.indexOf("") != -1) {alert('Preencha todos os campos!'); return}

        // Preparando JSON para ser enviado para o PHP
		let data_php = {
            id_aluno: IDaluno,
            peso: peso,
            altura: altura,
            imc: imc,
            torax: torax,
            cintura: cintura,
            abdomen: abdomen,
            quadril: quadril,
            braco: braco,
            coxa: coxa,
            antebraco: antebraco,
            panturrilha: panturrilha,
            pescoco: pescoco
		}
		let pac = JSON.stringify(data_php)

        // Realizando o cadastro
        $.ajax({
            type:'POST',
            url:'./backend/avaliacaoFisica/app.php',
            data: 'cadastraAvaliacao='+pac,
            cache: false,
            success:function(e){
                //Passando o resultado e exibindo na tela    
                document.getElementById('msg_avaliacao').innerHTML = e;
                document.getElementById('av_peso').value = ''
                document.getElementById('av_altura').value = ''
                document.getElementById('av_imc').value = ''
                document.getElementById('av_torax').value = ''
                document.getElementById('av_cintura').value = ''
                document.getElementById('av_abdomen').value  = ''
                document.getElementById('av_quadril').value = ''
                document.getElementById('av_braco').value = ''
                document.getElementById('av_coxa').value = ''
                document.getElementById('av_antebraco').value = ''
                document.getElementById('av_panturrilha').value = ''
                document.getElementById('av_pescoco').value = ''
                document.getElementById('aluno_Av').value = ''
                
                setTimeout(function(){
                    document.getElementById('msg_avaliacao').innerHTML = ""	
                },3000)					
            }
        })
    })
   
})