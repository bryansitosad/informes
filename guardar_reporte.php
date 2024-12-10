<?php
session_start();
require 'db.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Obtiene el nombre de usuario y la fecha de creación
$usuario_id = $_SESSION['user_id'];
$nombre_usuario = $_SESSION['nombre_usuario']; // Asegúrate de que 'nombre_usuario' esté en la sesión
$fecha_creacion = date('Y-m-d H:i:s'); // Fecha y hora actual

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre_proyecto = $_POST['nombre_proyecto'];
    $descripcion = $_POST['descripcion'];
    $total = $_POST['total'];

    // Procesar los documentos cargados
    $documentos = [];
    if (isset($_FILES['documentos']) && is_array($_FILES['documentos']['tmp_name'])) {
        foreach ($_FILES['documentos']['tmp_name'] as $index => $tmp_name) {
            $file_name = $_FILES['documentos']['name'][$index];
            $file_tmp = $_FILES['documentos']['tmp_name'][$index];
            $file_path = 'C:/xampp1/htdocs/proyectoinformeproyectos/uploads/documentos/' . $file_name; // Ruta absoluta
            move_uploaded_file($file_tmp, $file_path);
            $documentos[] = $file_path;
        }
    }

    // Procesar las imágenes cargadas
    $imagenes = [];
    if (isset($_FILES['imagenes']) && is_array($_FILES['imagenes']['tmp_name'])) {
        foreach ($_FILES['imagenes']['tmp_name'] as $index => $tmp_name) {
            $file_name = $_FILES['imagenes']['name'][$index];
            $file_tmp = $_FILES['imagenes']['tmp_name'][$index];
            $file_path = 'C:/xampp1/htdocs/proyectoinformeproyectos/uploads/imagenes/' . $file_name; // Ruta absoluta
            move_uploaded_file($file_tmp, $file_path);
            $imagenes[] = $file_path;
        }
    }

    // Convertir las rutas de los archivos a un formato de texto (puedes usar JSON para guardar múltiples rutas)
    $documentos_ruta = json_encode($documentos);
    $imagenes_ruta = json_encode($imagenes);

    // Insertar el reporte en la base de datos
    $stmt = $pdo->prepare("INSERT INTO reportes (usuario_id, nombre_proyecto, descripcion, fecha_creacion, total, documentos, imagenes) 
                            VALUES (:usuario_id, :nombre_proyecto, :descripcion, :fecha_creacion, :total, :documentos, :imagenes)");

    $stmt->execute([
        'usuario_id' => $usuario_id,
        'nombre_proyecto' => $nombre_proyecto,
        'descripcion' => $descripcion,
        'fecha_creacion' => $fecha_creacion,
        'total' => $total,
        'documentos' => $documentos_ruta,
        'imagenes' => $imagenes_ruta
    ]);

    // Redirige a una página de éxito o muestra un mensaje
    echo "Reporte guardado correctamente.";
    header("Location: dashboard.html");
    exit();
}
?>
