<?php
$extra_css = '<link rel="stylesheet" href="' . constant('URL') . 'public/assets/css/pelicula-detalle.css">';
$extra_js = '<script src="https://www.youtube.com/iframe_api"></script> 
<script src="' . constant('URL') . 'public/assets/js/pelicula-detalle.js"></script>';

ob_start();
?>

<main>
    <section class="detail-movie">
        <input type="hidden" id="movie-id" value="<?php echo $movie->id; ?>">
        <div class="detail-movie-cover" id="detailMovieContainer">
            <img class="cover" src="<?php echo constant('URL') . htmlspecialchars($movie->url_portada ?? 'default.jpg'); ?>" alt="Tráiler">
            <div class="detail-movie-container">
                <h1 class="cover-title" id="movie-name-title"><?php echo htmlspecialchars($movie->nombre); ?></h1>
                <div class="detail-movie-content">
                    <p><?php echo htmlspecialchars($movie->descripcion); ?></p>
                    <div class="d-flex gap-5">
                        <a class="btn button-red" href="#buyTicket">
                            <img class="button-icon" src="<?php echo constant('URL') . 'public/assets/images/svg/comprar.svg'; ?>" alt="">
                            <span>Comprar</span>
                        </a>
                        <button class="btn button-red" id="viewTrailerButton">
                            <img class="button-icon" src="<?php echo constant('URL') . 'public/assets/images/svg/VerTrailer.svg'; ?>" alt="">
                            <span>Ver trailer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-container d-none" id="videoContainer">
            <iframe id="trailerVideo" src="<?php echo htmlspecialchars($movie->url_trailer); ?>?enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </section>

    <div class="container" id="buyTicket">
        <div class="row">
            <div class="container text-center my-5 filter-date">
                <h3 class="fecha">Elige una fecha:</h3>
                <p class="filter-month">Mayo</p>
                <div class="row justify-content-center">
                    <?php foreach ($fechasUnicas as $fecha) : ?>
                        <div class="col-auto">
                            <input type="radio" id="fecha<?php echo $fecha; ?>" name="fecha" class="btn-check" autocomplete="off" value="<?php echo $fecha; ?>">
                            <label class="btn btn-date" for="fecha<?php echo $fecha; ?>">
                                <p><?php echo date('d', strtotime($fecha)); ?></p>
                                <span><?php echo date('l', strtotime($fecha)); ?></span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="filters">
                    <div class="filters-header d-flex align-items-center gap-4">
                        <img src="<?php echo constant('URL'); ?>public/assets/images/svg/IconFilter.svg" alt="IconFilter">
                        <h3>Filtrar por:</h3>
                    </div>
                    <div class="filters-content">
                        <ul class="p-0 my-4">
                            <li class="filter-li">
                                <div class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-4">
                                        <img src="<?php echo constant('URL'); ?>public/assets/images/svg/location.svg" alt="icono">
                                        <p>Ciudad</p>
                                    </div>
                                    <img class="fa-icon fa-plus" src="<?php echo constant('URL'); ?>public/assets/images/svg/mas.svg" alt="icono">
                                    <img class="fa-icon fa-minus" src="<?php echo constant('URL'); ?>public/assets/images/svg/minus.svg" alt="icono">
                                </div>
                                <div class="filter-body toggle-content">
                                    <ul>
                                        <?php foreach ($ciudades as $ciudad) : ?>
                                            <li>
                                                <input type="radio" name="city" id="city-<?php echo $ciudad->id; ?>" value="<?php echo $ciudad->nombre; ?>">
                                                <label for="city-<?php echo $ciudad->id; ?>"><?php echo $ciudad->nombre; ?></label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="filter-li">
                                <div class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-4">
                                        <img src="<?php echo constant('URL'); ?>public/assets/images/svg/location.svg" alt="icono">
                                        <p>Cine</p>
                                    </div>
                                    <img class="fa-icon fa-plus" src="<?php echo constant('URL'); ?>public/assets/images/svg/mas.svg" alt="icono">
                                    <img class="fa-icon fa-minus" src="<?php echo constant('URL'); ?>public/assets/images/svg/minus.svg" alt="icono">
                                </div>
                                <div class="filter-body toggle-content">
                                    <ul>
                                        <?php foreach ($cines as $cine) : ?>
                                            <li>
                                                <input type="radio" name="cine" id="cine-<?php echo $cine->id; ?>" value="<?php echo $cine->nombre; ?>">
                                                <label for="cine-<?php echo $cine->id; ?>"><?php echo $cine->nombre; ?></label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="filter-li">
                                <div class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-4">
                                        <img src="<?php echo constant('URL'); ?>public/assets/images/svg/location.svg" alt="icono">
                                        <p>Horario</p>
                                    </div>
                                    <img class="fa-icon fa-plus" src="<?php echo constant('URL'); ?>public/assets/images/svg/mas.svg" alt="icono">
                                    <img class="fa-icon fa-minus" src="<?php echo constant('URL'); ?>public/assets/images/svg/minus.svg" alt="icono">
                                </div>
                                <div class="filter-body toggle-content">
                                    <ul id="horario-list" class="horario-list">
                                        <?php foreach ($funciones as $funcion) : ?>
                                            <li class="horario-item">
                                                <input type="radio" name="horario" id="horario-<?php echo $funcion->id; ?>" value="<?php echo $funcion->id; ?>">
                                                <label for="horario-<?php echo $funcion->id; ?>" class="horario-label">
                                                    <?php echo htmlspecialchars($funcion->horario) . "<br>" . htmlspecialchars($funcion->cine) . "<br>" . htmlspecialchars($funcion->fecha); ?>
                                                </label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 d-flex flex-column flex-lg-row align-items-center">
                <div class="col-12 col-lg-8 d-flex justify-content-center ticket-container">
                    <?php include 'ticket.php'; ?>

                </div>

                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <a href="/compra" class="btn button-red mt-4 mt-lg-0" id="siguiente-btn">
                        <img class="button-icon" src="../assets/svg/comprar.svg" alt="">
                        <span>Siguiente</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>