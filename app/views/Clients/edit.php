<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar cliente</title>
</head>
<body>

<h1>Editar cliente</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=update">
  <!-- Campo oculto para el ID -->
  <input type="hidden" name="id" value="<?php echo (int)$Cliente['id']; ?>">

  <p>
    Nombre completo:<br>
    <input type="text" name="nombre" value="<?php
      echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : htmlspecialchars($Cliente['nombre']);
    ?>" required>
  </p>

  <p>
    Correo electrónico:<br>
    <input type="email" name="email" value="<?php
      echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($Cliente['email']);
    ?>" required>
  </p>

  <p>
    Teléfono:<br>
    <input type="tel" name="telefono" value="<?php
      echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : htmlspecialchars($Cliente['telefono']);
    ?>">
  </p>

  <button type="submit">Actualizar cliente</button>
</form>

<p><a href="index.php?action=index">Volver al listado</a></p>

</body>
</html>
