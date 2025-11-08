<?php
$host = '127.0.0.1';
$db   = 'gamemobilestudioadmin';
$user = 'phanminhtien';
$pass = '01692294368tien';
$port = "3306";
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
    $pdo = new \PDO($dsn, $user, $pass, $options);
    echo "✅ Kết nối cơ sở dữ liệu thành công! <br>";
    echo "Server Info: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
} catch (\PDOException $e) {
    echo "❌ Lỗi kết nối cơ sở dữ liệu: <br>";
    echo "Error: " . $e->getMessage() . "<br>";
    echo "Code: " . $e->getCode();
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}