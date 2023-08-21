<!DOCTYPE html>
<html>
<head>
    <title>Cuadraditos dentro de un div cuadrado</title>
    <style>
        .cuadrado-grande {
            position: relative;
            width: 300px;
            height: 300px;
            background-color: transparent;
            border: 2px solid blue;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 2px;
        }

        .cuadradito {
            background-color: transparent;
            border: 1px solid green;
        }

        .cuadradito.rojo {
            border-color: red;
        }

        input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="cuadrado-grande" id="cuadrado">
        <?php
            $numCuadraditos = 16;
            $numCuadraditosRojo = 12;

            for ($i = 1; $i <= $numCuadraditos; $i++) {
                $clase = ($i <= $numCuadraditosRojo) ? 'rojo' : '';
                echo '<div class="cuadradito ' . $clase . '"></div>';
            }
        ?>
    </div>

    <script>
        const cuadradoDiv = document.getElementById('cuadrado');
        const cuadraditos = cuadradoDiv.querySelectorAll('.cuadradito');

        cuadraditos.forEach(cuadradito => {
            cuadradito.addEventListener('click', () => {
                cuadradito.classList.toggle('rojo');
            });
        });
    </script>
</body>
</html>
