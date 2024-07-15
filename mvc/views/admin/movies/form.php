<div class="container mt-5">
    <h1><?php echo $title; ?></h1>
    <form method="POST" action="<?php echo constant('URL'); ?>admin/peliculas/<?php echo isset($movie) ? 'edit/' . $movie->getId() : 'create'; ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($movie) ? $movie->getNombre() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo isset($movie) ? $movie->getDescripcion() : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo isset($movie) ? $movie->getFechaInicio() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo isset($movie) ? $movie->getFechaFin() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="id_genero">Género</label>
            <select class="form-control" id="id_genero" name="id_genero" required>
                <?php foreach ($genres as $genre) : ?>
                    <option value="<?php echo $genre['id']; ?>" <?php echo isset($movie) && $movie->getIdGenero() == $genre['id'] ? 'selected' : ''; ?>><?php echo $genre['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_clasificacion">Clasificación</label>
            <select class="form-control" id="id_clasificacion" name="id_clasificacion" required>
                <?php foreach ($classifications as $classification) : ?>
                    <option value="<?php echo $classification['id']; ?>" <?php echo isset($movie) && $movie->getIdClasificacion() == $classification['id'] ? 'selected' : ''; ?>><?php echo $classification['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="duracion">Duración</label>
            <input type="number" class="form-control" id="duracion" name="duracion" value="<?php echo isset($movie) ? $movie->getDuracion() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="url_trailer">URL del Trailer</label>
            <input type="text" class="form-control" id="url_trailer" name="url_trailer" value="<?php echo isset($movie) ? $movie->getUrlTrailer() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="url_imagen">URL de la Imagen</label>
            <input type="text" class="form-control" id="url_imagen" name="url_imagen" value="<?php echo isset($movie) ? $movie->getUrlImagen() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="estadoEstreno">Estado de Estreno</label>
            <select class="form-control" id="estadoEstreno" name="estadoEstreno" required>
                <option value="Pre-venta" <?php echo isset($movie) && $movie->getEstadoEstreno() == 'Pre-venta' ? 'selected' : ''; ?>>Pre-venta</option>
                <option value="Estreno" <?php echo isset($movie) && $movie->getEstadoEstreno() == 'Estreno' ? 'selected' : ''; ?>>Estreno</option>
                <option value="Pelicula" <?php echo isset($movie) && $movie->getEstadoEstreno() == 'Pelicula' ? 'selected' : ''; ?>>Película</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="number" class="form-control" id="estado" name="estado" value="<?php echo isset($movie) ? $movie->getEstado() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="url_portada">URL de la Portada</label>
            <input type="text" class="form-control" id="url_portada" name="url_portada" value="<?php echo isset($movie) ? $movie->getUrlPortada() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="formatos">Formatos</label>
            <select class="form-control" id="formatos" name="formatos[]" multiple>
                <?php foreach ($formats as $format) : ?>
                    <option value="<?php echo $format['id']; ?>" <?php echo isset($movie) && in_array($format['nombre'], $movie->getFormatos()) ? 'selected' : ''; ?>><?php echo $format['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
