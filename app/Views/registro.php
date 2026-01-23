<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<h2>Registro de Usuario</h2>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('validation')): ?>
    <ul style="color:red;"><?= session()->getFlashdata('validation')->listErrors() ?></ul>
<?php endif; ?>

<?php if (session()->getFlashdata('captcha_error')): ?>
    <p style="color:red;"><?= session()->getFlashdata('captcha_error') ?></p>
<?php endif; ?>

<form method="post" action="<?= site_url('registro') ?>">
    <?= csrf_field() ?>

    <label>Nombre</label><br>
    <input type="text" name="nombre" value="<?= old('nombre') ?>"><br><br>

    <label>Correo</label><br>
    <input type="email" name="correo" value="<?= old('correo') ?>"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <label>Confirmar Password</label><br>
    <input type="password" name="password_confirm"><br><br>

    <div class="g-recaptcha" data-sitekey="<?= config('Recaptcha')->siteKey ?>"></div><br>

    <button type="submit">Registrarse</button>
</form>

</body>
</html>
