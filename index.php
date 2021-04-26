<?php
function testConnection(){
    $servername = "mariadb";
    $username = "root";
    $password = "root";

    try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully MariaDB";
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
}

echo "<h1>LAMP - DOCKER</h1>";
echo "<p>Default root password MariaDB: root</p>";
testConnection();
echo "<p><a href='http://127.0.0.1:8000' tagret='_blank'>PhpMyAdmin</a></p>";

phpinfo();
?>