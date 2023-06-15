Configuracion modo desarollo

1.-Descargar laragon preferentemete.
2.-usar con laragon de lo contrario agregar el host virtual en la siguente ruta 
     C:\Windows\System32\drivers\etc\host.archivo 
3.-agregar la siguiente linea de codigo
     127.0.0.1   prueba.test  //prueba test es el nombre del dominio  
4.-buscar la el siguente archivo en la carpeta de laragon
     C:\laragon\etc\apache2\sites-enabled\auto."nombre de tu carpeta".test
5.-cambiar la ruta de la opcion DocumentRoot por la ruta a donde quieres que apunte o se encuentre tu index ejemplo:
     DocumentRoot "C:/laragon/www/panel/public"
      <Directory "C:/laragon/www/panel">
6.-Cambiar los parametros de la base de datos en config/database.php
    