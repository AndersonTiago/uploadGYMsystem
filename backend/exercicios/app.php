<?php
	
	// Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}


	// Verificando dados para cadastro de exercício
	if(isset($_POST['cadastraExercicio']) && $_POST['cadastraExercicio'] != ''){
		
		//Recebendo os valores dos inputs e colocando em variáveis
		$pac = json_decode($_POST['cadastraExercicio'], true);
		$nome_exercicio = $pac["nome_exerc"];
		$grupo_muscular = $pac["grupo_musc"];

		//Inserindo valores no banco
		$stmt = $con->prepare('INSERT INTO exercicios (NOME_EXERCICIO, GRUPO_MUSCULAR) VALUES (:NOME, :GRUPO)');
		$stmt->bindParam(':NOME', $nome_exercicio);
		$stmt->bindParam(':GRUPO', $grupo_muscular);
		// $stmt->execute();

		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Exercício cadastrado com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao cadastrar Exercício!
				  </div>';
			exit();			
		}
		exit();
	}


	//Listando listaExercicio na tabela
	if(isset($_POST['action']) and $_POST['action'] == "listaExercicio"){
		$stmt = $con->prepare('SELECT * FROM exercicios ORDER BY ID_EXERCICIO');
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Listando exercícios na tabela por ID
	if(isset($_POST['action']) and $_POST['action'] == "listaExercicioID"){
		$pac = json_decode($_POST['id_search'], true);
		$stmt = $con->prepare('SELECT * FROM exercicios WHERE ID_EXERCICIO = :id');
		$stmt->bindParam(':id', $pac["id"]);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Editando Exercício
	if(isset($_POST['action']) and $_POST['action'] == "editExercicio"){
		
		$pac = json_decode($_POST['pacEdit'], true);
		$id = $pac["id"];
		$editNome = $pac["editNome"];
		$editGrupo = $pac["editGrupo"];

		$stmt = $con->prepare('UPDATE exercicios SET 
										NOME_EXERCICIO =:nome,
										GRUPO_MUSCULAR =:grupo
								WHERE ID_EXERCICIO = :id
							 ');
		$stmt->bindParam(':nome', $editNome);
		$stmt->bindParam(':grupo', $editGrupo);
		$stmt->bindParam(':id', $id);
		
		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Exercício Editado com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao editar Exercício!
				  </div>';
			exit();
		}
	}

	// Excluindo Exercício
	if(isset($_POST['action']) and $_POST['action'] == "deleteExercicio"){
		$pac = json_decode($_POST['deleteId'], true);
		$stmt = $con->prepare('DELETE FROM exercicios WHERE ID_EXERCICIO = :id');
		$stmt->bindParam(':id', $pac["id"]);
		if($stmt->execute()){
			echo "sucesso";
			exit();
		}else{
			echo "erro";
			exit();
		}

	}

	
	
?>