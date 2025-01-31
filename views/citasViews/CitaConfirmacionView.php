<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmacion de la cita</title>
    <style>
        .confirmacion-cita{
            display:flex;
            flex-direction: column;
            justify-content:center;
            align-items:center;
            background-color:lightblue;
            width: auto;
        }
    </style>
</head>
<body>
    
    <div class="confirmacion-cita">
        <h1>Datos de la cita:</h1>

        
        <p>Fecha de la cita: <?= $fecha_cita_formatted ?></p>

        
        <p>Descripción del tatuaje: <?= $input_descripcion ?></p>

        <!-- Nombre del cliente -->
        <p>Nombre del cliente: <?= $input_cliente ?></p>

        <!-- Información del tatuador -->
        <h2>Información del Tatuador</h2>
        <p>Nombre del tatuador:</strong> <?= $tatuador["nombre"] ?></p>
        <p>Email del tatuador:</strong> <?= $tatuador["email"] ?></p>

        <!-- Foto del tatuador -->
        <div class="foto-tatuador">
            <img src="<?= $tatuador["foto"] ?>" alt="Foto del tatuador" width="200">
        </div>
    </div>
</body>
</html>