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
    
	// Função que mostra todos os alunos com mensalidade atrasada, independete de estar A/I
	$arr[0] = [];
	$y = 0;
	for($i = 0; $i < count($result); $i++){
		$data_vencimento = new DateTime($result[$i]["MENSALIDADE_VENCIMENTO"]);
		$interval = $data_vencimento->diff($data_atual);
		$id = $result[$i]['ID_MENSALIDADE'];

		
		if($interval->format('%R%a') > 0){
			$stmt = $con->prepare('SELECT ID_MENSALIDADE,
										  MENSALIDADE_PLANO, 
										  MENSALIDADE_DATA, 
										  MENSALIDADE_VENCIMENTO, 
										  MENSALIDADE_AI, 
										  alunos.ALUNO_ID, 
										  alunos.ALUNO_NOME 
									FROM mensalidade INNER JOIN  alunos 
									ON mensalidade.fk_ALUNO_ID = alunos.ALUNO_ID
									WHERE ID_MENSALIDADE = :id
									ORDER BY ID_MENSALIDADE DESC');
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$result2 = $stmt->fetchAll();	
			$arr[0][$y] = $result2;
			$y++;
		}
	}	

	// Retornando resultado
	// print_r(count());exit;
	if(count($arr[0]) > 0){
		$flat = call_user_func_array('array_merge', $arr[0]);
		echo json_encode($flat);exit;
	}else{
		echo json_encode(0);exit;
	}
	
	

?>