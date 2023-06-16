<?php
    require("conn.php");
    require("protected.php");
    $tabela = $pdo->prepare("SELECT id_produto, nome_produto, qtd_produto, valor_produto, cat_produto 
    FROM produtos;");
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
      $tabela = $pdo->prepare("SELECT id_produto, nome_produto, cat_produto, qtd_produto, valor_produto, unidade_produto
      FROM produtos WHERE id_produto = '$search' OR nome_produto LIKE '%$search%' OR cat_produto LIKE '%$search%' OR valor_produto LIKE '%$search%' OR unidade_produto LIKE '%$search%';");
      $tabela->execute();
      $rowTabela = $tabela->fetchAll();
  }
  else{
      $tabela = $pdo->prepare("SELECT id_produto, nome_produto, cat_produto, qtd_produto, valor_produto, unidade_produto
      FROM produtos ORDER BY id_produto DESC;");
      $tabela->execute();
      $rowTabela = $tabela->fetchAll();
  }

  
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Tabela de produtos de uso único</title>
        <link rel="shortcut icon" href="imagens/tucano.png" type="image/png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
        <link rel="stylesheet" href="styleSideBar.css"> 
        <link rel="stylesheet" href="stylePag.css"> 
        <script src="https://kit.fontawesome.com/a5a5afe9dc.js" crossorigin="anonymous"></script>
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
        .search{
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
            <h1 style="text-align:center;">TABELA DE PRODUTOS DE USO ÚNICO</h1>
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
            <th scope="col"><b>ID PRODUTO</b></th>
            <th scope="col"><b>NOME PRODUTO</b></th>
            <th scope="col"><b>CATEGORIA PRODUTO</b></th>
            <th scope="col"><b>QUANTIDADE PRODUTO</b></th>
            <th scope="col"><b>UNIDADE PRODUTO </b></th>
            <th scope="col"><b>LOCAL PRODUTO</b></th>

            <th scope="col"><b>ENTRADA DE PRODUTO</b></th>
            <th scope="col"><b>RETIRADA DE PRODUTO</b></th>
            <th scope="col"><b>EDITAR PRODUTO</b></th>
            <th scope="col"><b>BAIXA EM PRODUTO</b></th>
            </tr>
        </thead>
        <tbody>
        <?php
    foreach ($rowTabela as $linha){
        echo '<tr>';
        echo "<th scope='row'><b>".$linha['id_produto']."</th></b>";
        echo "<td>".$linha['nome_produto']."</td>";
        echo "<td>".$linha['cat_produto']."</td>";

        echo "<td>".$linha['qtd_produto']."</td>";
        echo "<td>".$linha['unidade_produto']."</td>";

        echo "<td>".$linha['valor_produto']."</td>";
        echo '<td><a href="#" class="btn btn-primary btn-entrada" data-thisproduto_id="'.$linha['id_produto'].'" style="font-size: 1.1rem">Entrada</a> </td>';
        echo '<td><a href="#" class="btn btn-primary btn-emprestimo" data-thisproduto_id="'.$linha['id_produto'].'" style="font-size: 1.1rem">Retirada</a> </td>';
        echo '<td><a href="#" class="btn btn-warning btn-boema btn-editar bi bi-pencil-square" style="font-size: 1.5rem" data-thisproduto_id="'.$linha['id_produto'].'" data-thisproduto_nome="'.$linha['nome_produto'].'" data-thisproduto_qtd="'.$linha['qtd_produto'].'" data-thisproduto_valor="'.$linha['valor_produto'].'" data-thisproduto_cat="'.$linha['cat_produto'].'"></a></td>';
        echo '<td><a data-thisproduto_id='.$linha['id_produto'].'" class="btn btn-danger btn-baixa btn-nanana bi bi-recycle" style="font-size: 1.5rem"></a></td>';
        echo '</tr>';
    }
    ?>
        </tbody>
</div>
<a class="btn btn-success btn-add">CADASTRAR PRODUTO</a>
<a href="exportacaoData/tabelasExp.php" style="margin-left: 5rem" class="btn btn-success btn-export" onclick="exibirPopup('Sucesso!', 'Tabela Exportada!', 'success', 'OK')">EXPORTAR TABELA</a>
<a href="graficoTotal.php" style="margin-left: 5rem" class="btn btn-success btn-export">VISUALIZAR EM GRÁFICO</a>

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
                window.location = 'tabelas.php?search='+search.value; //criou um parametro
            }
        </script>



<!-- Modal BAIXA -->

<div class="modal fade" id="baixaModalLabel" tabindex="-1" role="dialog" aria-labelledby="baixaModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="baixaModalLabel">Baixa produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="CRUDE/delete_prod.php" method="POST">
            <div class="form-group">
              <label for="nome">Causa</label>
              <input type="text" class="form-control" id="causa_baixa" name="causa_baixa" value="">
            </div>
            <input type="hidden" id="id_prod" name="id_prod" value="">      
            <button type="submit" href="CRUDE/delete_prod.php"class="btn btn-primary">Dar baixa</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>  

                                                         <!-- SIDEBAR -->
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
                  <a class="nav-link tabelaPrincipal" style="opacity:50%;" href="#"><i class="fas fa-search"></i> Tabela </a>                  
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
            <label for="unidade">Unidade de medida</label>
          <select class="form-control" id="unidade_produto" name="unidade_produto">
              <option value="Unidade">Unidades</option>
              <option value="Litro">Litros</option>
              <option value="Pacote">Pacotes</option>
              <option value="Lote">Lotes</option>
          </select>
          </div>
          <div class="form-group">
            <label for="valor">Local</label>
            <input type="text" class="form-control" id="valor_prod" name="valor_prod">
          </div>
          <div class="form-group">
            <label for="categoria">Categoria (opcional)</label>
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
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarModalLabel">Editar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="CRUDE/edit_prod.php" method="POST">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="edit_nome_produto" name="edit_nome_produto" >
          </div>
          <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="text" class="form-control" id="edit_qtd_produto" name="edit_qtd_produto">
          </div>

          <div class="form-group">
            <label for="valor">Local</label>
            <input type="text" class="form-control" id="edit_valor_produto" name="edit_valor_produto">
          </div>
          <div class="form-group">
            <label for="categoria">Categoria</label>
            <input type="text" class="form-control" id="edit_cat_produto" name="edit_cat_produto">
          </div>
          <input  type="hidden" id="edit_id_produto" name="edit_id_produto">
          <button type="submit" class="btn btn-primary">Salvar</button>
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
              <label for="quantidade">Quantidade a retirar</label>
              <input type="text" class="form-control" id="qtd_prod" name="qtd_prod" value="">
            </div>
            <div class="form-group">
              <label for="quantidade">Requerente</label>
              <input type="text" class="form-control" id="mutuario_empr" name="mutuario_empr" value="">
            </div>
            <input type="hidden" id="id_prod_empr" name="id_prod_empr" value="">      
            <button type="submit" class="btn btn-primary">Confirmar retirada</button>
        </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        </div>
      </div>
    </div>
  </div>  

  <!-- Modal Entrada -->

  <div class="modal fade" id="entradaModalLabel" tabindex="-1" role="dialog" aria-labelledby="entradaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="entradaModalLabel">Adicionar produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="CRUDE/adicionar_prod.php" method="POST" onsubmit="return validateForm()">
          <div class="form-group">
            <label for="quantidade">Quantidade a se adicionar</label>
            <input type="text" class="form-control" id="qtd_prod_add" name="qtd_prod_add" value="">
          </div>
          <input type="hidden" id="id_prod_add" name="id_prod_add" value="">
          <button type="submit" class="btn btn-primary">Confirmar entrada</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function validateForm() {
    var quantidade = document.getElementById("qtd_prod_add").value;
    if (quantidade === ""){
      alert("O valor não pode ser nulo. Por favor, insira uma quantidade.");
      return false;
    } else if (quantidade < 0) {
      alert("O valor não pode ser negativo. Por favor, insira uma quantidade positiva.");
      return false;
    }
    return true;
  }
</script> 

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
  document.querySelectorAll('.btn-editar').forEach(function(element) {
    element.addEventListener('click', function() {
      var id = element.dataset.thisproduto_id;
      var nome = element.dataset.thisproduto_nome;
      var quantidade = element.dataset.thisproduto_qtd;
      var valor = element.dataset.thisproduto_valor;
      var categoria = element.dataset.thisproduto_cat;

      document.getElementById('edit_id_produto').value = id;
      document.getElementById('edit_nome_produto').value = nome;
      document.getElementById('edit_qtd_produto').value = quantidade;
      document.getElementById('edit_valor_produto').value = valor;
      document.getElementById('edit_cat_produto').value = categoria;

      // Abrir o modal
      $('#editarModal').modal('show');
    });
  });
</script>
<script>
$(document).ready(function() {
  var thisprod_id;

  $('.btn-baixa').click(function() {
    thisprod_id = $(this).data('thisproduto_id');
    $('#id_prod').val(thisprod_id);

    $('#baixaModalLabel').modal('show'); // Mostra o modal

  });

});
</script>
<script>
$(document).ready(function() {
  var thisprod_id;

  $('.btn-entrada').click(function() {
    thisprod_id = $(this).data('thisproduto_id');
    $('#id_prod_add').val(thisprod_id);

    $('#entradaModalLabel').modal('show'); // Mostra o modal

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
  function toggleSidebar() {
  var sidebar = document.querySelector('.sidebar');
  sidebar.classList.toggle('sidebar-closed');
}
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