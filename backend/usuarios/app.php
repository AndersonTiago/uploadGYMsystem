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
		$stmt = $con->prepare('SELECT USER_CPF FROM usuarios WHERE USER_CPF = :cpf');
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
	if(isset($_POST['cadastraUsuario']) && $_POST['cadastraUsuario'] != ''){
		
		$dataCad = date('Y-m-d');
		//Recebendo os valores dos inputs e colocando em variáveis
		$pac = json_decode($_POST['cadastraUsuario'], true);
		$nome = $pac['nome'];
        $data = $pac['data'];
        $cpf =  $pac['cpf'];
        $rg = $pac['rg'];
        $cargo = $pac['cargo'];
        $cep = $pac['cep'];
		$cidade = $pac['cidade'];
        $rua = $pac['rua'];
        $bairro = $pac['bairro'];
        $numero = $pac['numero'];
        $email = $pac['email'];
        $telefone = $pac['telefone'];
        $senha = md5($pac['senha']);

		//Inserindo valores no banco
		$stmt = $con->prepare('INSERT INTO usuarios (USER_NOME, USER_NASCIMENTO, USER_CPF, USER_RG, USER_CARGO, USER_CEP, USER_CIDADE, USER_RUA, USER_BAIRRO, USER_NUMERO, USER_EMAIL, USER_TELEFONE, USER_SENHA,USER_DATACADASTRO) 
                                VALUES (:NOME, :DATA, :CPF, :RG, :CARGO, :CEP, :CIDADE, :RUA, :BAIRRO, :NUMERO, :EMAIL, :TELEFONE, :SENHA, :DATACADASTRO)');
		$stmt->bindParam(':NOME', $nome);
		$stmt->bindParam(':DATA', $data);
        $stmt->bindParam(':CPF', $cpf);
        $stmt->bindParam(':RG', $rg);
        $stmt->bindParam(':CARGO', $cargo);
        $stmt->bindParam(':CEP', $cep);
		$stmt->bindParam(':CIDADE', $cidade);
        $stmt->bindParam(':RUA', $rua);
        $stmt->bindParam(':BAIRRO', $bairro);
        $stmt->bindParam(':NUMERO', $numero);
        $stmt->bindParam(':EMAIL', $email);
        $stmt->bindParam(':TELEFONE', $telefone);
        $stmt->bindParam(':SENHA', $senha);
		$stmt->bindParam(':DATACADASTRO', $dataCad);

        // Executando a query no banco e devolvendo o resultado ao JavaScript
		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Usuário cadastrado com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao cadastrar Usuário!
				  </div>';
			exit();			
		}
		exit();
	}


	

	//Listando listaUsuarios na tabela
	if(isset($_POST['action']) and $_POST['action'] == "listaUsuarios"){
		$stmt = $con->prepare('SELECT * FROM usuarios ORDER BY USER_ID');
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Listando exercícios na tabela por ID
	if(isset($_POST['action']) and $_POST['action'] == "listaUsuariosID"){
		$pac = json_decode($_POST['id_search'], true);
		$stmt = $con->prepare('SELECT * FROM usuarios WHERE USER_ID = :id');
		$stmt->bindParam(':id', $pac["id"]);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
	}

	// Editando Exercício
	if(isset($_POST['action']) and $_POST['action'] == "editUsuarios"){
		
		$pac = json_decode($_POST['pacEdit'], true);
		$editId = $pac["editId"];
		$editNome = $pac["editNome"];
		$editData = $pac["editData"];
		$editCpf = $pac["editCpf"];
		$editRg = $pac["editRg"];
		$editCargo = $pac["editCargo"];
		$editCep = $pac["editCep"];
		$editCidade = $pac["editCidade"];
		$editRua = $pac["editRua"];
		$editBairro = $pac["editBairro"];
		$editNumero = $pac["editNumero"];
		$editEmail = $pac["editEmail"];
		$editTelefone = $pac["editTelefone"];

		$stmt = $con->prepare('UPDATE usuarios SET 
										USER_NOME = :nome,
										USER_NASCIMENTO = :nascimento,
										USER_CPF = :cpf,
										USER_RG = :rg,
										USER_CARGO = :cargo,
										USER_CEP = :cep,
										USER_CIDADE = :cidade,
										USER_RUA = :rua,
										USER_BAIRRO = :bairro,
										USER_NUMERO = :numero,
										USER_EMAIL = :email,
										USER_TELEFONE = :telefone
								WHERE USER_ID = :id
							 ');
		$stmt->bindParam(':nome', $editNome);
		$stmt->bindParam(':nascimento', $editData);
		$stmt->bindParam(':cpf', $editCpf);
		$stmt->bindParam(':rg', $editRg);
		$stmt->bindParam(':cargo', $editCargo);
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
					  Usuário Editado com sucesso!
				  </div>';
			exit();
			
		}else{
			// echo '<div class="alert alert-danger" role="alert">
			// 		Erro ao editar Usuário!
			// 	  </div>';
			var_dump($stmt);
			exit();
		}
	}

	// Excluindo Exercício
	if(isset($_POST['action']) and $_POST['action'] == "deleteUsuarios"){
		$pac = json_decode($_POST['deleteId'], true);
		$stmt = $con->prepare('DELETE FROM usuarios WHERE USER_ID = :id');
		$stmt->bindParam(':id', $pac["id"]);
		if($stmt->execute()){
			echo '<div class="alert alert-success" role="alert">
					  Usuário removido com sucesso!
				  </div>';
			exit();
			
		}else{
			echo '<div class="alert alert-danger" role="alert">
					Erro ao remover Usuário!
				  </div>';
			exit();			
		}

	}

	// Buscando Informações com LIKE (geral não entregue e não deletado) -> CODIGO
	if(isset($_POST['cpfSearch']) and $_POST['cpfSearch'] != null){
		$pac = $_POST['cpfSearch'];
		$stmt = $con->prepare("SELECT * FROM usuarios WHERE  USER_CPF LIKE  :cpf '%'");
		$stmt->bindParam(':cpf', $pac);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
		// print_r($result);exit();
	}

	// Buscando Informações com LIKE (geral não entregue e não deletado) -> DESCRICAO
	if(isset($_POST['nomeSearch']) and $_POST['nomeSearch'] != null){
		$pac = $_POST['nomeSearch'];
		$stmt = $con->prepare("SELECT * FROM usuarios WHERE USER_NOME LIKE '%' :nome '%'");
		$stmt->bindParam(':nome', $pac);
		$stmt->execute();
		$result = $stmt->fetchAll();
		echo json_encode($result);exit();
		// print_r($result);exit();
	}
?>