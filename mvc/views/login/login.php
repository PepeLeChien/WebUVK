<?php
$extra_css = '<link rel="stylesheet" href="' . constant('URL') . 'public/assets/css/login.css">';
ob_start();
?>

<!----------------------- Main Container -------------------------->
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
    <div class="row border rounded-5 p-3 shadow box-area login-container" style="max-width: 700px">
        <!--------------------------- Left Box ----------------------------->
        <div class="col-md-6 rounded-4 p-0">
            <img class="img-container rounded-4 img-fluid w-100 h-100" src="<?php echo constant('URL'); ?>public/assets/images/bg/login_bg.jpg">
        </div>
        <!-------------------- ------ Right Box ---------------------------->
        <div class="col-md-6 right-box">
            <form class="mt-5 mx-4" method="POST" novalidate>
                <div class="row align-items-center justify-content-center">
                    <div class="header-text mb-4">
                        <h2 class="text-white">Hola, de nuevo</h2>
                        <p class="text-white">Bienvenido a cines UVK. Inicia Sesion para mejorar tu experiencia.</p>
                    </div>
                    <?php if (!empty($errores)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errores as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Ingrese su Email" required>
                    </div>
                    <div class="input-group mb-5">
                        <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Ingrese su Password" required>
                    </div>

                    <div class="input-group mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg button-red w-50 fs-6">Iniciar Sesion</button>
                    </div>
                    <div class="input-group mb-3 d-flex justify-content-center">
                        <a href="#" class="btn btn-lg w-50 fs-6 button-red">Registrate</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
