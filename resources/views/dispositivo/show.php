<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivo</title>
</head>
<body>

<h1>detalle </h1>
 <a href="/dispositivo">Lsitado</a>
 <a href="/dispositivo/<?=$dispositivo['id_dispositivo'] ?>/edit">Editar</a>
<p>Nombre: <?=$dispositivo['dispositivo_nombre']  ?></p>
<p>Modelo: <?=$dispositivo['dispositivo_modelo']  ?></p>
<p>Serie: <?=$dispositivo['dispositivo_serie']  ?></p>
<p>Fabricante: <?=$dispositivo['dispositivo_fabricante']  ?></p>

<form action="/dispositivo/<?=$dispositivo['id_dispositivo'] ?>/delete" method="post">
    <button>
        eliminar
    </button>
</form>
    
</body>
</html>

