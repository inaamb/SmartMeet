<?php
//Database connection
$conn = new mysqli("localhost", "root", "", "rooms");
if ($conn->connect_error) die("Connection failed: ". $conn->connect_error);

$results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_term = $_POST["search_term"];
    
    
    $stmt = $conn->prepare("SELECT * FROM Room WHERE type LIKE ? OR size LIKE ?");
    $search_param = "%$search_term%";
    $stmt->bind_param("ss", $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    $stmt->close();
}


echo '<!DOCTYPE html>
<html>
<head>
    <title>Search Rooms</title>
</head>
<body>
    <h1>Search Rooms</h1>
    
    <form method="POST">
        <input type="text" name="search_term" placeholder="Search by type or size">
        <button type="submit" name="search">Search</button>
    </form>';

if (!empty($results)) {
    echo '<h2>Search Results</h2>
        <table border="1">
            <tr>
                <th>Type</th>
                <th>Size</th>
                <th>Per Hour</th>
                <th>Per Day</th>
            </tr>';
    
    foreach ($results as $room) {
        echo '<tr>
                <td>'.htmlspecialchars($room['type']).'</td>
                <td>'.htmlspecialchars($room['size']).'</td>
                <td>'.htmlspecialchars($room['per_hour']).' OMR</td>
                <td>'.htmlspecialchars($room['per_day']).' OMR</td>
              </tr>';
    }
    
    echo '</table>';
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<p>No rooms found matching your search.</p>';
}

echo '</body>
</html>';

$conn->close();
?>
