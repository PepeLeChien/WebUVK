<?php
$action = isset($movie) ? 'Actualizar Película' : 'Crear Película';
$url = isset($movie) ? '/admin/peliculas/edit/' . $movie->getId() : '/admin/peliculas/create';
$selectedFormats = isset($movie) ? $movie->getFormatos() : [];
?>

<div class="container">
    <h1><?php echo $action; ?></h1>
    <form action="<?php echo $url; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre" class="form-label">Título</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $movie->getNombre() ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo $movie->getDescripcion() ?? ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select" id="genero" name="id_genero" required>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['id']; ?>" <?php echo (isset($movie) && $movie->getGenero() == $genre['nombre']) ? 'selected' : ''; ?>>
                        <?php echo $genre['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="clasificacion" class="form-label">Clasificación</label>
            <select class="form-select" id="clasificacion" name="id_clasificacion" required>
                <?php foreach ($classifications as $classification): ?>
                    <option value="<?php echo $classification['id']; ?>" <?php echo (isset($movie) && $movie->getClasificacion() == $classification['nombre']) ? 'selected' : ''; ?>>
                        <?php echo $classification['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Estreno</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $movie->getFechaInicio() ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="formatos" class="form-label">Formatos</label>
            <select class="form-select" id="formatos" name="formatos[]" multiple="multiple" required>
                <?php foreach ($formats as $format): ?>
                    <option value="<?php echo $format['id']; ?>" <?php echo in_array($format['nombre'], $selectedFormats) ? 'selected' : ''; ?>>
                        <?php echo $format['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="url_trailer" class="form-label">URL del Trailer</label>
            <input type="url" class="form-control" id="url_trailer" name="url_trailer" value="<?php echo $movie->getUrlTrailer() ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="url_imagen" class="form-label">URL de la Imagen</label>
            <input type="url" class="form-control" id="url_imagen" name="url_imagen" value="<?php echo $movie->getUrlImagen() ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="estadoEstreno" class="form-label">Estado de Estreno</label>
            <select class="form-select" id="estadoEstreno" name="estadoEstreno" required>
                <option value="Pre-Venta" <?php echo (isset($movie) && $movie->getEstadoEstreno() == 'Pre-Venta') ? 'selected' : ''; ?>>Pre-Venta</option>
                <option value="Estreno" <?php echo (isset($movie) && $movie->getEstadoEstreno() == 'Estreno') ? 'selected' : ''; ?>>Estreno</option>
                <option value="En Cartelera" <?php echo (isset($movie) && $movie->getEstadoEstreno() == 'En Cartelera') ? 'selected' : ''; ?>>En Cartelera</option>
                <option value="Finalizado" <?php echo (isset($movie) && $movie->getEstadoEstreno() == 'Finalizado') ? 'selected' : ''; ?>>Finalizado</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="url_portada" class="form-label">URL de la Portada</label>
            <input type="url" class="form-control" id="url_portada" name="url_portada" value="<?php echo $movie->getUrlPortada() ?? ''; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $action; ?></button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#formatos').select2();
    });
</script>
