<div class="container mt-5">
    <h1><?php echo $title; ?></h1>
    <form action="<?php echo isset($movie) ? constant('URL') . 'admin/peliculas/update/' . $movie->id : constant('URL') . 'admin/peliculas/create'; ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($movie) ? $movie->nombre : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo isset($movie) ? $movie->descripcion : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo isset($movie) ? $movie->fecha_inicio : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo isset($movie) ? $movie->fecha_fin : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="id_genero">Género</label>
            <select class="form-control" id="id_genero" name="id_genero" required>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo $genre['id']; ?>" <?php echo isset($movie) && $movie->id_genero == $genre['id'] ? 'selected' : ''; ?>><?php echo $genre['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_clasificacion">Clasificación</label>
            <select class="form-control" id="id_clasificacion" name="id_clasificacion" required>
                <?php foreach ($classifications as $classification): ?>
                    <option value="<?php echo $classification['id']; ?>" <?php echo isset($movie) && $movie->id_clasificacion == $classification['id'] ? 'selected' : ''; ?>><?php echo $classification['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="duracion">Duración (minutos)</label>
            <input type="number" class="form-control" id="duracion" name="duracion" value="<?php echo isset($movie) ? $movie->duracion : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="url_trailer">URL del Trailer</label>
            <input type="url" class="form-control" id="url_trailer" name="url_trailer" value="<?php echo isset($movie) ? $movie->url_trailer : ''; ?>">
        </div>
        <div class="form-group">
            <label for="url_imagen">URL de la Imagen</label>
            <input type="text" class="form-control" id="url_imagen" name="url_imagen" value="<?php echo isset($movie) ? $movie->url_imagen : ''; ?>">
        </div>
        <div class="form-group">
            <label for="estadoEstreno">Estado de Estreno</label>
            <select class="form-control" id="estadoEstreno" name="estadoEstreno" required>
                <option value="Pre-venta" <?php echo isset($movie) && $movie->estadoEstreno == 'Pre-venta' ? 'selected' : ''; ?>>Pre-venta</option>
                <option value="Estreno" <?php echo isset($movie) && $movie->estadoEstreno == 'Estreno' ? 'selected' : ''; ?>>Estreno</option>
                <option value="Pelicula" <?php echo isset($movie) && $movie->estadoEstreno == 'Pelicula' ? 'selected' : ''; ?>>Pelicula</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1" <?php echo isset($movie) && $movie->estado == 1 ? 'selected' : ''; ?>>Activo</option>
                <option value="0" <?php echo isset($movie) && $movie->estado == 0 ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="url_portada">URL de la Portada</label>
            <input type="url" class="form-control" id="url_portada" name="url_portada" value="<?php echo isset($movie) ? $movie->url_portada : ''; ?>">
        </div>
        <div class="form-group">
            <label for="formatos">Formatos</label>
            <select multiple class="form-control" id="formatos" name="formatos[]" required>
                <?php foreach ($formats as $format): ?>
                    <option value="<?php echo $format['id']; ?>" <?php echo isset($movie) && in_array($format['nombre'], $movie->formatos) ? 'selected' : ''; ?>><?php echo $format['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo isset($movie) ? 'Actualizar Película' : 'Crear Película'; ?></button>
    </form>
</div>
