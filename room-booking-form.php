<?php
header("Content-Type: text/html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = htmlspecialchars(trim($_POST['fullname']));
    $customer_email = htmlspecialchars(trim($_POST['email']));
    $customer_phone = htmlspecialchars(trim($_POST['phone']));
    $room_type = htmlspecialchars(trim($_POST['regroom']));
    $booking_date = htmlspecialchars(trim($_POST['date']));
    $start_time = htmlspecialchars(trim($_POST['time']));  
    $num_attendees = intval($_POST['maxpeople']);
    $needs_catering = htmlspecialchars(trim($_POST['catering']));
    $equipment_needed = isset($_POST['additional_equipment']) ? 
                      implode(", ", array_map('htmlspecialchars', (array)$_POST['additional_equipment'])) : 
                      "None";
    $additional_notes = htmlspecialchars(trim($_POST['desc'] ?? ''));

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rooms";

    
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO room_booking_form (
            customer_name, customer_email, customer_phone, room_type,
            booking_date, start_time, num_attendees,
            needs_catering, equipment_needed, additional_notes
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "sssssisss", 
            $customer_name, 
            $customer_email, 
            $customer_phone, 
            $room_type,
            $booking_date, 
            $start_time, 
             
            $num_attendees,
            $needs_catering, 
            $equipment_needed, 
            $additional_notes
        );
        

        
        $stmt->close();
        $conn->close();

        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Booking Confirmation</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        </head>
        <body>
            <header>
                <nav class="navbar navbar-expand-lg bg-light shadow">
                    <div class="container-fluid p-3">
                        <a href="#" class="navbar-brand"><img src="smartmeet transparent bg.PNG" alt="Logo" width=auto height="110px"></a>
                    </div>
                </nav>
            </header>

            <main>
                <div class="container mt-5 mb-5">
                    <div class="card p-4 shadow-lg">
                        <div class="card-header bg-info text-white">
                            <h3>Booking Confirmation</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success">
                                <h4>Thank you, '.$customer_name.'!</h4>
                                <p>Your booking has been received. We\'ll contact you at '.$customer_email.' or '.$customer_phone.' to confirm your booking.</p>
                            </div>

                            <h4 class="mt-4">Booking Details:</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="bg-light">Room Type</th>
                                    <td>'.$room_type.'</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Date & Time</th>
                                    <td>'.$booking_date.' at '.$start_time.'</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Number of Seats</th>
                                    <td>'.$num_attendees.'</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Additional Equipment</th>
                                    <td>'.$equipment_needed.'</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Catering</th>
                                    <td>'.$needs_catering.'</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Additional Information</th>
                                    <td>'.(!empty($additional_notes) ? $additional_notes : "None provided").'</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <a href="room-booking.html" class="btn btn-info text-white">Back to Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="bg-light py-5 mt-5 text-dark">
                <div class="container text-center">
                    <ul class="nav justify-content-center mb-3">
                        <li class="nav-item"><a class="nav-link text-info" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-info" href="about-us.html">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-info" href="contact-us.html">Contact Us</a></li>   
                    </ul>
                    <div class="justify-content-center mb-3">
                        <a href="https://www.instagram.com/youthcenter_om/?theme=dark" class="text-info fs-2 me-3"><i class="bi bi-instagram"></i></a>
                        <a href="https://x.com/youthcenter_om?lang=en" class="text-info fs-2 me-3"><i class="bi bi-twitter"></i></a>
                    </div>
                    <div class="mb-3"> 
                        <p class="text-info">You can reach us at: <a class="text-info" href="mailto:SmartMeet@gmail.com">SmartMeet@gmail.com</a></p>
                        <p class="text-info">&copy; 2025 SmartMeet. All Rights Reserved.</p>
                    </div>
                </div>
            </footer>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>';
     
} else {
    echo 'Invalid request'
}
?>