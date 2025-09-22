<?php
require 'config.php'; // Include the connection

// Using PDO
try {
    $stmt = $dbh->query("SELECT * FROM users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['id'] . ", Name: " . $row['name'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>