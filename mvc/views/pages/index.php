<div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($this->d['movies'] as $index => $movie): ?>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($this->d['movies'] as $index => $movie): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $movie->url_portada; ?>" class="d-block w-100" alt="<?php echo $movie->nombre; ?>">
                    <div class="carousel-caption caption-div d-none d-md-block">
                        <span class="badge bg-warning text-dark"> <?php echo $movie->estadoEstreno; ?> </span>
                        <h2> <?php echo $movie->nombre; ?> </h2>
                        <p> <?php echo $movie->descripcion; ?> </p>
                        <a class="btn button-red" href="<?php echo constant('URL') . 'pelicula-detalle/' . htmlspecialchars($movie->id).'#buyTicket'; ?>">
                            <img class="button-icon" src="./assets/svg/comprar.svg" alt="">
                            <span>Comprar</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Botones de control -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


<div class="main-container">
    <section class="releases">
        <h3 class="sub-title"><span>&nbsp Próxim</span>os Estrenos</h3>
        <div class="releases-container row gx-4 gy-4">
            <?php foreach($this->d['preMovies'] as $movie): ?>
                <div class="col-6 col-lg">
                    <?php include 'movie.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="movies">
        <h3 class="sub-title"><span>&nbsp Pelí</span>culas</h3>
        <div class="movies-container row gx-4 gy-4">
            <?php foreach($this->d['movies'] as $movie): ?>
                <div class="col-6 col-lg">
                    <?php include 'movie.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>