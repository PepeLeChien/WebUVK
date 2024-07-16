<?php
$extra_css = '<link rel="stylesheet" href="' . constant('URL') . 'public/assets/css/pelicula-detalle.css">';
$extra_js = '<script src="https://www.youtube.com/iframe_api"></script> 
<script src="' . constant('URL') . 'public/assets/js/pelicula-detalle.js"></script>';

ob_start();
?>

<main>
    <!-- trailer video -->
    <section class="detail-movie">
        <div class="detail-movie-cover" id="detailMovieContainer"> <!-- agregar función js -->
        <img class="cover" src="<?php echo constant('URL') . htmlspecialchars($movie->url_portada ?? 'default.jpg'); ?>" alt="Tráiler">
              <div class="detail-movie-container">
                <h1 class="cover-title"><?php echo htmlspecialchars($movie->nombre); ?></h1>
                <div class="detail-movie-content">
                    <p><?php echo htmlspecialchars($movie->descripcion); ?></p>
                    <div class="d-flex gap-5">
                        <a class="btn button-red" href="#buyTicket"> <!-- comprar html -->
                            <img class="button-icon" src="<?php echo constant('URL') . 'public/assets/images/svg/comprar.svg'; ?>" alt="">
                            <span>Comprar</span>
                        </a>
                        <button class="btn button-red" id="viewTrailerButton"> <!-- comprar html -->
                            <img class="button-icon" src="<?php echo constant('URL') . 'public/assets/images/svg/VerTrailer.svg'; ?>" alt="">
                            <span>Ver trailer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-container d-none" id="videoContainer">
            <iframe id="trailerVideo" src="<?php echo htmlspecialchars($movie->url_trailer); ?>?enablejsapi=1"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <!-- fin trailer video -->
    </section>
    <div class="container" id="buyTicket">
        <div class="row">
            <div class="container text-center my-5 filter-date">
                <h3 class="fecha">Elige una fecha:</h3>
                <p class="filter-month">Mayo</p>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <input type="radio" id="fecha1" name="fecha" class="btn-check" autocomplete="off" checked>
                        <label class="btn btn-date active" for="fecha1">
                            <p>07</p>
                            <span>Martes</span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <input type="radio" id="fecha2" name="fecha" class="btn-check" autocomplete="off">
                        <label class="btn btn-date" for="fecha2">
                            <p>08</p>
                            <span>Miércoles</span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <input type="radio" id="fecha3" name="fecha" class="btn-check" autocomplete="off">
                        <label class="btn btn-date" for="fecha3">
                            <p>09</p>
                            <span>Jueves</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-3">
                <!-- Agregar filtros -->
                <!-- filters -->
                <div class="filters">
                    <!-- columna -->

                    <div class="filters-header d-flex align-items-center gap-4"> <!--  title filters -->
                        <img src="../assets/svg/IconFilter.svg" alt="IconFilter">
                        <h3>Filtrar por:</h3>
                    </div>

                    <div class="filters-content"> <!-- contiene todos los filtros -->
                        <ul class="p-0 my-4"> <!-- contiene la lista filtros -->
                            <!-- filtro 1 -->
                            <li class="filter-li">
                                <div
                                    class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                    <!--  nombre del filtro -->
                                    <div class="d-flex gap-4">
                                        <img src="../assets/svg/location.svg" alt="icono">
                                        <p>Ciudad</p>
                                    </div>
                                    <img class="fa-icon fa-plus" src="../assets/svg/mas.svg" alt="icono">
                                    <img class="fa-icon fa-minus" src="../assets/svg/minus.svg" alt="icono">
                                </div>
                                <div class="filter-body toggle-content ">
                                    <!-- Contenido del filtro (expandir filtro) -->
                                    <ul>
                                        <li>
                                            <input type="radio" name="city" id="city-lima" value="Lima">
                                            <label for="city-lima">Lima</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="city" id="city-abancay" value="Abancay">
                                            <label for="city-abancay">Abancay</label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- END filtro 1 -->

                            <li class="filter-li">
                                <div
                                    class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                    <!--  nombre del filtro -->
                                    <div class="d-flex gap-4">
                                        <img src="../assets/svg/location.svg" alt="icono">
                                        <p>Cine</p>
                                    </div>
                                    <img class="fa-icon fa-plus" src="../assets/svg/mas.svg" alt="icono">
                                    <img class="fa-icon fa-minus" src="../assets/svg/minus.svg" alt="icono">
                                </div>
                                <div class="filter-body toggle-content ">
                                    <!-- Contenido del filtro (expandir filtro) -->
                                    <ul>
                                        <li>
                                            <input type="radio" name="cine" id="cine-lima" value="CP Lima">
                                            <label for="cine-lima">CP Lima</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="cine" id="cine-abancay" value="CP Abancay">
                                            <label for="cine-abancay">CP Abancay</label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- END filtro 1 -->

                        </ul>

                    </div>
                </div>
                <!-- END filters -->
            </div>

            <!-- ticket -->
            <div class="col-lg-9 d-flex flex-column flex-lg-row align-items-center">
                <div class=" col-12 col-lg-8 d-flex justify-content-center  ticket-container">
                    <div class="container mt-5 ticket ">
                        <div class="row pb-5  ticket-content">
                            <div class="row">
                                <div class="col text-left ticket-title">
                                    <h3><?php echo htmlspecialchars($movie->nombre); ?></h3>
                                    <p>Hoy <?php echo date('d \d\e F', strtotime($movie->fecha_inicio)); ?></p>
                                </div>
                            </div>
                            <div class="row ticket-details">
                                <div class="col-6 ticket-details-movie">
                                    <h5>Sala</h5>
                                    <p>Sala 1</p>
                                </div>
                                <div class="col-6 ticket-details-movie">
                                    <h5>Hora</h5>
                                    <p>22:30 PM</p>
                                </div>
                                <div class="col-6 ticket-details-movie">
                                    <h5>Ciudad</h5>
                                    <p>Lima</p>
                                </div>
                                <div class="col-6 ticket-details-movie">
                                    <h5>Cine</h5>
                                    <p>El Agustino</p>
                                </div>
                                <div class="col-6 ticket-details-movie">
                                    <h5>Formato</h5>
                                    <p>Xtreme</p>
                                </div>
                                <div class="col-6 ticket-details-movie">
                                    <h5>Butaca</h5>
                                    <p>----</p>
                                </div>
                            </div>
                            <div class="ticket-icon">
                                <img src="../assets/svg/canchita.svg" alt="Compra" class="comprar-img">
                            </div>
                        </div>

                        <div class="row total-section mt-5 py-3 ">
                            <div class="d-flex gap-4 justify-content-center">
                                <h3 class="m-0">Total:</h3>
                                <p class="m-0">----</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 d-flex justify-content-center ">
                    <button class="btn button-red mt-4 mt-lg-0 " href=""> <!-- comprar html -->
                        <img class="button-icon" src="../assets/svg/comprar.svg" alt="">
                        <span>Siguiente</span>
                    </button>
                </div>
                <!-- END ticket -->
            </div>
        </div>
    </div>
    <section>

    </section>
</main>

 