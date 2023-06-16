<!DOCTYPE HTML>
  <html lang="pt-br">
  <head>
          <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
          <title>Gráfico de Produtos no Estoque</title>
          <link rel="shortcut icon" href="imagens/tucano.png" type="image/png">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
          <link rel="stylesheet" href="../styleSideBar.css"> 
          <link rel="stylesheet" href="../stylePag.css">
          
          <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet" />
          <script src="https://kit.fontawesome.com/a5a5afe9dc.js" crossorigin="anonymous"></script>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/icons/bootstrap-icons.min.css" rel="stylesheet">
          <link rel="stylesheet" href="styleTabela.css">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        </head>
      <body>
        
      
      <!-- GRAFICO -->
      <?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasetucas";

try {
    // Criação da conexão PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obter os valores da tabela
    $sql = "SELECT  produto_empr, patrimonio, data_empr, responsavel, id_emprPR FROM empr_pr";
    $stmt = $conn->query($sql);

    $dadosGastos = [];
    $labels = [];

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $labels[] = $row['produto_empr'];
            $responsavel[] = $row['responsavel'];
            $nomesProdutos[] = $row['produto_empr'];
            $dadosGastos[] = $row['patrimonio'];
            $quantidadesProdutos[] = $row['patrimonio'];
            $data = new DateTime($row['data_empr']);
            $labelsData[] = $data->format('d/m/Y');
            $id []= $row['id_emprPR'];
        }
    }

    // Fecha a conexão PDO
    $conn = null;
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>
          <div class="container">

              <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logout a {
            background-color: #F2C063;
            color: #F2E6CE;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 60px;
        }

        .grafico-container {
            margin-top: 250px;
            width: 800px;
            height: 600px;
            margin-left: 350px;
        }
    </style>
</head>

<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Gastos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet" />
</head>
<body>
    <canvas id="canvasGrafico"></canvas>

    <script>
    window.onload = function () {
        var ctx = document.getElementById("canvasGrafico").getContext("2d");

        var dadosGastos = <?php echo json_encode($dadosGastos); ?>;
        var id = <?php echo json_encode($id); ?>;
        var labelsData = <?php echo json_encode($labelsData); ?>;
        var nomesProdutos = <?php echo json_encode($nomesProdutos); ?>;
        var quantidadesProdutos = <?php echo json_encode($quantidadesProdutos); ?>;
        var responsavel = <?php echo json_encode($responsavel); ?>;

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: nomesProdutos,
                datasets: [{
                    label: "Retiradas",
                    data: id,
                    backgroundColor: "rgba(255, 0, 0, 0.2)", // Fundo vermelho
                    borderColor: "rgba(255, 0, 0, 1)", // Borda vermelhae
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                var dataIndex = context.dataIndex;
                                var produto = nomesProdutos[dataIndex];
                                var quantidade = quantidadesProdutos[dataIndex];
                                label += produto + ' - ' + 'patrimonio: ' + quantidade + ' - data:' + labelsData[dataIndex];
                                return label;
                            }
                        }
                    }
                }
            }
        });
    };
</script>
</body>
</html>

  <!-- SIDEBAR -->
  <div class="barraTop">
  <div class="logo">

        <span></span>
      </button>
      <button type="button" onclick="toggleSidebar()"class="toggle toggles" id="toggles">
        <span onclick="toggleSidebar()"></span>
      </button>

              <img src="../imagens/tucano.png" alt="Logo Icon" class="logo-icon">
          </a>

              <span class="logo-text">Tucas</span>
          </div>
          
          <div class="logout">
              <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
          </div>

      </div>




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

          </ul>
      </li>   
      
      <li class="nav-item-bobo">
          <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#menu_item2" href="#"> Gráficos <i class="bi small bi-caret-down-fill h3"></i> </a>
          <ul id="menu_item2" class="submenu collapse" data-bs-parent="#nav_accordion">
                
                <li class="nav-item-baba">
                    <a class="nav-link tabelaPrincipal"  onclick="redirecionarParaPaginaTabelas()" href="#"><i class="fas fa-search"></i> Gráficos </a>                  
                </li>
                <script>

      function redirecionarParaPaginaTabelas() {
          window.location.href = "graficoTotal.php";
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
                    <a onclick="redirecionarParaPaginaChaves()"style="opacity:50%;" hrfe="tabelasPR.php" class="nav-link tabelaHistorico" href="#"><i class="fas fa-key"></i> Chaves</a>
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




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>
  </html>