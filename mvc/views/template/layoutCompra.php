<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
$email = $_SESSION['email'] ?? '';
$rol = $_SESSION['rol'] ?? '';

if (!$auth || $rol !== 'Administrador') {
    header('Location: /login');
    exit;
}

$username = explode('@', $email)[0];

$currentUrl = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelicula-entrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/assets/css/styles.css">
    <link rel="stylesheet" href="../../public/assets/css/pelicula-detalle.css">
    <link rel="stylesheet" href="../../public/assets/css/pelicula-entrada.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <main class="container-fluid main-container">
        <div class="row first-row">
            <div class="col-12 col-md-4">
                <button class="btn button-red mt-4 mt-lg-0 " href="">
                    <span>Regresar</span>
                </button>
            </div>
            <div class="col-12 col-md-8 nav-butaca"> 
                    <a href="">
                        <img src="../../public/assets/images/icons/butaca.png" alt="">
                    </a>
                    <a href="">
                        <img src="../../public/assets/images/icons/ticket.png" alt="">
                    </a>
                    <a href="">
                        <img src="../../public/assets/images/icons/Pago.png" alt="">
                    </a> 


            </div>
        </div>

        <div class="row second-row">
            <div class="col-12 col-md-4 ">
                <div class=" d-flex justify-content-center  ticket-container">
                    <?php include '../pages/ticket.php'; ?>
                </div>
            </div>

        </div>

        <div class="next-div">
            <button class="btn button-red mt-4 mt-lg-0 " href="">
                <span>Continuar</span>
            </button>
        </div>
    </main>
</body>

</html>