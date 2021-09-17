<?php

    // Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}

    // Verificando dados para cadastro de exercício
	if(isset($_POST['cadastraEquipamento']) && $_POST['cadastraEquipamento'] != ''){
		
		//Recebendo os valores dos inputs e colocando em variáveis
		$pac = json_decode($_POST['cadastraEquipamento'], true);
		$nome = $pac['ap_nome'];
        $marca = $pac['ap_marca'];
        $kg =  $pac['ap_kg'];
        $qtd = $pac['ap_qtd'];

		//Inserindo valores no banco
		$stmt = $con->prepare('INSERT INTO equipamentos (ap_nome, ap_marca, ap_kg, ap_qtd) 
                                VALUES (:NOME, :MARCA, :KG, :QTD)');
		$stmt->bindParam(':NOME', $nome);
		$stmt->bindParam(':MARCA', $marca);
        $stmt->bindParam(':KG', $kg);
        $stmt->bindParam(':QTD', $qtd);

        // Executando a query no banco e devolvendo o resultado ao JavaScript
		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Equipamento cadastrado com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao cadastrar Equipamento!
				  </div>';
			exit();			
		}
		exit();
	}


	//Listando listaEquipamentos na tabela
	if(isset($_POST['action']) and $_POST['action'] == "listaEquipamento"){
		$stmt = $con->prepare('SELECT * FROM equipamentos ORDER BY ap_id');
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Listando exercícios na tabela por ID
	if(isset($_POST['action']) and $_POST['action'] == "listaEquipamentoID"){
		$pac = json_decode($_POST['id_search'], true);
		$stmt = $con->prepare('SELECT * FROM equipamentos WHERE ap_id = :id');
		$stmt->bindParam(':id', $pac["id"]);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Editando Exercício
	if(isset($_POST['action']) and $_POST['action'] == "editEquipamento"){
		
		$pac = json_decode($_POST['pacEdit'], true);
		$editId = $pac["editId"];
		$editNome = $pac["editNome"];
		$editMarca = $pac["editMarca"];
		$editKg = $pac["editKg"];
		$editQtd = $pac["editQtd"];

		$stmt = $con->prepare('UPDATE equipamentos SET 
										ap_nome = :nome,
										ap_marca = :marca,
										ap_kg = :kg,
										ap_qtd = :qtd
								WHERE ap_id = :id
							 ');
		$stmt->bindParam(':nome', $editNome);
		$stmt->bindParam(':marca', $editMarca);
		$stmt->bindParam(':kg', $editKg);
		$stmt->bindParam(':qtd', $editQtd);
		$stmt->bindParam(':id', $editId);
		
		if($stmt->execute()){

			echo '<div class="alert alert-success" role="alert">
					  Equipamento Editado com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao editar Equipamento!
				  </div>';
			exit();
		}
	}

	// Excluindo Exercício
	if(isset($_POST['action']) and $_POST['action'] == "deleteEquipamento"){
		$pac = json_decode($_POST['deleteId'], true);
		$stmt = $con->prepare('DELETE FROM equipamentos WHERE ap_id = :id');
		$stmt->bindParam(':id', $pac["id"]);

		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Equipamento removido com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao remover Equipamento!
				  </div>';
			exit();			
		}

	}

	// Buscando Informações com LIKE -> NOME
	if(isset($_POST['nomeSearch']) and $_POST['nomeSearch'] != null){
		$pac = $_POST['nomeSearch'];
		$stmt = $con->prepare("SELECT * FROM equipamentos WHERE ALUNO_NOME LIKE '%' :nome '%'");
		$stmt->bindParam(':nome', $pac);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
		// print_r($result);exit();
	}
	
?>