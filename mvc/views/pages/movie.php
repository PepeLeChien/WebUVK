<div class="movie">
    <span class="badge bg-warning text-dark"><?php echo htmlspecialchars($movie->estadoEstreno); ?></span>
    <img src="<?php echo htmlspecialchars(constant('URL')  . $movie->url_imagen); ?>" alt="pelicula">
    <div class="movie-buttons">
        <a class="btn button-red" href="<?php echo constant('URL') . 'pelicula-detalle/' . htmlspecialchars($movie->id).'#buyTicket'; ?>">
            <img class="button-icon" src="<?php echo constant('URL'); ?>public/assets/images/svg/comprar.svg" alt="">
            <span>Comprar</span>
        </a>
        <a class="btn button-yellow" href="<?php echo constant('URL') . 'pelicula-detalle/' . htmlspecialchars($movie->id); ?>">
            <img class="button-icon" src="<?php echo constant('URL'); ?>public/assets/images/svg/detalles.svg" alt="">
            <span>Detalles</span>
        </a>
    </div>
</div>
