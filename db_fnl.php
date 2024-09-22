<?php




$root = 'root';
$pswd = '';



//подключение к бд через PDO
try {
    // подключаемся к серверу
    $conn = new PDO('mysql:host=MySQL-8.2;dbname=shop', $root, $pswd);
    echo "Database connection established";
}
//отлов ошибки и вывод
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



