$(document).ready(function(){
   

    // Ação dada quando tenta cadastrar um usuário
    document.querySelector('#ap_cadastra').addEventListener('click', function(){
        
        // Pegando os valores dos inputs
        let ap_nome  = document.getElementById('ap_nome').value
        let ap_marca  = document.getElementById('ap_marca').value
        let ap_kg   = document.getElementById('ap_kg').value
        let ap_qtd   = document.getElementById('ap_qtd').value

        // Preparando JSON para ser enviado para o PHP
		let data_php = {
			ap_nome: ap_nome,
            ap_marca: ap_marca,
            ap_kg: ap_kg,
            ap_qtd: ap_qtd
		}
		let pac = JSON.stringify(data_php)

        // Realizando o cadastro do usuário
        if(ap_nome == "" && ap_qtd == ""){
            alert('Preencha todos os campos')
            document.getElementById('ap_nome').focus()
        }else{
            $.ajax({
                type:'POST',
                url:'./backend/equipamentos/app.php',
                data: 'cadastraEquipamento='+pac,
                cache: false,
                success:function(e){
                    //Passando o resultado e exibindo na tela
                    document.getElementById('msg_cadastroEquipamento').innerHTML = e;
                    document.getElementById('ap_nome').value = "";
                    document.getElementById('ap_marca').value = "";
                    document.getElementById('ap_kg').value = "";
                    document.getElementById('ap_qtd').value = "";
                    document.getElementById('ap_nome').focus();
                    setTimeout(function(){
                        document.getElementById('msg_cadastroEquipamento').innerHTML = ""	
                    },3000)					
                }
            })
        }
        
    })
})