<header class="header fixed-top">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="login-container2">
                <img src="<?php echo constant('URL'); ?>public/assets/images/icons/IconUser.png" alt="">
            </div>
            <a class="navbar-brand" href="<?php echo constant('URL'); ?>">
                <img src="<?php echo constant('URL'); ?>public/assets/images/logos/Logo.png" alt="LOGO UVK" width="80px" height="60px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo constant('URL'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL'); ?>cartelera">Cartelera</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL'); ?>cines">Cines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL'); ?>dulceria">Dulcería</a>
                    </li>
                </ul>
                <form class="d-flex search-container" role="search">
                    <img src="<?php echo constant('URL'); ?>public/assets/images/icons/IconSearch.png" alt="">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                </form>
            </div>
            <div class="login-container1">
                <img src="<?php echo constant('URL'); ?>public/assets/images/icons/IconUser.png" alt="">
            </div>
        </div>
    </nav>
</header>
