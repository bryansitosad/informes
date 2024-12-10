<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        echo "El nombre de usuario ya está en uso. Elige otro.";
    } else {
        // Insertar nuevo usuario en la base de datos
        $stmt = $pdo->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
        $stmt->execute([
            'username' => $username,
            'password' => $password
        ]);

        echo "Usuario registrado con éxito. <a href='login.html'>Iniciar Sesión</a>";
    }
}
?>
