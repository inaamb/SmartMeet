<?php
$conn = new mysqli("localhost", "root", "", "rooms");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$type = $_POST['type'];
$size = $_POST['size'];
$per_hour = $_POST['per_hour'];
$per_day = $_POST['per_day'];

$sql = "INSERT INTO Room (type, size, per_hour, per_day) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdd", $type, $size, $per_hour, $per_day);
$stmt->execute();

echo "<h2>Room Added</h2>
<table border='1'>
<tr><th>Type</th><th>Size</th><th>Per Hour</th><th>Per Day</th></tr>
<tr><td>$type</td><td>$size</td><td>$per_hour OMR</td><td>$per_day OMR</td></tr>
</table>";

$conn->close();
?>
