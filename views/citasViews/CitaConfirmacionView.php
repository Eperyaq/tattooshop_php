<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmacion de la cita</title>
</head>
<body>
    <h1>Datos de la cita:</h1>

    <?php foreach ($datos as $dato) : ?>
        <li><?= $dato ?> </li>
    <?php endforeach; ?>
    
</body>
</html>