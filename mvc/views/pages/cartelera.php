<?php
$extra_css = '<link rel="stylesheet" href="' . constant('URL') . 'public/assets/css/cartelera.css">';
$extra_js = '<script src="' . constant('URL') . 'public/assets/js/cartelera.js"></script>';

ob_start();
?>

<section id="cartelera">
    <div class="container my-5">
        <div class="row mb-2">
            <div class="col-3">
                <h1 class="sub-title"><span>&nbsp Peli</span>culas</h1>
            </div>
            <div class="col-9 d-flex align-items-center container-buttons-cartelera">
                <a class="button-secondary mx-2 active" id="en-cartelera-btn">En cartelera</a>
                <a class="button-secondary mx-2" id="proximos-estrenos-btn">Próximos estrenos</a>
            </div>
        </div>
        <div class="row">
            <div class="filters col-lg-3 col-md-12">
                <div class="filters-header d-flex align-items-center gap-4">
                    <img src="<?php echo constant('URL'); ?>public/assets/images/svg/IconFilter.svg" alt="IconFilter">
                    <h3>Filtrar por:</h3>
                </div>
                <div class="filters-content">
                    <ul class="p-0 my-4">
                        <li class="filter-li">
                            <div class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-4">
                                    <img src="<?php echo constant('URL'); ?>public/assets/images/svg/location.svg" alt="icono">
                                    <p>Ciudad</p>
                                </div>
                                <img class="fa-icon fa-plus" src="<?php echo constant('URL'); ?>public/assets/images/svg/mas.svg" alt="icono">
                                <img class="fa-icon fa-minus" src="<?php echo constant('URL'); ?>public/assets/images/svg/minus.svg" alt="icono">
                            </div>
                            <div class="filter-body toggle-content">
                                <ul>
                                    <?php foreach ($ciudades as $ciudad) : ?>
                                    <li>
                                        <input type="radio" name="city" id="city-<?php echo $ciudad->id; ?>" value="<?php echo $ciudad->nombre; ?>">
                                        <label for="city-<?php echo $ciudad->id; ?>"><?php echo $ciudad->nombre; ?></label>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-li">
                            <div class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-4">
                                    <img src="<?php echo constant('URL'); ?>public/assets/images/svg/location.svg" alt="icono">
                                    <p>Cine</p>
                                </div>
                                <img class="fa-icon fa-plus" src="<?php echo constant('URL'); ?>public/assets/images/svg/mas.svg" alt="icono">
                                <img class="fa-icon fa-minus" src="<?php echo constant('URL'); ?>public/assets/images/svg/minus.svg" alt="icono">
                            </div>
                            <div class="filter-body toggle-content">
                                <ul>
                                    <?php foreach ($cines as $cine) : ?>
                                    <li>
                                        <input type="radio" name="cine" id="cine-<?php echo $cine->id; ?>" value="<?php echo $cine->nombre; ?>">
                                        <label for="cine-<?php echo $cine->id; ?>"><?php echo $cine->nombre; ?></label>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                        <li class="filter-li">
                            <div class="filter-title toggle-title d-flex align-items-center justify-content-between">
                                <div class="d-flex gap-4">
                                    <img src="<?php echo constant('URL'); ?>public/assets/images/svg/location.svg" alt="icono">
                                    <p>Formato</p>
                                </div>
                                <img class="fa-icon fa-plus" src="<?php echo constant('URL'); ?>public/assets/images/svg/mas.svg" alt="icono">
                                <img class="fa-icon fa-minus" src="<?php echo constant('URL'); ?>public/assets/images/svg/minus.svg" alt="icono">
                            </div>
                            <div class="filter-body toggle-content">
                                <ul>
                                    <?php foreach ($formatos as $formato) : ?>
                                    <li>
                                        <input type="radio" name="formato" id="formato-<?php echo $formato->id; ?>" value="<?php echo $formato->nombre; ?>">
                                        <label for="formato-<?php echo $formato->id; ?>"><?php echo $formato->nombre; ?></label>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 p-5">
                <div class="row" id="movies-list">
                </div>
            </div>
        </div>
    </div>
</section>
 
