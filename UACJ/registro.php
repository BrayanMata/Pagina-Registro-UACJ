<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Registrar</title>
</head>
<body>
    <form action="index.php" method="POST">
        <h1>Registrar</h1>
        <label for="alumno">Selecciona Alumno:</label><br>
        <select name="alumno" id="alumno" required>
            <option value="">Seleccione un alumno</option>
            <?php
                while($alumno =$alumnos_result->fetch_assoc()){
                    //echo"option value = '{$alumno['Codigo']}'>{$alumno['Nombre']} (Codigo:{$alumno['Codigo']})"; 
                    echo "<option value = '{$alumno['Codigo']}' > {$alumno['Nombre']} (Codigo:{$alumno['Codigo']}) </option>";  
                }
            ?>
            </select><br><br>

            <input type="submit" name="registrar_inscripcion" value="Registrar Inscripcion">

    </form>
    <?php
        $conn -close();
    ?>
</body>
</html>