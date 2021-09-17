// Abrindo MENU conforme usuário 
switch(window.location.href){
    // Abrindo Menu de usuários
    case 'http://localhost/anderson/academia/cadastro_usuario.php':
        document.getElementById('usuarios').classList.add('show')
    break;
    case 'http://localhost/anderson/academia/lista_usuarios.php':
        document.getElementById('usuarios').classList.add('show')
    break;

    // Abrindo Menu de Alunos
    case 'http://localhost/anderson/academia/cadastro_aluno.php':
        document.getElementById('alunos').classList.add('show')
    break;
    case 'http://localhost/anderson/academia/lista_alunos.php':
        document.getElementById('alunos').classList.add('show')
    break;
} 


$(document).ready(function(){
    $('.button-left').click(function(){
        $('.sidebar').toggleClass('fliph');
    });      
 });

 // Função responsável por deixar o site responsivo (imagem e container principal)
 window.addEventListener('resize', function(){
    // Manipulando a Imagem do LOGO
    if (window.innerWidth < 768) {
        document.querySelector('#img-menu').style.width="30%";
        document.querySelector('#tela-desc').style.margin="0px auto";
    }else{
        document.querySelector('#img-menu').style.width="65%";
        document.querySelector('#tela-desc').style.margin="";
    }

    // Manipulando o container Principal
    if (window.innerWidth > 755 && window.innerWidth < 1173) {
        document.querySelector('#cont_principal').style.width="60%";
    }else{
        document.querySelector('#cont_principal').style.width="100%";
    }
})


// adicionando máscara aos inputs CPF
$(document).ready(function () { 
    var $cpf = $("#cpf_usuario");
    $cpf.mask('000.000.000-00', {reverse: false});
});
// adicionando máscara aos inputs RG
$(document).ready(function () { 
    var $rg = $("#rg_usuario");
    $rg.mask('00.000.000-00', {reverse: true});
});
// adicionando máscara aos inputs CEP
$(document).ready(function () { 
    var $cep = $("#cep_usuario");
    $cep.mask('00000-000', {reverse: true});
});
// adicionando máscara aos inputs TELEFONE
$(document).ready(function () { 
    var $cep = $("#tel_usuario");
    $cep.mask('(00) 000000000', {reverse: false});
});


// Consumindo API dos correios e trazendo o logradouro e bairros para os Inputs
if(window.location.href == 'http://localhost/academia/cadastro_usuario.php' || window.location.href == 'http://localhost/academia/cadastro_aluno.php'){
    document.querySelector('#cep_usuario').addEventListener('keyup', function(){
        let cepValue = document.querySelector('#cep_usuario').value
        if(cepValue.length == 9){
            cepSearch = cepValue.replace('-','')
            $.getJSON(`https://viacep.com.br/ws/${cepValue}/json/`, function(data) { 
                console.log(data)
                let cidade = data.localidade           
                let bairro = data.bairro; 
                let rua = data.logradouro
                document.querySelector('#cidade_usuario').value = cidade
                document.querySelector('#rua_usuario').value = rua                
                document.querySelector('#bairro_usuario').value = bairro                
                document.querySelector('#numero_usuario').focus()
            })
        }else{
            document.querySelector('#rua_usuario').value = ""            
            document.querySelector('#bairro_usuario').value = ""           
        }
        
    })    
}

if(window.location.href == 'http://localhost/academia/cadastro_usuario.php' || window.location.href == 'http://localhost/academia/cadastro_aluno.php'){
     // Verificando CPF
    function isValidCPF(cpf) {
        if (typeof cpf !== "string") return false
        cpf = cpf.replace(/[\s.-]*/igm, '')
        if (
            !cpf ||
            cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999" 
        ) {
            return false
        }
        var soma = 0
        var resto
        for (var i = 1; i <= 9; i++) 
            soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
        resto = (soma * 10) % 11
        if ((resto == 10) || (resto == 11))  resto = 0
        if (resto != parseInt(cpf.substring(9, 10)) ) return false
        soma = 0
        for (var i = 1; i <= 10; i++) 
            soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
        resto = (soma * 10) % 11
        if ((resto == 10) || (resto == 11))  resto = 0
        if (resto != parseInt(cpf.substring(10, 11) ) ) return false
        return true
    }

    // Evento para verificar se o CPF é válido ou não
    document.querySelector('#cpf_usuario').addEventListener('keyup', function(){
        cpf = document.querySelector('#cpf_usuario').value

        if(cpf.length == "14"){
            if(isValidCPF(cpf)){
                document.querySelector('#cpf_usuario').classList.remove('is-invalid')
                document.querySelector('#cpf_usuario').classList.add('is-valid')
                document.getElementById('rg_usuario').focus()
                return
            }else{
                alert('CPF inválido') 
                document.querySelector('#cpf_usuario').classList.add('is-invalid')
                document.querySelector('#cpf_usuario').classList.remove('is-valid')
                document.querySelector('#cpf_usuario').value = ""               
            }
        }else{
            document.querySelector('#cpf_usuario').classList.add('is-invalid')
            document.querySelector('#cpf_usuario').classList.remove('is-valid')
        }
        
    }) 
}

if(window.location.href == 'http://localhost/academia/lista_usuarios.php' || window.location.href == 'http://localhost/academia/lista_alunos.php'){
     // Verificando CPF
    function isValidCPF(cpf) {
        if (typeof cpf !== "string") return false
        cpf = cpf.replace(/[\s.-]*/igm, '')
        if (
            !cpf ||
            cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999" 
        ) {
            return false
        }
        var soma = 0
        var resto
        for (var i = 1; i <= 9; i++) 
            soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
        resto = (soma * 10) % 11
        if ((resto == 10) || (resto == 11))  resto = 0
        if (resto != parseInt(cpf.substring(9, 10)) ) return false
        soma = 0
        for (var i = 1; i <= 10; i++) 
            soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
        resto = (soma * 10) % 11
        if ((resto == 10) || (resto == 11))  resto = 0
        if (resto != parseInt(cpf.substring(10, 11) ) ) return false
        return true
    }

    // Evento para verificar se o CPF é válido ou não
    document.querySelector('#modal_cpf_usuario').addEventListener('keyup', function(){
        cpf = document.querySelector('#modal_cpf_usuario').value

        if(cpf.length == "14"){
            if(isValidCPF(cpf)){
                document.querySelector('#modal_cpf_usuario').classList.remove('is-invalid')
                document.querySelector('#modal_cpf_usuario').classList.add('is-valid')
                document.getElementById('rg_usuario').focus()
                return
            }else{
                alert('CPF inválido') 
                document.querySelector('#modal_cpf_usuario').classList.add('is-invalid')
                document.querySelector('#modal_cpf_usuario').classList.remove('is-valid')
                document.querySelector('#modal_cpf_usuario').value = ""               
            }
        }else{
            document.querySelector('#modal_cpf_usuario').classList.add('is-invalid')
            document.querySelector('#modal_cpf_usuario').classList.remove('is-valid')
        }
        
    }) 
}



