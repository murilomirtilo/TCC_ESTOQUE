<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Split Dropright com Bootstrap</title>

  <!-- CSS do Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/icons/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styleTabela.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- Estilos personalizados (opcional) -->
  <style>
    /* Adicione estilos personalizados aqui, se necessário */
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <!-- Conteúdo principal à esquerda -->
        <h1>Conteúdo Principal</h1>
        <p>Este é o conteúdo principal à esquerda.</p>
      </div>
      <div class="col-md-4">
        <div class="dropdown dropright">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opções
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <!-- Itens do menu dropdown -->
            <a class="dropdown-item" href="#">Item 1</a>
            <a class="dropdown-item" href="#">Item 2</a>
            <a class="dropdown-item" href="#">Item 3</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS do Bootstrap (necessário para funcionalidades como dropdowns, modais, etc.) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>