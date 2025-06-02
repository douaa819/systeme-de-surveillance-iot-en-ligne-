<?php
require_once 'config.php';

$sql = "SELECT * FROM alerts ORDER BY id DESC";
$result = $conn->query($sql);

$alerts = [];
while ($row = $result->fetch_assoc()) {
    $alerts[] = $row;
}

header('Content-Type: application/json');
echo json_encode($alerts);

$conn->close();
?>
