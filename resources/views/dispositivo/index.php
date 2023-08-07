<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach ($dispositivos as $dispositivo) : ?>
                  <tr>
                    <td><a href="/dispositivo/<?= $dispositivo['id_dispositivo'] ?>"><?= $dispositivo['id_dispositivo'] ?></a></td>
                    <td><?= $dispositivo['dispositivo_nombre'] ?></td>
                    <td><?= $dispositivo['dispositivo_serie'] ?></td>
                    <td><?= $dispositivo['dispositivo_fabricante'] ?></td>
                    <td><?= $dispositivo['dispositivo_modelo'] ?></td>
                  </tr>
                <?php endforeach ?>
</body>
</html>