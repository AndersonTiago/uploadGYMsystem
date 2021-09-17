// -------------------- MONTA FICHA ----------------------------	
$(document).ready(function(){

    // Função responsável por trazer todos os alunos do banco
    $.ajax({
        type:'POST',
        url:'./backend/mensalidade/app.php',
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
            select += `<option id="${alunos[i].ALUNO_ID}" value="${alunos[i].ALUNO_NOME}"> ${alunos[i].ALUNO_NOME} </option>`
        }
        document.getElementById('aluno_mensalidade').innerHTML=select
    }

    // Pegando e formatando Data Atual
    function dataAtual(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        return today        
    }

    // Somando dias para fornecer o campo de vencimento
    function dataM(dias){
        let dataMensal = document.getElementById('dta_mensal').value
        var dt = new Date(dataMensal);
        Date.prototype.addDias = function(dias){
            this.setDate(this.getDate() + dias)
        };
        //Exemplo adicionando 10 dias na sua data
        dt.addDias(dias);

        var dd = String(dt.getDate()).padStart(2, '0');
        var mm = String(dt.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = dt.getFullYear();
        dt = yyyy + '-' + mm + '-' + dd;

        return dt        
    }

    // Somando dias para fornecer o campo de vencimento (caso data pagamento fosse alterado)
    function dataMod(data, dias){
        var dt = new Date(data);
        Date.prototype.addDias = function(dias){
            this.setDate(this.getDate() + dias)
        };
        //Exemplo adicionando 10 dias na sua data
        dt.addDias(dias);

        var dd = String(dt.getDate()).padStart(2, '0');
        var mm = String(dt.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = dt.getFullYear();
        dt = yyyy + '-' + mm + '-' + dd;

        return dt        
    }

    // Datas inicio planos
    document.getElementById('dta_mensal').value = dataAtual(new Date())
    document.getElementById('dta_trimestral').value = dataAtual(new Date())
    document.getElementById('dta_anual').value = dataAtual(new Date())

    // Datas vencimento
    document.getElementById('dta_mensalV').value = dataM(31)
    document.getElementById('dta_trimestralV').value = dataM(91)
    document.getElementById('dta_anualV').value = dataM(366)
    
    // Fazendo calculo de datas caso a data de pagamento seja alterado manualmente //
    // Plano Mensal
    document.getElementById('dta_mensal').addEventListener('change', function(){
        let data = document.getElementById('dta_mensal').value
        document.getElementById('dta_mensalV').value = dataMod(data,31)
    })
    // Plano Trimestral
    document.getElementById('dta_trimestral').addEventListener('change', function(){
        let data = document.getElementById('dta_trimestral').value
        document.getElementById('dta_trimestralV').value = dataMod(data,91)
    })
    // Plano Anual
    document.getElementById('dta_anual').addEventListener('change', function(){
        let data = document.getElementById('dta_anual').value
        document.getElementById('dta_anualV').value = dataMod(data,366)
    })

    // Pegando o ID do Aluno selecionado
    let IDaluno = ""
    $("#aluno_mensalidade").change(function() {
        IDaluno = $(this).children(":selected").attr("id");
    });

    // Escolha do plano Mensal
    document.getElementById("btn_plan_mensal").addEventListener('click', function(){
        if(confirm('Tem certeza que deseja escolher esse plano?')){        
           // Pegando os valores dos inputs
            let data_mensal  = document.getElementById('dta_mensal').value
            let data_mensalV = document.getElementById('dta_mensalV').value
            if(IDaluno == "Selecione o aluno" || IDaluno == ""){alert("Selecione o aluno!"); return}
            
            // Montando array com todos os dados do formulário
            let planoMensal = []
            planoMensal[0] = IDaluno
            planoMensal[1] = data_mensal
            planoMensal[2] = data_mensalV
            
            // Verificando se todos os dados estão preenchidos
            if(planoMensal.indexOf("") != -1) {alert('Preencha todos os campos!'); return}

            let data_php = {
                id_aluno: IDaluno,
                mensalidade_tipo: "Mensal",
                data_mensal: data_mensal,
                data_mensalV: data_mensalV
            }
            let pac = JSON.stringify(data_php)
    
            // Realizando o cadastro da mensalidade
            $.ajax({
                type:'POST',
                url:'./backend/mensalidade/app.php',
                data: 'cadastraMensalidade='+pac,
                cache: false,
                success:function(e){
                    document.getElementById('msg_mensalidadeAluno').innerHTML = e
                    //Passando o resultado e exibindo na tela    
                    setTimeout(function(){
                        document.getElementById('msg_mensalidadeAluno').innerHTML = ""	
                    },3000)               
                }
            })
        }
    })

    // Escolha do plano Trimestral
    document.getElementById("btn_plan_trimestral").addEventListener('click', function(){
        if(confirm('Tem certeza que deseja escolher esse plano?')){        
            // Pegando os valores dos inputs
             let data_trimestral  = document.getElementById('dta_trimestral').value
             let data_trimestralV = document.getElementById('dta_trimestralV').value
             if(IDaluno == "Selecione o aluno" || IDaluno == ""){alert("Selecione o aluno!"); return}
             
             // Montando array com todos os dados do formulário
             let planoTrimestral = []
             planoTrimestral[0] = IDaluno
             planoTrimestral[1] = data_trimestral
             planoTrimestral[2] = data_trimestralV
             
             // Verificando se todos os dados estão preenchidos
             if(planoTrimestral.indexOf("") != -1) {alert('Preencha todos os campos!'); return}
 
             let data_php = {
                 id_aluno: IDaluno,
                 mensalidade_tipo: "Trimestral",
                 data_mensal: data_trimestral,
                 data_mensalV: data_trimestralV
             }
             let pac = JSON.stringify(data_php)
     
             // Realizando o cadastro do usuário
             $.ajax({
                 type:'POST',
                 url:'./backend/mensalidade/app.php',
                 data: 'cadastraMensalidade='+pac,
                 cache: false,
                 success:function(e){
                     document.getElementById('msg_mensalidadeAluno').innerHTML = e
                     //Passando o resultado e exibindo na tela    
                     setTimeout(function(){
                         document.getElementById('msg_mensalidadeAluno').innerHTML = ""	
                     },3000)	                   
                     
                 }
             })
        }
    })

    // Escolha do plano Anual
    document.getElementById("btn_plan_anual").addEventListener('click', function(){
        if(confirm('Tem certeza que deseja escolher esse plano?')){        
            // Pegando os valores dos inputs
             let data_anual  = document.getElementById('dta_anual').value
             let data_anualV = document.getElementById('dta_anualV').value
             if(IDaluno == "Selecione o aluno" || IDaluno == ""){alert("Selecione o aluno!"); return}
             
             // Montando array com todos os dados do formulário
             let planoTrimestral = []
             planoTrimestral[0] = IDaluno
             planoTrimestral[1] = data_anual
             planoTrimestral[2] = data_anualV
             
             // Verificando se todos os dados estão preenchidos
             if(planoTrimestral.indexOf("") != -1) {alert('Preencha todos os campos!'); return}
 
             let data_php = {
                 id_aluno: IDaluno,
                 mensalidade_tipo: "Anual",
                 data_mensal: data_anual,
                 data_mensalV: data_anualV
             }
             let pac = JSON.stringify(data_php)
     
             // Realizando o cadastro do usuário
             $.ajax({
                 type:'POST',
                 url:'./backend/mensalidade/app.php',
                 data: 'cadastraMensalidade='+pac,
                 cache: false,
                 success:function(e){
                     document.getElementById('msg_mensalidadeAluno').innerHTML = e
                     //Passando o resultado e exibindo na tela    
                     setTimeout(function(){
                         document.getElementById('msg_mensalidadeAluno').innerHTML = ""	
                     },3000)	                   
                     
                 }
             })
        }
    })


   
})