<?php
function renderMovie($badgeText, $imgSrc, $buyLink, $detailsLink) {
    echo '
    <div class="movie ">
        <span class="badge bg-warning text-dark">' . htmlspecialchars($badgeText) . '</span> <!-- Bootrap etiqueta Estreno -->
        <img src="' . htmlspecialchars($imgSrc) . '" alt="imagenPelicula">

        <div class="movie-buttons"> <!-- Div para botones dentro de la pelicula -->

            <a class="btn button-red" href="' . htmlspecialchars($buyLink) . '"> <!-- comprar html -->
                <img class="button-icon" src="./assets/svg/comprar.svg" alt="">
                <span>Comprar</span>
            </a>

            <a class="btn button-yellow" href="' . htmlspecialchars($detailsLink) . '"> <!-- Detalles html -->
                <img class="button-icon" src="./assets/svg/detalles.svg" alt="">
                <span>Detalles</span>
            </a>
        </div>
    </div>';
}
?>
