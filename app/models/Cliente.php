<?php
require_once __DIR__ . '/Database.php';

class Cliente
{
  public static function all(): array
  {
    $sql = "SELECT id, nombre, email, telefono, fecha_registro FROM clientes ORDER BY id DESC";
    $stmt = Database::pdo()->query($sql);
    return $stmt->fetchAll();
  }

  public static function find(int $id): ?array
  {
    $sql = "SELECT id, nombre, email, telefono, fecha_registro FROM clientes WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);

    $row = $stmt->fetch();
    return $row ? $row : null;
  }

  public static function create(string $nombre, string $email, string $telefono): void
  {
    $nombre = trim($nombre);
    $email = trim($email);
    $telefono = trim($telefono);

    // Reglas de validación
    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }
    if ($email === '') {
      throw new Exception("El email es obligatorio.");
    }
    if (strlen($telefono) !== 9) {
      throw new Exception("El teléfono debe tener exactamente 9 dígitos.");
    }

    $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':nombre' => $nombre,
      ':email' => $email,
      ':telefono' => $telefono
    ]);
  }

  public static function update(int $id, string $nombre, string $email, string $telefono): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $nombre = trim($nombre);
    $email = trim($email);
    $telefono = trim($telefono);

    // Reglas de validación
    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }
    if ($email === '') {
      throw new Exception("El email es obligatorio.");
    }
    if (strlen($telefono) !== 9) {
      throw new Exception("El teléfono debe tener exactamente 9 dígitos.");
    }

    $sql = "UPDATE clientes SET nombre = :nombre, email = :email, telefono = :telefono WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':nombre' => $nombre,
      ':email' => $email,
      ':telefono' => $telefono
    ]);
  }

  public static function delete(int $id): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $sql = "DELETE FROM clientes WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }
}
