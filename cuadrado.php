<!DOCTYPE html>
<html>
<head>
    <title>Cuadraditos dentro de un div cuadrado</title>
    <style>
        .cuadrado-grande {
            position: relative;
            background-color: transparent;
            border: 2px solid blue;
            display: grid;
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
    <label for="ancho">Ancho:</label>
    <input type="number" id="ancho" />
    
    <label for="alto">Alto:</label>
    <input type="number" id="alto" />

    <div class="cuadrado-grande" id="cuadrado">
        <?php
            $numCuadraditosRojo = 12;

            for ($i = 1; $i <= ($ancho * $alto); $i++) {
                $clase = ($i <= $numCuadraditosRojo) ? 'rojo' : '';
                echo '<div class="cuadradito ' . $clase . '"></div>';
            }
        ?>
    </div>

    <script>
        const cuadradoDiv = document.getElementById('cuadrado');
        const cuadraditos = cuadradoDiv.querySelectorAll('.cuadradito');
        const anchoInput = document.getElementById('ancho');
        const altoInput = document.getElementById('alto');

        anchoInput.addEventListener('input', actualizarCuadrado);
        altoInput.addEventListener('input', actualizarCuadrado);

        function actualizarCuadrado() {
            const ancho = parseFloat(anchoInput.value) || 0;
            const alto = parseFloat(altoInput.value) || 0;
            const numCuadraditosRojo = 12;

            cuadradoDiv.style.gridTemplateColumns = `repeat(${ancho}, 1fr)`;

            cuadraditos.forEach((cuadradito, index) => {
                const clase = (index < numCuadraditosRojo) ? 'rojo' : '';
                cuadradito.className = `cuadradito ${clase}`;
            });
        }
    </script>
</body>
</html>
