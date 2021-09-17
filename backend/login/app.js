$(document).ready(function(){

    // Vericiando Login
    document.getElementById('btn_login').addEventListener('click', function(){
        let user = document.getElementById('login').value
        let senha = document.getElementById('senha').value

        let msg = '<div class="alert alert-danger" role="alert"> Usuário ou senha inválidos!</div>'

        if(user == '' || senha == ''){
            document.getElementById('msg_login').innerHTML= msg
            setTimeout(function(){
                document.getElementById('msg_login').innerHTML = ""	
            },3000)	
        }else{

            dataLogin = {
                user: user,
                senha: senha
            }
            let data = JSON.stringify(dataLogin);

            $.ajax({
                type: 'post',
                url: '../academia/backend/login/app.php',
                data: 'login='+data,
                cache: false,
                success: function(e){
                    if(e == 'ok'){
                        window.location.href = '../academia/principal.php'
                    }else{
                        document.getElementById('msg_login').innerHTML= msg
                        document.getElementById('login').value = ''
                        document.getElementById('senha').value = ''
                        document.getElementById('login').focus()
                        setTimeout(function(){
                            document.getElementById('msg_login').innerHTML = ""	
                        },3000)	
                    }
                }
            })
        }
    })
})