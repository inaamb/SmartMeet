<?php
header("Content-Type: application/xhtml+xml");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $compname = htmlspecialchars($_POST['compname']);
    $desc = htmlspecialchars($_POST['desc']);
    $reqroom = htmlspecialchars($_POST['reqroom']);
    $maxpeople = intval($_POST['maxpeople']);
    $date = $_POST['date'];
    $catering = htmlspecialchars($_POST['catering']);

    $conn = new mysqli("localhost", "root", "", "rooms");

    if ($conn->connect_error) {
        die('<?xml version="1.0" encoding="UTF-8"?>
        <!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head><title>Error</title></head>
        <body><p>Database connection failed: ' . htmlspecialchars($conn->connect_error) . '</p></body>
        </html>');
    }

    $stmt = $conn->prepare("INSERT INTO collaboration 
    (fullname, phone, email, compname, description, reqroom, maxpeople, preferred_date, catering)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssiss", $fullname, $phone, $email, $compname, $desc, $reqroom, $maxpeople, $date, $catering);
    $stmt->execute();
    $stmt->close();

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head><title>Room Booking Requests</title></head><body>';
    echo '<h2>Room Booking Submitted</h2>';
    echo '<p>Thank you ' . $fullname . '. Here are all submissions:</p>';
    echo '<table border="1"><tr>
        <th>Name</th><th>Phone</th><th>Email</th><th>Room</th><th>Date</th><th>People</th><th>Catering</th><th>Submitted</th>
    </tr>';

    $result = $conn->query("SELECT * FROM collaboration ORDER BY submitted_at DESC");

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
            <td>' . htmlspecialchars($row['fullname']) . '</td>
            <td>' . htmlspecialchars($row['phone']) . '</td>
            <td>' . htmlspecialchars($row['email']) . '</td>
            <td>' . htmlspecialchars($row['reqroom']) . '</td>
            <td>' . htmlspecialchars($row['preferred_date']) . '</td>
            <td>' . htmlspecialchars($row['maxpeople']) . '</td>
            <td>' . htmlspecialchars($row['catering']) . '</td>
            <td>' . htmlspecialchars($row['submitted_at']) . '</td>
        </tr>';
    }

    echo '</table></body></html>';

    $conn->close();
} else {
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html>';
    echo '<html xmlns="http://www.w3.org/1999/xhtml"><head><title>Error</title></head>';
    echo '<body><p>Invalid request.</p></body></html>';
}
?>
