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
        echo($usuarioLogadoId);

    }
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Tabela de Produtos</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/icons/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styleTabela.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
    
        <div class="container">
            <h1 style="text-align:center;">Tabela de Produtos</h1>
            <br>  
        <table class="table">
        <thead>
        <tr>
            <th scope="col"><b>ID PRODUTO</b></th>
            <th scope="col"><b>NOME PRODUTO</b></th>
            <th scope="col"><b>CATEGORIA PRODUTO</b></th>
            <th scope="col"><b>QUANTIDADE PRODUTO</b></th>
            <th scope="col"><b>LOCAL PRODUTO</b></th>

            <th scope="col"><b>EMPRÉTISMO</b></th>
            <th scope="col"><b>EDITAR PRODUTO</b></th>
            <th scope="col"><b>EXCLUIR PRODUTO</b></th>
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
        echo "<td>".$linha['valor_produto']."</td>";
        echo '<td><a href="#" class="btn btn-primary btn-emprestimo" data-thisproduto_id="'.$linha['id_produto'].'" style="font-size: 1.1rem">Empréstimo</a> </td>';
        echo '<td><a href="#" class="btn btn-warning btn-boema btn-editar bi bi-pencil-square"style="font-size: 1.5rem" data-thisproduto_id="'.$linha['id_produto'].'"></a></td>';
        echo '<td><a href="CRUDE/delete_prod.php?produto='.$linha['id_produto'].'" class="btn btn-danger btn-nanana bi bi-trash" style="font-size: 1.5rem" onclick="return confirmDelete()"></a></td>';
        echo '</tr>';
    }
    ?>
        </tbody>


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
              <input type="text" class="form-control" id="causa_prod" name="causa_prod" value="">
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



<!-- SIDE BAR TOOOOOOOOMA-LE mutuário -->
<div class="sidebar">
          <h5 class="text-center">Menu</h5>
  <ul class="nav flex-column">
              <li class="nav-item">
              <a class="nav-link tabelaPrincipal" href="#" onclick="redirecionarParaPaginaTabelas()"> <i class="bi bi-house"></i> Home </a>

<script>
    function redirecionarParaPaginaTabelas() {
        window.location.href = "tabelas.php";
    }
</script>                  
              </li>
              <li class="nav-item-baba">
                  <a onclick="redirecionarParaPaginaHistorico()" hrfe="tabelasEMPR.php" class="nav-link tabelaHistorico" href="#"><i class="bi bi-clock-history"></i> Histórico </a>
              </li>
<script>
    function redirecionarParaPaginaHistorico() {
        window.location.href = "tabelasEMPR.php";
    }
</script>                 
              <li class="nav-item-baba">
                  <a class="nav-link baba" href="#"><i class="bi bi-person"></i> Perfil </a>
              </li>

          </ul>
      </div>




        
        </table>
        <a class="btn btn-success btn-add">CADASTRAR PRODUTO</a>
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