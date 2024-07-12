<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'UVK Cines'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/assets/css/index.css">

    <?php if (isset($extra_css)): ?>
        <?php echo $extra_css; ?>
    <?php endif; ?>

</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>

    <main>
        <?php echo $contenido; ?>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>

    <script src="<?php echo constant('URL'); ?>public/assets/js/index.js"></script>
    <?php if (isset($extra_js)): ?>
        <?php echo $extra_js; ?>
    <?php endif; ?>
</body>
</html>
