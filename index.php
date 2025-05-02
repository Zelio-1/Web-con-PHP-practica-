<?php
    require("funciones.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina usando PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/cosmo/bootstrap.min.css" integrity="sha512-PU+mnI7iaSDt/G/adHVcQOX2I+K3bQ27kwHJQ1rPq5iqQvHuHSdJOUU/TmPcUsyUGrfAxK+Z4rnx/SL+qCmBNQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Hola Mundo</h1>
    <?php 
        //Comentrario
        $saludo = "Buenas";
        $titulo = '<h1 class="text-danger">Hola desde PHP</h1>';
        echo $titulo;
        echo "Hola Miguel".$saludo;

        $x = 1;
        $contador = 1;
        while($x<5) {
            $contador += 2;
            if($contador==3) {
                echo '<p>'.$contador.'</p>';
            }
            $x +=1;
        }

    ?>

    <p>La fecha de hoy es: <?=hoy()?></p>

</body>
</html>