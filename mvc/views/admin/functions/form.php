<div class="container mt-5">
    <h1><?php echo $title; ?></h1>
    <form method="POST" action="<?php echo constant('URL'); ?>admin/funciones/<?php echo isset($function) ? 'edit/' . $function->getId() : 'create'; ?>">
        <div class="form-group">
            <label for="id_cineSala">Cine Sala</label>
            <select class="form-control" id="id_cineSala" name="id_cineSala" required>
                <?php foreach ($cineSalas as $cineSala) : ?>
                    <option value="<?php echo $cineSala['id']; ?>" <?php echo isset($function) && $function->getIdCineSala() == $cineSala['id'] ? 'selected' : ''; ?>>
                        <?php echo $cineSala['cine_nombre'] . ' - Sala ' . $cineSala['sala_numero']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_peliculaFormato">Película Formato</label>
            <select class="form-control" id="id_peliculaFormato" name="id_peliculaFormato" required>
                <?php foreach ($peliculaFormatos as $peliculaFormato) : ?>
                    <option value="<?php echo $peliculaFormato['id']; ?>" <?php echo isset($function) && $function->getIdPeliculaFormato() == $peliculaFormato['id'] ? 'selected' : ''; ?>>
                        <?php echo $peliculaFormato['pelicula_nombre'] . ' - ' . $peliculaFormato['formato_nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo isset($function) ? $function->getFecha() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="horario">Horario</label>
            <input type="time" class="form-control" id="horario" name="horario" value="<?php echo isset($function) ? $function->getHorario() : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="number" class="form-control" id="estado" name="estado" value="<?php echo isset($function) ? $function->getEstado() : ''; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
