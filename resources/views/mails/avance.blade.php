<!DOCTYPE html>
<html>
<head>
    <title>Recordatorio</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
         .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #add8e6; /* Azul claro */
            border: none;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombreado */
            color: #ffffff; /* Color del texto */
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }
         .letra{
            font-family: 'Roboto', sans-serif;
            font-weight:400;
         }

    </style>
</head>
<body>
        <p class="letra">Hola {{ $nombre }},</p>
        <p class="letra">¡Te encuentras en un emocionante viaje de aprendizaje!</p>
        <p class="letra">Tu porcentaje de avance en el capítulo {{$cap}} es: {{ $ran }}</p>
        <p class="letra">Recuerda que cada paso que das te acerca más a tus metas. ¡Sigue adelante con determinación y alcanzarás grandes logros en este curso!</p>
        <br>
        <p>Si presentas inconvenientes, escribe a: pedro@evolucion.co </p>
        <p class="letra" style="text-center">¡Nunca dejes de aprender!</p>
        <br>
        <center>
        <a class="btn letra" href="https://glearning.com.co/" target="_blank">Continuar</a>
        </center>
</body>
</html>