<nav class="navbar navbar-expand-lg navbar-dark bg-dark nav-menu">
    <div class="row-btn" style="width:100%">
      <form  action="./backend/login/app.php" method="post">
        <button id="btn-logout" name="sair" class="btn btn-secondary fas fa-power-off" type="submit" style="float: right">&nbsp;Sair</button>
      </form>
    </div>
</nav>
<div class="nav-side-menu no-print2">
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <img id="img-menu" src="img/img_logo_login.jpg" alt="..." class="rounded mx-auto d-block img_logo_menu img-fluid collapsed out">    
    <h4 style="text-align:center;"> GYM SYSTEM </h4>
    <hr>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content collapse active">
            <li>
              <a href="principal.php">
              <i class="fa fa-dashboard fa-lg"></i> Dashboard
              </a>
            </li>

            <li id="li_usuarios"  data-toggle="collapse" data-target="#usuarios" class="collapsed active">
              <a href="#"><i class="fa fa-gift fa-lg"></i> Usuários <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="usuarios">
                <li><a href="cadastro_usuario.php">Novo Usuário</a></li>
                <li><a href="lista_usuarios.php">Lista de usuários</a></li>

            </ul>

            <li data-toggle="collapse" data-target="#alunos" class="collapsed">
              <a href="#"><i class="fa fa-globe fa-lg"></i> Alunos <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="alunos">
              <li><a href="cadastro_aluno.php">Novo Aluno</a></li>
              <li><a href="lista_alunos.php">Lista de alunos</a></li>
              <li><a href="lista_alunos_inativos.php">Alunos inativos</a></li>
            </ul>

            <li data-toggle="collapse" data-target="#mensalidade" class="collapsed">
              <a href="#"><i class="fa fa-globe fa-lg"></i> Mensalidades <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="mensalidade">
              <li><a href="cadastro_mensalidade.php">Cadastrar Mensalidade</a></li>
              <li><a href="lista_mensalidade.php">Lista de mensalidades</a></li>
              <li><a href="lista_mensalidade_atrasada.php">Mensalidades atrasadas</a></li>
            </ul>

            <li data-toggle="collapse" data-target="#ficha" class="collapsed">
              <a href="#"><i class="fa fa-globe fa-lg"></i> Ficha de treino <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="ficha">
              <li><a href="cadastro_exercicio.php">Cadastrar Exercício</a></li>
              <li><a href="monta_ficha.php">Montar Ficha</a></li>
              <li><a href="lista_validadeFicha.php">Validade Fichas</a></li>
            </ul>

            <li data-toggle="collapse" data-target="#avaliacao" class="collapsed">
            <a href="#"><i class="fa fa-globe fa-lg"></i> Avaliação Física <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="avaliacao">
              <li><a href="cadastro_avaliacao.php">Cadastrar avaliação</a></li>
              <li><a href="lista_avaliacao.php">Lista de avaliações</a></li>
            </ul>            

            <li data-toggle="collapse" data-target="#equipamentos" class="collapsed">
              <a href="#"><i class="fa fa-car fa-lg"></i> Equipamentos <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="equipamentos" style="margin-bottom: 100px;">
              <li><a href="cadastro_equipamento.php">Novo equipamento</a></li>
              <li><a href="lista_equipamento.php">Lista de Equipamentos</a></li>
            </ul>
        </ul>
    </div>
</div>








