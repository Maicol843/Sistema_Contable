<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro_contable";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row["password"])) {
            header("Location: ../html/inicio.html");
            exit();
        } else {
            echo "Contraseña incorrecta. <a href='../index.html'>Volver a intentarlo</a>";
        }
    } else {
        echo "Usuario no encontrado. <a href='../index.html'>Volver a intentarlo</a>";
    }
}

$conn->close();
?>
