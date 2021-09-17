<?php

    // Fazendo conexão com o Banco de Dados
	try{
		$con = new PDO('mysql:host=localhost;dbname=academia', 'root', '');
	}catch(PDOException $e){
		echo "Erro: ".$e-> getMessage();
	}

	// Verificando cadastro de CPF duplicados
	if(isset($_POST['dbCPF'])){
		$cpf = $_POST['dbCPF'];
		$stmt = $con->prepare('SELECT ALUNO_CPF FROM alunos WHERE ALUNO_CPF = :cpf');
		$stmt->bindParam(':cpf', $cpf);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if($result){
			echo "CPF já cadastrado";
		}else{
			return;
		}		
		exit;		
	}

    // Verificando dados para cadastro de exercício
	if(isset($_POST['cadastraAluno']) && $_POST['cadastraAluno'] != ''){
		$dataCadastro = date("Y-m-d");
		//Recebendo os valores dos inputs e colocando em variáveis
		$pac = json_decode($_POST['cadastraAluno'], true);
		$nome = $pac['nome'];
        $data = $pac['data'];
        $cpf =  $pac['cpf'];
        $rg = $pac['rg'];
        $cep = $pac['cep'];
		$cidade = $pac['cidade'];
        $rua = $pac['rua'];
        $bairro = $pac['bairro'];
        $numero = $pac['numero'];
        $email = $pac['email'];
        $telefone = $pac['telefone'];

		//Inserindo valores no banco
		$stmt = $con->prepare('INSERT INTO alunos (ALUNO_NOME, ALUNO_NASCIMENTO, ALUNO_CPF, ALUNO_RG, ALUNO_CEP, ALUNO_CIDADE, ALUNO_RUA, ALUNO_BAIRRO, ALUNO_NUMERO, ALUNO_EMAIL, ALUNO_TELEFONE, ALUNO_DATACADASTRO) 
                                VALUES (:NOME, :DATA, :CPF, :RG, :CEP, :CIDADE, :RUA, :BAIRRO, :NUMERO, :EMAIL, :TELEFONE, :DATACADASTRO)');
		$stmt->bindParam(':NOME', $nome);
		$stmt->bindParam(':DATA', $data);
        $stmt->bindParam(':CPF', $cpf);
        $stmt->bindParam(':RG', $rg);
        $stmt->bindParam(':CEP', $cep);
		$stmt->bindParam(':CIDADE', $cidade);
        $stmt->bindParam(':RUA', $rua);
        $stmt->bindParam(':BAIRRO', $bairro);
        $stmt->bindParam(':NUMERO', $numero);
        $stmt->bindParam(':EMAIL', $email);
        $stmt->bindParam(':TELEFONE', $telefone);
		$stmt->bindParam(':DATACADASTRO', $dataCadastro);

        // Executando a query no banco e devolvendo o resultado ao JavaScript
		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Aluno cadastrado com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao cadastrar Aluno!
				  </div>';
			exit();			
		}
		exit();
	}

	//Listando listaAlunos na tabela
	if(isset($_POST['action']) and $_POST['action'] == "listaAlunos"){
		$stmt = $con->prepare('SELECT * FROM alunos ORDER BY ALUNO_ID');
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Listando exercícios na tabela por ID
	if(isset($_POST['action']) and $_POST['action'] == "listaAlunosID"){
		$pac = json_decode($_POST['id_search'], true);
		$stmt = $con->prepare('SELECT * FROM alunos WHERE ALUNO_ID = :id');
		$stmt->bindParam(':id', $pac["id"]);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Editando Exercício
	if(isset($_POST['action']) and $_POST['action'] == "editAlunos"){
		
		$pac = json_decode($_POST['pacEdit'], true);
		$editId = $pac["editId"];
		$editNome = $pac["editNome"];
		$editData = $pac["editData"];
		$editCpf = $pac["editCpf"];
		$editRg = $pac["editRg"];
		$editCep = $pac["editCep"];
		$editCidade = $pac["editCidade"];
		$editRua = $pac["editRua"];
		$editBairro = $pac["editBairro"];
		$editNumero = $pac["editNumero"];
		$editEmail = $pac["editEmail"];
		$editTelefone = $pac["editTelefone"];

		$stmt = $con->prepare('UPDATE alunos SET 
										ALUNO_NOME = :nome,
										ALUNO_NASCIMENTO = :nascimento,
										ALUNO_CPF = :cpf,
										ALUNO_RG = :rg,
										ALUNO_CEP = :cep,
										ALUNO_CIDADE = :cidade,
										ALUNO_RUA = :rua,
										ALUNO_BAIRRO = :bairro,
										ALUNO_NUMERO = :numero,
										ALUNO_EMAIL = :email,
										ALUNO_TELEFONE = :telefone
								WHERE ALUNO_ID = :id
							 ');
		$stmt->bindParam(':nome', $editNome);
		$stmt->bindParam(':nascimento', $editData);
		$stmt->bindParam(':cpf', $editCpf);
		$stmt->bindParam(':rg', $editRg);
		$stmt->bindParam(':cep', $editCep);
		$stmt->bindParam(':cidade', $editCidade);
		$stmt->bindParam(':rua', $editRua);
		$stmt->bindParam(':bairro', $editBairro);
		$stmt->bindParam(':numero', $editNumero);
		$stmt->bindParam(':email', $editEmail);
		$stmt->bindParam(':telefone', $editTelefone);
		$stmt->bindParam(':id', $editId);
		
		if($stmt->execute()){

			echo '<div class="alert alert-success" role="alert">
					  Aluno Editado com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao editar Aluno!
				  </div>';			
			exit();
		}
	}

	// Excluindo Exercício
	if(isset($_POST['action']) and $_POST['action'] == "deleteAlunos"){
		$pac = json_decode($_POST['deleteId'], true);
		
		// Removendo de todas as tabelas as referências do usuário deletado

		// Removendo aluno da tabela mensalidade
		$delMensalidade = $con->prepare('DELETE FROM mensalidade WHERE fk_ALUNO_ID = :id');
		$delMensalidade->bindParam(':id', $pac["id"]);
		$delMensalidade->execute();
		
		// Removendo aluno da tabela avaliacaofisica
		$delAvaliacao = $con->prepare('DELETE FROM avaliacaofisica WHERE fk_ALUNO_ID = :id');
		$delAvaliacao->bindParam(':id', $pac["id"]);
		$delAvaliacao->execute();

		// removendo aluno
		$stmt = $con->prepare('DELETE FROM alunos WHERE ALUNO_ID = :id');
		$stmt->bindParam(':id', $pac["id"]);
		// Executando a query no banco e devolvendo o resultado ao JavaScript
		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Aluno removido com sucesso!
				  </div>';
			exit();			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao remover Aluno!
				  </div>';
			exit();			
		}

	}

	// Buscando Informações com LIKE -> CPF
	if(isset($_POST['cpfSearch']) and $_POST['cpfSearch'] != null){
		$pac = $_POST['cpfSearch'];
		$stmt = $con->prepare("SELECT * FROM alunos WHERE  ALUNO_CPF LIKE  :cpf '%'");
		$stmt->bindParam(':cpf', $pac);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
		// print_r($result);exit();
	}

	// Buscando Informações com LIKE -> NOME
	if(isset($_POST['nomeSearch']) and $_POST['nomeSearch'] != null){
		$pac = $_POST['nomeSearch'];
		$stmt = $con->prepare("SELECT * FROM alunos WHERE ALUNO_NOME LIKE '%' :nome '%'");
		$stmt->bindParam(':nome', $pac);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
		// print_r($result);exit();
	}
?>