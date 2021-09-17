<?php
    // Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}
    
	// Buscando Informações dados ALUNOS
	if(isset($_POST['action']) && $_POST['action']  == 'searchAluno'){
		$stmt = $con->prepare("SELECT ALUNO_ID, ALUNO_NOME FROM alunos");
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	   // Verificando dados para cadastro de exercício
	if(isset($_POST['cadastraAvaliacao']) && $_POST['cadastraAvaliacao'] != ''){
		$dataCadastro = date("Y-m-d");
		//Recebendo os valores dos inputs e colocando em variáveis
		$pac = json_decode($_POST['cadastraAvaliacao'], true);
		$id_aluno = $pac['id_aluno'];
		$peso = $pac['peso'];
        $altura = $pac['altura'];
        $imc =  $pac['imc'];
        $torax = $pac['torax'];
        $cintura = $pac['cintura'];
		$abdomen = $pac['abdomen'];
        $quadril = $pac['quadril'];
        $braco = $pac['braco'];
        $coxa = $pac['coxa'];
        $antebraco = $pac['antebraco'];
        $panturrilha = $pac['panturrilha'];
		$pescoco = $pac['pescoco'];

		//Inserindo valores no banco
		$stmt = $con->prepare('INSERT INTO avaliacaofisica (AV_DATA, fk_ALUNO_ID, AV_PESO, AV_ALTURA, AV_IMC, AV_TORAX, AV_CINTURA, AV_ABDOMEN, AV_QUADRIL, AV_BRACO, AV_COXA, AV_ANTEBRACO, AV_PANTURRILHA, AV_PESCOCO) 
                                VALUES (:DATA, :ID, :PESO, :ALTURA, :IMC, :TORAX, :CINTURA, :ABDOMEN, :QUADRIL, :BRACO , :COXA, :ANTEBRACO, :PANTURRILHA, :PESCOCO)');
		$stmt->bindParam(':DATA', $dataCadastro);
		$stmt->bindParam(':ID', $id_aluno);
        $stmt->bindParam(':PESO', $peso);
        $stmt->bindParam(':ALTURA', $altura);
        $stmt->bindParam(':IMC', $imc);
		$stmt->bindParam(':TORAX', $torax);
        $stmt->bindParam(':CINTURA', $cintura);
        $stmt->bindParam(':ABDOMEN', $abdomen);
        $stmt->bindParam(':QUADRIL', $quadril);
        $stmt->bindParam(':BRACO', $braco);
		$stmt->bindParam(':COXA', $coxa);
		$stmt->bindParam(':ANTEBRACO', $antebraco);
		$stmt->bindParam(':PANTURRILHA', $panturrilha);
		$stmt->bindParam(':PESCOCO', $pescoco);

        // Executando a query no banco e devolvendo o resultado ao JavaScript
		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Avaliação cadastrada com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao cadastrar Avaliação!
				  </div>';
			exit();			
		}
		exit();
	}
 
	if(isset($_POST['consultaAvaliacao']) && $_POST['consultaAvaliacao'] != ''){
		$id = $_POST['consultaAvaliacao'];		
		$stmt = $con->prepare('SELECT * FROM avaliacaofisica WHERE fk_ALUNO_ID = :id ORDER BY ID_AVALIACAO DESC');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Listando exercícios na tabela por ID
	if(isset($_POST['action']) and $_POST['action'] == "listaAvaliacaoID"){
		$pac = json_decode($_POST['id_search'], true);
		$stmt = $con->prepare('SELECT * FROM avaliacaofisica WHERE ID_AVALIACAO = :id');
		$stmt->bindParam(':id', $pac["id"]);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}
	
	// Editando Exercício
	if(isset($_POST['action']) and $_POST['action'] == "editAvaliacao"){
		
		$pac = json_decode($_POST['pacEdit'], true);
		$editId = $pac["editId"];
		$editPeso = $pac["editPeso"];
		$editAltura = $pac["editAltura"];
		$editIMC = $pac["editIMC"];
		$editTorax = $pac["editTorax"];
		$editCintura = $pac["editCintura"];
		$editAbdomen = $pac["editAbdomen"];
		$editQuadril = $pac["editQuadril"];
		$editBraco = $pac["editBraco"];
		$editCoxa = $pac["editCoxa"];
		$editAntebraco = $pac["editAntebraco"];
		$editPanturrilha = $pac["editPanturrilha"];
		$editPescoco = $pac["editPescoco"];

		$stmt = $con->prepare('UPDATE avaliacaofisica SET 
										AV_PESO = :peso,
										AV_ALTURA = :altura,
										AV_IMC = :imc,
										AV_TORAX = :torax,
										AV_CINTURA = :cintura,
										AV_ABDOMEN = :abdomen,
										AV_QUADRIL = :quadril,
										AV_BRACO = :braco,
										AV_COXA = :coxa,
										AV_ANTEBRACO = :antebraco,
										AV_PANTURRILHA = :panturrilha,
										AV_PESCOCO = :pescoco
								WHERE ID_AVALIACAO = :id
							 ');
		$stmt->bindParam(':peso', $editPeso);
		$stmt->bindParam(':altura', $editAltura);
		$stmt->bindParam(':imc', $editIMC);
		$stmt->bindParam(':torax', $editTorax);
		$stmt->bindParam(':cintura', $editCintura);
		$stmt->bindParam(':cintura', $editAbdomen);
		$stmt->bindParam(':abdomen', $editAbdomen);
		$stmt->bindParam(':quadril', $editQuadril);
		$stmt->bindParam(':braco', $editBraco);
		$stmt->bindParam(':coxa', $editCoxa);
		$stmt->bindParam(':antebraco', $editAntebraco);
		$stmt->bindParam(':panturrilha', $editPanturrilha);
		$stmt->bindParam(':pescoco', $editPescoco);
		$stmt->bindParam(':id', $editId);
		
		if($stmt->execute()){

			echo '<div class="alert alert-success" role="alert">
					  Avaliação Editada com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao editar Avaliação!
				  </div>';			
			exit();
		}
	}
?>