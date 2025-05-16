<?php
// features.php
header('Content-Type: application/json');

// Enable error reporting for debugging (optional for development)
ini_set('display_errors', 1);
error_reporting(E_ALL);

$features = [];

$conn = new mysqli("localhost", "root", "", "smart_meet");
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

$sql = "SELECT image_src, feature_name, description FROM features";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $features[] = [
            "imageSrc" => $row['image_src'],
            "featureName" => $row['feature_name'],
            "description" => $row['description']
        ];
    }
}

$conn->close();
echo json_encode($features);
?>
