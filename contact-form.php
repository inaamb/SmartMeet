<?php
header("Content-Type: application/xhtml+xml");


$conn = new mysqli("localhost", "root", "", "rooms");
if ($conn->connect_error) {
    die('<?xml version="1.0" encoding="UTF-8"?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml"><head><title>Error</title></head><body>
    <p>Database connection failed: ' . htmlspecialchars($conn->connect_error) . '</p>
    </body></html>');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $help = $conn->real_escape_string($_POST['help']);

    $sql = "INSERT INTO help_requests (fullname, phone, email, help) VALUES ('$fullname', '$phone', '$email', '$help')";
    if (!$conn->query($sql)) {
        die('<?xml version="1.0" encoding="UTF-8"?>
        <!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml"><head><title>Error</title></head><body>
        <p>Database insert failed: ' . htmlspecialchars($conn->error) . '</p>
        </body></html>');
    }
} else {
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html>';
    echo '<html xmlns="http://www.w3.org/1999/xhtml"><head><title>Error</title></head><body>';
    echo '<p>Invalid request.</p></body></html>';
    exit;
}

$result = $conn->query("SELECT fullname, phone, email, help, submitted_at FROM help_requests ORDER BY submitted_at DESC");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" ';
echo '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml">';
echo '<head><title>Help Requests</title>';
echo '<style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #999; padding: 8px; }
        th { background: #eee; }
      </style>';
echo '</head><body>';
echo '<h2 style="text-align:center;">Submitted Help Requests</h2>';
echo '<table><tr><th>Full Name</th><th>Phone</th><th>Email</th><th>Help Request</th><th>Submitted At</th></tr>';

while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['fullname']) . '</td>';
    echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
    echo '<td>' . nl2br(htmlspecialchars($row['help'])) . '</td>';
    echo '<td>' . htmlspecialchars($row['submitted_at']) . '</td>';
    echo '</tr>';
}

echo '</table></body></html>';

$conn->close();
?>
