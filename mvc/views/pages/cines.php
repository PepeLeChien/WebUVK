<?php
$extra_css = '<link rel="stylesheet" href="' . constant('URL') . 'public/assets/css/cine.css">';
$extra_js = '<script src="' . constant('URL') . 'public/assets/js/cine.js"></script>';

ob_start();
?>
<section id="seccion-container">
    <main>
        <section>
            <div class="cine container my-5">
                <div class="row">
                    <!-- Titulo -->
                    <div class="col-md-4">
                        <h1 class="sub-title"><span>&nbsp Nues</span>tros Cines </h1>
                    </div>
                    <!-- end Titulo  -->
                </div>
                <div class="row mt-4">
                    <!-- Primera sede -->
                    <div class="container-cine" style="padding: 20px;">
                        <div class="row">
                            <img src="<?php echo constant('URL'); ?>public/assets/images/img/cines/uvkElAgustino.jpg"  alt="UVK El Agustino">
                            <div class="direccion-cine col-md-6">
                                <h2 class="cine-title">UVK El Agustino</h2>
                                <p>Dirección: Centro Comercial Agustino Plaza, El Agustino. Jr.Ancash 2151</p>
                                <p>Contacto: <a href="mailto:elagustino@uvkmulticines.com">elagustino@uvkmulticines.com</a></p>
                                <br> <a href="https://maps.app.goo.gl/x21kUnCBxiNKCpPc6" target="_blank" class="container-button-cine"> Ver Mapa</a></br>
                            </div>

                        </div>
                    </div>
                    <!-- Segunda sede -->
                    <div class="container-cine" style="padding: 20px;">
                        <div class="row">
                            <div class="direccion-cine col-md-6">
                                <h2 class="cine-title">UVK ILO</h2>
                                <p>Dirección: Centro Comercial Mar Plaza Jr. Abtao 623 - ILO </p>
                                <p>Contacto: <a href="mailto:ilo@uvkmulticines.com">ilo@uvkmulticines.com</a></p>
                                <br> <a href="https://maps.app.goo.gl/adj1eVdqWHkny2tVA" target="_blank" class="container-button-cine"> Ver Mapa</a></br>
                            </div>
                            <img src="<?php echo constant('URL'); ?>public/assets/images/img/cines/uvkILO.jpg" alt="UVK ILO">

                        </div>
                    </div>
                    <!-- Tercera sede -->
                    <div class="container-cine" style="padding: 20px;">
                        <div class="row">
                            <img src="<?php echo constant('URL'); ?>public/assets/images/img/cines/UVKpanorama.jpg"  alt="Sede 3" style="width:50%; height:auto;">
                            <div class="direccion-cine col-md-6">
                                <h2 class="cine-title">UVK PLANTINO PANORAMA</h2>
                                <p>Dirección:Patio Panorama (A media cuadra del Óvalo Monitor) Av. Circunvalación Golf Los Incas 134 - Santiago de Surco</p>
                                <p>Contacto: <a href="mailto:panorama@uvkmulticines.com">panorama@uvkmulticines.com</a></p>
                                <br> <a href="https://maps.app.goo.gl/adj1eVdqWHkny2tVA" target="_blank" class="container-button-cine"> Ver Mapa</a></br>
                            </div>
                        </div>
                    </div>
                    <!-- Cuarta sede -->
                    <div class="container-cine" style="padding: 20px;">
                        <div class="row">
                            <img src="<?php echo constant('URL'); ?>public/assets/images/img/cines/sanMartin.jpg"  alt="UVK San Martin">
                            <div class="direccion-cine col-md-6">
                                <h2 class="cine-title">UVK San Martin</h2>
                                <p>Dirección: Frente a la Plaza San Martín - Cercado de Lima Jr. Ocoña 110</p>
                                <p>Contacto: <a href="mailto:elagustino@uvkmulticines.com">sanmartin@uvkmulticines.com</a></p>
                                <br> <a href="https://maps.app.goo.gl/FGhTb3TsddsVt8YP8" target="_blank" class="container-button-cine"> Ver Mapa</a></br>
                            </div>
                        </div>
                    </div>
                    <!-- Quinta sede -->
                    <div class="container-cine" style="padding: 20px;">
                        <div class="row">
                            <div class="direccion-cine col-md-6">
                                <h2 class="cine-title">UVK Tumbes</h2>
                                <p>Dirección: San Martin, Tumbes 24001 </p>
                                <p>Contacto: <a href="mailto:ilo@uvkmulticines.com">tumbes@uvkmulticines.com</a></p>
                                <br> <a href="https://maps.app.goo.gl/Cp2MNQmkD5FDVREr7" target="_blank" class="container-button-cine"> Ver Mapa</a></br>
                            </div>
                            <img src="<?php echo constant('URL'); ?>public/assets/images/img/cines/tumbes.jpg"    alt="UVK Tumbes">
                        </div>
                    </div>
                    <!-- Sexta sede -->
                    <div class="container-cine" style="padding: 20px;">
                        <div class="row">
                            <img src="<?php echo constant('URL'); ?>public/assets/images/img/cines/Basadre.jpg"    alt="UVK Platino Basadre">
                            <div class="direccion-cine col-md-6">
                                <h2 class="cine-title">UVK Platino Basadre</h2>
                                <p>Dirección: C. Las Palmeras 359, San Isidro 15073</p>
                                <br> <a href="https://maps.app.goo.gl/gGHy8hWe47RbT76R7" target="_blank" class="container-button-cine"> Ver Mapa</a></br>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>

    <div class="pagination">
        <button class="prev-page">
            < </button>
                <button class="page-number">1</button>
                <button class="next-page">></button>
    </div>

</section>