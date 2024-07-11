<?php
$title = "UVK Cines - Home";
ob_start();
?>
<div id="carouselExample" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://fastly.picsum.photos/id/862/1500/600.jpg?hmac=oKqTPaADPf31oorI4xub_oOL--_pCHOn4ISvyEACdGU" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://fastly.picsum.photos/id/547/1500/600.jpg?hmac=BBoXNK1UiWhbpiSaslbFzL8CxqthxjOQgHR8SmEwjaU" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://fastly.picsum.photos/id/95/1500/600.jpg?hmac=EkZhCfRZxCGCyL6Y0FtwIT3ghWPWq2lhDrYQ78fZFNU" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://fastly.picsum.photos/id/116/1500/600.jpg?hmac=y0O43C2lt6NawMn0-lmPSnRCnTM8E8ALFVocrS3FUyo" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://fastly.picsum.photos/id/392/1500/600.jpg?hmac=huImLqxpXBHzc8iGWLfbDHXphBvmKQdVtURInpi0z18" class="d-block w-100" alt="...">
        </div>
    </div>
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
            <?php foreach($this->d['movies'] as $movie): ?>
                <div class="col-6 col-lg">
                    <div class="movie">
                        <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($movie->estadoEstreno); ?></span>
                        <img src="<?php echo htmlspecialchars(constant('URL') . 'public/assets/images/' . $movie->url_imagen); ?>" alt="pelicula">
                        <div class="movie-buttons">
                            <a class="btn button-red" href="#">
                                <img class="button-icon" src="<?php echo constant('URL'); ?>public/assets/svg/comprar.svg" alt="">
                                <span>Comprar</span>
                            </a>
                            <a class="btn button-yellow" href="#">
                                <img class="button-icon" src="<?php echo constant('URL'); ?>public/assets/svg/detalles.svg" alt="">
                                <span>Detalles</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="movies">
        <h3 class="sub-title"><span>&nbsp Pelí</span>culas</h3>
        <div class="movies-container row gx-4 gy-4">
            <?php foreach($this->d['movies'] as $movie): ?>
                <div class="col-6 col-lg">
                    <div class="movie">
                        <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($movie->estadoEstreno); ?></span>
                        <img src="<?php echo htmlspecialchars(constant('URL') . 'public/assets/images/' . $movie->url_imagen); ?>" alt="pelicula">
                        <div class="movie-buttons">
                            <a class="btn button-red" href="#">
                                <img class="button-icon" src="<?php echo constant('URL'); ?>public/assets/svg/comprar.svg" alt="">
                                <span>Comprar</span>
                            </a>
                            <a class="btn button-yellow" href="#">
                                <img class="button-icon" src="<?php echo constant('URL'); ?>public/assets/svg/detalles.svg" alt="">
                                <span>Detalles</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();
include realpath(__DIR__ . '/../templates/layout.php');
?>
