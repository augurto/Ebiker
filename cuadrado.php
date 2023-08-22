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
            grid-gap: 2px;
        }

        .cuadradito {
            background-color: transparent;
            border: 1px solid green;
        }

        .cuadradito.rojo {
            border-color: red;
            background-color: red;
        }

        input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <label for="filas">Filas:</label>
    <input type="number" id="filas" />
    
    <label for="columnas">Columnas:</label>
    <input type="number" id="columnas" />

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
        const filasInput = document.getElementById('filas');
        const columnasInput = document.getElementById('columnas');

        filasInput.addEventListener('input', actualizarCuadraditos);
        columnasInput.addEventListener('input', actualizarCuadraditos);

        function actualizarCuadraditos() {
            const filas = parseInt(filasInput.value) || 0;
            const columnas = parseInt(columnasInput.value) || 0;
            const numCuadraditosRojo = 12;
            const totalCuadraditos = filas * columnas;

            cuadradoDiv.style.gridTemplateColumns = `repeat(${columnas}, 1fr)`;
            cuadradoDiv.style.gridTemplateRows = `repeat(${filas}, 1fr)`;

            cuadraditos.forEach((cuadradito, index) => {
                const clase = (index < numCuadraditosRojo) ? 'rojo' : '';
                cuadradito.className = `cuadradito ${clase}`;
            });

            if (totalCuadraditos > cuadraditos.length) {
                for (let i = cuadraditos.length; i < totalCuadraditos; i++) {
                    const nuevoCuadradito = document.createElement('div');
                    nuevoCuadradito.className = 'cuadradito';
                    cuadradoDiv.appendChild(nuevoCuadradito);
                }
            } else if (totalCuadraditos < cuadraditos.length) {
                while (cuadraditos.length > totalCuadraditos) {
                    cuadraditos[cuadraditos.length - 1].remove();
                }
            }
        }
    </script>
</body>
</html>
