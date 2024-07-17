<?php
include 'includes/templates/pelicula.php';
include 'includes/funciones.php';
include 'includes/config/db.php';

$inicio = true;
incluirTemplate('header', $inicio);

$conn = conectarDb();

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sqlPreVenta = "SELECT id, nombre, url_imagen, estadoEstreno FROM pelicula p WHERE p.estadoEstreno = 'Pre-venta' AND p.estado = 1 LIMIT 5";
$resultPreVenta = $conn->query($sqlPreVenta);

if ($resultPreVenta === false) {
    die("Error en la consulta: " . $conn->error);
}

$sqlPeliculas = "SELECT id, nombre, url_imagen, estadoEstreno FROM pelicula p WHERE p.estadoEstreno IN ('Estreno', 'Pelicula') AND p.estado = 1 LIMIT 5";
$resultPeliculas = $conn->query($sqlPeliculas);

if ($resultPeliculas === false) {
    die("Error en la consulta: " . $conn->error);
}

$sqlEstrenos = "SELECT id, nombre, descripcion, url_portada, estadoEstreno FROM pelicula p WHERE p.estadoEstreno IN ('Estreno', 'Pelicula') AND p.estado = 1 LIMIT 5";
$resultEstrenos = $conn->query($sqlEstrenos);

$estrenos = array();

if ($resultEstrenos->num_rows > 0) {
    while ($row = $resultEstrenos->fetch_assoc()) {
        $estrenos[] = $row;
    }
}


?>



<main>
    <!-- CARRUSEL DE IMAGENES -->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-indicators">
            <?php foreach ($this->d['movies'] as $index => $movie) : ?>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($this->d['movies'] as $index => $movie) : ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $movie['url_portada']; ?>" class="d-block w-100" alt="<?php echo $movie['nombre']; ?>">
                    <div class="carousel-caption caption-div d-none d-md-block">
                        <span class="badge bg-warning text-dark"> <?php echo $movie['estadoEstreno']; ?> </span>
                        <h2> <?php echo $movie['nombre']; ?> </h2>
                        <p> <?php echo $movie['descripcion']; ?> </p>
                        <a class="btn button-red" href="">
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
        <section class="releases"> <!-- CONTENEDOR PARA ESTRENOS -->
            <h3 class="sub-title"><span>&nbsp Próxim</span>os Estrenos</h3>
            <div class="releases-container row gx-4 gy-4">
                <?php
                if ($resultPreVenta->num_rows > 0) {
                    // Iterar sobre los resultados y renderizar cada película
                    $cont = 1;
                    $var = "col-6";
                    while ($row = $resultPreVenta->fetch_assoc()) {
                        if ($cont > 2) {
                            $var = "col-4";
                        }
                        $cont++;
                        echo '<div class="' . $var . ' col-lg">';
                        renderMovie($row["estadoEstreno"], $row["url_imagen"], "#", "#");
                        echo '</div>';
                    }
                } else {
                    echo "<p>No hay próximos estrenos disponibles.</p>";
                }
                ?>


            </div>
        </section>
        <section class="movies"> <!-- CONTENEDOR PARA PELICULAS -->
            <h3 class="sub-title"><span>&nbsp Pelí</span>culas</h3>
            <div class="movies-container row gx-4 gy-4">
                <?php
                if ($resultPeliculas->num_rows > 0) {
                    // Iterar sobre los resultados y renderizar cada película
                    $cont = 1;
                    $var = "col-6";
                    while ($row = $resultPeliculas->fetch_assoc()) {
                        if ($cont > 2) {
                            $var = "col-4";
                        }
                        $cont++;
                        echo '<div class="' . $var . ' col-lg">';
                        renderMovie($row["estadoEstreno"], $row["url_imagen"], "#", "#");
                        echo '</div>';
                    }
                } else {
                    echo "<p>No hay próximos estrenos disponibles.</p>";
                }
                ?>


            </div>
        </section>
    </div>
</main>





<?php
incluirTemplate('footer');
?>