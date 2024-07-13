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
?> 
  
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title><?php echo $title; ?></title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/assets/AdminKit/css/app.css">
	<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/assets/AdminKit/css/custom.css">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="<?php echo constant('URL'); ?>admin">
				<img src="<?php echo constant('URL'); ?>public/assets/images/logos/LogoUVK_byn.png" alt="Logo UVK Blanco y negro"  width="50px">
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Crud
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link"  href="<?php echo constant('URL'); ?>admin">
							<i class="align-middle" data-feather="sliders"></i> <span
								class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link"  href="<?php echo constant('URL'); ?>admin">
							<i class="align-middle" data-feather="film"></i> <span class="align-middle">Peliculas</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="<?php echo constant('URL'); ?>admin">
							<i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Funciones</span>
						</a>
					</li>
					
					<li class="sidebar-item">
						<a class="sidebar-link"  href="<?php echo constant('URL'); ?>admin">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Usuarios</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link"  href="<?php echo constant('URL'); ?>admin">
							<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign
								Up</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link"  href="<?php echo constant('URL'); ?>">
							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Ver web</span>
						</a>
					</li>

					

					 
				</ul>

				 
			</div>
		</nav>

		<div class="main">
			<?php include_once __DIR__ . '/headerAdmin.php'; ?>

			<main class="content">
				<?php echo $contenido; ?>
			</main>

			<?php include_once __DIR__ . '/footerAdmin.php'; ?>
		</div>
	</div>

	<script src="<?php echo constant('URL'); ?>public/assets/AdminKit/js/app.js"></script>
</body>
</html>
