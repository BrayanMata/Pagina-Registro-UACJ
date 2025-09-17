<?php
    // Conexión a la base de datos (esto debe ir al inicio)
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "uni";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }
    
    // --- Lógica para agregar un nuevo alumno ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_alumno'])) {
        $sql = "INSERT INTO alumnos (Nombre, Apellidos, Edad, Telefono) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssis", $_POST['nombre'], $_POST['apellidos'], $_POST['edad'], $_POST['telefono']);

        if ($stmt->execute()) {
            $mensaje_alumno = "<p class='exito'>El alumno fue agregado correctamente.</p>";
        } else {
            $mensaje_alumno = "<p class='error'>Error al agregar el alumno: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    // --- Lógica para registrar una inscripción ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_inscripcion'])) {
        $fecha_actual = date('Y-m-d');
        $sql_insc = "INSERT INTO inscripciones (Fecha, CodigoAlumno, CodigoCarrera) VALUES (?, ?, ?)";
        $stmt_insc = $conn->prepare($sql_insc);
        $stmt_insc->bind_param("sii", $fecha_actual, $_POST['alumno'], $_POST['carrera']);

        if ($stmt_insc->execute()) {
            $mensaje_inscripcion = "<p class='exito'>Inscripción registrada correctamente.</p>";
        } else {
            $mensaje_inscripcion = "<p class='error'>Error al registrar la inscripción: " . $stmt_insc->error . "</p>";
        }
        $stmt_insc->close();
    }

    // Obtener alumnos y carreras
    $alumnos_result = $conn->query("SELECT Codigo, Nombre, Apellidos FROM alumnos ORDER BY Apellidos");
    $carreras_result = $conn->query("SELECT Codigo, Nombre FROM carreras ORDER BY Nombre");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Registro e inscripicion</title>
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Alumno</h1>
        <?php if (isset($mensaje_alumno)) echo $mensaje_alumno; ?>

        <form action="index.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" required>

            <label for="edad">Edad:</label>
            <input type="number" name="edad" required>

            <label for="telefono">Teléfono:</label>
            <input type="tel" name="telefono" required>

            <input type="submit" name="agregar_alumno" value="Agregar Alumno">
        </form>

        <hr>

        <h1>Inscribir Alumno en Carrera</h1>
        <?php if (isset($mensaje_inscripcion)) echo $mensaje_inscripcion; ?>

        <form action="index.php" method="POST">
            <label for="alumno">Selecciona Alumno:</label>
            <select name="alumno" required>
                <option value="">-- Seleccione un alumno --</option>
                <?php while ($alumno = $alumnos_result->fetch_assoc()): ?>
                    <option value="<?= $alumno['Codigo'] ?>">
                        <?= $alumno['Apellidos'] ?>, <?= $alumno['Nombre'] ?> (Código: <?= $alumno['Codigo'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="carrera">Selecciona Carrera:</label>
            <select name="carrera" required>
                <option value="">-- Seleccione una carrera --</option>
                <?php while ($carrera = $carreras_result->fetch_assoc()): ?>
                    <option value="<?= $carrera['Codigo'] ?>">
                        <?= $carrera['Nombre'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="submit" name="registrar_inscripcion" value="Registrar Inscripción">
        </form>
    </div>
</body>
</html>