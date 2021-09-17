<?php
    // Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}
    
	// Função que mostra todos os alunos Inativos
	if(isset($_POST['action']) and $_POST['action'] == "listaAlunos"){
		$stmt = $con->prepare('SELECT ID_MENSALIDADE,
											MENSALIDADE_PLANO, 
											MENSALIDADE_DATA, 
											MENSALIDADE_VENCIMENTO, 
											MENSALIDADE_AI, 
											alunos.ALUNO_ID, 
											alunos.ALUNO_NOME,
											alunos.ALUNO_CPF,
											alunos.ALUNO_TELEFONE,
											alunos.ALUNO_EMAIL
										FROM mensalidade INNER JOIN  alunos 
										ON mensalidade.fk_ALUNO_ID = alunos.ALUNO_ID
										WHERE MENSALIDADE_AI = "I"
										ORDER BY ID_MENSALIDADE DESC');
		$stmt->execute();
		$result = $stmt->fetchAll(); 
		echo json_encode($result);exit;
	}


	// Buscando Informações com LIKE -> CPF
	if(isset($_POST['cpfSearch']) and $_POST['cpfSearch'] != null){
		$pac = $_POST['cpfSearch'];
		$stmt = $con->prepare('SELECT ID_MENSALIDADE,
										  MENSALIDADE_PLANO, 
										  MENSALIDADE_DATA, 
										  MENSALIDADE_VENCIMENTO, 
										  MENSALIDADE_AI, 
										  alunos.ALUNO_ID, 
										  alunos.ALUNO_NOME,
										  alunos.ALUNO_CPF,
										  alunos.ALUNO_TELEFONE,
										  alunos.ALUNO_EMAIL
									FROM mensalidade INNER JOIN  alunos 
									ON mensalidade.fk_ALUNO_ID = alunos.ALUNO_ID
									WHERE ALUNO_CPF LIKE  :cpf "%" AND MENSALIDADE_AI = "I"
									ORDER BY ID_MENSALIDADE DESC');
		$stmt->bindParam(':cpf', $pac);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Buscando Informações com LIKE -> NOME
	if(isset($_POST['nomeSearch']) and $_POST['nomeSearch'] != null){
		$pac = $_POST['nomeSearch'];
		$stmt = $con->prepare('SELECT ID_MENSALIDADE,
										  MENSALIDADE_PLANO, 
										  MENSALIDADE_DATA, 
										  MENSALIDADE_VENCIMENTO, 
										  MENSALIDADE_AI, 
										  alunos.ALUNO_ID, 
										  alunos.ALUNO_NOME,
										  alunos.ALUNO_CPF,
										  alunos.ALUNO_TELEFONE,
										  alunos.ALUNO_EMAIL
									FROM mensalidade INNER JOIN  alunos 
									ON mensalidade.fk_ALUNO_ID = alunos.ALUNO_ID
									WHERE alunos.ALUNO_NOME LIKE  :nome "%" AND MENSALIDADE_AI = "I"
									ORDER BY ID_MENSALIDADE DESC');
		$stmt->bindParam(':nome', $pac);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
		// print_r($result);exit();
	}

?>