<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "rooms");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute DELETE query
    $sql = "DELETE FROM room WHERE room_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<p>Room with ID $room_id deleted successfully.</p>";
        } else {
            echo "<p>No room found with ID $room_id.</p>";
        }
    } else {
        echo "<p>Error deleting room: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
