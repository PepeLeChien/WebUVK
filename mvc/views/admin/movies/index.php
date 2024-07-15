<?php
$extra_js = '<script src="' . constant('URL') . 'public/assets/js/movies.js"></script>';
ob_start();
?>
<div>
    <h1>Películas</h1>
    <a href="<?php echo constant('URL'); ?>admin/peliculas/create" class="btn btn-primary">Crear Película</a>
    <table class="table" id="moviesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Género</th>
                <th>Clasificación</th>
                <th>Fecha de Estreno</th>
                <th>Formatos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se cargarán aquí con AJAX -->
        </tbody>
    </table>
</div>