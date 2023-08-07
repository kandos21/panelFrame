<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>detalle </h1>
 <a href="/contacts/<?=$contact['id_dispositivo'] ?>/edit">Editar</a>
<p>Nombre: <?=$contact['dispositivo_nombre']  ?></p>
<p>Modelo: <?=$contact['dispositivo_modelo']  ?></p>
<p>Serie: <?=$contact['dispositivo_serie']  ?></p>
<p>Fabricante: <?=$contact['dispositivo_fabricante']  ?></p>

<form action="/contacts/<?=$contact['id_dispositivo'] ?>/delete" method="post">
    <button>
        eliminar
    </button>
</form>
    
</body>
</html>