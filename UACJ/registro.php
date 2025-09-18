<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "uni";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexion falló: " . $conn->connect_error);
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloGeneral.css">
    <link rel="stylesheet" href="css/estiloFormulario.css">
    <title>Registrar</title>
</head>
<body>
    
    <main>
        <h1>Inscribir Alumno en Carrera</h1>
        <?php if (isset($mensaje_inscripcion)) echo $mensaje_inscripcion; ?>
        <div class="formulario">
            <form action="" method="POST">
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
                <a href="index.php">Registrar un alumno</a>
            </form>
        </div>
    </main>
</body>
</html>