<?php
    // Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}
    
	// Buscando Informações ddos ALUNOS
	if(isset($_POST['action']) && $_POST['action']  == 'searchAluno'){
		$stmt = $con->prepare("SELECT ALUNO_ID, ALUNO_NOME FROM alunos");
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
		// print_r($result);exit();
	}

    //Listando listaExercicio na tabela
	if(isset($_POST['action']) and $_POST['action'] == "listaExercicio"){
		$stmt = $con->prepare('SELECT * FROM exercicios ORDER BY ID_EXERCICIO');
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

    
?>