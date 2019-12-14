
<?php include "action.php" ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Solway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="js/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Cadastro de Clientes</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <a class="navbar-brand" href="index.php">Cadastro de Clientes</a>
      <form class="form-inline ml-auto" action="#">
        <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar">
        <button class="btn btn-primary" type="submit">Pesquisar</button>
      </form>
    </nav>
    <br>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 mt-3 bg-info p-4 rounded">
          <div class="text-center">
            <img class="img-thumbnail" src="<?= $det_imagem; ?>" width="300" alt="Imagem do Cliente">
          </div>
          <br>
          <table>
            <tr>
              <td><h4 class="text-light">ID:</h4></td>
              <td><h4 class="text-light"><?= $det_cliente_id; ?></h4></td>
            </tr>
            <tr>
              <td><h4 class="text-light">Nome:</h4></td>
              <td><h4 class="text-light"><?= $det_nome; ?></h4></td>
            </tr>
            <tr>
              <td><h4 class="text-light">Nascimento: </h4></td>
              <td><h4 class="text-light"><?= $det_data_nasc; ?></h4></td>
            </tr>
            <tr>
              <td><h4 class="text-light">Telefone:</h4></td>
              <td><h4 class="text-light"><?= $det_telefone; ?></h4></td>
            </tr>
          </table>
          <!-- <h4 class="text-light">ID: <?= $det_cliente_id; ?></h4>
          <h4 class="text-light">Nome: <?= $det_nome; ?></h4>
          <h4 class="text-light">Data de Nascimento: <?= $det_data_nasc; ?></h4>
          <h4 class="text-light">Telefone: <?= $det_telefone; ?></h4> -->
        </div>
      </div>
    </div>
  </body>
</html>
