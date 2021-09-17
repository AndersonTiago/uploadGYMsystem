// Verifica quantidade de alunos com mensalidade atrasada
$(document).ready(function(){
    $.ajax({
        type: 'post',
        url: './backend/mensalidade/app2.php',
        data: 'action=listaAlunos',
        cache: false,
        success: function(e){
            if(e == 0){
                document.getElementById('qtd_PA').innerHTML = 0
            }else{
                var resultado = JSON.parse(e)
                document.getElementById('qtd_PA').innerHTML = resultado.length
            }
            
        }
    })
})
