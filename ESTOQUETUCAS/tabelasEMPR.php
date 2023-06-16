<?php
    require("conn.php");
    require("protected.php");
    $tabela = $pdo->prepare("SELECT id_empr, mutuario_empr, quantidade_empr, data_empr, produto_empr, responsavel
    FROM emprestimos;");
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
    $tabela = $pdo->prepare("SELECT id_empr, mutuario_empr, quantidade_empr, data_empr, produto_empr, responsavel
    FROM emprestimos WHERE id_empr = '$search' OR mutuario_empr LIKE '%$search%' OR data_empr LIKE '%$search%' OR produto_empr LIKE '%$search%' OR responsavel LIKE '%$search%' OR unidade_empr LIKE '%$search%';");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
}
else{
    $tabela = $pdo->prepare("SELECT id_empr, mutuario_empr, quantidade_empr, data_empr, produto_empr, responsavel, unidade_empr
    FROM emprestimos ORDER BY data_empr DESC;");
    $tabela->execute();
    $rowTabela = $tabela->fetchAll();
}



?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>HISTÓRICO DE RETIRADA</title>
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
            <h1 style="text-align:center;">HISTÓRICO DE RETIRADA</h1>
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
            <a href="exportacaoData/tabelasHistExp.php" style="margin-left: 5rem" class="btn btn-success btn-export" onclick="exibirPopup()">EXPORTAR TABELA</a>
            <a href="graficoSaidasUnico.php" style="margin-left: 5rem" class="btn btn-success btn-export">VISUALIZAR EM GRÁFICO</a>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

            <script>
              function exibirPopup() {
                Swal.fire({
                  title: 'Sucesso!',
                  text: 'Tabela Exportada!',
                  icon: 'success',
                  confirmButtonText: 'Fechar'
                });
              }
            </script>
            
            <br>  
        <table class="table">
        <thead>
        <tr>

            <th scope="col"><b>REQUERENTE</b></th>
            <th scope="col"><b>PRODUTO RETIRADO</></th>
            <th scope="col"><b>QUANTIDADE RETIRADA</b></th>
            <th scope="col"><b>UNIDADES RETIRADAS</b></th>
            <th socpe="col"><b>RESPONSÁVEL</b></th>
            <th scope="col"><b>DATA DA RETIRADA</b></th>
            </tr>
        </thead>
        <tbody>
        <?php
foreach ($rowTabela as $linha){
  echo '<tr>';

  echo "<td>".$linha['mutuario_empr']."</td>";
  echo "<td>".$linha['produto_empr']."</td>";
  echo "<td>".$linha['quantidade_empr']."</td>";
  echo "<td>".$linha['unidade_empr']."</td>";
  echo "<td>".$linha['responsavel']."</td>";  
  $data_empr = strtotime($linha['data_empr']);
  $data_formatada = date("d/m/Y", $data_empr);
  echo "<td>".$data_formatada."</td>";
  echo '</tr>';
}
?>

        </tbody>

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
                window.location = 'tabelasEMPR.php?search='+search.value; //criou um parametro
            }
        </script>

        

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
                  <a class="nav-link tabelaPrincipal"  onclick="redirecionarParaPaginaTabelas()"  href="#"><i class="fas fa-search"></i> Tabela </a>                  
              </li>
              <script>

    function redirecionarParaPaginaTabelas() {
        window.location.href = "tabelas.php";
    }
</script> 

              <li class="nav-item-baba">
                  <a onclick="redirecionarParaPaginaHistorico()"style="opacity:50%;" hrfe="tabelasEMPR.php" class="nav-link tabelaHistorico" href="#"><i class="far fa-clock"></i> Histórico </a>
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
                  <a onclick="redirecionarParaPaginaPR()" hrfe="tabelasPR.php" class="nav-link tabelaHistorico" href="#"><i class="fas fa-search"></i> Tabela</a>
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

<script>
  function validarQuantidade() {
    var quantidadeInput = document.getElementById("qtd_prod");
    var quantidade = parseInt(quantidadeInput.value);
    
    if (isNaN(quantidade) || quantidade % 1 !== 0) {
      alert("A quantidade deve ser um número inteiro.");
      return false; // Impede o envio do formulário
    }
    
    return true; // Permite o envio do formulário
  }
</script>

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
        <form action="CRUDE/cad_prod.php" method="POST" onsubmit="return validarQuantidade();">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="name_prod" name="name_prod">
          </div>
          <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="text" class="form-control" id="qtd_prod" name="qtd_prod">
          </div>
          <div class="form-group">
            <label for="valor">Local</label>
            <input type="text" class="form-control" id="valor_prod" name="valor_prod">
          </div>
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="text" class="form-control" id="cat_prod" name="cat_prod">
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

            <input type="hidden" id="id_prod" name="id_prod" value="">      
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
          <h5 class="modal-title" id="emprestimoModalLabel">Empréstimo produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="CRUDE/emprestimo_prod.php" method="POST">
            
            <div class="form-group">
              <label for="quantidade">Quantidade a dar baixa</label>
              <input type="text" class="form-control" id="qtd_prod" name="qtd_prod" value="">
            </div>
            <div class="form-group">
              <label for="quantidade">Mutuário</label>
              <input type="text" class="form-control" id="mutuario_empr" name="mutuario_empr" value="">
            </div>
            <input type="hidden" id="id_prod_empr" name="id_prod_empr" value="">      
            <button type="submit" class="btn btn-primary">Confirmar empréstimo</button>
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
    $('#id_prod').val(thisprod_id);

    $('#editarModalLabel').modal('show'); // Mostra o modal

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
<script>
  function confirmDelete() {
    return confirm("Tem certeza que deseja excluir este produto?");
  }
</script>
  </body>
</html>