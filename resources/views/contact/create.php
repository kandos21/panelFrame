<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear </title>
</head>
<body>
    <h1>Crear contacto</h1>

    <form action="/contacts" method="post">
        <label for="name">Dispositivo Nombre</label>
        <input type="text" name="dispositivo_nombre" id="dispositivo_nombre">

        <label for="name">Modelo</label>
        <input type="text" name="dispositivo_modelo" id="dispositivo_modelo">

        <label for="name">Serie</label>
        <input type="text" name="dispositivo_serie" id="dispositivo_serie">

        <label for="name">fabricante</label>
        <input type="text" name="dispositivo_fabricante" id="dispositivo_fabricante">


        <button type="submit"> Crear</button>

        
    
    </form>
</body>
</html>