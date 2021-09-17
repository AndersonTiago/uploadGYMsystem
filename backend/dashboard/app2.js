// Verifica quantidade de alunos inativos
$(document).ready(function(){
    $.ajax({
        type: 'post',
        url: './backend/alunos/app2.php',
        data: 'action=listaAlunos',
        cache: false,
        success: function(e){            
            var resultado = JSON.parse(e)
            document.getElementById('qtd_AI').innerHTML = resultado.length         
        }
    })
})