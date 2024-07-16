<?php
$extra_js = '<script src="' . constant('URL') . 'public/assets/js/functions.js"></script>';
ob_start();
?>
<div>
    <h1>Funciones</h1>
    <a href="<?php echo constant('URL'); ?>admin/funciones/create" class="btn btn-primary">Crear Función</a>
    <table class="table" id="functionsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cine Sala</th>
                <th>Película Formato</th>
                <th>Fecha</th>
                <th>Horario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
</div>