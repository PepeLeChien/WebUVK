<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Películas</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/assets/css/style.css">
</head>
<body>
    <h1>Películas</h1>
    <div class="movies-container">
        <?php foreach($this->d['movies'] as $movie): ?>
            <div class="movie">
                <h2><?php echo $movie->title; ?></h2>
                <p><?php echo $movie->description; ?></p>
                <img src="<?php echo constant('URL') . 'public/assets/images/' . $movie->image; ?>" alt="<?php echo $movie->title; ?>">
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
