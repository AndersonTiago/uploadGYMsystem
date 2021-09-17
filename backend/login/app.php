<?php

     // Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}

    if(isset($_POST['sair'])){
        session_start();
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        session_destroy();
        header('location:../../login.php');
    }

    if(isset($_POST['login']) && $_POST['login'] != ""){
        $pac = json_decode($_POST['login'], true);
		$login = $pac["user"];
		$senha = md5($pac["senha"]); 

        $busca = $con->prepare("SELECT * FROM usuarios WHERE `USER_EMAIL`=:logi and `USER_SENHA`=:senh");
        $busca->bindParam(':logi',$login,PDO::PARAM_STR);
        $busca->bindParam(':senh',$senha,PDO::PARAM_STR); 
        $busca->execute();
        $res = $busca->rowCount();

        session_start();

        if($res > 0){
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            echo 'ok';exit();
            
        }else {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            echo 'no';exit();        
        }

    }







    
