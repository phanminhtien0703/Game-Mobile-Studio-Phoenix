<?php
try {
    $host = '127.0.0.1';
    $dbname = 'gamemobilestudioadmin';
    $username = 'root';
    $password = '';
    
    // Tạo kết nối PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Thiết lập chế độ báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Kết nối database thành công!";
    
    // Thử truy vấn một bảng để kiểm tra
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<br><br>Danh sách các bảng trong database:<br>";
    foreach ($tables as $table) {
        echo "- " . $table . "<br>";
    }

    // Kiểm tra số lượng bản ghi trong mỗi bảng
    echo "<br>Số lượng bản ghi trong mỗi bảng:<br>";
    foreach ($tables as $table) {
        $stmt = $conn->query("SELECT COUNT(*) FROM `$table`");
        $count = $stmt->fetchColumn();
        echo "- $table: $count bản ghi<br>";
    }
    
} catch(PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}