<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar </title>
</head>
<body>
    <h1>Actualizar contacto</h1>
    <a href="/homes">Regresar</a>
    <form action="/homes/<?=$home['id_dispositivo'] ?>" method="post">
        <label for="name">Dispositivo Nombre</label>
        <input value="<?=$home['dispositivo_nombre'] ?>" type="text" name="dispositivo_nombre" id="dispositivo_nombre">

        <label for="name">Modelo</label>
        <input value="<?=$home['dispositivo_modelo'] ?>" type="text" name="dispositivo_modelo" id="dispositivo_modelo">

        <label for="name">Serie</label>
        <input value="<?=$home['dispositivo_serie'] ?>" type="text" name="dispositivo_serie" id="dispositivo_serie">

        <label for="name">fabricante</label>
        <input value="<?=$home['dispositivo_fabricante'] ?>" type="text" name="dispositivo_fabricante" id="dispositivo_fabricante">


        <button type="submit"> Actualizar</button>

        
    
    </form>
</body>
</html>