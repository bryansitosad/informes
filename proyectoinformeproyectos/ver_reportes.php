<?php
session_start();
require 'db.php';

try {
    $search = isset($_GET['search']) ? trim($_GET['search']) : ''; // Obtenemos el criterio de búsqueda
    if ($search) {
        // Consulta con búsqueda
        $stmt = $pdo->prepare("SELECT reportes.id, usuarios.username, reportes.nombre_proyecto, reportes.descripcion, reportes.fecha_creacion, reportes.total 
                               FROM reportes
                               JOIN usuarios ON reportes.usuario_id = usuarios.id
                               WHERE reportes.nombre_proyecto LIKE :search OR reportes.descripcion LIKE :search");
        $stmt->execute(['search' => "%$search%"]);
    } else {
        // Consulta sin búsqueda (mostrar todos los reportes)
        $stmt = $pdo->query("SELECT reportes.id, usuarios.username, reportes.nombre_proyecto, reportes.descripcion, reportes.fecha_creacion, reportes.total 
                             FROM reportes
                             JOIN usuarios ON reportes.usuario_id = usuarios.id");
    }
    $reportes = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch como array asociativo
} catch (Exception $e) {
    $reportes = []; // En caso de error, inicializamos como un array vacío
    error_log("Error en la consulta de reportes: " . $e->getMessage()); // Log del error
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Todos los Reportes Ingresados</h2>

        <!-- Barra de búsqueda -->
        <form method="get" action="ver_reportes.php" class="search-form">
            <input type="text" name="search" placeholder="Buscar por nombre del proyecto o descripción..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Buscar</button>
        </form>

        <!-- Tabla de reportes -->
        <?php if (!empty($reportes)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
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
                    <td><?php echo htmlspecialchars($reporte['id']); ?></td>
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
        <?php else: ?>
        <p>No se encontraron reportes.</p>
        <?php endif; ?>
    </div>
</body>
</html>

