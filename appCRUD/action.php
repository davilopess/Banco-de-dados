<?php
  session_start();
  include "conf.php";

  $pesquisar = false;

  $update = false;
  $cliente_id = "";
  $nome = "";
  $data_nasc = "";
  $telefone = "";
  $imagem = "uploads/perfil.jpg";

  // CRUD Create
  if (isset($_POST["sub_btn"])) {
    $nome = $_POST["nome"];
    $data_nasc = $_POST["data_nasc"];
    $telefone = $_POST["telefone"];
    if (isset($_FILES["imagem"]["name"]) && $_FILES["imagem"]["name"] != "") {
      $imagem = $_FILES["imagem"]["name"];
      $upload = "uploads/" . $imagem;
      move_uploaded_file($_FILES["imagem"]["tmp_name"], $upload);
    } else {
      $upload = "uploads/perfil.jpg";
    }

    $query = "INSERT INTO table_clientes(nome, data_nasc, telefone, foto) VALUES(
            ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nome, $data_nasc, $telefone, $upload);
    $stmt->execute();

    $_SESSION["response"] = "Cliente Cadastrado!";
    $_SESSION["res_type"] = "success";
    header("location:index.php");

    $stmt->close();
    $conn->close();
  }

  // CRUD Delete
  if (isset($_GET["deletar"])) {
    $cliente_id = $_GET["deletar"];

    $sql = "SELECT foto FROM table_clientes WHERE cliente_id = ?";
    $stmt_2 = $conn->prepare($sql);
    $stmt_2->bind_param("i", $cliente_id);
    $stmt_2->execute();
    $result_2 = $stmt_2->get_result();
    $row = $result_2->fetch_assoc();

    $imagem_path = $row["foto"];
    unlink($imagem_path);

    $query = "DELETE FROM table_clientes WHERE cliente_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();

    $_SESSION["response"] = "Cliente Deletado!";
    $_SESSION["res_type"] = "danger";

    $stmt->close();
    $conn->close();
    header("location:index.php");
  }

  // CRUD Update
  if (isset($_GET["editar"])) {
    $cliente_id = $_GET["editar"];

    $query = "SELECT * FROM table_clientes WHERE cliente_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $cliente_id = $row["cliente_id"];
    $nome = $row["nome"];
    $data_nasc = $row["data_nasc"];
    $telefone = $row["telefone"];
    $imagem = $row["foto"];

    $update = true;
  }

  if (isset($_POST["update"])) {
    $cliente_id = $_POST["cliente_id"];
    $nome = $_POST["nome"];
    $data_nasc = $_POST["data_nasc"];
    $telefone = $_POST["telefone"];
    $old_imagem = $_POST["old_imagem"];

    if (isset($_FILES["imagem"]["name"]) && $_FILES["imagem"]["name"] != "") {
      unlink($old_imagem);
      $new_imagem = $_FILES["imagem"]["name"];
      $upload_new_image = "uploads/" . $new_imagem;
      move_uploaded_file($_FILES["imagem"]["tmp_name"], $upload_new_image);
      echo "sucesso";
    } else {
      $new_imagem = $old_imagem;
    }

    $query = "UPDATE table_clientes SET nome=?, data_nasc=?, telefone=?, foto=? WHERE cliente_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $nome, $data_nasc, $telefone, $upload_new_image, $cliente_id);
    $stmt->execute();

    $_SESSION["response"] = "Dados Atualizados!";
    $_SESSION["res_type"] = "primary";

    $stmt->close();
    $conn->close();

    header("location:index.php");
  }

  if (isset($_GET["detalhes"])) {
    $det_cliente_id = $_GET["detalhes"];
    $det_query = "SELECT * FROM table_clientes WHERE cliente_id = ?";
    $det_stmt = $conn->prepare($det_query);
    $det_stmt->bind_param("i", $det_cliente_id);
    $det_stmt->execute();
    $det_result = $det_stmt->get_result();
    $det_row = $det_result->fetch_assoc();

    $det_cliente_id = $det_row["cliente_id"];
    $det_nome = $det_row["nome"];
    $det_data_nasc = $det_row["data_nasc"];
    $det_telefone = $det_row["telefone"];
    $det_imagem = $det_row["foto"];

    $det_stmt->close();
    $conn->close();
  }

  if (isset($_GET["pesquisar"])) {
    $pesquisar = true;
  }

?>
