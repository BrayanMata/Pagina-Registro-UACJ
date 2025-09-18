<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_alumno'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "uni";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("La conexion falló: " . $conn->connect_error);
        }

        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $edad = $_POST['edad'];
        $telefono = $_POST['telefono'];

        $sql = "INSERT INTO alumnos(Codigo, Nombre, Apellidos, Edad, Telefono)
                VALUES('$codigo', '$nombre', '$apellidos', '$edad', '$telefono')";

        if($conn->query($sql)=== TRUE){
            echo "<p style = 'color=green'>El alumno fue agregado</p>";
        }else{
            echo "<p style='color:red'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloGeneral.css">
    <link rel="stylesheet" href="css/estiloFormulario.css">
    <title>Registro e inscripicion</title>
</head>
<body>
    <main>
        <h1>Registrar Alumno</h1>
        <div class="formulario">
            <form action="index.php" method="POST">
            
                <label for="codigo">Codigo: </label><br>
                <input type="text" id="codigo" name="codigo" required><br><br>

                <label for="nombre">Nombre: </label><br>
                <input type="text" id="nombre" name="nombre"><br><br>

                <label for="apellidos">Apellidos: </label><br>
                <input type="text" id="apellidos" name="apellidos"><br><br>

                <label for="edad">Edad: </label><br>
                <input type="number" id="edad" name="edad"><br><br>

                <label for="telefono">Telefono: </label><br>
                <input type="tel" id="telefono" name="telefono"><br><br>

                <input type="submit" name="agregar_alumno" value="Agregar Alumno">
                <a href="registro.php">Inscribir un alumno</a>
            </form>
        </div>
    </main>
</body>
</html>