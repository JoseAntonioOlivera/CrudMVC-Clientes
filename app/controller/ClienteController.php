<?php
require_once __DIR__ . '/../model/Cliente.php';

class ClienteController
{
  public function index(): void
  {
    $Clientes = Cliente::all();
    // Subimos un nivel (..) para salir de controllers y entrar en views
    require __DIR__ . '/../views/Clients/index.php';
  }

  public function create(): void
  {
    $error = '';
    require __DIR__ . '/../views/Clients/create.php';
  }

  public function store(): void
  {
    try {
      $nombre = (string)($_POST['nombre'] ?? '');
      $email = (string)($_POST['email'] ?? '');
      $telefono = (string)($_POST['telefono'] ?? '');

      Cliente::create($nombre, $email, $telefono);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();
      require __DIR__ . '/../views/Clientes/create.php';
    }
  }

  public function edit(): void
  {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $Cliente = Cliente::find($id);

    if ($Cliente === null) {
      echo "Cliente no encontrado";
      return;
    }

    $error = '';
    require __DIR__ . '/../views/Clients/edit.php';
  }

  public function update(): void
  {
    try {
      $id = (int)($_POST['id'] ?? 0);
      $nombre = (string)($_POST['nombre'] ?? '');
      $email = (string)($_POST['email'] ?? '');
      $telefono = (string)($_POST['telefono'] ?? '');

      Cliente::update($id, $nombre, $email, $telefono);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();
      $id = (int)($_POST['id'] ?? 0);
      $Cliente = Cliente::find($id);
      
      if ($Cliente === null) {
        echo "Cliente no encontrado";
        return;
      }

      require __DIR__ . '/../views/Clientes/edit.php';
    }
  }

  public function delete(): void
  {
    try {
      $id = (int)($_POST['id'] ?? 0);
      Cliente::delete($id);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      echo "No se pudo borrar: " . $e->getMessage();
    }
  }
}
