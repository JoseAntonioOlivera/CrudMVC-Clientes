<?php
// Aquí llega la variable $Clientes desde el controlador
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Clientes</title>
</head>
<body>

<h1>Listado de clientes</h1>

<p><a href="index.php?action=create">Crear nuevo cliente</a></p>

<?php if (count($Clientes) === 0): ?>
  <p>No hay clientes registrados.</p>
<?php else: ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Fecha Registro</th>
      <th>Acciones</th>
    </tr>

    <?php foreach ($Clientes as $c): ?>
      <tr>
        <td><?php echo (int)$c['id']; ?></td>
        <td><?php echo htmlspecialchars($c['nombre']); ?></td>
        <td><?php echo htmlspecialchars($c['email']); ?></td>
        <td><?php echo htmlspecialchars($c['telefono']); ?></td>
        <td><?php echo $c['fecha_registro']; ?></td>
        <td>
          <a href="index.php?action=edit&id=<?php echo (int)$c['id']; ?>">Editar</a>

          <form method="post" action="index.php?action=delete" style="display:inline" onsubmit="return confirm('¿Seguro que quieres borrar este cliente?');">
            <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>">
            <button type="submit">Borrar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>

  </table>
<?php endif; ?>

<p><a href="index.php">Volver al inicio</a></p>

</body>
</html>
