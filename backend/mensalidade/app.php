<?php
    // Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}
    
	// Função que inativa o aluno depois de 15 dias de atraso na mensalidade
	$stmt = $con->prepare('SELECT * FROM mensalidade');
	$stmt->execute();
	$result = $stmt->fetchAll(); 
	$dat = date('Y-m-d');
	$data_atual = new DateTime($dat);

	for($i = 0; $i < count($result); $i++){
		$data_vencimento = new DateTime($result[$i]["MENSALIDADE_VENCIMENTO"]);
		$interval = $data_vencimento->diff($data_atual);

		if($interval->format('%R%a') >= 15){
			$stmt = $con->prepare('UPDATE mensalidade SET 
	 									MENSALIDADE_AI= "I"
	 								WHERE fk_ALUNO_ID = :ID
	 						 	');
			$stmt->bindParam(':ID', $result[$i]["fk_ALUNO_ID"]);
			$stmt->execute();

		}
	}
	
	
	// Buscando Informações ddos ALUNOS
	if(isset($_POST['action']) && $_POST['action']  == 'searchAluno'){
		$stmt = $con->prepare("SELECT ALUNO_ID, ALUNO_NOME FROM alunos");
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}
    
	// Verificando dados para cadastro de exercício
	if(isset($_POST['cadastraMensalidade']) && $_POST['cadastraMensalidade'] != ''){

		//Recebendo os valores dos inputs e colocando em variáveis
		$pac = json_decode($_POST['cadastraMensalidade'], true);
		$idAluno = $pac['id_aluno'];
        $mensalidadeT = $pac['mensalidade_tipo'];
        $dtaI =  $pac['data_mensal'];
		$dtaV =  $pac['data_mensalV'];

		// Verificando a data de Vencimento
		if($dtaI > $dtaV){
			echo '<div class="alert alert-danger" role="alert">
					ERRO na data de Vencimento.
				  </div>';
			exit();			
		}

		// Listando se há mensalidade do Aluno
		$stmtV = $con->prepare('SELECT fk_ALUNO_ID FROM mensalidade WHERE fk_ALUNO_ID = :ID_ALUNO');
		$stmtV->bindParam(':ID_ALUNO', $idAluno);
		$stmtV->execute();
		$result = $stmtV->rowCount();

		/* Caso exista mensalidade cadastrado do aluno, 
		  	então é atualizada as datas de vencimento e Plano
		   Se não existir, então é feita a inserção no banco
		 */
		
		if($result > 0){
			$stmt = $con->prepare('UPDATE mensalidade SET 
										MENSALIDADE_PLANO = :plano,
										MENSALIDADE_DATA = :dataI,
										MENSALIDADE_VENCIMENTO = :dataV,
										MENSALIDADE_AI = "A"
									WHERE fk_ALUNO_ID = :id
							 	');
			$stmt->bindParam(':plano', $mensalidadeT);
			$stmt->bindParam(':dataI', $dtaI);
			$stmt->bindParam(':dataV', $dtaV);
			$stmt->bindParam(':id', $idAluno);

			// Executando a query no banco e devolvendo o resultado ao JavaScript
			if($stmt->execute()){
				echo '<div class="alert alert-success" role="alert">
							Mensalidade atualizada com sucesso!
					  </div>';
				exit();
			}else{
				echo '<div class="alert alert-danger" role="alert">
						Erro ao atualizar Mensalidade!
					  </div>';
				exit();			
			}
			exit();

		}else{
			//Inserindo valores no banco
			$stmt = $con->prepare('INSERT INTO mensalidade (fk_ALUNO_ID, MENSALIDADE_PLANO, MENSALIDADE_DATA, MENSALIDADE_VENCIMENTO, MENSALIDADE_AI) 
									VALUES (:ID_ALUNO, :PLANO, :DATAI, :DATAV, "A")');
			$stmt->bindParam(':ID_ALUNO', $idAluno);
			$stmt->bindParam(':PLANO', $mensalidadeT);
			$stmt->bindParam(':DATAI', $dtaI);
			$stmt->bindParam(':DATAV', $dtaV);

			// Executando a query no banco e devolvendo o resultado ao JavaScript
			if($stmt->execute()){
				echo '<div class="alert alert-success" role="alert">
							Mensalidade cadastrada com sucesso!
					  </div>';
				exit();
			}else{
				echo '<div class="alert alert-danger" role="alert">
							Erro ao cadastrar Mensalidade!
					  </div>';
				exit();			
			}
			exit();
		}
	}

	//Listando Mensalidades na tabela
	if(isset($_POST['action']) and $_POST['action'] == "listaMensalidade"){
		$stmt = $con->prepare('SELECT MENSALIDADE_PLANO, MENSALIDADE_DATA, MENSALIDADE_VENCIMENTO, MENSALIDADE_AI, alunos.ALUNO_ID, alunos.ALUNO_NOME FROM mensalidade INNER JOIN  alunos ON mensalidade.fk_ALUNO_ID = alunos.ALUNO_ID ORDER BY ID_MENSALIDADE DESC');
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

?>