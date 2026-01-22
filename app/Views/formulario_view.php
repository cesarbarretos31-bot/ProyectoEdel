<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Ultra Validado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Registro Completo (Validación Estricta)</h4>
            </div>
            <div class="card-body">
                
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/formulario/procesar" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?> <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre Completo (Solo letras):</label>
                            <input type="text" name="nombre" class="form-control" value="<?= old('nombre') ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Correo Electrónico:</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Edad (Número entero):</label>
                            <input type="number" name="edad" class="form-control" value="<?= old('edad') ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Precio (Ej: 99.99):</label>
                            <input type="text" name="precio" class="form-control" value="<?= old('precio') ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Fecha de Nacimiento:</label>
                            <input type="date" name="fecha" class="form-control" value="<?= old('fecha') ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Password (Mín. 8 caracteres):</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Subir Foto (JPG/PNG - Máx 2MB):</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Enviar y Validar Datos</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>