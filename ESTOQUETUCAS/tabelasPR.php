<?php
    require("conn.php");
    require("protected.php");
    $tabela = $pdo->prepare("SELECT patrimonio,id_produtoR, nome_produtoR, local_produtoR, situacao_produtoR, qtd_emprR, vista_pR, data_emprR
    FROM produtosretornaveis;");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
    
    /*
    if (empty($rowTabela)){
        echo "<script>
        alert('Tabela vazia!!!');
        </script>";
    } */
    if (isset($_SESSION['id'])) {
        $usuarioLogadoId = $_SESSION['id'];

        /*Barra de pesquisa*/
    }
    if(!empty($_GET['search'])){
      $search = $_GET['search'];
      $tabela = $pdo->prepare("SELECT id_produtoR, nome_produtoR, qtd_produtoR, local_produtoR, situacao_produtoR, qtd_emprR, vista_pR, data_emprR, patrimonio
      FROM produtosretornaveis WHERE id_produtoR = '$search' OR nome_produtoR LIKE '%$search%' OR local_produtoR LIKE '%$search%' OR vista_pR LIKE '%$search%' OR data_emprR LIKE '%$search%' OR patrimonio LIKE '%$search%';");
      $tabela->execute();
      $rowTabela = $tabela->fetchAll();
  }
  else{
      $tabela = $pdo->prepare("SELECT id_produtoR, nome_produtoR, qtd_produtoR, local_produtoR, situacao_produtoR, qtd_emprR, vista_pR, data_emprR, patrimonio
      FROM produtosretornaveis ORDER BY id_produtoR DESC;");
      $tabela->execute();
      $rowTabela = $tabela->fetchAll();
  }

?>


<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Tabela de produtos retornavéis</title>
        <link rel="stylesheet" href="styleSideBar.css"> 
        <link rel="stylesheet" href="stylePag.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/icons/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styleTabela.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <style>
          .box-search{
            display: flex;
            justify-content: flex-start;
            gap: .1%;
        }
        .logout a {
            background-color: #F2C063;
            color: #F2E6CE;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 60px;
        }
    </style>

    </head>
    <body>
    
        <div class="container">
            <h1 style="text-align:center;">TABELA DE PRODUTOS RETORNÁVEIS</h1>
            <!--Barra de pesquisa-->
        <br>
        <div class="box-search">
            <input type="search" class="form-control w-25" placeholder="Pesquisar item na tabela" id="pesquisar">
            <button onclick="searchData()" class="btn btn-outline-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <br>

            <br>  
        <table class="table">
        <thead>
        <tr>
            <th scope="col"><b>PATRIMÔNIO </b></th>
            <th scope="col"><b>NOME PRODUTO</b></th>
            <th scope="col"><b>LOCAL PRODUTO</b></th>
            <th scope="col"><b>ÚLTIMA VEZ EMPRESTADO PARA:</b></th>
            <th scope="col"><b>ÚLTIMA VEZ VISTA:</b></th>
            <th scope="col"><b>EMPRESTAR</b></th>
           <th scope="col"><b>DEVOLVER</b></th>
           <th scope="col"><b>DAR BAIXA</b></th>
           <th scope="col"><b>DELETAR PRODUTO</b></th>
            </tr>
        </thead>
        <tbody>
        <?php
foreach ($rowTabela as $linha){
    echo '<tr>';
    echo "<th scope='row'><b>".$linha['patrimonio']."</th></b>";
    echo "<td>".$linha['nome_produtoR']."</td>";
    echo "<td>".$linha['local_produtoR']."</td>";
    echo "<td>".$linha['vista_pR']."</td>";
    $data_empr = strtotime($linha['data_emprR']);
    $data_formatada = date("d/m/Y ", $data_empr);
    echo "<td>".$data_formatada."</td>";
    // Verificar a disponibilidade e exibir o botão correspondente
    if ($linha['situacao_produtoR'] == 0) {
        echo '<td><a href="#" class="btn btn-primary btn-emprestar_chave bi bi-arrow-down" data-thisdisponivel_chave="'.$linha['situacao_produtoR'].'" data-thisproduto_id="'.$linha['id_produtoR'].'" style="font-size: 1.1rem">EMPRESTAR</a></td>';
        echo '<td><button class="btn btn-outline-secondary btn-devolver_chave bi bi-arrow-up" style="font-size: 1.1rem" disabled>Devolver</button></td>';
    } else {
        echo '<td><button class="btn btn-outline-secondary btn-emprestar_chave bi bi-arrow-down" style="font-size: 1.1rem" disabled>EMPRESTAR</button></td>';
        echo '<td><a href="#" class="btn btn-warning btn-devolver_chave bi bi-arrow-up" data-thisdisponivel_chave="'.$linha['situacao_produtoR'].'" data-thisproduto_id="'.$linha['id_produtoR'].'" style="font-size: 1.1rem">Devolver</a></td>';

    }

    echo '<td><a data-thisproduto_id='.$linha['id_produtoR'].'" class="btn btn-danger btn-baixa btn-nanana bi bi-recycle" style="font-size: 1.5rem"></a></td>';
    echo "<td><a href='#' data-produto='" . $linha['id_produtoR'] . "' class='btn btn-danger btn-nanana bi bi-trash delete-link' style='font-size: 1.5rem'></a></td>";
    echo '</tr>';
}
?>
</tbody>
<a class="btn btn-success btn-add">CADASTRAR PRODUTO</a>
<a href="exportacaoData/tabelaPR.php" style="margin-left: 5rem" class="btn btn-success btn-export" onclick="exibirPopup('Sucesso!', 'Tabela Exportada!', 'success', 'OK')">EXPORTAR TABELA</a>



<!--barra de pesquisa -->
<script>
            var search = document.getElementById('pesquisar');

            search.addEventListener("keydown", function(event) {
                if (event.key === "Enter") 
                {
                    searchData();
                }
            });

            function searchData()
            {
                window.location = 'tabelasPR.php?search='+search.value; //criou um parametro
            }
        </script>


<!-- Modal BAIXA -->

<div class="modal fade" id="baixaModalLabel" tabindex="-1" role="dialog" aria-labelledby="baixaModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="baixaModalLabel">Baixa em produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="CRUDE/delete_prodR.php" method="POST">
            <div class="form-group">
              <label for="nome">Causa</label>
              <input type="text" class="form-control" id="avaria_produtoR" name="avaria_produtoR" value="">
            </div>
            <input type="hidden" id="id_produtoR" name="id_produtoR" value="">      
            <button type="submit" href="CRUDE/delete_prodR.php"class="btn btn-primary">Dar baixa</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>  

<!-- Modal EMPRESTAR -->

<div class="modal fade" id="emprestarModalLabel" tabindex="-1" role="dialog" aria-labelledby="emprestarModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="emprestarModalLabel">Emprestar produto retornável</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="CRUDE/emprestar_produto.php" method="POST">
            <div class="form-group">
              <label for="nome">Para quem você está emprestando?</label>
              <input type="text" class="form-control" id="vista_pR" name="vista_pR" value="">
            </div>
            <input type="hidden" id="id_produtoRemprestar" name="id_produtoRemprestar" value="">      
            <input type="hidden" id="situacao_produtoR" name="situacao_produtoR" value="">       
            <button type="submit" href="CRUDE/emprestar_produto.php"class="btn btn-primary">Emprestar</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>  

  <!-- Modal DEVOLVER -->

<div class="modal fade" id="devolverModalLabel" tabindex="-1" role="dialog" aria-labelledby="devolverModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="devolverModalLabel">Devolver produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="CRUDE/devolver_produto.php" method="POST">
                <div class="form-group">
              <label for="nome">Confirmar devolução?</label>
            <input type="hidden" id="id_produtoRA" name="id_produtoRA" value="">      
            <input type="hidden" id="situacao_produtoRA" name="situacao_produtoRA" value="">      
            <br><button type="submit" href="CRUDE/devolver_produto.php"class="btn btn-primary">Confirmar</button></br>
                </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>  

<!-- SIDEBAR -->
<div class="barraTop">
      <div class="logo">
            <span></span>

            </button>
            <button type="button" onclick="toggleSidebar()"class="toggle toggles" id="toggles">
              <span onclick="toggleSidebar()"></span>
            </button>

                <a href="#" class="logo-link">
                    <img src="imagens/tucano1.png" alt="Logo Icon" style="width:100px"class="logo-image" id="logo-img">
                </a>
                <span class="logo-text">Tucas</span>
            </div>

            <div class="logout">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
        </div>

        <script>
            const logoImg = document.getElementById('logo-img');
            let currentImage = 1;

            logoImg.addEventListener('mouseover', () => {
                currentImage = currentImage === 1 ? 3 : 4;
                logoImg.src = `imagens/tucano${currentImage}.png`;
            });

            logoImg.addEventListener('mouseout', () => {
                currentImage = currentImage === 3 ? 1 : 2;
                logoImg.src = `imagens/tucano${currentImage}.png`;
            });
        </script>
    <style>
        .barraTop {
          /*height: 100px;*/
        }
        .navbar-brand img {
            width: 10rem;
            height: 10rem;
        }

        .navbar-brand:hover img {
            animation: stopMotionAnimation 1s steps(4) infinite;
        }

        @keyframes stopMotionAnimation {
            0% { background-position: 0 0; }
            25% { background-position: -50px 0; }
            50% { background-position: -100px 0; }
            75% { background-position: -150px 0; }
            100% { background-position: -200px 0; }
        }

        .logo-image {
            position: relative;
            transition: transform 0.3s;
        }

        .logo-image:hover {
            transform: rotate(20deg);
        }

        .box-search {
            display: flex;
            justify-content: flex-start;
            gap: .1%;
        }
    </style>




  <div class="sidebar">
  <script>
  function toggleSidebar() {
  var sidebar = document.querySelector('.sidebar');
  sidebar.classList.toggle('sidebar-closed');
}
  </script>
    <ul class="custom-list">
      <li>.</li>
      <li>.</li>
      <li>.</li>
      
      <li class="nav-item-bobo">
		    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#menu_item2" href="#"> Produtos de uso único <i class="bi small bi-caret-down-fill h3"></i> </a>
		    <ul id="menu_item2" class="submenu collapse" data-bs-parent="#nav_accordion">
              
              <li class="nav-item-baba">
                  <a class="nav-link tabelaPrincipal"  onclick="redirecionarParaPaginaTabelas()" href="#"><i class="fas fa-search"></i> Tabela </a>                  
              </li>
              <script>

    function redirecionarParaPaginaTabelas() {
        window.location.href = "tabelas.php";
    }
</script> 

              <li class="nav-item-baba">
                  <a onclick="redirecionarParaPaginaHistorico()" hrfe="tabelasEMPR.php" class="nav-link tabelaHistorico" href="#"><i class="far fa-clock"></i> Histórico </a>
              </li>
<script>
    function redirecionarParaPaginaHistorico() {
        window.location.href = "tabelasEMPR.php";
    }
</script> 

<li class="nav-item-baba">
                  <a onclick="redirecionarParaPaginaBaixas()" hrfe="tabelasBAIXAS.php" class="nav-link tabelaBaixas" href="#"><i class="fas fa-arrow-circle-down"></i> Baixas </a>
              </li>
<script>
    function redirecionarParaPaginaBaixas() {
        window.location.href = "tabelasBAIXAS.php";
    }
</script>  
<li class="nav-item-baba">
                  <a onclick="redirecionarParaPaginaEntrada()" hrfe="tabelas_entradas.php" class="nav-link tabelaHistorico" href="#"><i class="fa-sharp fa-solid fa-arrow-up"></i> Entrada </a>
              </li>
<script>
    function redirecionarParaPaginaEntrada() {
        window.location.href = "tabelas_entradas.php";
    }
</script> 
		    </ul>
	  </li>   
    
    

    
    <li class="nav-item-bobo">
		    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#menu_item2" href="#"> Produtos retornáveis <i class="bi small bi-caret-down-fill h3"></i> </a>
		    <ul id="menu_item2" class="submenu collapse" data-bs-parent="#nav_accordion">
              
        </li>
              <li class="nav-item-baba">
                  <a onclick="redirecionarParaPaginaPR()" style="opacity:50%"hrfe="tabelasPR.php" class="nav-link tabelaHistorico" href="#"><i class="fas fa-search"></i> Tabela</a>
              </li>
<script>
    function redirecionarParaPaginaPR() {
        window.location.href = "tabelasPR.php";
    }
</script>    

              <li class="nav-item-baba">
                  <a onclick="redirecionarParaHistoricoPR()" hrfe="tabelasPR.php" class="nav-link tabelaHistoricoPR" href="#"><i class="far fa-clock"></i> Histórico </a>
              </li>
<script>
    function redirecionarParaHistoricoPR() {
        window.location.href = "historicoPR.php";
    }
</script>

              <li class="nav-item-baba">
                  <a onclick="redirecionarParaBaixasPR()" hrfe="tabelasPR.php" class="nav-link tabelaHistorico" href="#"><i class="fas fa-arrow-circle-down"></i> Baixas <a>
              </li>
<script>
    function redirecionarParaBaixasPR() {
        window.location.href = "baixasPR.php";
    }
</script>    

		    </ul>
	  </li>     

    <li class="nav-item-bobo">
		    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#menu_item2" href="#"> Chaves <i class="bi small bi-caret-down-fill h3"></i> </a>
		    <ul id="menu_item2" class="submenu collapse" data-bs-parent="#nav_accordion">
              
        </li>
              <li class="nav-item-baba">
                  <a onclick="redirecionarParaPaginaChaves()" hrfe="tabelasPR.php" class="nav-link tabelaHistorico" href="#"><i class="fas fa-key"></i> Chaves</a>
              </li>
<script>
    function redirecionarParaPaginaChaves() {
        window.location.href = "tabelasCHAVE.php";
    }
</script>     

		    </ul>
	  </li>         

    </ul>

  <script type="text/javascript">

document.addEventListener("DOMContentLoaded", function(){

  document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;	

      if(nextEl) {
        e.preventDefault();	
        let mycollapse = new bootstrap.Collapse(nextEl);

          if(nextEl.classList.contains('show')){
            mycollapse.hide();
          } else {
            mycollapse.show();
            // find other submenus with class=show
            var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
            // if it exists, then close all of them
          if(opened_submenu){
            new bootstrap.Collapse(opened_submenu);
          }

          }
        }

    });
  })

}); 
// DOMContentLoaded  end
</script>


                                        <!-- SIDEBAR FIM -->

  <script src="script.js"></script>
        
        </table>

  <!-- Modal REGISTRAR -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a5a5afe9dc.js" crossorigin="anonymous"></script>


<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrationModalLabel">Registrar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="CRUDE/cad_prodR.php" method="POST" onsubmit="return validarQuantidade();">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="name_prod" name="name_prod">
          </div>
          <div class="form-group">
            <label for="nome">Patrimônio</label>
            <input type="text" class="form-control" id="patr_prod" name="patr_prod">
          </div>
          <div class="form-group">
            <label for="valor">Local</label>
            <input type="text" class="form-control" id="local_prod" name="local_prod">
          </div>
          <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  function exibirPopup(titulo, texto, icon, botao) {
    Swal.fire({
      title: titulo,
      text: texto,
      icon: icon,
      confirmButtonText: botao
    });
  }
</script>


<!-- Modal PERFILLLLLLL MAIS POLVORAAAA -->

<div class="modal fade" id="perfilModal" tabindex="-1" role="dialog" aria-labelledby="perfilModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="perfilModalLabel">Meu perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php

// Configurações do banco de dados

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EstoqueRenisson";

// Cria uma conexão com o banco de dados
$conn2 = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn2->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn2->connect_error);
}

// Recupera o ID do usuário logado (substitua essa parte com a lógica de autenticação do seu sistema)

// Consulta SQL para selecionar as informações do usuário logado
$sqlPerfil = "SELECT id, login, email FROM usuarios WHERE id = $usuarioLogadoId";
$resultPerfil = $conn2->query($sqlPerfil);

// Verifica se foi encontrado um registro
if ($resultPerfil->num_rows == 1) {
    // Recupera os dados do usuário logado
    $row = $resultPerfil->fetch_assoc();
    $id = $row["id"];
    $login = $row["login"];
    $email = $row["email"];

    // Exibe os dados no modal
  echo'  <div class="container">';
  echo'  <div class="row">';
  echo'    <div class="col-md-12">';
  echo'      <p><strong>ID:</strong> <span id="perfilID">';echo($id); echo'</span></p>';
  echo'      <p><strong>Nome:</strong> <span id="perfilNome">';echo($login); echo'</span></p>';
  echo'      <p><strong>Email:</strong> <span id="perfilEmail">';echo($email); echo'</span></p>';
  echo'    </div>';
  echo'  </div>';
  echo' </div>';
} else {
    echo "Nenhum registro encontrado.";
}

?>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>  

<!-- Modal EDITAR -->

  <div class="modal fade" id="editarModalLabel" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarModalLabel">Editar produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="CRUDE/edit_prod.php" method="POST">
            
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="name_prod" name="name_prod" value="">
            </div>
            <div class="form-group">
              <label for="quantidade">Quantidade</label>
              <input type="text" class="form-control" id="qtd_prod" name="qtd_prod" value="">
            </div>
            <div class="form-group">
              <label for="valor">Local</label>
              <input type="text" class="form-control" id="valor_prod" name="valor_prod" value="">
            </div>
            <div class="form-group">
              <label for="categoria">Categoria</label>
              <input type="text" class="form-control" id="cat_prod" name="cat_prod" value="">
            </div>

            <input type="hidden" id="id_prod_edit" name="id_prod_edit" value="">      
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        </div>
      </div>
    </div>
  </div>  

<!-- Modal EMPRESTIMO -->

<div class="modal fade" id="emprestimoModalLabel" tabindex="-1" role="dialog" aria-labelledby="emprestimoModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="emprestimoModalLabel">Retirar produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="CRUDE/emprestimo_prod.php" method="POST">
            
            <div class="form-group">
              <label for="quantidade">Requerente</label>
              <input type="text" class="form-control" id="mutuario_empr" name="mutuario_empr" value="">
            </div>
    
            <button type="submit" class="btn btn-primary">Confirmar retirada</button>
        </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        </div>
      </div>
    </div>
  </div>  

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>


$(document).ready(function() {
      $('.btn-add').click(function() {
        $('#registrationModal').modal('show');
      });
    });
  </script>

<script>
$(document).ready(function() {
  var thisprod_id;

  $('.btn-editar').click(function() {
    thisprod_id = $(this).data('thisproduto_id');
    $('#id_prod_edit').val(thisprod_id);

    $('#editarModalLabel').modal('show'); // Mostra o modal

  });

});
</script>

<script>
$(document).ready(function() {
  var thisprod_id;
    var thisdisponivel_chave;
  $('.btn-devolver_chave').click(function() {
    thisprod_id = $(this).data('thisproduto_id');
    thisdisponivel_chave = $(this).data('thisdisponivel_chave');
    $('#id_produtoRA').val(thisprod_id);
    $('#situacao_produtoRA').val(thisdisponivel_chave);


    $('#devolverModalLabel').modal('show'); // Mostra o modal

  });

});
</script>
<script>
$(document).ready(function() {
  var thisprod_id;
    var thisdisponivel_chave;
  $('.btn-emprestar_chave').click(function() {
    thisprod_id = $(this).data('thisproduto_id');
    thisdisponivel_chave = $(this).data('thisdisponivel_chave');
    $('#id_produtoRemprestar').val(thisprod_id);
    $('#situacao_produtoR').val(thisdisponivel_chave);


    $('#emprestarModalLabel').modal('show'); // Mostra o modal

  });

});
</script>
<script>
$(document).ready(function() {
  var thisprod_id;

  $('.btn-baixa').click(function() {
    thisprod_id = $(this).data('thisproduto_id');
    $('#id_produtoR').val(thisprod_id);

    $('#baixaModalLabel').modal('show'); // Mostra o modal

  });

});
</script>
<script>
$(document).ready(function() {
  var thisprod_id;

  $('.btn-emprestimo').click(function() {
    thisprod_id = $(this).data('thisproduto_id');
    $('#id_prod_empr').val(thisprod_id);

    $('#emprestimoModalLabel').modal('show'); // Mostra o modal

  });

});
</script>

<script>
    $(document).ready(function() {
      $('.nav-link').click(function(e) {
        e.preventDefault();

        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        if ($(this).hasClass('baba')) {
          $('#perfilModal').modal('show');
        }
      });
    });
  </script>

</script>




<!-- <script>
  // Evento de clique no botão
  $('.delete-link').click(function(e) {
    e.preventDefault(); // Evita que o link seja seguido

    // Obtém o valor do atributo 'data-produto'
    var produtoId = $(this).data('produto');

    // Exibe uma mensagem de confirmação e executa o delete do produto
    Swal.fire({
      title: 'Excluir produto',
      text: 'Tem certeza que deseja excluir este produto?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Delete do produto
        deleteProduto(produtoId);
      }
    });
  }); 




  

//   // Função para realizar o delete do produto
//   function deleteProduto(produtoId) {
//     // Envia uma requisição assíncrona para excluir o produto
//     fetch('CRUDE/delete_prodR.php?produtoR=' + produtoId, { method: 'GET' })
//       .then(function(response) {
//         // Verifica se a requisição foi bem-sucedida
//         if (response.ok) {
//           // Exibe o popup de sucesso
//           Swal.fire({
//             title: 'Produto excluído',
//             text: 'O produto foi excluído com sucesso!',
//             icon: 'success',
//             confirmButtonText: 'OK'
//           }).then(() => {
//             // Redireciona ou atualiza a página para exibir as alterações
//             window.location.reload();
//           });
//         } else {
//           // Exibe o popup de erro
//           Swal.fire({
//             title: 'Erro',
//             text: 'Ocorreu um erro ao excluir o produto.',
//             icon: 'error',
//             confirmButtonText: 'OK'
//           });
//         }
//       })
//       .catch(function(error) {
//         // Exibe o popup de erro
//         Swal.fire({
//           title: 'Erro',
//           text: 'Ocorreu um erro ao excluir o produto: ' + error.message,
//           icon: 'error',
//           confirmButtonText: 'OK'
//         });
//       });
//   }
// < /script>
-->


<script>
  function confirmDelete() {
    return confirm("Tem certeza que deseja excluir esta chave?");
  }
</script>
  </body>
</html>