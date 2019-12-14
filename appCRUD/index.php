<?php
  include "action.php"
?>

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
      <form class="form-inline ml-auto" action="index.php" method="get">
        <input class="form-control mr-sm-2" type="text" name="campo_pesquisar" placeholder="Pesquisar">
        <button class="btn btn-primary" type="submit" name="pesquisar">Pesquisar</button>
      </form>
    </nav>
    <br>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <?php if(isset($_SESSION["response"])) {?>
          <div class="alert alert-<?= $_SESSION["res_type"]; ?> alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <b><?= $_SESSION["response"];?></b>
          </div>
          <?php } unset($_SESSION["response"]); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info">Adicionar Novo Cliente</h3>
            <form action="action.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="cliente_id" value="<?= $cliente_id; ?>">
              <div class="form-group">
                <label for="">Nome:</label>
                <input type="text" name="nome" value="<?= $nome; ?>" class=
                "form-control" placeholder="Nome" required>
              </div>
              <div class="form-group">
                <label for="">Data de Nascimento:</label>
                <input type="date" name="data_nasc" value="<?= $data_nasc; ?>" class=
                "form-control" placeholder="Data de Nascimento" required>
              </div>
              <div class="form-group">
                <label for="">Telefone:</label>
                <input type="tel" name="telefone" value="<?= $telefone; ?>" class=
                "form-control" placeholder="Telefone " required>
              </div>
              <div class="form-group">
                <label for="">Foto:</label>
                <input type="hidden" name="old_imagem" value="<?= $imagem; ?>">
                <input type="file" name="imagem" class="custom-file" placeholder="Imagem">
                <img class="img-thumbnail" src="<?= $imagem; ?>" width="120" alt="Imagem do Cliente">
              </div>
              <div class="form-group">
                <?php if ($update == true) { ?>
                  <input type="submit" name="update" class="btn btn-success btn-block" value=
                  "Atualizar Cliente">
                <?php } else { ?>
                  <input type="submit" name="sub_btn" class="btn btn-primary btn-block" value=
                  "Adicionar Cliente">
                <?php } ?>
              </div>
            </form>
        </div>
        <div class="col-md-8">
          <!-- CRUD Read -->
          <?php
            if ($pesquisar == false) {
              $query  = "SELECT * FROM table_clientes";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              $result = $stmt->get_result();
            } else {
              $cliente_nome = $_GET["campo_pesquisar"] . "%";
              $query  = "SELECT * FROM table_clientes WHERE nome LIKE ?";
              $stmt = $conn->prepare($query);
              $stmt->bind_param("s", $cliente_nome);
              $stmt->execute();
              $result = $stmt->get_result();
            }
          ?>
          <h3 class="text-center text-info">Clientes Cadastrados</h3>
          <br>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Telefone</th>
                <th>Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <td><?= $row["cliente_id"]; ?></td>
                <td><img src="<?= $row["foto"]; ?>" width="25"/></td>
                <td><?= $row["nome"]; ?></td>
                <td><?= $row["data_nasc"]; ?></td>
                <td><?= $row["telefone"]; ?></td>
                <td>
                  <a href="detalhes.php?detalhes=<?= $row["cliente_id"]; ?>" class=
                    "badge badge-primary p-2">Detalhes</a> |
                  <a href="action.php?deletar=<?= $row["cliente_id"]; ?>" class=
                    "badge badge-danger p-2" onclick=
                    "return confirm('Tem certeza que deseja deletar este cliente?')">Deletar</a> |
                  <a href="index.php?editar=<?= $row["cliente_id"]; ?>" class=
                    "badge badge-success p-2">Editar</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </body>
</html>
