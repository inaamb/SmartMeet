<?php
header("Content-Type: text/html");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = !empty($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : null;
    $heard_from = htmlspecialchars(trim($_POST['Where center was heard from']));
    $heard_other = ($heard_from == "Other") ? htmlspecialchars(trim($_POST['other'])) : null;
    $booking_satisfaction = intval($_POST['bookingSatisfaction']);
    $navigation_ease = intval($_POST['ease of navigation']);
    $room_type = htmlspecialchars(trim($_POST['room type']));
    $cleanliness_rating = intval($_POST['room cleanliness']);
    $room_match = htmlspecialchars(trim($_POST['did room match style and size requirments?']));
    $room_match_reasons = ($room_match == "No") ? htmlspecialchars(trim($_POST['reasons for style and size dissatisfaction'])) : null;
    $amenities_provided = htmlspecialchars(trim($_POST['were the amenities provided?']));
    $amenities_reasons = ($amenities_provided == "No") ? htmlspecialchars(trim($_POST['reasons for amenities dissatisfaction'])) : null; //because this is an optional question, so the next question can be null.

    //database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rooms";

    
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        
        $stmt = $conn->prepare("INSERT INTO questionnaire_responses (
            name, email, heard_from, heard_other, booking_satisfaction,
            navigation_ease, room_type, cleanliness_rating,
            room_match, room_match_reasons, amenities_provided, amenities_reasons
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssssiissssss", 
            $name, 
            $email,
            $heard_from,
            $heard_other,
            $booking_satisfaction,
            $navigation_ease,
            $room_type,
            $cleanliness_rating,
            $room_match,
            $room_match_reasons,
            $amenities_provided,
            $amenities_reasons
        );


        $stmt->close();
        $conn->close();

        //display thank you page that can take you back to questionnaire.with usual header and footer.
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Thank You</title>
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
                            <h3>Thank You for Your Feedback!</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success">
                                <h4>Thank you, '.$name.'!</h4>
                                <p>We appreciate you taking the time to complete our questionnaire.</p>
                                <p>Your feedback helps us improve our services.</p>
                            </div>
                            <a href="questionnaire.html" class="btn btn-info text-white">Back to Questionnaire</a>
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
    echo'invalid request'
}
?>