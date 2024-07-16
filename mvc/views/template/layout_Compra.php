<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
$email = $_SESSION['email'] ?? '';
$rol = $_SESSION['rol'] ?? '';

if (!$auth) {
    header('Location: /login');
    exit;
}

$username = explode('@', $email)[0];

$currentUrl = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelicula-entrada</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../public/assets/css/styles.css">
    <link rel="stylesheet" href="../../public/assets/css/pelicula-detalle.css">
    <link rel="stylesheet" href="../../public/assets/css/pelicula-pago.css">
    <link rel="stylesheet" href="../../public/assets/css/pelicula-entrada.css">
    <link rel="stylesheet" href="../../public/assets/css/styles-compra.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Extra CSS -->
    <?php if (isset($extra_css)) : ?>
        <?php echo $extra_css; ?>
    <?php endif; ?>
</head>

<body>
    <main class="container-fluid main-container">
        <!-- Navigation Row -->
        <div class="row first-row align-items-center">
            <div class="col-12 col-md-4">
                <button class="btn button-red mt-4 mt-lg-0" onclick="window.history.back();">
                    <span>Regresar</span>
                </button>
            </div>
            <div class="col-12 col-md-8">
                <div class="nav-butaca d-flex justify-content-end">
                    <a href="/compra">
                        <img src="../../public/assets/images/icons/butaca.png" alt="Butaca">
                    </a>
                    <a href="/compra/tickets">
                        <img src="../../public/assets/images/icons/ticket.png" alt="Ticket">
                    </a>
                    <a href="/compra/pago">
                        <img src="../../public/assets/images/icons/Pago.png" alt="Pago">
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row second-row">
            <div class="col-12 col-md-4">
                <div class="d-flex justify-content-center ticket-container">
                <?php include __DIR__ . '/../pages/ticket.php'; ?>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <?php echo $contenido; ?>
            </div>
        </div>

        <!-- Continue Button -->
        <div class="next-div text-center my-4">
            <a id="continue-button" class="btn button-red mt-4 mt-lg-0" href="#">
                <span>Continuar</span>
            </a>
        </div>

    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom JS -->
    <script src="<?php echo constant('URL'); ?>public/assets/js/compra.js"></script>
    <!-- Extra JS -->
    <?php if (isset($extra_js)) : ?>
        <?php echo $extra_js; ?>
    <?php endif; ?>
</body>

</html>