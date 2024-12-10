<?php
session_start();
require 'db.php';

// Verifica si el usuario es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.html");
    exit();
}

// Consulta los reportes de todos los usuarios
$stmt = $pdo->query("SELECT reportes.id, usuarios.username, reportes.nombre_proyecto, reportes.descripcion, reportes.fecha_creacion, reportes.total 
                     FROM reportes
                     JOIN usuarios ON reportes.usuario_id = usuarios.id");

$reportes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Todos los Reportes Ingresados</h2>
        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre del Proyecto</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportes as $reporte): ?>
                <tr>
                    <td><?php echo htmlspecialchars($reporte['username']); ?></td>
                    <td><?php echo htmlspecialchars($reporte['nombre_proyecto']); ?></td>
                    <td><?php echo htmlspecialchars($reporte['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($reporte['fecha_creacion']); ?></td>
                    <td><?php echo htmlspecialchars($reporte['total']); ?></td>
                    <td>
                        <a href="ver_reporte.php?id=<?php echo $reporte['id']; ?>">Ver</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
