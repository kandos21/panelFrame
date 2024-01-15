<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>detalle </h1>
 <a href="/homes/<?=$home['id_dispositivo'] ?>/edit">Editar</a>
<p>Nombre: <?=$home['dispositivo_nombre']  ?></p>
<p>Modelo: <?=$home['dispositivo_modelo']  ?></p>
<p>Serie: <?=$home['dispositivo_serie']  ?></p>
<p>Fabricante: <?=$home['dispositivo_fabricante']  ?></p>

<form action="/homes/<?=$home['id_dispositivo'] ?>/delete" method="post">
    <button>
        eliminar
    </button>
</form>
    
</body>
</html>