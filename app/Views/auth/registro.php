<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        label {
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>

<h2>Registro de Usuario</h2>

<!-- Mensaje de éxito -->
<?php if (session()->getFlashdata('success')): ?>
    <p class="success">
        <?= session()->getFlashdata('success') ?>
    </p>
<?php endif; ?>

<!-- Errores de validación -->
<?php if (session()->getFlashdata('validation')): ?>
    <ul class="error">
        <?= session()->getFlashdata('validation')->listErrors() ?>
    </ul>
<?php endif; ?>

<!-- Error de captcha -->
<?php if (session()->getFlashdata('captcha_error')): ?>
    <p class="error">
        <?= session()->getFlashdata('captcha_error') ?>
    </p>
<?php endif; ?>

<form method="post" action="<?= base_url('registro') ?>">
    <?= csrf_field() ?>

    <label>Nombre</label><br>
    <input type="text" name="nombre" value="<?= old('nombre') ?>" required>
    <br><br>

    <label>Correo</label><br>
    <input type="email" name="correo" value="<?= old('correo') ?>" required>
    <br><br>

    <label>Password</label><br>
    <input type="password" name="password" required>
    <br><br>

    <label>Confirmar Password</label><br>
    <input type="password" name="password_confirm" required>
    <br><br>

    <!-- Google reCAPTCHA -->
    <div class="g-recaptcha" data-sitekey="<?= config('Recaptcha')->siteKey ?>"></div>
    <br>

    <button type="submit">Registrarse</button>
</form>

</body>
</html>
