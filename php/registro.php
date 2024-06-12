<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro_contable";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Se registro exitosamente"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

$conn->close();
?>

